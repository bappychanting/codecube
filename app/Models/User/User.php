<?php

namespace App\Models\User; 

use App\Models\Model;

class User extends Model{

	/* Declaring all ariables */

  protected $id;
  protected $name;
  protected $username;
  protected $email;
  protected $password;

  /* Setter getter for all variables */

    // ID setter getter
  function setId($id){
    $this->id = intval($id);
  }
  function getId(){
    return $this->id;
  }

    // Name setter getter
  function setName($name){
    $this->name = ucwords($name);
  }
  function getName(){
    return $this->name;
  }

  	// Username setter and geter
  function setUsername($username){
    $this->username = str_replace(' ', '_', strtolower($username));
  }
  function getUsername(){
    return $this->username;
  }

  	// Email setter getter
  function setEmail($email){
  	$this->email = strtolower($email);
  }
  function getEmail(){
    return $this->email;
  }

  	// Password setter getter
  function setPassword($password){
    $this->password = $password;
  }
  function getPassword(){
    return $this->password;
  }

  /* All functions */

    // Setting all the data 
  public function setData($data = ''){

    if (isset($data['id'])){
      $this->setId($data['id']);
    }

    if (isset($data['name'])){
      $this->setName($data['name']);
    }

    if (isset($data['username'])){
      $this->setUsername($data['username']);
    }

    if (isset($data['email'])){
      $this->setEmail($data['email']);
    }

    if (isset($data['password']) && isset($data['confirmPassword']) && $data['password'] == $data['confirmPassword']){
      $this->setPassword($data['password']);
    }

    return $this;
  }

    // Validating necesarry data
  public function validateData()
  {

    $errors = array();

    if(empty($this->getName())){
      $errors['name'] = 'Name can not be empty!';
    }

    if(empty($this->getUsername())){
      $errors['username'] = 'Username can not be empty!';
    }

    if(empty($this->getEmail())){
      $errors['email'] = 'Email can not be empty!';
    }

    if(empty($this->getId())){

      if($this->db->table('users')->where('username', '=', $this->getUsername())->check()){
        $errors['username'] = "Username already exists!";
      }

      if($this->db->table('users')->where('email', '=', $this->getEmail())->check()){
        $errors['email'] = "Email already exists!";
      }

      if(empty($this->getPassword())){
        $errors['password'] = 'Please input password and make sure it matches with the password confirmation!';
      }

    }
    else{

      if($this->db->table('users')->where('username', '=', $this->getUsername())->and('id', '!=', $this->getId())->check()){
        $errors['username'] = "Username already exists!";
      }

      if($this->db->table('users')->where('email', '=', $this->getEmail())->and('id', '!=', $this->getId())->check()){
        $errors['email'] =  "Email already exists!";
      }

    }

    setErrors($errors);   

    return $this;
  }

  public function getUser(){    
    $user = $this->db->table('users')->where('id', '=', $this->getId())->or('username', '=', $this->getUsername())->or('email', '=', $this->getEmail())->read();
    return $user[0];
  }

  public function storeUser(){    
    if(empty(getErrors())){
      $store = $this->db->table('users')->data(['name' => $this->getName(), 'username' => $this->getUsername(), 'email' => $this->getEmail(), 'password' => empty($this->getPassword()) ? '' : password_hash($this->getPassword(), PASSWORD_BCRYPT)])->create();
      return $store;
    }
  }

  public function updateUser(){ 
    if(empty(getErrors())){
      $update = $this->db->table('users')->set(['name' => $this->getName(), 'username' => $this->getUsername(), 'email' => $this->getEmail()])->where('id', '=', $this->getId())->update();
      return $update;
    }
  }

  public function passVerify(){  
    $user = $this->getUser();
    if(password_verify($this->getPassword(), $user['password'])){
      return TRUE;
    }
    else{
      return FALSE;
    }
  }

  public function updatePass(){ 
    if(empty(getErrors())){
      $update = $this->db->table('users')->set(['password' => empty($this->getPassword()) ? '' : password_hash($this->getPassword(), PASSWORD_BCRYPT)])->where('id', '=', $this->getId())->update();
      return $update;
    }
  }

}