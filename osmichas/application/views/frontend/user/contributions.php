<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron text-center">
	<h3>Моите материали</h3>
	<div class="row images">
		<?php foreach($images as $image): ?>
			<div class="col-sm-6 col-md-4 image-container">
				<div class="thumbnail">
					<span class="image-status label label-<?=$image->confirmed ? 'success' : 'warning' ?>">
						<?=$image->confirmed ? 'Одобрен' : 'Чака одобрение' ?>
					</span>
					<img src="<?= URL::site('image/fetch', TRUE) . '/' . $image->id ?>" alt="...">
					<h4><?= $image->print_labels() ?: '...' ?></h4>
					<span><?= $image->print_tags() ?: '...' ?></span>
					<p>
						<a href="<?=URL::site('image/tager')?>/<?=$image->id?>" class="btn btn-success" role="button">Редактирай</a> 
					</p>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>