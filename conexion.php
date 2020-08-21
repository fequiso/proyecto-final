<?php
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'factura';

  $conexion = new mysqli($host, $user, $pass, $db);
  if ($conexion->connect_error) die ("Fatal error");
 ?>
