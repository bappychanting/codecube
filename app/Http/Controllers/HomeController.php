<?php

namespace App\Http\Controllers;

use App\Models\User; 

class HomeController extends Controller
{

	private $user; 

    public function __construct() {
    	// parent::__construct();
        $this->user = new User;
    }

    public function frontpage() 
    {
        try {
            return $this->view('welcome');
            $users = $this->user->queryTest();
            return $this->view('users.user', compact('users'));
        }
        catch (\Exception $e) {
            return $this->log('ERROR: '.$e->getMessage());
        }
    }

    public function error() {
        echo "Error!";
    }

}