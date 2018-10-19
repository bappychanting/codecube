<?php

namespace App\Models; 

class User extends Model{

	public function getUsers(){
        $pdo = self::getInstance();
        $query = $pdo->prepare('SELECT * FROM users');  
        $query->execute();
        $data=$query->fetchAll();
        return $data;
    }

}