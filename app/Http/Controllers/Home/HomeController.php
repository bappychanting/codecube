<?php

namespace App\Http\Controllers\Home;

class HomeController {

    public function __construct() {
    	// $this->{ $action }();
    }

    public function frontpage() {
        echo "Welcome to home!";
    }

    public function error() {
        echo "Found Error!";
    }

}