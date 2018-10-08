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

		// Include Routes
	/*foreach (glob("routes/*.php") as $files){
	    $routes = include $files;
	    foreach ($routes as $key=>$value){
	    	$route[$key] = $value;
	    }
	}*/

	print_r($route);

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
	else{
			// Set default parameters
		$default = include("routes/default.php");
		$controller = $default['landing']['controller'];
		$action = $default['landing']['action'];

		echo $controller;
	}
	
	ob_end_flush();
?>