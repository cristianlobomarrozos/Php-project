<?php

	require_once("../libs/Database_mysqli.php") ;
	require_once("../libs/Modelo.php") ;
	require_once("../libs/Marca.php") ;

	include("../css/bootstrap.php") ;

	$db = Database::getInstance("root", "", "coches") ;
	
	$id = $_GET["ids"] ;
	$modelo = $_GET["modelo"] ;
	$marca = $_GET["marca"] ;
	$potencia = $_GET["potencia"] ;
	$año = $_GET["año"] ;
	$precio = $_GET["precio"] ;
	$descripcion = $_GET["descripcion"] ;
	$esClasico = $_GET["esClasico"] ;

	//echo "<pre>".print_r($_GET, true)."</pre>" ;

	if(($precio !== "") && ($descripcion !== "")):
		
		$db->query("UPDATE modelo SET NomMod='$modelo' ,CodMar=$marca, Potencia=$potencia, año=$año, Descripcion='$descripcion', Precio=$precio, esClasico=$esClasico WHERE CodMod=$id") ;
	else:
		if(($precio !== "") && ($descripcion === "")):
			
			$db->query("UPDATE modelo SET NomMod='$modelo' ,CodMar=$marca, Potencia=$potencia, año=$año, Precio=$precio, esClasico=$esClasico WHERE CodMod=$id") ;
		endif;
		if(($descripcion !== "") && ($precio === "")):
			
			$db->query("UPDATE modelo SET NomMod='$modelo' ,CodMar=$marca, Potencia=$potencia, año=$año, Descripcion='$descripcion', esClasico=$esClasico WHERE CodMod=$id") ;
		endif;
		if(($precio === "") && ($descripcion === "")):
			
			$db->query("UPDATE modelo SET NomMod='$modelo' ,CodMar=$marca, Potencia=$potencia, año=$año, esClasico=$esClasico WHERE CodMod=$id") ;
		endif;

		header("Location: ../adminModelos.php") ;
	endif;
?>

