<?php

namespace App\Http\Controllers;

use App\Models\User; 

class HomeController extends Controller
{

    public function __construct(User $user='') {
    }

    public function frontpage() {

	    /*$users = User::getUsers();
	    print_r($users);*/
        echo "Welcome!";
    }

    public function error() {
        echo "Error!";
    }

}