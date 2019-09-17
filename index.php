<?php

try {

	ob_start();

	if(file_exists('config/app.php')){
		$config = include('config/app.php');
		if($config['update_session_cookie_settings'] == 'yes'){
			ini_set('session.gc_maxlifetime', $config['auth_time']*60);
			session_set_cookie_params($config['auth_time']*60);
		}
		session_start();
		$headers = apache_request_headers();
	}
	else{
		throw new Exception('Framework configuration file not found!');
	}

		// Check if database migration
	if($_SERVER['REQUEST_URI'] == '/database_migration'){
		if(file_exists("base/Migration/migration_view.php") && is_readable("base/Migration/migration_view.php")) {
			require_once("base/Migration/migration_view.php");
			ob_end_flush();
			die();
		}
		else{
			throw new Exception('Database Management files missing!');
		}
	}

		// Include autoload
	include("vendor/autoload.php");

		// Include project configurations
	if(file_exists("env.php") && is_readable("env.php")) {
		include("env.php");
	}
	else{
		throw new Exception('Environment configuration file not found! Please create a copy of the &quot;env.exmaple.php&quot; file in the root folder and rename it to &quot;env.php&quot;.');
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

		// Check and set post parameters
    if (!empty($_POST)) {
    	if(!empty($headers['X-CSRF-TOKEN']) && array_key_exists($headers['X-CSRF-TOKEN'], $_SESSION['tokens'])){
    		logger('Ajax call recieved to url: '.$_SERVER['REQUEST_URI'].'!');
    	}
    	elseif(!empty($_POST['_token']) && array_key_exists($_POST['_token'], $_SESSION['tokens'])){ 
    		$_SESSION['processing_token'] = $_POST['_token']; 
    		$_SESSION['tokens'][$_SESSION['processing_token']]['posts'] = $_POST; 
    	}
    	else{
    		unset($_POST);
			throw new Exception('Token mismatch!');
    	}
    }

		// Create route url string
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


		// Log last occured error
	$fetch_error = error_get_last();

    if(!empty($fetch_error)){
    	logger('ERROR: '.$fetch_error['message'].' in '.$fetch_error['file'].' in '.$fetch_error['line']);
    }

}
catch (Exception $e) {
    logger('ERROR: '.$e->getMessage());
    die(json_encode(['status'=>401, 'reason'=>$e->getMessage()]));
}
finally{
	ob_end_flush();
}
	
?>