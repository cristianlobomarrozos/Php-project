<?php
	

	class Database {

		private $host = "localhost" ;

		private $dbName ;
		private $dbUser ;
		private $dbPass ;

		private static $instance = null ;


		private $pdo = null ;
		private $sqlp = null ;
		private $lnk ;
		private $result = null ;


		private function __construct($dbu, $dbp, $dbn) {

			$this->dbUser = $dbu ;
			$this->dbPass = $dbp ;
			$this->dbName = $dbn ;

			$this->connect() ;
		}

		public function __destruct() {
			$this->pdo = null ;
		}


		public static function getInstance($dbu, $dbp, $dbn)
		{
			if (Database::$instance==null):
				Database::$instance = new Database($dbu, $dbp, $dbn) ;
			endif;

			return Database::$instance ;
		}


		private function connect() {

			try {
			
			$this->pdo = new PDO("mysql:host".$this->host.";dbname=".$this->dbName, $this->dbUser, $this->dbPass) or die("ERROR: Ha fallado la conexión con la base de datos.") ;

			} catch(PDOException $e) {
				echo "Conexión fallida: ".$e->getMessage() ;
			}
		}

		public function consulta($sql, ...$vector):bool {

			echo $sql."<br/>" ;
			echo count($vector)."<br/>" ;
			echo $vector[3]."<br/>" ;
			echo $sql ;

			$tam = count($vector) ;

			for($i = 0; $i<$tam; $i++):
				echo ($i+1) ;
				$this->sqlp->bindValue(($i+1), $vector[$i], PDO::PARAM_STR) ;
			endfor;

			if (!$sqlp->execute())
				$error = "Se ha producido un error en la creación del usuario" ;

			return $this->result ;
		}
	}




?>