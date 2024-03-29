<?php
	require_once "../libs/Database_mysqli.php" ;
	require_once "../libs/Usuario.php" ;
	require_once "../libs/Marca.php" ;
	require_once "../libs/Modelo.php" ;

	function Marca($id) {
		if (empty($id)):
			return [
				"cod" => 6,
				"mensaje" => "Falta identificador de la marca.",
			] ;
		else:
			$db = Database::getInstance("root", "", "coches") ;
			$db->query("SELECT * FROM marca WHERE CodMar=$id ; ") ;
			$marca = $db->getObject("Marca") ;

			//echo "<pre>".print_r($marca, true)."</pre>" ;

			// generamos el resultado que deseemos
			return [
						"id"       => $marca->getCodMar(),
						"name"     => $marca->getNomMar(),
						"country"     => $marca->getPaisMar(),
					] ;
		endif;
	}

	function Modelo($id) {

		$db = Database::getInstance("root", "", "coches") ;
		if(!empty($id)):
			$db->query("SELECT * FROM modelo WHERE CodMod=$id ; ") ;
			$modelo = $db->getObject("Modelo") ;

			return [
					"id"       => $modelo->getCodMod(),
					"name"     => $modelo->getNomMod(),
					"horse_power"     => $modelo->getPotencia(),
					"year"     => $modelo->getAño(),
					"classic"     => $modelo->getClasico(),
					"prize"     => $modelo->getPrecio(),
					"description" => $modelo->getDescripcion() 
				] ;
		else:

			$db->query("SELECT * FROM modelo; ") ;
			$modelo = $db->getObject("Modelo") ;

				return [
					"id"       => $modelo->getCodMod(),
					"name"     => $modelo->getNomMod(),
					"horse_power"     => $modelo->getPotencia(),
					"year"     => $modelo->getAño(),
					"classic"     => $modelo->getClasico(),
					"prize"     => $modelo->getPrecio(),
					"description" => $modelo->getDescripcion() 
				] ;
			
		endif;

		
	}

	function Usuario($id) {
		if (empty($id)):
			return [
				"cod" => 6,
				"mensaje" => "Falta identificador del usuario.",
			] ;
		else:
			$db = Database::getInstance("root", "", "coches") ;
			$db->query("SELECT * FROM usuario WHERE CodUsu=$id ; ") ;
			$usr = $db->getObject("Usuario") ;

			//echo "<pre>".print_r($marca, true)."</pre>" ;

			// generamos el resultado que deseemos
			return [
						"id"       => $usr->getCodUsu(),
						"name"     => $usr->getNombre(),
						"surname"     => $usr->getApellidos(),
						"birth-date"     => $usr->getFecNacimiento(),
					] ;
		endif;
	}


	//echo "<pre>".print_r($_GET, true)."</pre>" ;
	$api = $_GET["api"]??"" ;


	$db = Database::getInstance("root", "", "coches") ;

	if (!$db->query("SELECT * FROM usuario WHERE API_KEY='$api' ; ")):
		echo $api ;
		$data = [

				   "cod" => 0,
				   "mensaje" => "Api key no válida.",
				] ;

	else:

		$op = $_GET["op"]??"" ;

		switch ($op) 
		{
			case 'marca':
				$id   = $_GET["id"]??""  ;
				$data = Marca($id) ;
				break;

			case 'modelo':
				$id = $_GET["id"]??"" ;
				$data = Modelo($id) ;
				break ;

			case 'usuario':
				$id = $_GET["id"]??"" ;
				$data = Usuario($id) ;
				break ;
			default:
				$data = [
						  "cod" => 666,
						  "mensaje" => "Código de operación incorrecto.",
						] ;
				break;
		}

	endif ;


	// devolvemos el contenido especificando que es JSON
	header("Content-Type: application/json") ;
	echo json_encode($data) ;


?>