<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php foreach( $tags as $tag ): ?>
	<a class="fancybox" rel="gal" href="<?= URL::site('ajax/preview_image', TRUE) . '/' . $tag->image_id ?>" >
		<img src="<?= URL::site('image/fetch_tag', TRUE) . '/' . $tag->id ?>" class="tag" title="<?= $tag->label ?>" />
	</a>
<?php endforeach;?>