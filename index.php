<?php
	ob_start();

	session_start();

		// Declaring controller calling function
	function call($action, $route){
		if(file_exists('app/Http/Controllers/'.$route['class'].'.php')){

			require_once('app/Http/Controllers/'.$route['class'].'.php');

			$class = 'App\Http\Controllers\\'.str_replace('/', '\\', $route['class']);

			if(method_exists($class , $action)) {		
				$controller = new $class();
				$controller->{ $action }();
			}
			else{
				die("Error: Action not found!");
			}
		}
		else{
			die("Error: Action not found!");
		}
	}

		// Include Helpers
	$helpers = glob('helpers/*.php');
	foreach ($helpers as $helper) {
	    include($helper);   
	}

		// Include composer
	include("vendor/autoload.php");

		// Include project configurations
	if(file_exists("env.php") && is_readable("env.php")) {
		include("env.php");
	}
	else{
		die("Error: &quot;env.php&quot; file not found! This file contains environment variables! Please create a copy of the &quot;env.exmaple.php&quot; file in the config folder and rename it to &quot;env.php&quot;.");
	}
			
		// Set default parameters
	$default = include("routes/default.php");

		// Include Routes
    $routes = include("routes/web.php");
	
	$controller = $default['landing']['controller'];
	$action = $default['landing']['action'];

	if(!empty($_GET)){

			// Sanitize parameters
		foreach ($_GET as $key => $value) {
		  $key = preg_replace('/[^-a-zA-Z0-9_]/', '', $key);
		  $value = preg_replace('/[^-a-zA-Z0-9_]/', '', $value);
		  $_GET[$key] = $value;
		}

			// Set parameters
		if (isset($_GET['controller']) && isset($_GET['action'])) {
		  $controller = $_GET['controller'];
		  $action     = $_GET['action'];
		}
	} 

	if (array_key_exists($controller, $routes)){
		$route = $routes[$controller];
	    if (in_array($action, $route['methods'])){
			call($action, $route);
		} 
		else {
			call($default['error']['action'], $routes[$default['error']['controller']]);
	    }
	} 
	else {
		call($default['error']['action'], $routes[$default['error']['controller']]);
	}
	
	ob_end_flush();
?>