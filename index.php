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
	else{
			// Set default parameters
		$default = include("routes/default.php");
		$controller = $default['landing']['controller'];
		$action = $default['landing']['action'];
	}

		// Include Routes
    $routes = include("routes/web.php");

	if (array_key_exists($controller, $routes)) {
		
		require_once('app/Http/Controllers/'.$controller.'.php');
	    
	    if (in_array($action, $routes[$controller]['methods'])) {
			$controller = new $class($action);
		} 

		else {
			echo "nope";
	      // call('home', 'error');
	    }
	} 
	else {
			echo "nope";
	    // call('home', 'error');
	}
	
	ob_end_flush();
?>