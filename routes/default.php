<?php

return [

		/* 
		*	Declaring landing page and error page 
		*	Input controller and action name in black values
		*	Make sure the method exists in the class while adding actions, otherwise the application may crash!
		*/

	'landing' => [

		'controller' => 'home',

		'action' => 'frontpage'
	],

	'error' => [

		'controller' => 'home',

		'action' => 'error'
	],

];