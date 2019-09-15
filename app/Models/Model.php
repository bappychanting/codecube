<?php

namespace App\Models;

use Base\DB;  

class Model{

	protected $db;

	public function __construct() 
	{
		$this->db = new DB();
	}

	public function getLastId() 
	{
        return $this->db->getLastId();
	}

}