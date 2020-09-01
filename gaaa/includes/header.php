<?php
 session_start();
 if (empty($_SESSION['active']))
  {
     header('location: ../');
  }
 ?>
<header>
  <div class="header">

    <h2>ELECTRÓNICA FEQUISO <h3>venta telefónica 962249355</h3> </h2>

    <div class="optionsBar">
      <p>ANDAHUAYLAS, <?php echo fechaC(); ?></p>
      <span>|</span>
      <span class="user"><?php echo $_SESSION['user'] ?></span>
      <img class="photouser" src="img/user.jpg" alt="Usuario">
      <a href="salir.php"><img class="close" src="img/pp.png" alt="Salir del sistema" title="Salir"></a>
    </div>
  </div>
  <?php include 'nav.php'; ?>
</header>
