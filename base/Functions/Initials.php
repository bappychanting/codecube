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
			if(is_array($log_msg)){
				$log_msg = json_encode($log_msg);
			}
			file_put_contents($log_file_data, '['.date('Y-m-d H:i:s').'] '.$log_msg . "\n", FILE_APPEND);
		}
	}
}

	// Fucntion for getting locale
function locale($loc_file, $loc_key, $words= array())
{
	if(file_exists('config/app.php')){
		$config = include('config/app.php');
		$_file = 'resources/locale/'.$config['locale'].'/'.$loc_file.'.php';
		if(file_exists($_file)){
			$locale = include($_file);
			$string = $locale[$loc_key];
			if(!empty($words)){
				foreach ($words as $key => $value) {
					$string = str_replace(':'.$key, $value, $string);
				}
			}
			return $string;
		}
	}
	return '';
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

?>