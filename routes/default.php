<?php

return [

		/* 
		*	Declaring default landing page and error page 
		*	Input a class and and a method referenced with "@" as the value of the keys
		*	Make sure the method exists in the class while adding actions, otherwise the application may crash!
		*/

	'landing' => 'HomeController@welcome',

	'error' => 'HomeController@error',

		/* 
		*	Declaring default migration url 
		*	Input the url that you would like to use for accessing migration page in your browser as the value of the key
		*	Make sure to exclude the domain name and first forward slash
		*/

	'migration_url' => 'database_migration',

];