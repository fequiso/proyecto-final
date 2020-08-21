<?php
  $alert = '';
   if (!empty($_POST))
   {
     if (empty($_POST['usuario']) || empty($_POST['clave'])) {

       $alert = 'ingrese su usuario y contraseña';

     }else {
       require_once 'conexion.php';
       $user = $_POST['usuario'];
       $pass = $_POST['clave'];

       $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$user' AND clave='$pass'");
       $result = mysqli_num_rows($query);

       if ($result > 0) {
         $data = mysqli_fetch_array($query);
         session_start();
         $_SESSION['active'] = true;
         $_SESSION['idUser'] = $data['idusuario'];
         $_SESSION['nombre'] = $data['nombre'];
         $_SESSION['email']  = $data['email'];
         $_SESSION['user']   = $data['usuario'];
         $_SESSION['rol']    = $data['rol'];

         header('location: gaaa/');

       }else{
         $alert = 'usuario y contraseña incorrectos';
       }
     }
   }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ARTEFACTOS ELECTRÓNICOS</title>
    <link rel="stylesheet" href="css/estilo.css">
  </head>
  <body>
    <section id="contenedor">
      <form class="" action="" method="post">
        <h3>INICIAR SESIÓN</h3>
        <img src="imagenes/user.png" width="200" height="200" alt="login">
        <input type="text" name="usuario" placeholder="usuario" value="">
        <input type="password" name="clave" placeholder="contraseña" value="">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <input type="submit" name="" value="INGRESAR">
      </form>
    </section>
  </body>
</html>
