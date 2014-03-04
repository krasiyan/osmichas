<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Controller
 * @author Krasiyan Nedelchev
 */
class Controller_Ajax extends Controller_Main {

	public function before()
	{
		$this->auto_render = FALSE;

		// if( ! $this->ajax )
		// {
		// 	$this->redirect(URL::site());
		// }
	}

	public function action_labels()
	{
		
		$labels = ORM::factory('Label')->find_all()->as_array();

		$labels_rendered = $this->fetch_labels($labels);
		
		print json_encode($labels_rendered);
	}

	private function fetch_labels(&$labels, $parent_id = 0){
		$labels_rendered = array();

		foreach( $labels as $label ) 
		{	
			if( (! $label->parent_id AND ! $parent_id ) OR ( $parent_id AND $label->parent_id == $parent_id ) )
			{
				$labels_rendered[] = array(
					'id' => $label->id,
					'text' => $label->text,
					'children' => $this->fetch_labels($labels, $label->id)
				);
			}
		}

		return $labels_rendered;
	}

	public function action_upload_image()
	{
		$error = FALSE;
		if ( ! empty($_FILES) AND Arr::get($_FILES, 'image') ) {

			$image = ORM::factory('Image')
				->upload(Arr::get($_FILES, 'image'));
			
			if( ! $image ) $error = TRUE;
		}
		else $error = TRUE;
		

		if( $error) {
			$this->response->status(500);
			print 'Невалидно изображение!';
		}
		else {
			print $image->id;
		}
	}

	public function action_save_tag()
	{
		$image = ORM::factory('Image', $this->request->post('imageid'));
		
		if( 
			! $this->request->post('imageid') OR 
			! $image->loaded() OR
			! $this->request->post('width') OR
			! $this->request->post('height') OR
			! $this->request->post('label')
		) {
			print 0;
		}
		else 
		{
			$tag = ORM::factory('Tag');
			$tag->image = $image;
			$tag->start_x = $this->request->post('left');
			$tag->start_y = $this->request->post('top');
			
			$tag->end_x = $this->request->post('left') + $this->request->post('width');
			$tag->end_y = $this->request->post('top') + $this->request->post('height');

			$tag->label = $this->request->post('label');

			if( $tag->save() )
			{
				print $tag->id;
			}
			else 
			{
				print '0';
			}
		}
	}

	public function action_delete_tag()
	{
		$image = ORM::factory('Image', $this->request->post('imageid'));
		$tag = ORM::factory('Tag', $this->request->post('tagid'));
		
		if( 
			! $this->request->post('imageid') OR 
			! $image->loaded() OR
			! $this->request->post('tagid') OR
			! $tag->loaded() OR
			$tag->image_id != $image->id
		) {
			print 0;
		}
		else 
		{
			$tag->delete();
			print 1;
		}
	}

	public function action_search()
	{
		$results = array();
		if( 
			! $this->request->post('search') OR 
			! ($parameters = explode(',', $this->request->post('search'))) OR
			empty($parameters) 
		)
		{
			print json_encode($results);
		}
		else {
			$tags = ORM::factory('Tag');

			$tags->join('image')->on('image.id','=','tag.image_id');
			$tags->join('image_label')->on('image.id','=','image_label.image_id');

			$i = 0;
			foreach( $parameters as $parameter )
			{
				if( ! is_numeric($parameter) ) 
				{
					if( $i++ and $i == 1)
					{
						$tags->where_open();
					}
					$tags->or_where('tag.label', 'SOUNDS LIKE', $parameter);
				}		
			}
			if( $i )
			{
				$tags->where_close();
			}

			
			$tags->where_open();
			foreach( $parameters as $parameter )
			{
				if( is_numeric($parameter) ) 
				{
					$tags->where('image_label.label_id', '=', $parameter);
				}		
			}
			$tags->where_close();
			
			$tags
				->group_by('tag.id')
				->order_by('image.created_at', 'DESC');

			$tags = $tags->find_all();

			$tags_view = View::factory('frontend/ajax/search');
			$tags_view->set('tags', $tags);
			$this->response->body($tags_view);
		}
	}

	public function action_view_image(){
		$this->auto_render = FALSE;

		$image = ORM::factory('Image', (int) $this->request->param('id'));
		if(  ! $this->request->param('id') OR ! $image->loaded() )
		{
			$this->response->status(404);
			return ;
		}
		
		$image_view = View::factory('frontend/ajax/view_image');
		$image_view->set('image', $image);
		$this->response->body($image_view);
	}

	public function action_image_label(){
		$this->auto_render = FALSE;

		$image = ORM::factory('Image', (int) $this->request->post('imageid'));
		$label = ORM::factory('Label', (int) $this->request->post('labelid'));

		if(  
			! $this->request->post('imageid') OR 
			! $image->loaded() OR
			! $this->request->post('labelid') OR 
			! $label->loaded() OR
			! in_array($this->request->post('action'), array('remove', 'add'))
		)
		{
			print 0;
		}
		else {
			if( $this->request->post('action') == 'add' ){
				$image->add('labels', $label);	
			}
			else {
				$image->remove('labels', $label);	
			}
			print 1;
		}
	}
}