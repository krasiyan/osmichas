<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron">
	<h4>Добави на нов учебен материал</h4>
	<div class="row">
		<form action="<?= URL::site('ajax/upload_image') ?>" class="dropzone text-center" method="POST" enctype="multipart/form-data" id="imageUpload">
			<input type="hidden" name="t" value="t" />
			<div class="fallback">
				<input type="file" name="image"  />
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
	</div>
</div>