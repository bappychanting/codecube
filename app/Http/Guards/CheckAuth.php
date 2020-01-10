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
            base::redirect('signin');
        }
    }

}