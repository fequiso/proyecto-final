<?php
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'factura';

  $conexion = @mysqli_connect($host, $user, $pass, $db);
  if ($conexion->connect_error) die ("Fatal error");
 ?>
