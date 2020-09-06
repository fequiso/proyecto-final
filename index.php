<?php
  $alert = '';
  session_start();
  if (!empty($_SESSION['active']))
  {
    header('location: gaaa/');

  }else {

   if (!empty($_POST))
   {
     if (empty($_POST['usuario']) || empty($_POST['clave']))
     {

       $alert = 'ingrese su usuario y contraseña';

     }else {
       require_once 'conexion.php';
       $user = mysqli_real_escape_string($conexion,$_POST['usuario']);
       $pass = md5(mysqli_real_escape_string($conexion,$_POST['clave']));

       $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$user' AND clave='$pass'");
       mysqli_close($conexion);
       $result = mysqli_num_rows($query);

       if ($result > 0) {
         $data = mysqli_fetch_array($query);

         $_SESSION['active'] = true;
         $_SESSION['idUser'] = $data['idusuario'];
         $_SESSION['nombre'] = $data['nombre'];
         $_SESSION['email']  = $data['correo'];
         $_SESSION['user']   = $data['usuario'];
         $_SESSION['rol']    = $data['rol'];

         header('location: gaaa/');

       }else{
         $alert = 'usuario y contraseña incorrectos';
         session_destroy();
       }
     }
   }
 }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login | Sistema Facturación</title>
    <link rel="stylesheet" href="css/estilo.css">
    </style>
  </head>
  <body>
    <section id="contenedor">
      <form class="" action="" method="post">
        <h2>INICIAR SESIÓN</h2>
        <img src="imagenes/user.png" width="200" height="200" alt="login">
        <input type="text" name="usuario" placeholder="usuario" value="">
        <input type="password" name="clave" placeholder="contraseña" value="">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <input type="submit" name="" value="INGRESAR">
      </form>
    </section>
  </body>
</html>
