	<?php

	include_once("libs/Navbar.php") ;

	require_once("libs/Database_mysqli.php") ;
	require_once("libs/Modelo.php") ;

	

	$db = Database::getInstance("root", "", "coches") ;


	$id = $_GET["id"]??null ;

	$db->query("SELECT * FROM modelo WHERE CodMod=$id") ;
	//echo "SELECT * FROM modelo WHERE CodMod=$id" ; ;
	$consulta = $db->getObject("Modelo");
	$año = $consulta->getAño() ;
	$potencia = $consulta->getPotencia() ;

?>
		<div class="content">
			<div class="p-5">
				<div>
					<h1><?= $consulta->getNomMod() ?></h1>
					
				</div>
				<div class="col-md-3">
					<!--
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					  <div class="carousel-inner">
					    <div class="carousel-item active">
					      <img class="d-block w-100" src="./images/coches/<?=$consulta->getNomMod()?>.jpg" alt="<?= $consulta->getNomMod() ?>">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="..." alt="Second slide">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="..." alt="Third slide">
					    </div>
					  </div>
					  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>-->
					  <img src="./images/coches/<?=$consulta->getNomMod()?>.jpg" alt="<?= $consulta->getNomMod() ?>">
					</div>
				</div>
				<div>
					<p>
						Año <?=	$año ?> </p>
					<p>	Potencia(en caballos): <?= $potencia ?>CV</p><br/> 

					<p>
						<?= $consulta->getDescripcion() ?>
					</p>
				</div>
				<div class="font-weight-bold text-right" style="font-size: 2vw;">
					<?= $consulta->getPrecio() ?>€
				</div>
				<form action="compra.php">
					<input id="id" type="hidden" name="id" value="<?=$id?>" />
					<div class="p-1">
						<button type="submit" class="btn btn-primary">Comprar</button>
					</div>
				</form>
			</div>
		

		

<?php
	include_once("libs/Footer.php") ;
?>