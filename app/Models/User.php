<?php

namespace App\Models; 

class User extends Model{

	public function queryTest(){      

        	// Insert Query
        /*$query = $this->db->table('users')->data(['username' => 'best', 'name' => 'best', 'email' => 'best.com', 'contact' => '01712323414', 'address' => 'best', 'gender' => '3', 'verified' => '0', 'avatar' => 'default', 'password' => 'best'])->store();
        return $query;*/

            // Read Query
        /*$query = $this->db->table('men')->where('loose', '=', 'buy')->and('loose', '=', 'buy')->and('loose', '=', 'buy')->or('loose', '=', 'buy')->or('loose', '=', 'buy')->where()->not('loose', '=', 'buy')->and()->not('loose', '=', 'buy')->orderBy('created_at', 'desc')->orderBy('updated_at', 'asc')->read();
        return $query;*/
        /*$query = $this->db->table('users')->where('gender', '=', '3')->limit(2)->read();
        return $query;*/
        /*$query = $this->db->table('users')->where('username', '=', 'best')->read();
        return $query;*/
        /*$query = $this->db->get('select * from users');
        return $query;*/

            // Update Query
        /*$query = $this->db->table('users')->set(['email' => 'updatdsed@gmail.com'])->where('username', '=', 'best')->update();
        return $query;*/

            // Delete Query
        /*$query = $this->db->table('users')->where('username', '=', 'best')->delete();
        return $query;*/

        /*$query = $this->db->table('users')->where('gender', '=', '3')->read();
        return $query;*/

        $query = $this->db->table('users')->where('gender', '=', '3')->limit(4)->read();
        // return $query;
        // return $this->db->pagination();
        return json_encode($query).'<br>'.$this->db->pagination();

    }

}