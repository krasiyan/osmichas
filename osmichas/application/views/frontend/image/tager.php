<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron">
	<div class="row-fluid text-center">
		<h3>Добави категории и селектирай части от изображението</h3>
		<h4>Промените се отразяват автоматично</h4>
	</div>

	<div class="row-fluid text-center">
		<input type="text" name="labels" id="image-labels" class="form-control input-large " placeholder="Избери категории от списъка">
	</div>

	<div class="row-fluid top-spacer">
		<div class="span12 text-center">
			<img src="<?= URL::site('image/fetch', TRUE) . '/' . $image->id; ?>" data-iddb="<?= $image->id ?>" id="image" class="img-responsive" />
		</div>
	</div>
	
	<div class="row-fluid text-center">
		<a class="btn btn-danger" href="<?=URL::site('image/remove').'/'.$image->id ?>">Изтрий изображение</a>
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
	];
	var labels = [
		<?php foreach( $image->labels->find_all() as $label ): ?>
			'<?= $label->id ?>',
		<?php endforeach; ?>
	]
</script>