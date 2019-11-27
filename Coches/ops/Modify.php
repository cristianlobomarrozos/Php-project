<?php

	require_once("../libs/Database_mysqli.php") ;
	require_once("../libs/Modelo.php") ;
	require_once("../libs/Marca.php") ;

	include("../css/bootstrap.php") ;

	$db = Database::getInstance("root", "", "coches") ;



	//$modelo = $_POST["modelo"] ;
	//$marca = $_POST["marca"] ;
	//$potencia = $_POST["potencia"] ;
	//$año = $_POST["año"] ;
	//$esClasico = $_POST["esClasico"] ;

	//echo "<pre>".print_r($_GET, true)."</pre>" ;

	$cop = $_GET["cop"] ;
	$id = $_GET["id"] ;

	$db->query("SELECT * FROM modelo WHERE CodMod=$id") ;
	$result = $db->getObject("Modelo") ;

	echo "<pre>".print_r($result, true)."</pre>" ;
			$modelo = $result->getNomMod() ;
			$marca = $result->getCodMar() ;
			$potencia = $result->getPotencia() ;
			$año = $result->getAño() ;
			$esClasico = $result->getClasico() ;
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
					<input type="hidden" name="ids" value="<?= $id ?>">
					<input type="text" name="modelo" value="<?= $modelo ?>">
					<input type="int" name="potencia" value="<?= $potencia ?>">
					<input type="int" name="año" value="<?= $año ?>">
					<select name="marca">
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
                    <input type="text" name="descripcion" value="<?= $descripcion ?>">
					<input type="float" name="precio" value="<?= $precio ?>">
					<select name="esClasico">
							<option value="0" <?php 
												if($esClasico):
													echo "" ;
												else:
													echo "selected" ;
												endif;  ?>>No</option>
                            <option value="1" <?php 
												if($esClasico):
													echo "" ;
												else:
													echo "selected" ;
												endif;  ?>>Si</option>
                    </select>
                        <button type="submit" class="btn btn-success">Update</button>
				</form>


			<?php
			//header("Location: Update.php?id=$id") ;
				
			break;
	endswitch;

?>