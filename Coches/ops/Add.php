<?php

	require_once("../libs/Database_mysqli.php") ;


	$modelo = $_POST["modelo"] ;
	$marca = $_POST["marca"] ;
	$potencia = $_POST["potencia"] ;
	$año = $_POST["año"] ;
	$esClasico = $_POST["esClasico"] ;
	$precio = $_POST["precio"]??null ;
	$descripcion = $_POST["descripcion"]??null ;

	echo "<pre>".print_r($_POST, true)."</pre>" ;
	//die();

	$db = Database::getInstance("root", "", "coches") ;

	$db->query("INSERT INTO modelo(NomMod, CodMar, Potencia, año, Descripcion, Precio, esClasico) VALUES (\"$modelo\", $marca, $potencia, $año, \"$descripcion\", $precio, $esClasico)") ;

	header("Location: ../adminModelos.php");
	die() ;
?>