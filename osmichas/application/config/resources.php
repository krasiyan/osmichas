<?php defined('SYSPATH') or die('No direct access allowed!');

return array(
	'frontend' => array(
		'scripts' => array(
			//begin lib
			'js/libs/jquery.min.js',
			'js/libs/jquery-ui.min.js',
			'js/libs/bootstrap.min.js',
			'js/libs/select2.min.js',
			'js/libs/dropzone.min.js',
			'js/libs/jquery.validate.js',
			'js/libs/jquery.tag.js',
			'js/libs/jquery.isotope.min.js',
			'js/libs/jquery.fancybox.js',
			'js/libs/jquery.fancybox.pack.js',
			'js/libs/bootstrap-switch.min.js',

			//end lib
			
			//begin custom
			'js/validation.js',
			'js/search.js',
			'js/upload.js',
			'js/tager.js',
			//end custom
		),
		'styles' => array(
			//begin lib
			'css/bootstrap.min.css' => 'screen',
			'css/bootstrap-theme.min.css' => 'screen',
			'css/select2.css' => 'screen',
			'css/select2-bootstrap.css' => 'screen',
			'css/dropzone.css' => 'screen',
			'css/jquery.tag.css' => 'screen',
			'css/jquery-ui.custom.css' => 'screen',
			'css/isotope.css' => 'screen',
			'css/jquery.fancybox.css' => 'screen',
			'css/bootstrap-switch.min.css' => 'screen',
			//end lib
			
			//begin custom
			'css/style.css' => 'screen',
			//end custom
		)
	),
);