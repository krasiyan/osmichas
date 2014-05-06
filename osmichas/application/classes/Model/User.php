<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Model
 * @author Krasiyan Nedelchev
 */
class Model_User extends Model_Auth_User {

	protected $_table_name = 'user';
	protected $_primary_key = 'id';
	
	/**
	 * A user has many tokens and roles
	 *
	 * @var array Relationhips
	 */
	protected $_has_many = array(
		'user_tokens' => array('model' => 'User_Token'),
		'roles'       => array('model' => 'Role', 'through' => 'role_user'),
	);

	public function rules()
	{
		return array(
			'email' => array(
				array('not_empty'),
				array('email'),
				array(array($this, 'unique'), array('email', ':value')),
			),
			'name' => array(
				array('not_empty')
			)
		);
	}

	public function is_editor()
	{
		return $this->has('roles', ORM::factory('Role', array('name' => 'editor')));
	}
	
	public function is_admin()
	{
		return $this->has('roles', ORM::factory('Role', array('name' => 'admin')));
	}
	
	public function contributions_left()
	{
		return Kohana::$config->load('application.contributions_for_editor');
	}
}