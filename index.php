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

    if($argc > 0 && $argv[1] == 'migrate'){
        Base\Migration::executeQueries($argv[2]??'', glob("database/*.php"));
    }

    // Set default project routes
    $default = include($config_files['default']);

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
catch (Exception $e){
    die(json_encode(['status'=>$e->getCode(), 'reason'=>$e->getMessage()]));
}
finally{
    ob_end_flush();
}

?>

<?php

    $filters = array_fill(0, 3, null);

    for($i = 1; $i < $argc; $i++) {

        echo $argv[$i];
        echo ("\n");

    }

    /*readline_callback_handler_install('', function(){});
    echo("Enter password followed by return. (Do not use a real one!)\n");
    echo("Password: ");
    $strObscured='';
    while(true)
    {
    $strChar = stream_get_contents(STDIN, 1);
    if($strChar===chr(10))
    {
        break;
    }
    $strObscured.=$strChar;
    echo("*");
    }
    echo("\n");
    echo("You entered: ".$strObscured."\n");*/
?>