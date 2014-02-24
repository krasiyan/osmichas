<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron">
	<h4>Добавяне на нов материал</h4>
	<div class="row">
		<form action="<?= URL::site('ajax/upload_image') ?>" class="dropzone text-center" method="POST" enctype="multipart/form-data" id="imageUpload">
			<input type="hidden" name="t" value="t" />
			<div class="fallback">
				<input type="file" name="image"  />
			</div>
		</form>
	</div>
</div>