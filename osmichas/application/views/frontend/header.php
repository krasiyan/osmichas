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
			<a class="navbar-brand" href="<?= URL::site() ?>">Осми Час</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<!-- <li class="active"><a href="#">Търси</a></li> -->
				<?php if( $controller != 'search' ): ?>
					<li>
						<form action="<?= URL::site() ?>" method="POST" class="navbar-form navbar-left" role="search" >
							<div class="input-group input-normal" id="header-search-wrapper">
								<input type="text" name="query" class="form-control input-normal" id="header-search" placeholder="Въведи ключова дума">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-success">Търси</button>
								</div>
							</div>
						</form>
					</li>
				<?php endif; ?>
				<li class="<?= $controller == 'upload' ? 'active' : '' ?>">
					<a href="<?= URL::site('/upload') ?>">Добави материал</a>
				</li>
				<li class="<?= $controller == 'about' ? 'active' : '' ?>">
					<a href="<?= URL::site('/about') ?>">За проекта</a>
				</li>
				<!-- <li><a href="#contact">Контакти</a></li> -->
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-right" role="form">
					<div class="form-group">
						<input type="text" placeholder="Имейл" class="form-control">
					</div>
					<div class="form-group">
						<input type="password" placeholder="Парола" class="form-control">
					</div>
					<button type="submit" class="btn btn-success">Вход</button>
				</form>

				<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Избери категория <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Nav header</li>
						<li><a href="#">Separated link</a></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li> -->
			</ul>
		</div>
	</div>
</div>
<!-- END Fixed navbar -->