<?php

return [

		/* 
		*	Declaring default landing page and error page 
		*	Input a class and and a method referenced with "@" in the blank values
		*	Make sure the method exists in the class while adding actions, otherwise the application may crash!
		*/

	'landing' => 'HomeController@frontpage',

	'error' => 'HomeController@error',

];