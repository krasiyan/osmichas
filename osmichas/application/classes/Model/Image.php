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
	protected $_belongs_to = array(
		'user' => array('model' => 'User', 'foreign_key' => 'user_id')
	);

	public function upload($image, $user, $source)
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
		$this->user_id = $user->id;
		if($this->user->is_editor())
			$this->confirmed = 1;
		if($source)
			$this->source = $source;
		$this->save();

		return $this;
	}
	
	public function print_labels(){
		$labels = array();
		foreach($this->labels->find_all() as $label)
		{
			$labels[] = $label->text;
		}
		return implode(',', $labels);
	}

	public function print_tags(){
		$tags = array();
		foreach($this->tags->find_all() as $tag)
		{
			$tags[] = $tag->label;
		}
		return implode(',', $tags);
	}
}