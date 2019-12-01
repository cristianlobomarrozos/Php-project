<?php
	
	//echo "<pre>".print_r($_GET, true)."</pre>" ;

	require_once("./libs/Database_mysqli.php") ;
	require_once("./libs/Modelo.php") ;
	require_once("./libs/Marca.php") ;
	require_once("./libs/Sesion.php") ;
	require_once("./libs/Navbar.php") ;


	include("./css/bootstrap.php") ;

	$db = Database::getInstance("root", "", "coches") ;

	$sesion = Sesion::getInstance() ;
	if (!$sesion->checkActiveSession())
		 $sesion->redirect("index.php") ;

	$usr = $_SESSION["usuario"] ;

	$idUsu = $usr->getCodUsu() ;

	if (!$db->query("SELECT mo.*, ma.NomMar, p.* FROM modelo mo LEFT JOIN marca ma on (mo.CodMar=ma.CodMar) LEFT JOIN contiene c on (mo.CodMod=c.CodMod) RIGHT JOIN pedido p on (c.CodPed=p.Codped) LEFT JOIN usuario u on (p.CodUsu=u.CodUsu) WHERE u.CodUsu=$idUsu")):

		echo "<h3 class=\"text-center\">Todavía no has realizado ninguna compra.</h3>" ;

	else:

	$result = $db->getObject() ;

	?>
		<table class="table">
		  <thead>
		    <tr>
					<th width="15%" scope="col">Numero de pedido</th>
					<th width="15%" scope="col">Marca</th>
					<th width="15%" scope="col">Modelo</th>
					<th width="15%" scope="col">Potencia</th>
					<th width="15%" scope="col">Año</th>
					<th width="15%" scope="col">Precio</th>
					<th width="15%" scope="col">Fecha del pedido</th>
				</tr>
		  </thead>

 <?php

	do {
		//echo "<pre>".print_r($result, true)."<pre>" ;

?>
		  <tbody>
		    <tr>
					<td><?= $result->numeroPedido ?></td>
					<td><?= $result->NomMar ?></td>
					<td><?= $result->NomMod ?></td>
					<td><?= $result->Potencia ?></td>
					<td><?= $result->año ?></td>
					<td><?= $result->Precio ?></td>
					<td><?= $result->fecPedido ?></td>
				</tr>
		  </tbody>
		

		<?php

		$result = $db->getObject() ;
	} while($result) ;
endif;


?>
</table>
<?php
	include_once("libs/Footer.php") ;
?>