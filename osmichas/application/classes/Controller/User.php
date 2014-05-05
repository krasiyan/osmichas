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

	public function action_profile()
	{
		$this->auto_render = FALSE;
		
		if (! $this->user )
			$this->redirect(URL::site('user/login'));

		$education = Arr::get($this->facebook->api('/me'),'education', array());
		$school = Arr::get(Arr::get(end($education), 'school', array()), 'name');
		var_dump($school);
	}

	public function action_login()
	{

	}

	public function action_logout()
	{
		if (! $this->user )
			$this->redirect(URL::site('user/login'));
		else {
			Auth::instance()->logout();
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

		Auth::instance()->force_login($user);
		return $this->redirect(URL::site('user/profile'));
	}

}