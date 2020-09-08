<?php
	session_start();
	include "../conexion.php";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="/css/master.css"> <!-- agregar icono -->
	<?php include 'includes/scripts.php'; ?>
  <style media="screen">
  .btn_save{
    font-size: 12pt;
    background: #0059ff;
    padding: 10px;
    color: #FFF;
    letter-spacing: 1px;
    border-radius: 5px;
    cursor: pointer;
    margin: 15px auto;
    text-align: center;
  }
  </style>
	<title>ventas</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
    <section id="container">
      <div class="title_page">
        <h1>Nueva venta</h1>
      </div>
      <div class="datos_cliente">
        <div class="action_cliente">
          <h4>Datos del Cliente</h4>
          <a href="#" class="btn_new btn_new_cliente">Nuevo cliente</a>
        </div>
        <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
          <input type="hidden" name="action" value="addCliente">
          <input type="hidden" id="idcliente" name="idcliente" value="" required>
          <div class="wd30">
              <label>Nit</label>
              <input type="text" name="nit_cliente" id="nit_cliente">
          </div>
          <div class="wd30">
              <label >Nombre</label>
              <input type="text" name="nom_cliente" id="nom_cliente" disabled required>
          </div>
          <div class="wd30">
              <label >Teléfono</label>
              <input type="number" name="tel_cliente" id="tel_cliente" disabled required>
          </div>
          <div class="wd100">
              <label >Dirección</label>
              <input type="text" name="dir_cliente" id="dir_cliente" disabled required>
          </div>
          <div class="div_registro_cliente" class="wd100">
              <button type="submit" class="btn_save">GUARDAR</button>
          </div>
        </form>
      </div>
      <div class="datos_venta">
        <h4>Datos de venta</h4>
        <div class="datos">
          <div class="wd50">
            <label>Vendedor</label>
            <p><?php echo $_SESSION['nombre']; ?></p>
          </div>
          <div class="wd50">
            <label>Acciones</label>
            <div id="acciones_venta">
              <a href="#" class="btn_ok textcenter" id="btn_anular_venta">Anular</a>
              <a href="#" class="btn_new textcenter" id="btn_facturar_venta" style="display: none;">Procesar</a>
            </div>
          </div>
        </div>
      </div>
      <table class="tbl_venta">
        <head>
            <tr>
                <th width="100px">Código</th>
                <th>Descripcion</th>
                <th>Existencia</th>
                <th width="100px">Cantidad</th>
                <th class="textright">Precio</th>
                <th class="textright">Precio Total</th>
                <th>Accion</th>
            </tr>
            <tr>
                <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                <td id="txt_descripcion">-</td>
                <td id="txt_existencia">-</td>
                <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                <td id="txt_precio" class="textright">0.00</td>
                <td id="txt_precio_total" class="textright">0.00</td>
                <td><a href="#" id="add_product_venta" class="link_add">Agregar</a></td>
            </tr>
            <tr>
                <th>Código</th>
                <th colspan="2">Descripción</th>
                <th>Cantidad</th>
                <th class="textright">Precio</th>
                <th class="textright">Precio Total</th>
                <th>Acción</th>
            </tr>
        </head>
        <tbody id="detalle_venta">
          <!-- contenido ajax-->
        </tbody>
        <tfoot id="detalle_totales">
         <!-- contenido ajax -->
        </tfoot>
      </table>
    </section>
	<?php include 'includes/footer.php'; ?>

	<script type="text/javascript">
		$(document).ready(function(){
			var usuarioid = '<?php echo $_SESSION['idUser']; ?>';
			serchForDetalle(usuarioid);
		});
	</script>
</body>
</html>
