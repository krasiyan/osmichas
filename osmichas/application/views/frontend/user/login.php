<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron text-center">
	<p>
		Моля, въведи своето потребителско име и парола за <strong>„Осми час“</strong> или 
		<a href="<?= $fb_login_url?>" class="btn btn-info">
			Влез с Facebook&nbsp;&nbsp;<span class="icon-fb">
		</a>
	</p>
	
	<p>
		Нямаш акаунт? <a href="<?= URL::site('user/register') ?>">Регистрирай се!</a>
	</p>
	
	<?php if ($message): ?>
		<div class="alert alert-danger"><?=$message?></div>
	<?php endif ?>
	
	<form method="POST" action="<?=URL::site('user/login')?>" class="form-horizontal center-block" role="form" id="login-form">
		<div class="form-group">
			<div class="col-lg">
				<label class="sr-only" for="email">Имейл адрес</label>
				<input type="email" name="email" class="form-control input-lg" id="email" placeholder="Имейл адрес" focus>
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg">
				<label class="sr-only" for="password">Парола</label>
				<input type="password" name="password" class="form-control input-lg" id="password" placeholder="Парола">
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg">
				<button type="submit" class="btn btn-lg btn-success">Вход</button>
			</div>
		</div>
	</form>