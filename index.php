<?php

    // Include autoload
    include('vendor/autoload.php');

    // Executing Application
    Base\CodeCube::start([

        'env' => 'env.php', 

        'app' => 'config/app.php', 

        'default' => 'config/url.php', 

        'web_routes' => 'routes/web.php', 

        'api_routes' => 'routes/api.php',

        'commands' => 'app/Console/commands.php'

    ], $argc??null,  $argv??null); 

?>