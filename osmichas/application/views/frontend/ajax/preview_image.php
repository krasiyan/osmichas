<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php $labels = $image->labels->find_all()->as_array('id', 'text') ?>

<div class="btn-group text-center pull-right">
	<?php if($user AND $user->can_edit_image($image)): ?>
		<a class="btn btn-warning" href="<?=URL::site('image/tager').'/'.$image->id ?>">Редакция</a>
	<?php endif ?>
	<a class="btn btn-info" href="<?=URL::site('image/view').'/'.$image->id ?>" target="_new">Виж в цял размер</a>
</div>

<strong class="pull-left">
	<?= implode(', ', array_values($labels)) ?>
</strong>
<br />
<h4 class="pull-left">
		Добавил: <strong><?=$image->user->name ?></strong>
		<?php if($image->user->school): ?>
			, Училище: <strong><?=$image->user->school ?></strong>
		<?php endif;?>
</h4>

<div class="clearfix"></div>

<img src="<?= URL::site('image/fetch', TRUE) . '/' . $image->id ?>" class="img-responsive" id="image-box" />
