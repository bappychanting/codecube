<?php

try{

    ob_start();

        // Declaring essential configuration files
    $config_files = ['autoload' => 'vendor/autoload.php', 'env' => 'env.php', 'app' => 'config/app.php', 'default' => 'config/url.php', 'web_routes' => 'routes/web.php', 'api_routes' => 'routes/api.php'];

        // Checking missing configuration files
    foreach ($config_files as $file) {
        if(!file_exists($file)){  
            throw new Exception('Essential project configuration file missing: '.str_replace('/', '&#47;',$file));
        }
    }

        // Include autoload
    include($config_files['autoload']);

        // Include environment configuration files
    include($config_files['env']);

        // Set default project routes
    $default = include($config_files['default']);

    if(substr($_SERVER['REQUEST_URI'], 1) == $default['migration_url'])
    {   
            // executing migration
        if(empty($_POST)){
            echo Base\Migration::migrationView($default['migration_url']);
        }
        else{
            $files = glob("database/*.php");
            $messages = Base\Migration::executeQueries($files);
            echo json_encode($messages);
        }
    }
    else
    {
            // Create route url string
        $route_url = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

            // Checking if api url
        if(strpos($route_url, $default['api_url'].'/') === 0){

                // Rewrite URL
            $api_url = substr($route_url, strlen('api/'));

                // Include api routes
            $routes = include($config_files['api_routes']);

                // Call api route
            if(empty($routes[$api_url])){
                call($default['error']);
            }
            else{
                call($routes[$api_url]);
            }
        }
        else{
                // Include Web Routes
            $routes = include($config_files['web_routes']);

                // Include project application configuration files and setting up
            $config = include($config_files['app']);
            serverSetup($config);

                // Starting session
            session_start();

                // Sanitizing incoming parameters
            sanitize();

                // Call route
            if(empty($route_url)){
                call($default['landing']);
            }
            elseif(empty($routes[$route_url])){
                call($default['error']);
            }
            else{
                call($routes[$route_url]);
            }
        }

            // Log last occured error
        $fetch_error = error_get_last();
        if(!empty($fetch_error)){
            logger('ERROR: '.$fetch_error['message'].' in '.$fetch_error['file'].' in '.$fetch_error['line']);
        }
    }
}
catch (Exception $e){
    if(function_exists('logger')){
        logger('ERROR: '.html_entity_decode($e->getMessage()));
    }
    die(json_encode(['status'=>401, 'reason'=>$e->getMessage()]));
}
finally{
    ob_end_flush();
}

?>