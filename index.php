<?php
	ob_start();
	session_start();

		// Include composer
	include("vendor/autoload.php");

		// Include project configurations
	foreach (glob("config/*.php") as $files){
	    $configurations = include $files;
	    foreach ($configurations as $key=>$value){
	    	$GLOBALS['config'][$key] = $value;
	    }
	}

	if(!empty($_GET)){

			// Sanitize parameters
		foreach ($_GET as $key => $value) {
		  $_GET[$key][$value] = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET[$key][$value]);
		}
			// Set parameters
		if (isset($_GET['controller']) && isset($_GET['action'])) {
		  $controller = $_GET['controller'];
		  $action     = $_GET['action'];
		}
	} 
	else {
			// Set default parameters
		$controller = 'home';
		$action     = 'frontpage';
	}

		// Include route
	require_once('routes.php');
	
	ob_end_flush();
?>