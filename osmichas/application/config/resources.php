<?php defined('SYSPATH') or die('No direct access allowed!');

return array(
	'frontend' => array(
		'scripts' => array(
			//begin lib
			'js/libs/jquery.min.js',
			'js/libs/bootstrap.min.js',
			'js/libs/select2.min.js',
			//end lib
			
			//begin custom
			'js/search.js',
			//end custom
		),
		'styles' => array(
			//begin lib
			'css/bootstrap.min.css' => 'screen',
			'css/bootstrap-theme.css' => 'screen',
			'css/select2.css' => 'screen',
			'css/select2-bootstrap.css' => 'screen',
			//end lib
			
			//begin custom
			'css/style.css' => 'screen',
			//end custom
		)
	),
);