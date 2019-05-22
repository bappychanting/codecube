<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function welcome() 
    {
        $this->guard('CheckGuest');
        return $this->view('welcome');
    }

    public function error() 
    {
        $this->abort(404);
    }

}