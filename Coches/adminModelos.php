<?php
	include("libs/Navbar.php");

	require_once("./libs/Database_mysqli.php") ;
    require_once("./libs/Modelo.php") ;
	require_once("./libs/Marca.php") ;

	$db = Database::getInstance("root", "", "coches") ;
	$despl = Database::getInstance("root", "", "coches") ;

    $ses = Sesion::getInstance() ;

    if (!$ses->checkActiveSession())
         $ses->redirect("index.php") ;

    $usr = $_SESSION['usuario'] ;


    if($usr->getEsAdmin()):

	if(!$db->query("SELECT mo.*, ma.NomMar FROM modelo mo left join marca ma on (mo.CodMar=ma.CodMar)")):
		//die("Error");
	else:
		//$modelo = $db->getObject("Modelo") ;

?>

<table class="table table-borderless">  
    <form class="form-inline" method="post" action="./ops/Add.php">
        <input id="cop" type="hidden" name="cop"/>
        <div class="form-group">
            <thead>  
                <tr>  
                     
                    <th scope="col">Modelo</td>  
                    <th scope="col">Potencia</td>  
                    <th scope="col">Año</td>  
                    <th scope="col">Marca</td>  
                    <th scope="col">Descripción</td>  
                    <th scope="col">Precio</td>  
                    <th scope="col">Clásico</td>  
                </tr>  
                <tr>  
                    <td><input type="text" name="modelo"></td>  
                    <td><input type="int" name="potencia"></td>  
                    <td><input type="int" name="año"></td>  
                    <td><select name="marca">
                        <option selected value="0"> -- Elija una opción -- </option>
                        <?php
                            $despl->query("SELECT * FROM marca") ;
                            $item = $despl->getObject("Marca");

                            do {

                                echo "<option value=\"".$item->getCodMar()."\">".$item->getNomMar()."</option>" ;
                                
                                //echo "<pre>".print_r($item->getNomMar(), true)."</pre>" ;

                                $item = $despl->getObject("Marca") ;

                            }while($item) ;
                        ?>
                    </select></td>
                    <td><input type="text" name="descripcion"></td>
                    <td><input type="float" name="precio"></td>
                    <td>
                        <select name="esClasico">
                            <option selected value="10"> -- Elija una opción -- </option>
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </td>
                    <td>
                        <button id="add" class="btn-sm btn-primary">Añadir</button>
                    </td>
                </tr>
            </thead>

        </div>
    </form>
      
<form class="form-inline" method="get" action="./ops/Modify.php">
    <!--<input id="cop" type="hidden" name="cop"/>-->

    <div class="form-group">

<?php
        
        $db->query("SELECT mo.*, ma.NomMar FROM modelo mo left join marca ma on (mo.CodMar=ma.CodMar)") ;
        $result = $db->query("SELECT mo.*, ma.NomMar FROM modelo mo left join marca ma on (mo.CodMar=ma.CodMar)") ;
        $modelo = $db->getObject("Modelo") ;
        do {

            $marca = $modelo->getCodMar() ;
            //echo "<pre>".print_r($_GET, true)."</pre>" ;
            $id = $modelo->getCodMod() ;
?>
 
            <tbody>  
                <tr>  
                    <td><input type="text" disabled name="modelo" value="<?= $modelo->getNomMod() ?>"></td>  
                    <td><input type="int" disabled name="potencia" value="<?= $modelo->getPotencia() ?>"></td>  
                    <td><input type="int" disabled name="año" value="<?= $modelo->getAño() ?>"></td>  
                    <td><input type="int" disabled name="marca" value="<?= $modelo->NomMar ?>"></td>  
                    <td><input type="text" disabled name="descripcion" value="<?= $modelo->getDescripcion() ?>"></td>
                    <td><input type="float" disabled name="precio" value="<?= $modelo->getPrecio() ?>"></td>
                    <td>
                        <?php

                        //echo "<pre>".print_r($modelo->esClasico, true)."</pre>" ;
                        
                            if($modelo->esClasico):
                                echo "Si" ;
                            else:
                                echo "No" ;
                            endif;
                        ?>
                    </td>
                    <td>
                        <!--<button id="delete" class="btn-sm btn-danger">Borrar</button>-->
                        <!--<button id="edit" class="btn-sm btn-warning">Editar</button>-->
                        <a class="btn btn-danger" href="./ops/Modify.php?cop=delete&id=<?= $id ?>">Borrar</a>
                        <a class="btn btn-warning" href="./ops/Modify.php?cop=update&id=<?= $id ?>">Editar</a>
                    </td>
                </tr>  
                 
            </tbody>  
        
<?php

            $modelo = $db->getObject("Modelo") ;
        } while ($modelo) ;

    endif;
    else:
         $ses->redirect("index.php") ;
    endif;
?>
</table>  
    
    </div>
</form>
<?php
	include("libs/Footer.php");
?>