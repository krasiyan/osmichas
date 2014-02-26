<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php foreach( $tags as $tag ): ?>
	<a class="fancybox" href="<?= URL::site('ajax/view_image', TRUE) . '/' . $tag->image_id ?>">
		<img src="<?= URL::site('image/fetch_tag', TRUE) . '/' . $tag->id ?>" class="tag" title="<?= $tag->label ?>" />
	</a>
<?php endforeach;?>