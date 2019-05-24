<?php

return [

		/* 
		*	Declaring all route urls
		*	Make sure there is no slash (/) at the end of the route key string
		*	Each route url key must contain a class and and a method referenced with "@" as value
		*/

		// public pages

	'welcome' => 'HomeController@welcome',

	'login' => 'User/AuthController@login',

	'captcha' => 'User/AuthController@checkCaptcha',

	'signin' => 'User/AuthController@signin',

	'register' => 'User/AuthController@register',

	'password/forgot' => 'User/AuthController@forgotPassword',

	'password/mail' => 'User/AuthController@sendResetInfo',

	'password/reset' => 'User/AuthController@resetPassword',

	'password/update' => 'User/AuthController@updatePassword',

	'home' => 'ItemController@index',

	'items/all' => 'ItemController@store',

	'items/store' => 'ItemController@store',

	'items/edit' => 'ItemController@sections',

	'items/update' => 'ItemController@update',

	'items/delete' => 'ItemController@delete',

	'user/show' => 'User/UserController@show',

	'user/store' => 'User/UserController@store',

	'user/edit' => 'User/UserController@edit',

	'user/edit/password' => 'User/UserController@editPassword',

	'user/update' => 'User/UserController@update',

	'user/update/password' => 'User/UserController@updatePassword',

	'signout' => 'User/UserController@signout',

];
