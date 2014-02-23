<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron">
	<h4>Добавяне на нов материал</h4>
	<div class="row">
		<form action="<?= URL::site('/upload') ?>" class="dropzone text-center" method="POST" enctype="multipart/form-data" id="imageUpload">
			<div class="fallback">
				<input type="file" name="image"  />
			</div>
			<button type="submit" id="start-upload" class="btn btn-primary btn-lg hidden">Качи материала</button>	
		</form>
	</div>
</div>