<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Model
 * @author Krasiyan Nedelchev
 */
class Model_Image extends ORM {

	protected $_table_name = 'image';
	protected $_primary_key = 'id';
	protected $_has_many = array(
		'tags' => array('model' => 'Tag', 'foreign_key' => 'image_id'),
		'labels' => array('model' => 'Label', 'through' => 'image_label'),
	);
	
	public function upload($image)
	{
		if (
			! Upload::valid($image) OR
			! Upload::not_empty($image) OR
			! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif')) OR
			! Arr::get($image, 'tmp_name')
		)
		{
			return FALSE;
		}

		$image_obj = Image::factory(Arr::get($image,'tmp_name'));
		if( ! $image_obj) return FALSE;

		if( $image_obj->width > 1024 )
		{
			$image_obj = $image_obj->resize(1024, NULL);
		}
		
		if( $image_obj->height > 1280 )
		{
			$image_obj = $image_obj->resize(NULL, 1280);
		}

		$this->mime = $image_obj->mime;
		$this->extension = $image_obj->type;
		$this->size = filesize($image_obj->file);
		$this->content = base64_encode($image_obj->render('jpg'));
		$this->save();

		return $this;
	}
	
}