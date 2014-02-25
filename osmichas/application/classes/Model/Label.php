<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Model
 * @author Krasiyan Nedelchev
 */
class Model_Label extends ORM {

	protected $_table_name = 'label';
	protected $_primary_key = 'id';
	protected $_has_one = array(
		'parent' => array('model' => 'Label', 'foreign_key' => 'parent_id'),
	);
	protected $_has_many = array(
		'images' => array('model' => 'Image', 'through' => 'image_label'),
	);
	
}