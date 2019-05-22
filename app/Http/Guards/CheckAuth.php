<?php

namespace App\Http\Guards;

use App\Base\Request;
use App\Base\DB;
use App\Base\BaseController as base; 

class CheckAuth 
{
    public function __construct()
    {
        $request = new Request();
        if(!$request->auth()){
            base::redirect('admin/login');
        }
        else{
	        $config = base::config('app');
            $token = getTokenData();
	        $auth_time = strtotime('+'.$config['auth_time'].' minutes', $token['time']);
	        if(time() > $auth_time){
	        	base::redirect('admin/signout');
	        }
        }
    }

}