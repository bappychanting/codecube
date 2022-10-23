<?php

try{

    ob_start();

        // Declaring essential configuration files
    $config_files = ['autoload' => 'vendor/autoload.php', 'env' => 'env.php', 'app' => 'config/app.php', 'default' => 'config/url.php', 'web_routes' => 'routes/web.php', 'api_routes' => 'routes/api.php'];

        // Checking missing configuration files
    foreach ($config_files as $file)
        if(!file_exists($file))  throw new Exception('Essential project configuration file missing: '.str_replace('/', '&#47;',$file));

        // Include autoload
    include($config_files['autoload']);

        // Include environment configuration files
    $env_array = include($config_files['env']);
    foreach($env_array as $env=>$value) define($env, $value);

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
    else{
            // Create route url string
        $route_url = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

            // Checking if api url
        if(strpos($route_url, $default['api_url'].'/') === 0)
        {
                // Include api routes
            $routes = include($config_files['api_routes']); 

                // Rewrite URL
            $route_url = empty(substr($route_url, strlen($default['api_url'].'/'))) ? '404' : substr($route_url, strlen($default['api_url'].'/'));
        }
        else{
                // Include project application configuration files and setting up
            $config = include($config_files['app']);
            serverSetup($config);

                // Starting session
            session_start();

                // Include Web Routes
            $routes = include($config_files['web_routes']);

                // Sanitizing url and incoming parameters
            $route_url = sanitize($route_url, $routes);
        }

        // Call route
        if(empty($route_url))
            call($default['landing']);
        elseif(empty($routes[$route_url]))
            call($default['error']);
        else
            call($routes[$route_url]);

            // Log last occured error
        if(!empty(error_get_last()))    logger('ERROR: '.error_get_last()['message'].' in '.error_get_last()['file'].' in '.error_get_last()['line']);
    }
}
catch (Exception $e){
    die(json_encode(['status'=>$e->getCode(), 'reason'=>$e->getMessage()]));
}
finally{
    ob_end_flush();
}

?>