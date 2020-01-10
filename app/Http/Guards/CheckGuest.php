<?php

namespace App\Http\Guards;

use Base\Authenticable;

class CheckGuest
{
	public function __construct()
	{
		$auth = new Authenticable;
		if($auth->check()){
			base::redirect('home');
		}
	}

}