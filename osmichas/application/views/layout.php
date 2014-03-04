<?php defined('SYSPATH') or die('No direct access allowed!'); ?>
<!doctype html>
<html lang="<?= I18n::$lang ?>">

	<head>
		<title><?=$title?></title>
		
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<?php foreach($meta as $meta_name => $meta_content):?>
			<meta name="<?= $meta_name ?>" content="<?= $meta_content ?>"/>
		<?endforeach?>

		<?php foreach ($styles as $style => $type):?>
			<?= HTML::style($style, array('media' => $type)) ?>
		<?endforeach?>
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<link rel="icon" href="<?= URL::site('images/favicon.ico', TRUE) ?>">
	</head>

	<body>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-48612549-1', 'osmichas.info');
			ga('send', 'pageview');
		</script>

		<?= $header ?>

		<div class="container" role="main">
			<?= $content ?>
		</div>

		<div id="footer">
			<div class="container">
				<?= $footer ?>
			</div>
		</div>

		<script type="text/javascript">
			var osmichas = {
					url_base: '<?= URL::base(TRUE, FALSE) ?>',
					controller: '<?= $controller ?>',
					action: '<?= $action ?>'
			};
		</script>

		<?php foreach ($scripts as $script): ?>
			<script src="<?= strpos($script, '://') ? $script : URL::site($script) ?>"></script>
		<?php endforeach; ?>
	</body>
</html>