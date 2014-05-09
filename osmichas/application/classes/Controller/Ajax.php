<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Controller
 * @author Krasiyan Nedelchev
 */
class Controller_Ajax extends Controller_Main {

	public function before()
	{
		parent::before();
		$this->auto_render = FALSE;
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
		if (!$this->user)
		{
			if (
				(!$this->request->post('private_material') OR $this->request->post('private_material') == "off") AND 
				!$this->request->post('source') 
			)
			{
				$error = "Моля, посочи източник!";
			}
			else if (!$this->request->post('email')) 
			{
				$error = "Моля, въведи имейл!";
			}
			else 
			{
				$user = ORM::factory('User', array('email' => $this->request->post('email')));
				
				if ($user->loaded() AND $user->active) 
				{
					$error = "Този имейл вече е регистриран!";
				}
				else if (!$user->loaded()) 
				{
					$user = $user->soft_register($this->request->post('email'));
					$this->auth->force_login($user);
					if(!is_object($user))
						$error = $user;
				}
			}
		}
		else 
		{
			$user = $this->user;
		}
		if (!$error)
		{
			if (!empty($_FILES) AND Arr::get($_FILES, 'image'))
			{
				$image = ORM::factory('Image')
					->upload(Arr::get($_FILES, 'image'), $user, $this->request->post('source'));
				if (!$image) $error = 'Невалидно изображение!';
			}
			else $error = 'Невалидно изображение!';
		}
		

		if ($error) 
		{
			$this->response->status(500);
			print $error;
		}
		else 
		{
			print $image->id;
		}
	}

	public function action_save_tag()
	{
		$image = ORM::factory('Image', $this->request->post('imageid'));
		if($this->user AND $this->user->can_edit_image($image))
		{
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

				if ( $tag->save() )
				{
					if (!$this->user->is_editor())
					{
						$tag->image->confirmed = 0;
						$tag->image->save();
					}

					print $tag->id;
				}
				else 
				{
					print '0';
				}
			}
		}
		else
			print 0;
	}

	public function action_delete_tag()
	{
		$image = ORM::factory('Image', $this->request->post('imageid'));
		if($this->user AND $this->user->can_edit_image($image)) {

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
				if (!$this->user->is_editor())
				{
					$tag->image->confirmed = 0;
					$tag->image->save();
				}
				
				print 1;
			}
		}
		else
			print 0;
	}

	public function action_search_image()
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

			$tags->select(DB::expr('GROUP_CONCAT(image_label.label_id) as label_ids'));
			$tags->join('image')->on('image.id','=','tag.image_id');
			$tags->join('image_label', 'LEFT')->on('image.id','=','image_label.image_id');

			foreach( $parameters as $parameter )
			{
				if( ! is_numeric($parameter) ) 
				{
					$tags->where_open();
						$tags->where('tag.label', '=', $parameter);
						$tags->or_where('tag.label', 'LIKE', $parameter.'%');
						$tags->or_where('tag.label', 'LIKE', '%'.$parameter);
						$tags->or_where('tag.label', 'LIKE', '%'.$parameter.'%');
					$tags->where_close();
				}		
			}

			$tags
				->group_by('tag.id')
				->order_by('image.created_at', 'DESC');

			$tags = $tags->find_all();
			
			$tags_filtered = array();

			foreach( $tags as $tag ){
				$tag_label_ids = explode(',', $tag->label_ids);

				$matching_search = TRUE;
				foreach( $parameters as $parameter )
				{
					if( is_numeric($parameter) ) 
					{
						if( in_array($parameter, $tag_label_ids) === FALSE )
						{
							$matching_search = FALSE;
							break;
						}
					}
				}
				if( $matching_search AND $tag->image->confirmed )
				{
					$tags_filtered[] = $tag;
				}
			}

			$tags_view = View::factory('frontend/ajax/search_image');
			$tags_view->set('tags', $tags_filtered);
			$this->response->body($tags_view);
		}
	}

	public function action_preview_image(){
		$this->auto_render = FALSE;

		$image = ORM::factory('Image', (int) $this->request->param('id'));
		if(  ! $this->request->param('id') OR ! $image->loaded() )
		{
			$this->response->status(404);
			return ;
		}
		
		$image_view = View::factory('frontend/ajax/preview_image');
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

	public function action_image_status()
	{
		$this->auto_render = FALSE;
		if ((int) $this->request->post('imageid') AND $this->user AND $this->request->post('status') !== NULL)
		{
			$image = ORM::factory('Image', (int) $this->request->post('imageid'));
			if ($this->user->can_edit_image($image)){
				$image->confirmed = ( $this->request->post('status') ? 1 : 0 );
				$image->save();
				print 1;
				return;
			}
		}
		print 0;
	}

	public function action_image_source()
	{
		$this->auto_render = FALSE;
		if ((int) $this->request->post('imageid') AND $this->user)
		{
			$image = ORM::factory('Image', (int) $this->request->post('imageid'));
			if ($this->user->can_edit_image($image)){
				$image->source = ( $this->request->post('source') ? : NULL );
				$image->save();
				print 1;
				return;
			}
		}
		print 0;
	}

}