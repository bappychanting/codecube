<?php

namespace App\Http\Guards;

use Base\Authenticable;
use Base\BaseController as base; 

class CheckGuest
{
    public function __construct()
    {
        $auth = new Authenticable;
        if($auth->check() || $auth->remember()){
            base::redirect('home');
        }
    }

}