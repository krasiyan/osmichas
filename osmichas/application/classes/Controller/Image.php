<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Controller
 * @author Krasiyan Nedelchev
 */
class Controller_Image extends Controller_Main {

	public function action_index(){
		$this->redirect(URL::site());
	}

	public function action_fetch(){
		$this->auto_render = FALSE;

		$image = ORM::factory('Image', (int) $this->request->param('id'));

		if(  ! $this->request->param('id') OR ! $image->loaded() )
		{
			return $this->redirect(URL::site('image/upload'));
		}
		
		$expires_header = 60*60*24*14;

		// $this->response->headers('Pragma', 'public');
		// $this->response->headers('Cache-Control', 'maxage='.$expires_header);
		// $this->response->headers('Expires', gmdate('D, d M Y H:i:s', time() + $expires_header) . ' GMT');
		// $this->response->headers('Content-length', $image->size);
		$this->response->headers('Content-Type', $image->mime);

		echo base64_decode($image->content);
	}

	public function action_fetch_tag(){
		$this->auto_render = FALSE;

		$tag = ORM::factory('Tag', (int) $this->request->param('id'));

		if(  ! $this->request->param('id') OR ! $tag->loaded() OR ! $tag->image->loaded() )
		{
			$this->response->status(404);
			return ;
		}
		
		$expires_header = 60*60*24*14;

		$this->response->headers('Content-Type', 'image/jpg');

		$temp_image = tmpfile();
		fwrite($temp_image, base64_decode($tag->image->content));
		$temp_image_meta = stream_get_meta_data($temp_image);
		$temp_image_path = ( isset($temp_image_meta['uri']) ? $temp_image_meta['uri'] : NULL );
		
		if( ! $temp_image_path )
		{	
			$this->response->status(404);
			return ;
		}

		$image = Image::factory($temp_image_path);
		
		$width = $tag->end_x - $tag->start_x;
		$height = $tag->end_y - $tag->start_y;

		echo $image
			->crop($width, $height, $tag->start_x, $tag->start_y)
			->render();
			
		fclose($temp_image);

	}

	public function action_upload()
	{
		$this->title = 'Добавяне на изображение';
	}
	
	public function action_tager()
	{
		$this->title = 'Тагване на изображение';

		$image = ORM::factory('Image', (int) $this->request->param('id'));
		if (
			! $this->user OR
 			!$image->loaded() OR
			!$this->user->can_edit_image($image) OR
			!$this->request->param('id')
		)
			return $this->redirect(URL::site('image/upload'));
		
		$this->add_vars('image', $image);
	}

	public function action_remove()
	{
		$image = ORM::factory('Image', (int) $this->request->param('id'));

		if(  $this->user AND $this->user->can_edit_image($image) AND $this->request->param('id') AND $image->loaded() )
		{
			$image->remove('labels');

			foreach ( $image->tags->find_all() as $tag )
			{
				$tag->delete();
			}
			$image->delete();
		}
		$this->redirect(URL::site());
	}

	public function action_for_approval()
	{
		$this->title = "Материали за одобрение";
		if (!$this->user OR !$this->user->is_editor())
			$this->redirect(URL::site());

		$images = ORM::factory('Image')
			->where('confirmed', '=', 0)
			->find_all();
		$this->add_vars('images', $images);
	}

	public function action_view()
	{
		$image = ORM::factory('Image', $this->request->param('id'));
		if (!$image->confirmed)
			$this->redirect(URL::site());
		
		$labels = array_values($image->labels->find_all()->as_array('id', 'text')); 
		$tags = array_values($image->tags->find_all()->as_array('id', 'label'));

		$this->meta['keywords'] = implode(',', $labels + $tags);
		$this->meta['description'] = implode(',', $labels + $tags);
		$this->title = substr( implode(',', $tags), 0, 200);

		$this->add_vars('image', $image);
		$this->add_vars('labels', $labels);
		$this->add_vars('tags', $tags);
	}
}