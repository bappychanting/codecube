<?php

namespace App\Http\Guards;

use Base\Authenticable;

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