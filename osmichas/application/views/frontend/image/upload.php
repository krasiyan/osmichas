<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron">
	<?php if (!$user): ?>
		<h4 class="text-center">Може да добавяш материали и без да имаш акаунт. Просто въведи имейл адреса си!</h4>
	<?php endif ?>

	<div class="row top-spacer">
		<form action="<?= URL::site('ajax/upload_image') ?>" class="dropzone text-center" method="POST" enctype="multipart/form-data" id="imageUpload">
			<input type="hidden" name="t" value="t" />
			<div class="fallback">
				<input type="file" name="image"  />
			</div>

			<div class="checkbox">
				<label class="control-label">
					<p>
						Този материал е личен и имам права над него
						<input type="checkbox" name="private_material" checked>
					</p>
					<div class="col-md">
						<input type="text" name="source" id="source" placeholder="Моля, посочи източника на материала" class="form-control input-md" >
					</div>
				</label>
			</div>
		</form>
		<div class="pull-right" id="upload-description">
			<p>
				Съдържанието на сайта се контролира <strong>пряко от неговите потребители</strong>. 
				<strong>„Осми час“</strong> приветства всякакви графични материали с единствените условия те:
			</p>
			<ul>
				<li>Да не нарушават по никакъв начин авторското право или законите на Република България</li>
				<li>Да нe са нецензурни или вулгарни</li>
				<li>Да се виждат ясно и да са съставени по начин, който е разбираем за целевата им аудитория</li>
			</ul>
		</div>

		<?php if (!$user): ?>
			<div class="clearfix"></div>
			<div class="col-md text-center 	center-block">
				<label class="sr-only" for="email">Имейл адрес</label>
				Ние никога няма да публиуваме твоя имейл адрес в интернет пространството!
				<input type="email" name="email" class="form-control text-center center-block input-md" id="noacc-email" placeholder="Имейл адрес" focus>
			</div>
		<?php endif ?>
		
		<div class="clearfix"></div>

		<div class="checkbox text-center">
			<label class="control-label">	
				<h3>
					Съгласен съм с условията на сайта. Добави материала сега!
				</h3>
					<input type="checkbox" name="tos" value="0">
			</label>
		</div>
	</div>
</div>