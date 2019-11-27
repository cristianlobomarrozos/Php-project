<?php

	class Database 
	{
		private $host = "localhost" ;

		private $dbName ;
		private $dbUser ;
		private $dbPass ;

		private $sqli = null ;
		private $result = null ;
		private static $instance = null ;

		private function __construct($dbu, $dbp, $dbn) 
		{
			$this->dbUser = $dbu ;
			$this->dbPass = $dbp ;
			$this->dbName = $dbn ;

			$this->connect() ;
		}

		public function __destruct()
		{
			$this->sqli->close() ;
		}


		public static function getInstance($dbu, $dbp, $dbn)
		{
			if (Database::$instance==null) 
				Database::$instance = new Database($dbu, $dbp, $dbn) ;

			return Database::$instance ;
		}


		private function connect()
		{
			$this->sqli = new mysqli($this->host, $this->dbUser, $this->dbPass) 
						  or die("ERROR: Ha fallado la conexión con la base de datos.") ; 

			$this->sqli->select_db($this->dbName) ;

			$this->sqli->set_charset("utf8") ;
		}

		public function query($sql):bool
		{
			$this->result = $this->sqli->query($sql) 
								or die("ERROR: se ha producido un error de acceso a la base de datos") ;

			if (is_object($this->result))
				return ($this->result->num_rows > 0) ;

			return $this->result ;
		}

		
		public function getObject($cls = "StdClass")
		{
			if (is_null($this->result)) return null ;

			return $this->result->fetch_object($cls) ;
		}

		/**
		 * @return int
		 */
		public function getNumRows():int
		{
			return $this->result->num_rows ; 
		}

		
		public function __wakeup()
		{
			$this->connect() ;
		}

	}
?>