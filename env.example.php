<?php

	// Declaring application environment variables. 

	// Keep value of 'APP_ENV' as 'dev' only when in development mode

return [

	'APP_NAME' => 'CodeCube',

	'APP_URL' => 'http://localhost:8000',

	'APP_ENV' => 'dev',
	
	'APP_KEY' => 'secret',

	'DB_CONNECTION' => 'mysql',

	'DB_HOST' => '127.0.0.1',

	'DB_PORT' => '3306',

	'DB_DATABASE' => 'homestead',

	'DB_USERNAME' => 'homestead',
	
	'DB_PASSWORD' => 'secret',

	'MAIL_DRIVER' => 'smtp',

	'MAIL_HOST' => 'smtp.mailtrap.io',
	
	'MAIL_PORT' => '2525',

	'MAIL_USERNAME' => NULL,

	'MAIL_PASSWORD' => NULL,

	'MAIL_ENCRYPTION' => NULL,

];