<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package OsmiChas
 * @category Model
 * @author Krasiyan Nedelchev
 */
class Model_User_Token extends Model_Auth_User_Token {

	protected $_table_name = 'user_token';
	protected $_primary_key = 'id';

	// Relationships
	protected $_belongs_to = array(
		'user' => array('model' => 'User'),
	);
	
} // End Auth User Token Model
