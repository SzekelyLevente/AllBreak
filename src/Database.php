<?php
	class Database{
		public $conn;

		private $hostname="localhost";
		private $username="root";
		private $password="";
		private $database="cardapp";

		public function __construct()
		{
			$this->conn=new Mysqli($this->hostname,$this->username,$this->password,$this->database);
			if(!$this->conn)
			{
				die("Connection failed.");
			}
			$this->conn->set_charset("utf8mb4");
		}

		public function close()
		{
			$this->conn->close();
		}
	} 
 ?>