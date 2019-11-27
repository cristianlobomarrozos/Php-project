<?php
	require_once ("libs/Sesion.php") ;

	$sesion = Sesion::getInstance() ;

	$sesion->close() ;

	$sesion->redirect("index.php") ;


?>