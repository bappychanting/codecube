<?php

return [

		/* 
		*	Declaring landing page and error page 
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