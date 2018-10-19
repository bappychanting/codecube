<?php

namespace App\Http\Controllers;

use App\Models\User; 

class HomeController extends Controller
{

	private $user; 

    public function __construct() {
    	$this->user = new User;
    }

    public function frontpage() {

	    $users = $this->user->getUsers();
	    print_r($users);
        echo "Welcome!";
    }

    public function error() {
        echo "Error!";
    }

}