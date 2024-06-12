<?php
class model 
{
	protected $conn;

	public function __construct() 
	{
		global $db;
		$this->conn = $db;
	}

}