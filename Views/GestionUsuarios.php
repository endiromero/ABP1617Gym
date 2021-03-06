<!--Elías 06/11/2016-->
<?php
//Ser al menos entrenador
if(!isset($_SESSION))
{
    session_start();
}
if(!isset($_SESSION['userID'])){
  header('Location: paginaPrincipal.php');
}else{
  //La sesion esta seteada. Si eres deportista no entras
  require_once('../Controllers/c_Usuario.php');
  require_once("../DB/connectDB.php");

  $usuariosController = new UsuarioController();
  $user = $usuariosController->getUserByEmail($_SESSION['userID']);

  if($user['tipoUsuario']=='deportista'){
    header('Location: paginaPrincipal.php');
  }
  else{
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Gestion de Usuarios</title>
    <?php
        require_once('NavBar.php');
        require_once('../Controllers/c_Usuario.php');
        require_once("../DB/connectDB.php");

        $usuariosController = new UsuarioController();
        $usuarios = $usuariosController->gestionUsuarios();
        ?>

  </head>

    <body>
        <div class="tabla panel-default">
            <div class = 'row panel-heading'>
              <span class ="col-md-2">Email</span> <span class="col-md-2" >Nombre</span> <span class="col-md-2" >Catergoria</span> <span class="col-md-2" >Opciones</span>
            </div>
            <?php foreach($usuarios as $it){ ?>
            <div class = 'row'>
              <span class="col-md-2"><?php echo ($it['email']); ?></span>
              <span class="col-md-2"><?php echo ($it['nomUsuario']); ?></span>
              <span class="col-md-2"><?php echo($it['tipoUsuario']);?></span>
              <button class="col-md-1 btn btn-danger" type="submit" form="borrar" name="idUsuario" value = <?php echo("".$it['idUsuario']."");?>>Borrar</button>
              <button class="col-md-1 btn btn-warning" onclick="location.href='ModificarUsuario.php?id=<?php echo($it['idUsuario']);?>'">Modificar</button>
            </div>
              <form method= "post" action = "../Controllers/c_Usuario.php?op=0" class ='derecha' id="borrar">
              </form>


  <?php } ?>
            <button class="btn btn-success" onclick="location.href='CrearUsuario.php'">Crear Nuevo Usuario</button>
            </div>
    </body>
</html>
<?php
}
}
?>
