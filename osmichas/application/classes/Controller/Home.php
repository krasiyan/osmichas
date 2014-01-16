<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Controller
 * @author Krasiyan Nedelchev
 */
class Controller_Home extends Controller_Main {

	public function action_index()
	{
		$this->add_vars(array(
			'test' => 'test1'
		));
	}

}