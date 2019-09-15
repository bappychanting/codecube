<?php
  
namespace Base;

use Base\DB; 
use Base\Request;
  
class Authenticable
{
	private $db;
	private $request;

	public function __construct() 
	{
		$this->db = new DB;
		$this->request = new Request;
	}

		// Function for signing in
    public function signin($identity='', $password='', $auth_table='users', $identity_field_1='username', $identity_field_2='email', $password_field='password') { 
		$get_user = $this->db->table($auth_table)->where($identity_field_1, '=', $identity)->or($identity_field_2, '=', $identity)->read();  
		if(count($get_user) == 1){
			$user = $get_user[0];
			if(password_verify($password, $user[$password_field])){
				$update = $this->db->table($auth_table)->set(['timestamp' => time(), 'attempts' => 0])->where('username', '=', $identity)->or('email', '=', $identity)->update();
				if($update){ 
					$this->request->setAuth($user);
					$this->request->setFlash(array('success' => "Login successful!"));
					return TRUE;
				}
				return FALSE;
			}
			else{
				$attempts = $user['attempts'] + 1;
				$update = $this->db->table($auth_table)->set(['attempts' => $attempts])->where('username', '=', $identity)->or('email', '=', $identity)->update();
				if($attempts > 3){
					$this->request->setData('timeout', 'Multiple incorrect attempts detected!');
					return FALSE;
				}
				else{
					$this->request->setFlash(array('danger' => "Wrong login credentials! Try again to log in with correct username/email and password."));
					return FALSE;
				}
			}
		} 
		else{
			$this->request->setFlash(array('danger' => "Wrong login credentials! Try again to log in with correct username/email and password."));
			return FALSE;
		}
    }
  
	public function storeLink($token, $user, $links_table='reset_password_links'){   
		$store = $this->db->table($links_table)->data(['token' => $token, 'user_id' => $user])->create();
		return $store;
	}
  
	public function getLink($token, $links_table='reset_password_links_view'){   
		$link = $this->db->table($links_table)->where('token', '=', $token)->read(); 
		return $link[0];
	}
  
	public function updateValidity($token, $links_table='reset_password_links'){   
		$update = $this->db->table($links_table)->set(['validity' => 0])->where('token', '=', $token)->update(); 
		return $update;
	}

    	// Function for signing out
    public function signout(){
    	session_destroy();
    }

}
  
?>