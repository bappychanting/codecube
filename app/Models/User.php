<?php

namespace App\Models; 

class User extends Model{

	public function getUsers(){      
        
        $query = $this->db->table('users')->read();
        return $query;

    }

}