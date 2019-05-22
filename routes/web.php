<?php

return [

		/* 
		*	Declaring all route urls
		*	Make sure there is no slash (/) at the end of the route key string
		*	Each route url key must contain a class and and a method referenced with "@" as value
		*/

		// public pages

	'welcome' => 'HomeController@welcome',

	'login' => 'Admin/UserController@login',

	'captcha' => 'Admin/UserController@checkCaptcha',

	'signin' => 'Admin/UserController@signin',

	'password/forgot' => 'Admin/UserController@forgotPassword',

	'password/mail' => 'Admin/UserController@sendResetInfo',

	'password/reset' => 'Admin/UserController@resetPassword',

	'password/update' => 'Admin/UserController@updatePassword',

	'home' => 'Admin/ItemController@index',

	'items/store' => 'Admin/ItemController@store',

	'items/get' => 'Admin/ItemController@sections',

	'items/update' => 'Admin/ItemController@update',

	'items/delete' => 'Admin/ItemController@delete',

	'user/show' => 'Admin/UserController@show',

	'user/edit' => 'Admin/UserController@edit',

	'user/edit/password' => 'Admin/UserController@editPassword',

	'user/update' => 'Admin/UserController@update',

	'user/update/password' => 'Admin/UserController@updatePassword',

	'signout' => 'Admin/UserController@signout',

];
