<?php

return [

		/* 
		*	Declaring all route urls
		*	Make sure there is no slash (/) at the end of the route key string
		*	Each route url key must contain a class and and a method referenced with "@" as value
		*/

		// public pages

	'welcome' => 'HomeController@welcome',

	'login' => 'Auth/AuthController@login',

	'captcha' => 'Auth/AuthController@checkCaptcha',

	'signin' => 'Auth/AuthController@signin',

	'register' => 'Auth/AuthController@register',

	'password/forgot' => 'Auth/AuthController@forgotPassword',

	'password/mail' => 'Auth/AuthController@sendResetInfo',

	'password/reset' => 'Auth/AuthController@resetPassword',

	'password/update' => 'Auth/AuthController@updatePassword',

	'home' => 'ItemController@index',

	'items/store' => 'ItemController@store',

	'items/get' => 'ItemController@sections',

	'items/update' => 'ItemController@update',

	'items/delete' => 'ItemController@delete',

	'user/show' => 'User/UserController@show',

	'user/edit' => 'User/UserController@edit',

	'user/edit/password' => 'User/UserController@editPassword',

	'user/update' => 'User/UserController@update',

	'user/update/password' => 'User/UserController@updatePassword',

	'signout' => 'User/UserController@signout',

];
