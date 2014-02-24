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

		$this->response->headers('Pragma', 'public');
		$this->response->headers('Cache-Control', 'maxage='.$expires_header);
		$this->response->headers('Expires', gmdate('D, d M Y H:i:s', time() + $expires_header) . ' GMT');
		$this->response->headers('Content-length', $image->size);
		$this->response->headers('Content-Type', 'image/gif');

		echo base64_decode($image->content);
	}

	public function action_upload()
	{
		$this->title = 'Добавяне на изображение';
	}
	public function action_tag()
	{
		$image = ORM::factory('Image', (int) $this->request->param('id'));

		if(  ! $this->request->param('id') OR ! $image->loaded() )
		{
			return $this->redirect(URL::site('image/upload'));
		}

		$this->title = 'Обособяване на изображение';	

		$this->bind_var('image', $image);

	}
}