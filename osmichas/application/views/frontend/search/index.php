<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron">
	<h2>Осмият час настана...</h2>
	<div class="row">
		<form action="<?= URL::site() ?>" method="POST">
			<div class="input-group" id="home-search-wrapper">
				<input type="text" name="query" id="home-search" class="form-control input-large chzn-custom-value" placeholder="Въведи ключова дума или избери от списъка">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary btn-lg">Търси</button>
				</span>
			</div>
		</form>
	</div>
</div>