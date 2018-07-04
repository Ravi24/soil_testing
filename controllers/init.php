<?php
	session_start();
	$GLOBALS['config'] = array(
		'mysql' => array(
			'host' => 'localhost',
			'user' => 'root',
			'password' => '',
			'database' => 'soil_lab'
		),
		'remember' => array(
			'cookie_name' => 'hash',
			'cookie_expiry' => 604800,
		),
		'session' => array(
			'session_name' => 'user',
			'token_name' =>  'token'
		),
		'file_structure' => array(
			'controllers' => $_SERVER['DOCUMENT_ROOT'].'\soil_testing\controllers',
			'functions' => $_SERVER['DOCUMENT_ROOT'].'/soil_testing/functions/',
			'models' => $_SERVER['DOCUMENT_ROOT'].'\soil_testing\models',
			'views' => $_SERVER['DOCUMENT_ROOT'].'soil_testing\views',
			'templates' => $_SERVER['DOCUMENT_ROOT'].'soil_testing\views\templates'
		)
	);

	spl_autoload_register(function($controllers){
		try{
			require_once "{$controllers}.php";
		}catch(Exception $e){
			echo "Caught an exception". $e->getMessage();
		}
	});

	require_once(Config::get('file_structure/functions').'sanitize.php');