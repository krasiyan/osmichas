<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron">

	<div class="row-fluid">
		<div class="span12 text-center">
			<img src="<?= URL::site('image/fetch', TRUE) . '/' . $image->id; ?>" data-iddb="<?= $image->id ?>" id="image" class="img-responsive" />
		</div>
	</div>
	
</div>

<script>
	var tags = [
		<?php foreach( $image->tags->find_all() as $tag ): ?>
			{
				'id': <?= $tag->id ?>,
				'label': '<?= $tag->label ?>',
				'width': <?= $tag->end_x - $tag->start_x ?>, 
				'height': <?= $tag->end_y - $tag->start_y ?>,
				'top': <?= $tag->start_y ?>,
				'left': <?= $tag->start_x ?>
			},
		<?php endforeach; ?>
	]
</script>