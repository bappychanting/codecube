<?php
	ob_start();

	session_start();

		// Declaring controller method calling function
	function call($route_url =''){
		
		$get_controller_action = explode("@", $route_url);

		$controller = $get_controller_action[0];

		$method = $get_controller_action[1];

		if(file_exists('app/Http/Controllers/'.$controller.'.php')){

			require_once('app/Http/Controllers/'.$controller.'.php');

			$controller_class = 'App\Http\Controllers\\'.str_replace('/', '\\', $controller);

			if(method_exists($controller_class , $method)) {		
				$class = new $controller_class();
				$class->{ $method }();
			}
			else{
				die("Error: Action not found!");
			}
		}
		else{
			die("Error: Action not found!");
		}
	}

		// Check if database migration
	if($_SERVER['REQUEST_URI'] == '/database'){
		require_once("app/Base/Migration/migration_view.php");
		ob_end_flush();
		die();
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
			
		// Set default urls
	$default = include("routes/default.php");

		// Include Routes
    $routes = include("routes/web.php");

		// Sanitize url parameters
	if(!empty($_GET)){
		foreach ($_GET as $key => $value) {
		  $key = preg_replace('/[^-a-zA-Z0-9_]/', '', $key);
		  $value = preg_replace('/[^-a-zA-Z0-9_]/', '', $value);
		  $_GET[$key] = $value;
		}
	} 

		// Create route ur string
	$route_url = '';

	$_URI = explode("/", $_SERVER['REQUEST_URI']);

    $count_slash = 0;
	foreach ($_URI as $value) {
		if(!empty($value) && strpos($value, "=") == false){
			if($count_slash > 0){
        		$route_url .= '/';
      		}
			$route_url .= $value;
      		$count_slash++;
		}
	}

		// Call route
	if(!empty($route_url)){
		if(!empty($routes[$route_url])){
			call($routes[$route_url]);
		}
		else{
			call($default['error']);
		}
	}
	else{
		call($default['landing']);
	}
	
	ob_end_flush();
?>