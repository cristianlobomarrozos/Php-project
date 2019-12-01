<?php

	require_once("../libs/Database_mysqli.php") ;
	require_once("../libs/Modelo.php") ;
	require_once("../libs/Sesion.php") ;
	require_once("../libs/Marca.php") ;

	include("../css/bootstrap.php") ;



	$db = Database::getInstance("root", "", "coches") ;

	$sesion = Sesion::getInstance() ;
	if (!$sesion->checkActiveSession()) 
		 $sesion->redirect("../index.php") ;
	
	$usr = $_SESSION["usuario"] ;

	$esAdmin = $usr->getEsAdmin() ;
    //echo $esAdmin ;
    
    if (!$esAdmin):
        $sesion->redirect("../index.php") ;
    else:

	$id = $_GET["ids"]??null ;
	$modelo = $_GET["modelo"]??null ;
	$marca = $_GET["marca"]??null ;
	$potencia = $_GET["potencia"]??null ;
	$año = $_GET["año"]??null ;
	$precio = $_GET["precio"]??null ;
	$descripcion = $_GET["descripcion"]??null ;
	$esClasico = $_GET["esClasico"]??null ;

	//echo "<pre>".print_r($_GET, true)."</pre>" ;

	if(($precio !== "") && ($descripcion !== "")):
		
		$db->query("UPDATE modelo SET NomMod='$modelo' ,CodMar=$marca, Potencia=$potencia, año=$año, Descripcion='$descripcion', Precio=$precio, esClasico=$esClasico WHERE CodMod=$id") ;
		header("Location: ../adminModelos.php") ;

	else:
		if(($precio !== "") && ($descripcion === "")):
			
			$db->query("UPDATE modelo SET NomMod='$modelo' ,CodMar=$marca, Potencia=$potencia, año=$año, Precio=$precio, esClasico=$esClasico WHERE CodMod=$id") ;

			header("Location: ../adminModelos.php") ;
		endif;
		if(($descripcion !== "") && ($precio === "")):
			
			$db->query("UPDATE modelo SET NomMod='$modelo' ,CodMar=$marca, Potencia=$potencia, año=$año, Descripcion='$descripcion', esClasico=$esClasico WHERE CodMod=$id") ;

			header("Location: ../adminModelos.php") ;
		endif;
		if(($precio === "") && ($descripcion === "")):
			
			$db->query("UPDATE modelo SET NomMod='$modelo' ,CodMar=$marca, Potencia=$potencia, año=$año, esClasico=$esClasico WHERE CodMod=$id") ;

			header("Location: ../adminModelos.php") ;
		endif;

	endif;

		
	endif;
?>

