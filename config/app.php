<?php

return [

			// Configuring application behaviour

		'error_reporting' => 'off', // declaring whether to show error reporting

		'auth_time' => '30 minutes', // declaring how long a login session will last

		'remember_me' => '30 days', // declaring how long remember me cookie will last

		'update_session_cookie_settings' => 'no', // declaring if the php settings will be updated with the auth time
		
		'upload' => 'storage/app/public', // file upload folder

		'auto_logging' => 'on', // configuration for allowing automatic logging 

		'locale' => 'en', // configuration for default locale

		'placeholder' => 'https://picsum.photos/200/300', // configuration for image placeholder

];