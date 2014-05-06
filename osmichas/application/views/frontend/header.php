<?php defined('SYSPATH') or die('No direct access allowed!'); ?>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Превключи навигацията</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= URL::site() ?>">
				<img src="<?=URL::site('', TRUE)?>images/logo.png" alt="Осми час">
			</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="<?= $controller == 'search' ? 'active' : '' ?>">
					<a href="<?= URL::site() ?>">Търси</a>
				</li>				
				<li class="<?= ($controller == 'image' AND $action == 'upload') ? 'active' : '' ?>">
					<a href="<?= URL::site('image/upload') ?>">Добави материал</a>
				</li>			
				<?php if( $user AND $user->is_editor()): ?>	
					<li class="<?= ($controller == 'image' AND $action == 'approve') ? 'active' : '' ?>">
						<a href="<?= URL::site('image/upload') ?>">
							Чакащи одобрение
							<span class="badge">42</span>
						</a>
					</li>
				<?php endif ?>
				<li class="<?= $controller == 'about' ? 'active' : '' ?>">
					<a href="<?= URL::site('about') ?>">За проекта</a>
				</li>
				<li>
					<a class="disabled">
						<div class="fb-like" data-href="http://omsichas.info" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if (!$user): ?>
					<form method="POST" action="<?=URL::site('user/login') ?>" class="navbar-form navbar-right form-inline" id="header-login" role="form" >
						<div class="btn-group">
							<a href="<?=URL::site('user/login')?>" class="btn btn-default">
								Вход
							</a>
							<a href="<?=URL::site('user/register')?>" class="btn btn-success">
								Регистрация
							</a>
							<a href="<?= $fb_login_url?>" class="btn btn-info">
								Влез с FB
							</a>
						</div>
					</form>
				<?php else: ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Здравей, <?= $user->name ?><b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<?php if( $user->is_admin()): ?>
								<li class="dropdown-header">Вие сте администратор!</li>
							<?php elseif( $user->is_editor()): ?>
								<li class="dropdown-header">Вие сте редактор!</li>
							<?php else: ?>
								<li class="dropdown-header">Добавете <?= $user->contributions_left() ?> материала за да станете редактор!</li>
							<?php endif ?>
							<li><a href="<?= URL::site('user/profile') ?>">Профил</a></li>
							<li><a href="<?= URL::site('user/contributions') ?>">Моите материали</a></li>
							<?php if( $user->is_editor()): ?>
								<li>
									<a href="<?= URL::site('image/approve') ?>">
										Материали за одобрение
										<span class="badge">31</span>
									</a>
								</li>
							<?php endif ?>
							<li class="divider"></li>
							<li><a href="<?= URL::site('user/logout')?>">Изход</a></li>
						</ul>
					</li>
				<?php endif ?>
			</ul>
		</div>
	</div>
</div>
<!-- END Fixed navbar -->