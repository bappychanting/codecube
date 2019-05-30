<?php

	// Fucntion for generating log
function logger($log_msg = '')
{
	if(file_exists('config/app.php')){
		$config = include('config/app.php');
		if($config['auto_logging'] == 'on'){
			$log_filename = "storage/logs";
			if (!file_exists($log_filename)) 
			{
			    mkdir($log_filename, 0777, true);
			}
			$log_file_data = $log_filename.'/log-' . date('Y-m-d') . '.log';
			file_put_contents($log_file_data, '['.date('Y-m-d H:i:s').'] '.$log_msg . "\n", FILE_APPEND);
		}
	}
}

	// Get Field Data
function getTokenData()
{
	$token_data = array();
	if(isset($_SESSION['processing_token'])){
		$token_data = $_SESSION['tokens'][$_SESSION['processing_token']];
	}
	else{
		$tokens = $_SESSION['tokens'];
		if(count($tokens) > 1){
			usort($tokens, function($a, $b) {
			    return $a['time'] <=> $b['time'];
			});
		}
		$token_data = end($tokens);
	}
	return $token_data;
}

  	// Errors setter
function setErrors($errors)
{
    $token_data = getTokenData();
	$_SESSION['tokens'][$token_data['csrf_token']]['errors'] = $errors; 
}

	// Errors getter
function getErrors()
{
    $token_data = getTokenData();
    return $_SESSION['tokens'][$token_data['csrf_token']]['errors'];
}

  	// get return url
function back()
{
    $token_data = getTokenData();
    return ltrim($token_data['url'], '/');
}

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
			throw new Exception('Method &quot;'.$method.'&quot; not found in controller &quot;'.$controller_class.'&quot;!');
		}
	}
	else{
		throw new Exception('Controller &quot;'.$controller.'&quot; not found!');
	}
}

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
		throw new Exception('&quot;env.php&quot; file not found! This file contains environment variables! Please create a copy of the &quot;env.exmaple.php&quot; file in the config folder and rename it to &quot;env.php&quot;.');
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
    die("<h4 style='margin-top: 50px; color: #666666; text-align: center;'>Error: ".$e->getMessage()."</h4>");
}
finally{
	ob_end_flush();
}
	
?>