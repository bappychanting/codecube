<?php
		
		// Declaring application environment variables. 

		// Keep value of APP_ENV constant as 'dev' only when in development mode

 	define('APP_NAME', 'CodeCube');

 	define('APP_URL', strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://localhost:8000');

 	define('APP_ENV', 'dev');

 	define('APP_KEY', 'secret');

 	define('DB_CONNECTION', 'mysql');

 	define('DB_HOST', '127.0.0.1');

 	define('DB_PORT', '3306');

 	define('DB_DATABASE', 'homestead');

 	define('DB_USERNAME', 'homestead');

 	define('DB_PASSWORD', 'secret');

 	define('MAIL_DRIVER', 'smtp');

 	define('MAIL_HOST', 'smtp.mailtrap.io');

 	define('MAIL_PORT', '2525');

 	define('MAIL_USERNAME', NULL);

 	define('MAIL_PASSWORD', NULL);

 	define('MAIL_ENCRYPTION', NULL);