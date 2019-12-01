<?php

	require_once("../libs/Database_mysqli.php") ;
	require_once("../libs/Sesion.php") ;
	require_once("../libs/Usuario.php") ;

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
	$cop = $_GET["cop"] ;
	$id = $_GET["id"] ;

	$db->query("SELECT * FROM usuario WHERE CodUsu=$id") ;
    //$result = $db->query("SELECT * FROM usuario") ;
    $usuario = $db->getObject("Usuario") ;
    $admin = $usuario->getEsAdmin() ;


	//echo "<pre>".print_r($usuario, true)."</pre>" ;

	switch($cop):
		case "delete":
			$db->query("DELETE FROM usuario WHERE CodUsu=$id") ;
			header("Location: ../adminUsu.php") ;
			break;
		case "update":

		?>


			<form action="UpdateUser.php">
					<input type="hidden" name="ids" value="<?= $id ?>">
					<input type="text" disabled name="nombre" value="<?= $usuario->getNombre() ?>">
					<input type="int" disabled name="email" value="<?= $usuario->getEmail() ?>">
					<input type="int" disabled name="apellidos" value="<?= $usuario->getApellidos() ?>">
					<input type="int" disabled name="fecNac" value="<?= $usuario->getFecNacimiento() ?>">
					<select name="esAdmin">
							<option value="0" <?php 
												if($admin):
													echo "selected" ;
												endif;  ?>>No</option>
                            <option value="1" <?php 
												if($admin):
													echo "selected" ;
												endif;  ?>>Si</option>
                    </select>
                        <button type="submit" class="btn btn-success">Update</button>
				</form>


			<?php
			//header("Location: Update.php?id=$id") ;
				
			break;
	endswitch;
endif;

?>