<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php $labels = $image->labels->find_all()->as_array('id', 'text') ?>

<div class="btn-group text-center pull-right">
	<a class="btn btn-warning" href="<?=URL::site('image/tager').'/'.$image->id ?>">Редакция</a>
	<a class="btn btn-info" href="<?=URL::site('image/fetch').'/'.$image->id ?>" target="_new">Пълен размер</a>
</div>

<strong class="pull-left">
	<?= implode(', ', array_values($labels)) ?>
</strong>

<div class="clearfix"></div>

<img src="<?= URL::site('image/fetch', TRUE) . '/' . $image->id ?>" class="img-responsive" id="image-box" />
