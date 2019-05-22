<?php

namespace App\Http\Guards;

use App\Base\Request;
use App\Base\BaseController as base; 

class CheckGuest
{
    public function __construct()
    {
        $request = new Request();
        if($request->auth()){
            base::redirect('error');
        }
    }

}