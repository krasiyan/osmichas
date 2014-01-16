<?php defined('SYSPATH') or die('No direct access allowed!'); ?>
<!doctype html>
<html lang="<?=I18n::$lang?>" xmlns:fb="http://ogp.me/ns/fb#" xmlns:fb="http://www.facebook.com/2008/fbml">

	<head>
		<meta name="format-detection" content="telephone=no">
		<meta charset="utf-8"/>

		<?php foreach($meta as $meta_name => $meta_content):?>
			<meta <?=(strpos($meta_name, "og:") !== 0 AND strpos($meta_name, "fb:") !== 0) ? "name" : "property" ?>="<?= $meta_name ?>" content="<?= $meta_content ?>"/>
		<?endforeach?>

		<title><?=$title?></title>

		<link rel="shortcut icon" href="<?=URL::site('img/favicon.png')?>">

		<?php foreach ($styles as $file => $type):?>
			<?=HTML::style($file, array('media' => $type))?>
		<?endforeach?>
	</head>

	<body>
		<div>

			<?=$header?>
			<?=$content?>
			<?=$footer?>
		</div>

		<script>
			var osmichas = {
					url_base: '<?=URL::base(TRUE, FALSE)?>',
					controller: '<?=$controller?>',
					action: '<?=$action?>',
			};
		</script>

		<?php foreach ($scripts as $file): ?>
			<script src="<?= strpos($file, '://') ? $file : URL::site($file) ?>"></script>
		<?php endforeach; ?>
	</body>
</html>