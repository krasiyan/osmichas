<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Model
 * @author Krasiyan Nedelchev
 */
class Model_Userlabel extends ORM {

	protected $_table_name = 'userlabel';
	protected $_primary_key = 'id';
	protected $_has_one = array(
		'parent' => array('model' => 'Userlabel', 'foreign_key' => 'parent_id'),
	);
	
}