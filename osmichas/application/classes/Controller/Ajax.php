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

	public function action_userlabels()
	{
		$a = array(1,2,3);
		print json_encode($a);
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
}