<?php

/**
 * This class is used to connect to database 
 */
class Database
{
	private $dbhost = 'localhost';
	private $dbname = 'phpapi';
	private $dbusername = 'root';
	private $dbpassword = '';
	private $con;

	public function connect()
	{
		// try to connect to database using PDO
		try {
			$this->con = new PDO('mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname, $this->dbusername, $this->dbpassword);
		} catch(PDOException $e) {
			echo 'Failed to connect to db ' . $e->getMessage();
		}

		return $this->con;
	}
}