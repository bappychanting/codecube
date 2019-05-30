<?php

namespace App\Http\Guards;

use Base\Request;
use Base\BaseController as base; 

class CheckGuest
{
    public function __construct()
    {
        $request = new Request();
        if($request->auth()){
            base::redirect('home');
        }
    }

}