<?php

namespace App\Models;

use App\Base\DB;  

class Model{

	protected $db;

	public function __construct() 
	{
		$this->db = new DB();
	}

}