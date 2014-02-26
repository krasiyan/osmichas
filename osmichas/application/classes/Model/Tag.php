<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Model
 * @author Krasiyan Nedelchev
 */
class Model_Tag extends ORM {

	protected $_table_name = 'tag';
	protected $_primary_key = 'id';
	protected $_belongs_to = array(
		'image' => array('model' => 'Image'),
	);
	
}