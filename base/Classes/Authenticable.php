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
    public function signin($identity='', $password='') { 
		$get_user = $this->db->table('users')->where('username', '=', $identity)->or('email', '=', $identity)->read();  
		if(count($get_user) == 1){
			foreach ($get_user as $user){
				if(password_verify($password, $user['password'])){
					$update = $this->db->table('users')->set(['timestamp' => time(), 'attempts' => 0])->where('username', '=', $identity)->or('email', '=', $identity)->update();
					if($update){ 
						$this->request->setAuth($user);
						$this->request->setFlash(array('success' => "Login successful!"));
						return TRUE;
					}
					return FALSE;
				}
				else{
					$attempts = $user['attempts'] + 1;
					$update = $this->db->table('users')->set(['attempts' => $attempts])->where('username', '=', $identity)->or('email', '=', $identity)->update();
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
		} 
		else{
			$this->request->setFlash(array('danger' => "Wrong login credentials! Try again to log in with correct username/email and password."));
			return FALSE;
		}
    }
  
	public function storeLink($token, $user){   
		$store = $this->db->table('reset_password_links')->data(['token' => $token, 'user_id' => $user])->create();
		return $store;
	}
  
	public function getLink($token){   
		$link = $this->db->table('reset_password_links_view')->where('token', '=', $token)->read(); 
		return $link[0];
	}
  
	public function updateValidity($token){   
		$update = $this->db->table('reset_password_links')->set(['validity' => 0])->where('token', '=', $token)->update(); 
		return $update;
	}

    	// Function for signing out
    public function signout(){
    	session_destroy();
    }

}
  
?>