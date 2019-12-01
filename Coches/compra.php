<?php
	
	//echo "<pre>".print_r($_GET, true)."</pre>" ;

	require_once("./libs/Database_mysqli.php") ;
	require_once("./libs/Modelo.php") ;
	require_once("./libs/Marca.php") ;
	require_once("./libs/Sesion.php") ;


	include("./css/bootstrap.php") ;

	$db = Database::getInstance("root", "", "coches") ;

	$sesion = Sesion::getInstance() ;
	if (!$sesion->checkActiveSession())
		 $sesion->redirect("index.php") ;

	$usr = $_SESSION["usuario"] ;

	$idUsu = $usr->getCodUsu() ;

	$hoy = time() ;

	//echo "<pre>".print_r($hoy, true)."</pre>" ;

	$fecha = "'".date('Y-m-d')."'" ;

	//echo $idUsu ;
	//echo $fecha ;

	$idMod = $_GET["id"] ;

	$db->query("SELECT * FROM modelo WHERE CodMod=$idMod") ;

	$result = $db->getObject("modelo") ;

	$codMar = $result->getCodMar() ;

	$db->query("SELECT * FROM marca WHERE CodMar=$codMar") ;

	$marca = $db->getObject("marca") ;

	//echo "<pre>".print_r($result, true)."</pre>" ;

	//echo "<pre>".print_r($usr, true)."</pre>" ;

	//echo "<pre>".print_r($marca, true)."</pre>" ;
	
	$token = "$idUsu".time()."$codMar";

	echo $token;	

	$db->query("INSERT INTO pedido(CodUsu, fecPedido, numeroPedido) values ($idUsu, $fecha, '$token')") ;

	$db->query("SELECT * FROM pedido WHERE CodUsu=$idUsu AND fecPedido=$fecha") ;
	$pedido = $db->getObject() ;

	echo "<pre>".print_r($pedido, true)."</pre>" ;

	$db->query("SELECT * FROM pedido WHERE numeroPedido='$token'") ;
	$pedido = $db->getObject() ;

	echo "<pre>".print_r($pedido, true)."</pre>" ;

	$codPedido = $pedido->CodPed ;

	//echo $codPedido ;
	$db->query("INSERT INTO contiene(CodMod, CodPed) values ($idMod, $codPedido) ") ;

	header("Location: ./pedidos.php") ;
?>