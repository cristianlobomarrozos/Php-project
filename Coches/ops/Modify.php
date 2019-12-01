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

	//echo "<pre>".print_r($_GET, true)."</pre>" ;

	$cop = $_GET["cop"] ;
	$id = $_GET["id"] ;

	$db->query("SELECT * FROM modelo WHERE CodMod=$id") ;
	$result = $db->getObject("Modelo") ;

	//echo "<pre>".print_r($result, true)."</pre>" ;
			$modelo = $result->getNomMod() ;
			$marca = $result->getCodMar() ;
			$potencia = $result->getPotencia() ;
			$año = $result->getAño() ;
			$esClasico = $result->esClasico ;
			$descripcion = $result->getDescripcion() ;
			$precio = $result->getPrecio() ;

	switch($cop):
		case "delete":
			$db->query("DELETE FROM modelo WHERE CodMod=$id") ;
			header("Location: ../adminModelos.php") ;
			break;
		case "update":

		?>


			<form action="Update.php">
				<div class="form-group">
					<input type="hidden" name="ids" value="<?= $id ?>">
				</div>
				<div class="form-group">
					<label>Modelo:</label>
					<input type="text" class="form-control" name="modelo" value="<?= $modelo ?>">
				</div>
				<div class="form-group">
					<label>Potencia:</label>
					<input type="int" class="form-control" name="potencia" value="<?= $potencia ?>">
				</div>
				<div class="form-group">
					<label>Año:</label>
					<input type="int" class="form-control" name="año" value="<?= $año ?>">
				</div>
				<div class="form-group">
					<label>Marca:</label>
					<select class="form-control" name="marca">
						 <!--<option selected value="0"> -- Elija una opción -- </option>-->
	                        <?php
	                            $db->query("SELECT * FROM marca") ;
	                            $item = $db->getObject("Marca");

	                            do {

	                            	if($item->getCodMar() === $marca):

	                                	echo "<option selected value=\"".$item->getCodMar()."\">".$item->getNomMar()."</option>" ;
	                                else:
	                                	echo "<option value=\"".$item->getCodMar()."\">".$item->getNomMar()."</option>" ;
	                                endif;
	                                
	                                //echo "<pre>".print_r($item->getNomMar(), true)."</pre>" ;

	                                $item = $db->getObject("Marca") ;

	                            }while($item) ;
	                        ?>
                    </select>
                </div>
                <div class="form-group">
                	<label>Descripción:</label>
                    <input type="text" class="form-control" name="descripcion" value="<?= $descripcion ?>">
                </div>
                <div class="form-group">
                	<label>Precio:</label>
					<input type="float" class="form-control" name="precio" value="<?= $precio ?>">
				</div>
				<div class="form-group">
					<label>Es Clásico:</label>
					<select class="form-control" name="esClasico">
						<?php
						echo $esClasico ;
							if($esClasico):
								echo "<option selected value=\"1\">Sí</option>" ;
								echo "<option value=\"0\">No</option>" ;
							else:
								echo "<option value=\"1\">Sí</option>" ;
								echo "<option selected value=\"0\">No</option>" ;
							endif;
						?>
                    </select>
                </div>
                        <button type="submit" class="btn btn-success">Update</button>
				</form>

				<form>

			<?php
			//header("Location: Update.php?id=$id") ;
				
			break;
	endswitch;
endif;

?>