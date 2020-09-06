<?php
 if (empty($_SESSION['active']))
  {
     header('location: ../');
  }
 ?>
 <style media="screen">
 #form_add_product{
   width: 420px;
   text-align: center;
 }
 .btn_new{
   cursor: pointer;
 }
 </style>
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
<div class="modal">
  <div class="bodyModal">
    <form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault();
       sendDataProduct(); ">
      <h1>agregar producto</h1>
      <h2 class="nameProducto"></h2><br>
      <input type="number" name="cantidad" id="txtCantidad" placeholder="cantidad del producto"
      required><br>
      <input type="text" name="precio" id="txtPrecio" placeholder="precio del producto" required>

      <input type="hidden" name="producto_id" id="producto_id" required>
      <input type="hidden" name="action" value="addProduct" required>
      <div class="alert alertAddProduct"></div>

      <button type="submit" class="btn_new">agregar</button>
      <a href="#" class="btn_ok closeModal" onclick="coloseModal();">cerrar</a>
    </form>
  </div>
</div>
