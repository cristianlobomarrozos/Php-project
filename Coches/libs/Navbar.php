<?php
	require_once("libs/Sesion.php") ;
	require_once("libs/Usuario.php") ;
	require_once("libs/Database_mysqli.php") ;

	$sesion = Sesion::getInstance() ;

	//echo $usu->NomUsu;
	//echo "<pre>".print_r($usu["NomUsu"],true)."</pre>" ;
	
	$db = Database::getInstance("root", "", "coches") ;

?>

<!DOCTYPE html>
<html>
<head>
	<title> Coches </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	
	<link rel="stylesheet" href="./css/style.css">	
</head>
<body>
	<nav>
		<div>
		<ul>
		  <li><a href="./index.php">Inicio</a></li>
		  <li class="dropdown1">
		  	<a class="dropdown1" href="javascript:void(0)">Modelos</a>
		  	<div class="dropdown1-content">
		  		<a href="./clasicos.php">Clásicos</a>
		  		<a href="./modernos.php">Modernos</a>
		  	</div>
		  </li>
		  <?php
		if ($sesion->checkActiveSession()):
						$usu = $_SESSION["usuario"];
						//echo "<pre>".print_r($_SESSION["usuario"], true)."</pre>" ;
						//echo $usu;
						if (!$db->query("SELECT esAdmin FROM usuario ")):
							die("Error") ;
						else:
							//echo "<pre>".print_r($usu->getEsAdmin(), true)."</pre>" ;
							if ($usu->getEsAdmin()):
								echo "<li>" ;
								echo "<a href=\"adminUsu.php\">Usuarios</a>" ;
								echo "<a href=\"adminModelos.php\">Gestión modelos</a>" ;
								echo "</li>" ;
							endif;
						endif;
						echo "<li class=\"dropdown1\">" ;
						echo "<a class=\"dropdown1\" href=\"javascript:void(0)\">".$usu->getNombre()."</a>" ;
						echo "<div class=\"dropdown1-content\">"; 
						echo "<a href=\"perfil.php\">Perfil</a>";
						echo "<a href=\"pedidos.php\">Historial compras</a>";
						//echo "<a href=\"#\">Ajustes</a>";
						echo "<a href=\"logout.php\">Logout</a>" ;

						echo "</div>" ;
						echo "</li>" ;

					else:
						echo "<li class=\"dropdown1\">" ;
						echo "<a href=\"login.php\">Login</a>" ;
						echo "</li>" ;

					endif; 
				?>
		  
		</ul>
	</div>
	</nav>
	
