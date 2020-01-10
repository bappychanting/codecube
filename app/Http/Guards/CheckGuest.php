<?php

namespace App\Http\Guards;

use Base\Authenticable;
use Base\BaseController as base; 

class CheckGuest
{
	public function __construct()
	{
		$auth = new Authenticable;
		if($auth->check()){
			base::redirect('home');
		}
		elseif(!$auth->check() && $auth->remember()){
			$auth->resetAuth();
			base::redirect('home');
		}
	}

}