<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron text-center">
	<p>
		<strong>„Осми час“</strong> е интернет приложение, насочено към ученици и студенти, 
		предоставящо бързо и удобно търсене на графични материали с учебна насоченост. 
	</p>
	<h4>Осмият час започна. Въвeди своите критерии за търсене и натисни "Търси". Приятен час!</h4>
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

	<div class="row top-spacer" id="preloader" > 
		<img src="<?=URL::site('', TRUE)?>images/preloader.gif" alt="Loading ..." />
	</div>
	<div class="row" id="search-results" style="display:none">
		<?= View::factory('frontend/ajax/search')->set('tags', $tags) ?>
	</div>
</div>