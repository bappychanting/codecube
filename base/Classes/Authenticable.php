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
	public function signin($identity='', $password='', $remember = 'remember', $auth_table='users', $identity_field_1='username', $identity_field_2='email', $password_field='password', $attempts_field = 'attempts', $login_token_field = 'login_token') { 
		$get_user = $this->db->table($auth_table)->where($identity_field_1, '=', $identity)->or($identity_field_2, '=', $identity)->read();  
		if(count($get_user) == 1){
			$user = $get_user[0];
			if(password_verify($password, $user[$password_field])){
				$login_token = bin2hex(openssl_random_pseudo_bytes(30));
				$update = $this->db->table($auth_table)->set([$attempts_field => 0, $login_token_field => $login_token])->where($identity_field_1, '=', $identity)->or($identity_field_2, '=', $identity)->update();
				if($update){ 
					if(isset($_POST[$remember])){
						$config = include("config/app.php");
						$expire = time() + strtotime($config['remember_me'], 0);
						$this->request->setCookie('remember_me', base64_encode($identity).':'.base64_encode($login_token), $expire);
					}
					$this->request->put('auth', $user);
					$this->request->setFlash(array('success' => "Login successful!"));
					return TRUE;
				}
				return FALSE;
			}
			else{
				$attempts = $user[$attempts_field] + 1;
				$update = $this->db->table($auth_table)->set([$attempts_field => $attempts])->where($identity_field_1, '=', $identity)->or($identity_field_2, '=', $identity)->update();
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

    	// Fuction to check if auth
	public function check($auth_table='users', $identity_field='username', $token_field='login_token'){
		$auth = $this->request->show('auth');
		$remember_me = $this->request->getCookie('remember_me');

		if(empty($auth) && empty($remember_me)){
			return FALSE;
		}
		elseif(empty($auth) && !empty($remember_me)){
			list($username, $token) = explode(':', $this->request->getCookie('remember_me'));
			$user = $this->db->table($auth_table)->where($identity_field, '=', base64_decode($username))->read(); 
			if(hash_equals($user[0][$token_field], hash('sha256', base64_decode($token)))){
				$this->request->put('auth', $user);
				return TRUE;
			} 
			return FALSE;
		}
		elseif(!empty($auth) && empty($remember_me)){
            $config = include("config/app.php");
            $token = getTokenData(); 
            $auth_time = strtotime('+'.$config['auth_time'], $token['time']);
            if(time() > $auth_time){
				session_destroy();
				return FALSE;
            }
		}
		return TRUE;
	}

    	// Function to get auth data
	public function getAuth(){
		$auth = $this->request->show('auth');
		if(!empty($auth)){
			return (object)$auth;
		}
	}

    	// Function for signing out
	public function signout(){
		$this->request->deleteCookie('remember_me');
		session_destroy();
	}

    	// Fuction to store password reset link
	public function storeLink($token, $user, $links_table='reset_password_links'){   
		$store = $this->db->table($links_table)->data(['token' => $token, 'user_id' => $user])->create();
		return $store;
	}

    	// Fuction to get password reset link
	public function getLink($token, $links_table='reset_password_links_view'){   
		$link = $this->db->table($links_table)->where('token', '=', $token)->read(); 
		return $link[0];
	}

    	// Fuction to update password reset link validity
	public function updateValidity($token, $links_table='reset_password_links'){   
		$update = $this->db->table($links_table)->set(['validity' => 0])->where('token', '=', $token)->update(); 
		return $update;
	}

}

?>