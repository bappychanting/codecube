<?php

namespace App\Http\Guards;

use Base\Request;
use Base\DB;
use Base\BaseController as base; 

class CheckAuth 
{
    public function __construct()
    {
        $request = new Request();
        if(!$request->auth()){
            base::redirect('signin');
        }
        else{
	        $config = base::config('app');
            $token = getTokenData();
	        $auth_time = strtotime('+'.$config['auth_time'].' minutes', $token['time']);
	        if(time() > $auth_time){
	        	base::redirect('signout');
	        }
        }
    }

}