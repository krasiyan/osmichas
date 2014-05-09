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
			->join('image')
				->on('image.id', '=', 'tag.image_id')
			->where('image.confirmed', '=', 1)
			->order_by('tag.id', 'DESC')
			->find_all();

		$tags_filtered = array();
		foreach($tags as $tag)
		{
			if($tag->image->confirmed)
				$tags_filtered[] = $tag;
		}

		$this->add_vars('tags', $tags_filtered);
	}

}