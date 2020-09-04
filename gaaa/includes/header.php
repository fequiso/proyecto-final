<?php
 if (empty($_SESSION['active']))
  {
     header('location: ../');
  }
 ?>
<header>
  <div class="header">

    <h2>FACTURACIÓN ELECTRÓNICA</h2>

    <div class="optionsBar">
      <p>ANDAHUAYLAS, <?php echo fechaC(); ?></p>
      <span>|</span>
      <span class="user"><?php echo $_SESSION['user'].' - '.$_SESSION['rol']; ?></span>
      <img class="photouser" src="img/user.jpg" alt="Usuario">
      <a href="salir.php"><img class="close" src="img/pp.png" alt="Salir del sistema" title="Salir"></a>
    </div>
  </div>
  <?php include 'nav.php'; ?>
</header>
