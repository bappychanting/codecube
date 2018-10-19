<?php

		// Declaring application environment variables


	/*foreach (glob("config/*.php") as $files){
	    $configurations = include $files;
	    foreach ($configurations as $key=>$value){
	    	$GLOBALS['config'][$key] = $value;
	    }
	}*/

 	const APP_NAME = 'Student Relationship Management System';

	const DB_CONNECTION = 'mysql';

	const DB_HOST = '127.0.0.1';

	const DB_PORT = '3306';

	const DB_DATABASE = 'srms';

	const DB_USERNAME = 'root';

	const DB_PASSWORD = '1234';