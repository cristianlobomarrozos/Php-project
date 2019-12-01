<?php

	require_once("../libs/Database_mysqli.php") ;
	require_once("../libs/Modelo.php") ;
	require_once("../libs/Sesion.php") ;
	require_once("../libs/Marca.php") ;

	include("../css/bootstrap.php") ;

	$sesion = Sesion::getInstance() ;
	if (!$sesion->checkActiveSession()) 
		 $sesion->redirect("../index.php") ;

	$usr = $_SESSION["usuario"] ;

	$esAdmin = $usr->getEsAdmin() ;
    if (!$esAdmin):
        $sesion->redirect("../index.php") ;
    else:


	$db = Database::getInstance("root", "", "coches") ;
	
	$id = $_GET["ids"] ;
	$admin = $_GET["esAdmin"] ;
	//echo "<pre>".print_r($_GET, true)."</pre>" ;

	$db->query("UPDATE usuario SET esAdmin=$admin WHERE CodUsu=$id") ;

	header("Location: ../adminUsu.php") ;
	endif;

?>