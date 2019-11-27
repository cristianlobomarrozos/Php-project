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

    if(!$db->query("SELECT * FROM usuario")):
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
                     
                    <th scope="col">Nombre</td>  
                    <th scope="col">Email</td>  
                    <th scope="col">Apellidos</td>  
                    <th scope="col">Fecha de nacimiento</td>  
                    <th scope="col">esAdmin</td> 
                </tr>  
            </thead>

        </div>
    </form>
      
<form class="form-inline" method="get" action="./ops/Modify.php">
    <!--<input id="cop" type="hidden" name="cop"/>-->

    <div class="form-group">

<?php
        
        $db->query("SELECT * FROM usuario") ;
        //$result = $db->query("SELECT * FROM usuario") ;
        $usuario = $db->getObject("Usuario") ;
        do {

            $id = $usuario->getCodUsu() ;
            $admin = $usuario->getEsAdmin() ;

            //echo "<pre>".print_r($usuario, true)."</pre>" ;
?>
 
            <tbody>  
                <tr>  
                    <td><input type="text" disabled name="nombre" value="<?= $usuario->getNombre() ?>"></td>  
                    <td><input type="int" disabled name="email" value="<?= $usuario->getEmail() ?>"></td>  
                    <td><input type="int" disabled name="apellidos" value="<?= $usuario->getApellidos() ?>"></td>  
                    <td><input type="int" disabled name="fecNac" value="<?= $usuario->getFecNacimiento() ?>"></td>  
                    <td>
                        <input type="text" disabled name="admin" value="<?php if($admin):
                                                                        echo "Si";
                                                                        else:
                                                                        echo "No";
                                                                        endif;  ?>">
                    </td>
                    <td>
                        <!--<button id="delete" class="btn-sm btn-danger">Borrar</button>-->
                        <!--<button id="edit" class="btn-sm btn-warning">Editar</button>-->
                        <a class="btn btn-danger" href="./ops/ModifyUser.php?cop=delete&id=<?= $id ?>">Borrar</a>
                        <a class="btn btn-warning" href="./ops/ModifyUser.php?cop=update&id=<?= $id ?>">Editar</a>
                    </td>
                </tr>  
                 
            </tbody>  
        
<?php

            $usuario = $db->getObject("Usuario") ;
        } while ($usuario) ;

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