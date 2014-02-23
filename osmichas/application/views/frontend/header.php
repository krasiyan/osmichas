<?php defined('SYSPATH') or die('No direct access allowed!'); ?>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Осми Час</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<!-- <li class="active"><a href="#">Търси</a></li> -->
				<li>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group" >
							<input type="text" class="form-control" id="header-search" placeholder="Въведи ключова дума">
						</div>
						<button type="submit" class="btn btn-default">Търси</button>
					</form>
				</li>
				<li><a href="#upload">Добави материал</a></li>
				<li><a href="#about">За проекта</a></li>
				<!-- <li><a href="#contact">Контакти</a></li> -->
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
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
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- END Fixed navbar -->