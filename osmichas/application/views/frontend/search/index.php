<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron">
	<h2>Осмият час настана...</h2>
	<div class="row">
		<form action="<?= URL::site() ?>" method="POST" id="home-search-form">
			<div class="control-group input-group" id="home-search-wrapper">
				<input type="text" name="search" id="home-search" class="form-control input-large " placeholder="Въведи ключова дума или избери от списъка">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary btn-lg" id="home-search-start">Търси</button>
				</span>
			</div>
		</form>
	</div>
	<div class="row" id="search-results">
	</div>
</div>