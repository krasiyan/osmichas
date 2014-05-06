<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="jumbotron text-center">
	<p>
		Моля, попълни регистрационната форма или влез с <a href="<?= $fb_login_url ?>" class="btn btn-info">Facebook</a>
	</p>
	
	<form method="POST" action="" class="form-horizontal center-block" role="form" id="registration-form">
		<?php 
			$fields = array(
				'name' => 'Име и фамилия',
				'email' => 'Имейл адрес', 
				'password' => 'Парола', 
				'password_confirm' => 'Повтори паролата', 
				'school' => 'Училище'
			);
		?>

		<?php foreach ($fields as $field => $placeholder): ?>
			<div class="form-group <?=Arr::get($errors, $field) ? 'has-error' : '' ?>">
				<div class="col-lg">
					<label class="sr-only" for="<?= $field ?>"><?= $placeholder ?></label>
					<input 
						type="<?= ($field == 'password' OR $field == 'password_confirm') ? 'password' : 'text' ?>" 
						name="<?= $field ?>" 
						value="<?= ( isset($user->$field) AND $field != 'password' AND $field != 'password_confirm' ) ? $user->$field : '' ?>"
						id="<?= $field ?>" 
						placeholder="<?= $placeholder ?>" 
						class="form-control input-lg" >

					<?php if (Arr::get($errors, $field)): ?>
						<span class="help-block"><?=Arr::get($errors, $field) ?></span>
					<?php endif; ?>
				</div>
			</div>	
		<?php endforeach; ?>
		<div class="form-group">
			<div class="col-lg">
				<button type="submit" class="btn btn-lg btn-success">Регистрация</button>
			</div>
		</div>
	</form>