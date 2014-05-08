<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Controller
 * @author Krasiyan Nedelchev
 */
class Controller_User extends Controller_Main {

	public function action_index()
	{
		if (! $this->user )
			$this->redirect(URL::site('user/login'));
		else 
			$this->redirect(URL::site('user/profile'));
	}


	public function action_login()
	{
		if ($this->user)
			return $this->redirect(URL::site('user/profile'));
		
		$message = '';

		if ($this->valid_post)
		{
			if ($this->auth->login(
				$this->request->post('email'), 
				$this->request->post('password')
			))
			{
				$this->redirect(URL::site('user/profile'));
			}
			else 
			{
				$message = "Грешно потребителско име или парола!";
			}
		}

		$this->add_vars('message', $message);
		$this->add_vars('email', $this->request->post('email'));
	}

	public function action_logout()
	{
		if (! $this->user )
			$this->redirect(URL::site('user/login'));
		else {
			$this->auth->logout();
			$this->redirect(URL::site());
		}
	}

	public function action_fblogin()
	{
		$this->auto_render = FALSE;

		if ($this->user)
			return $this->redirect(URL::site('user/profile'));
		
		if ( ! $fbid = $this->facebook->getUser() OR ! $fb_data = $this->facebook->api('/me') )
			return $this->redirect(URL::site());

		$user = ORM::factory('User')
			->where('fbid', '=', $fbid)
			->find();
		
		if ( ! $user->loaded())
		{
			$education = Arr::get($this->facebook->api('/me'),'education', array());
			$school_name = Arr::get(Arr::get(end($education), 'school', array()), 'name');
			
			$user->values(array(
				'fbid' => $fbid,
				'email' => Arr::get($fb_data, 'email'),
				'school' => $school_name,
			))->save();
		}

		$this->auth->force_login($user);
		return $this->redirect(URL::site('user/profile'));
	}

	public function action_register()
	{
		$errors = array();
		$user = ORM::factory('User');

		if ($this->valid_post)
		{
			$user->values(
				$this->request->post(), 
				array('name', 'password', 'email', 'school')
			);
			try
			{
				$extra_rules = Validation::factory($this->request->post())
					->rule('password', 'not_empty')
					->rule('school', 'not_empty')
					->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));

				$user->save($extra_rules);
				$user->add('roles', ORM::factory('Role', array('name'=>'member')));
				$this->redirect(URL::site('user/profile'));
			}
			catch (ORM_Validation_Exception $e) {
				$errors = $e->errors('models');
				$errors = array_merge($errors, Arr::get($errors, '_external', array()));
			}
		}

		$this->add_vars('errors', $errors);
		$this->add_vars('user', $user);
	}

	public function action_profile()
	{
		if (! $this->user )
			$this->redirect(URL::site('user/login'));
		
		$errors = array();	
		$user = $this->user;
		
		if ($this->valid_post)
		{
			if ($this->request->post('password'))
				$user->values(
					$this->request->post(), 
					array('password', 'school')
				);
			else 
				$user->values(
					$this->request->post(), 
					array('school')
				);

			try
			{
				$extra_rules = Validation::factory($this->request->post());
				if ($this->request->post('password')){
					$extra_rules->rule('password', 'not_empty');
					$extra_rules->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));
				}
				$extra_rules->rule('school', 'not_empty');

				$user->save($extra_rules);
				$errors = 'success';
			}
			catch (ORM_Validation_Exception $e) {
				$errors = $e->errors('models');
				$errors = array_merge($errors, Arr::get($errors, '_external', array()));
			}
		}

		$this->add_vars('errors', $errors);
		$this->add_vars('user', $user);
	}

	public function action_contributions()
	{
		$images = $this->user->images->find_all();
		$this->add_vars('images', $images);
	}
}