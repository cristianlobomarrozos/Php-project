<?php
	include("libs/Navbar.php");

	require_once("./libs/Database_mysqli.php") ;
	require_once("./libs/Modelo.php") ;

	$db = Database::getInstance("root", "", "coches") ;
	if(!$db->query("SELECT mo.*, ma.NomMar FROM modelo mo left join marca ma on (mo.CodMar=ma.CodMar) WHERE esClasico=true")):
		die("Error");
	else:
		$modelo = $db->getObject("Modelo") ;
?>
<!--
    <form action="buscador.php" method="post">
      <input name="palabra" placeholder="Palabra">
      <input type="submit" name="buscador" value="Buscar">
    </form>-->
<?php
	do {
?>
<div class="card mb-3 my-3" style="max-width: 100%;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="./images/coches/<?=$modelo->getNomMod()?>.jpg" class="card-img" alt="<?= $modelo->getNomMod() ?>" style="max-height: 300px";>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <a href="info.php?id=<?= $modelo->getCodMod() ?>"><?= $modelo->getNomMod() ?></a>
        <p class="card-text">Año <?= $modelo->getAño() ?>, potencia <?= $modelo->getPotencia() ?>CV</p>
        <p class="card-text"><?= $modelo->getDescripcion() ?></p>
        <p class="card-text"><?= $modelo->getPrecio() ?>€</p>
      </div>
    </div>
  </div>
</div>

<?php 
    $modelo = $db->getObject("Modelo") ;    
    } while($modelo) ;
    endif;  
?> 

<?php
	include("libs/Footer.php");
?>