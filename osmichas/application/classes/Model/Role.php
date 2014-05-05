<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Model
 * @author Krasiyan Nedelchev
 */
class Model_Role extends Model_Auth_Role {

	protected $_table_name = 'role';
	protected $_primary_key = 'id';

	// Relationships
	protected $_has_many = array(
		'users' => array('model' => 'User','through' => 'role_user'),
	);
}