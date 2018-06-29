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
			'session_name' => 'user'
		)
	);

	spl_autoload_register(function($controllers){
		try{
			require_once "controllers/{$controllers}.php";
		}catch(Exception $e){
			echo "Caught an exception". $e->getMessage();
		}
	});

	require_once('functions/sanitize.php');