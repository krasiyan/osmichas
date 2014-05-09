<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Controller
 * @author Krasiyan Nedelchev
 */
class Controller_Main extends Controller_Template {
	public $template = 'layout';

	/**
	 * @var string views directory
	 */
	public $directory = 'frontend';

	/**
	 * @var String path to the view file for the current request
	 */
	public $view = '';

	/**
	 * @var Array variable to render the view
	 */
	public $vars = array();

	/**
	 * @var Boolean a flag whether to perform an user check
	 */
	protected $user_check = TRUE;

	/**
	 * @var String The site title
	 */
	protected $title = FALSE;

	/**
	 *
	 * @var Array holds the scripts to load on the page 
	 */
	public $scripts = array();
	
	/**
	 *
	 * @var array holds the inline scripts for printing php variables and more; will be printed last on the page 
	 */
	public $inline_scripts = array();
	
	/**
	 *
	 * @var array the scripts which wil load in the head like cufon and others 
	 */
	public $head_scripts = array();
	
	/**
	 *
	 * @var Array holds the stylesheets to load on the page 
	 */
	public $styles = array();
	
	/**
	 *
	 * @var Array holds the meta properties for the header
	 */
	public $meta = array();
	
	
	/**
	 *
	 * @var Boolean checks if the request is an XMLHttpRequest 
	 */
	protected $ajax = FALSE;
	
	
	/**
	 *
	 * @var Boolean check if the request is a post request and has a valid $_POST array 
	 */
	protected $valid_post = FALSE;

	/**
	 * 
	 * @var string name of the current action 
	 */
	protected $action;

	/**
	 * 
	 * @var string name of the current controller
	 */
	protected $controller;

	/**
	 *
	 * @var Boolean indicate wheter a view should automatically be rendered or not
	 */

	//protected $auto_render = TRUE;

	public function before()
	{
		$this->ajax = $this->request->is_ajax();
		$this->action = strtolower($this->request->action());
		$this->controller = strtolower($this->request->controller());
		
		if ($this->request->is_ajax())
		{
			$this->ajax = TRUE;
		}
		if (Request::POST == $this->request->method() && Valid::not_empty($this->request->post()))
		{
			$this->valid_post = TRUE;
		}

		View::set_global('controller', $this->controller);
		View::set_global('action', $this->action);

		$this->auth = Auth::instance();
		$this->facebook = FB::factory();

		$facebook_login_params = array(
			'scope' => Kohana::$config->load('FB.permissions'),
			'redirect_uri' => URL::site(Kohana::$config->load('FB.login_url'), TRUE)
		);

		$this->facebook_login_url = $this->facebook->getLoginUrl($facebook_login_params);
		View::set_global('fb_login_url', $this->facebook_login_url);

		View::set_global('fb_app_id', Kohana::$config->load('FB.appId'));

		$this->user = ( $this->auth->logged_in() ? $this->auth->get_user() : null );
		View::set_global('user', $this->user);

		$this->waiting_for_approval = ORM::factory('Image')
			->where('confirmed', '=', 0)
			->find_all()
			->count();
		View::set_global('waiting_for_approval', $this->waiting_for_approval);

		$this->meta['fb:app_id'] = Kohana::$config->load('FB.appId');
		$this->meta['og:title'] = Kohana::$config->load('application.title');
		$this->meta['og:type'] = "website";
		$this->meta['og:image'] = URL::site(Kohana::$config->load('application.logo'), TRUE);

	}

	/**
	 * Merges the given array with the current template variables
	 *
	 * @param Array|String $arr template variables to be added as array or a name of the variable added if a second parameter is provided
	 * @param mixed $var the variable to be added if provided
	 * @return $this
	 */
	protected function add_vars($arr, $var = NULL)
	{
		if (is_array($arr))
		{
			$this->vars = array_merge($this->vars, $arr);
		}
		elseif (is_string($arr))
		{
			$this->vars[$arr] = $var;
		}
		return $this;
	}

	protected function bind_var($name, & $value)
	{
		$this->vars[$name] = & $value;
		return $this;
	}

	public function after()
	{
		if (( ! $this->request->is_initial() || $this->request->is_ajax()))
		{
			if ($this->request->controller() != 'error')
			{
				$this->auto_render = FALSE;
			}
		}

		if ($this->view === '' && $this->auto_render)
		{
			$this->view = $this->controller.'/'.$this->action;
		}
		if ($this->view && ! Kohana::find_file('views', $this->view))
		{
			$this->view = $this->directory.'/'.$this->view;
		}

		if ($this->auto_render === TRUE)
		{
			$this->title = 
				empty($this->title) ? 
					Inflector::humanize(
						$this->action == 'index' ? $this->controller : $this->action.' - '.$this->controller
					) : 
				$this->title;

			$this->template = View::factory($this->template);

			$this->template->title = ucwords(Kohana::$config->load('application.title').' - '.$this->title);
			$this->template->meta = array_merge(Kohana::$config->load('application')->get('meta', array()), $this->meta);

			$resources = Kohana::$config->load('resources.frontend');

			$this->template->styles = array_merge($resources['styles'], $this->styles);
			$this->template->scripts = array_merge($this->scripts, $resources['scripts']);
			$this->template->content = View::factory($this->view, $this->vars);

			// used for correct error handling from view
			$this->template->content = $this->template->content->render();

			$this->template->header = View::factory($this->directory.'/header');
			$this->template->footer = View::factory($this->directory.'/footer');
		}
		else
		{
			if ($this->view)
			{
				$this->response->body(View::factory($this->view, $this->vars));
			}
		}
		parent::after();
	}
}
