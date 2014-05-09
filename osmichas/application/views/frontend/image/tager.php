<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron">
	<div class="row-fluid text-center">
		<h3>Добави категории и селектирай (тагни) части от изображението</h3>
		<h4>Промените се отразяват автоматично</h4>
	</div>

	<div class="row-fluid text-center" id="image-labels-wrapper">
		<input type="text" name="labels" id="image-labels" class="form-control input-large " placeholder="Избери категории от списъка">
	</div>


	<div class="row-fluid text-center top-spacer" id="tager-description">
		<p>
			Опитвай се, частите, които обособяваш да са с <strong>минимална площ</strong>, и същевременно да носят смисъл <strong>сами по себе си</strong>.
		</p>
		<p>
			Придържай се към <strong>кратките</strong>, <strong>ясни</strong> и <strong>точни</strong> имена на таговете
		</p>
	</div>

	<h4>
		Добавил: <strong><?=$image->user->name ?></strong>
		<?php if($image->user->school): ?>
			, Училище: <strong><?=$image->user->school ?></strong>
		<?php endif;?>
	</h4>
	
	<div class="row-fluid">
		<div class="span12 text-center">
			<img src="<?= URL::site('image/fetch', TRUE) . '/' . $image->id; ?>" data-iddb="<?= $image->id ?>" id="image" class="img-responsive" />
		</div>
	</div>


	<div class="clearfix"></div>
	
	<div class="row-fluid text-left">
		<?php if($user->is_editor()): ?>
			<div class="checkbox">
				<label class="control-label">
					<h4>
						Авторски материал
						<input type="checkbox" name="private_material" <?=$image->source ? '' : 'checked' ?>>
					</h4>
					<div id="source-wrapper" class="control-group col-md">
						<input 
							type="text" 
							value="<?=$image->source ?>" 
							name="source" 
							id="source" 
							placeholder="Моля, посочи източника на материала" 
							class="form-control input-md inline"
							style="display:inline-block; width:80%">
						<button id="source-save" class="btn btn-success inline">
							Запази източник
						</button>
					</div>
				</label>
			</div>
			<div class="checkbox">
				<label class="control-label">	
					<h4>
						Позволи да се вижда на сайта
						<input type="checkbox" name="approved" <?=$image->confirmed ? 'checked' : '' ?>>
					</h4>
				</label>
			</div>
		<?php endif ?>
		<a class="btn btn-danger pull-right" href="<?=URL::site('image/remove').'/'.$image->id ?>">Изтрий изображението</a>
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