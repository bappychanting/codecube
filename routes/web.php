<?php

return [

		/* 
		*	Declaring all route urls
		*	Make sure there is no slash (/) at the end of the route key string
		*	Each route url key must contain a class and and a method referenced with "@" as value
		*/

		// public pages

	'welcome' => 'HomeController@welcome',

	'signin' => 'User/AuthController@signin',

	'captcha' => 'User/AuthController@checkCaptcha',

	'login' => 'User/AuthController@login',

	'signup' => 'User/AuthController@signup',

	'register' => 'User/AuthController@register',

	'password/forgot' => 'User/AuthController@forgotPassword',

	'password/mail' => 'User/AuthController@sendResetInfo',

	'password/reset' => 'User/AuthController@resetPassword',

	'password/update' => 'User/AuthController@updatePassword',

	'signout' => 'User/AuthController@signout',

	'home' => 'HomeController@home',

	'items/all' => 'ItemController@index',

	'items/create' => 'ItemController@create',

	'items/store' => 'ItemController@store',

	'items/show' => 'ItemController@show',

	'items/edit' => 'ItemController@edit',

	'items/update' => 'ItemController@update',

	'items/delete' => 'ItemController@delete',

	'user/show' => 'User/UserController@show',

	'user/edit' => 'User/UserController@edit',

	'user/edit/password' => 'User/UserController@editPassword',

	'user/update' => 'User/UserController@update',

	'user/update/password' => 'User/UserController@updatePassword',

];
