<?php
	
	require_once "../libs/Database_mysqli.php" ;
	require_once "../libs/Usuario.php" ;

	$db = Database::getInstance("root", "", "coches") ;
	$despl = Database::getInstance("root", "", "coches") ;

	$db->query("SELECT * FROM usuario") ;
	$despl->query("SELECT * FROM usuario") ;

	//$result = $db->getObject("Usuario") ;
	

	//echo "<pre>".print_r($result, true)."</pre>" ;

	//$email = $result->getEmail() ;

	//$api = "$email".time() ;
	//echo $api."<br/>" ;
	//echo md5($api) ;

	//echo "<pre>".print_r($insert, true)."</pre>" ;
	//echo "<pre>".print_r($db, true)."</pre>" ;
	//die() ;
	while ($result = $db->getObject("Usuario")) :

		$id = $result->getCodUsu() ;
		//echo $id ;
		$email = $result->getEmail() ;
		$api = "$email".time() ;
		$md5 = md5($api) ;
		//echo $md5 ;

		$update = "UPDATE usuario SET API_KEY='$md5' WHERE CodUsu=$id ;" ;

		//$db->query($update) ;
		
		//echo $update ;

		//$db->query("SELECT * FROM usuario") ;
		//$result = $db->getObject("Usuario") ;
	endwhile;
	



?>