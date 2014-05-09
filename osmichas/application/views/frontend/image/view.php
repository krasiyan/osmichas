<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron">
	<div class="text-left">
		<strong class="pull-left">
			<?= implode(', ', $labels+$tags) ?>
		</strong>
		<br />
		<h4>
			Добавил: <strong><?=$image->user->name ?></strong>
			<?php if($image->user->school): ?>
				, Училище: <strong><?=$image->user->school ?></strong>
			<?php endif;?>
			<?php if($image->source): ?>
				, Източник: <strong><?=$image->source ?></strong>
			<?php endif;?>
		</h4>
	</div>
	
	<div class="row-fluid span12 text-center">
		<img src="<?= URL::site('image/fetch', TRUE) . '/' . $image->id; ?>" data-iddb="<?= $image->id ?>" id="image" class="img-responsive center-block" />
		<div class="fb-comments top-spacer" data-href="<?= URL::site('image/view', TRUE) . '/' . $image->id ?>" data-numposts="5" data-colorscheme="light"></div>
	</div>


</div>