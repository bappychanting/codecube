<?php

namespace App\Http\Guards;

use Base\Authenticable as auth;
use Base\BaseController as base; 

class CheckAuth 
{
    public function __construct()
    {
        $auth = new auth;
        if(!$auth->check()){
            base::redirect('signin');
        }
    }

}