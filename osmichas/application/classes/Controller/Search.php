<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package OsmiChas
 * @category Controller
 * @author Krasiyan Nedelchev
 */
class Controller_Search extends Controller_Main {

	public function action_index()
	{
		$this->title = 'Бързо и удобно търсене на графични учебни материали';

		$tags = ORM::factory('Tag')
			->order_by('tag.id', 'DESC')
			->find_all();

		$this->add_vars('tags', $tags);
	}

}