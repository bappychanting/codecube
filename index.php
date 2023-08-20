<?php

    // Declaring essential configuration files
    $config_files = [

        'autoload' => 'vendor/autoload.php', 

        'env' => 'env.php', 

        'app' => 'config/app.php', 

        'default' => 'config/url.php', 

        'web_routes' => 'routes/web.php', 

        'api_routes' => 'routes/api.php'

    ];

    // Checking missing configuration files
    foreach ($config_files as $file)
        if(!file_exists($file))  throw new Exception('Essential project configuration file missing: '.str_replace('/', '&#47;',$file));

    // Include autoload
    include($config_files['autoload']);

    // Executing Application
    Base\CodeCube::start($config_files, $argc??null,  $argv??null); 

?>