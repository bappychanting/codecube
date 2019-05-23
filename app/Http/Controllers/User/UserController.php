<?php

namespace App\Http\Controllers\User; 

use App\Base\Request; 
use App\Models\User\User; 
use App\Http\Controllers\Controller; 

class UserController extends Controller
{
    private $user; 
    private $request; 

    public function __construct() {
        $this->guard('CheckAuth');
        $this->user = new User;
        $this->request = new Request; 
    }

    public function store() 
    {
        $alerts = array();
        $store = $this->user->setData($_POST)->validateData()->storeUser();
        if($store){
            $this->request->setFlash(array('success' => "You have now been registered!"));
            $this->redirect('login');
        }
        $this->redirect(back());
    }

    public function show() 
    { 
        $auth_user = $this->request->getAuth();
        return $this->view('users.show', compact('auth_user'));
    }

    public function edit() 
    {
        $this->guard('UserAccess');
        $auth_user = $this->request->getAuth();
        return $this->view('admin.users.edit', compact('auth_user'));
    }

    public function editPassword() 
    { 
        $this->guard('UserAccess');
        $auth_user = $this->request->getAuth();
        return $this->view('admin.users.edit_pass', compact('user', 'auth_user'));
    }

    public function update() 
    {
        $update = $this->user->setData($_POST)->validateData()->updateUser();
        if($update){
            $this->request->setFlash(array('success' => "User has beed updated!"));
            $this->redirect('admin/users/show', ['username' => $_POST['username']]);
        }
        else{
            $this->redirect(back());
        }
    }

    public function updatePassword() 
    {
        $auth_user = $this->request->getAuth();
        if($auth_user->username == $_POST['username']){ 
            $this->user->setUsername($_POST['username']);
            $this->user->setPassword($_POST['auth_pass']);
            $check = $this->user->passVerify();
            if($check){
                $update = $this->user->setData($_POST)->updatePass();
            }
        }
        else{
            $update = $this->user->setData($_POST)->updatePass();
        }
        if($update){
            $this->request->setFlash(array('success' => "Password has beed updated!"));
            $this->redirect('admin/users/show', ['username' => $_POST['username']]);
        }
        else{
            $this->request->setFlash(array('danger' => "Password could not be updated! Please try again!"));
            $this->redirect(back());
        }
    }

}