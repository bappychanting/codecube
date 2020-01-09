<?php

namespace App\Http\Guards;

use Base\Authenticable;
use Base\BaseController as base; 

class CheckAuth 
{
    public function __construct()
    {
        $auth = new Authenticable;

        if(!$auth->check()){
            if($auth->remember()){
                $auth->resetAuth();
            }
            else{
                base::redirect('signin');
            }
        }
        else{
            $config = base::config('app');
            $token = getTokenData(); 
            $auth_time = strtotime('+'.$config['auth_time'], $token['time']);
            if(time() > $auth_time){
                if($auth->remember()){
                    $auth->resetAuth();
                    base::redirect('home');
                }
                else{
                    base::redirect('signout');
                }
            }
        }
    }

}