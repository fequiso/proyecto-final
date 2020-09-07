<?php
	session_start();
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
  /*============ Ventas ============*/
.datos_cliente, .datos_venta, .title_page{
	width: 100%;
	max-width: 900px;
	margin: auto;
	margin-bottom: 20px;
}
#detalle_venta tr{
	background-color: #FFF !important;
}
#detalle_venta td{
	border-bottom: 1px solid #CCC;
}
.datos{
	background-color: #e3ecef;
	display: -webkit-flex;
	display: -moz-flex;
	display: -ms-flex;
	display: -o-flex;
	display: flex;
	display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    border: 2px solid #78909C;
    padding: 10px;
    border-radius: 10px;
    margin-top: 10px;
}
.action_cliente{
	display: -webkit-flex;
	display: -moz-flex;
	display: -ms-flex;
	display: -o-flex;
	display: flex;
	align-items: center;
}

.datos label{
	margin: 5px auto;
}
.wd20{
	width: 20%;
}
.wd25{
	width: 25%;
}
.wd30{
	width: 30%;
}
.wd40{
	width: 40%;
}
.wd60{
	width: 60%;
}
.wd100{
	width: 100%;
}
#div_registro_cliente, #add_product_venta{
	display: none;
}
.displayN{
	display: none;
}
.tbl_venta{
	max-width: 900px;
	margin: auto;
}
.tbl_venta tfoot td{
	font-weight: bold;
}
.textright{
	text-align: right;
}
.textcenter{
	text-align: center;
}
.textleft{
	text-align: left;
}
.btn_anular{
	background-color: #f36a6a;
	border: 0;
	border-radius: 5px;
	cursor: pointer;
	padding: 10px;
	margin: 0 3px;
	color: #FFF;
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
            <p>Felisario Quispe Sopanta</p>
          </div>
          <div class="wd50">
            <label>Acciones</label>
            <div id="acciones_venta">
              <a href="#" class="btn_ok textcenter" id="btn_anular_venta">Anular</a>
              <a href="#" class="btn_new textcenter" id="btn_facturar_venta">Procesar</a>
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
            <tr>
                <td>1</td>
                <td colspan="2">Mouse USB</td>
                <td class="textcenter">1</td>
                <td class="textright">100.00</td>
                <td class="textright">100.00</td>
                <td class="">
                    <a class="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle(1);">Borrar</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td colspan="2">Monitor</td>
                <td class="textcenter">2</td>
                <td class="textright">300.00</td>
                <td class="textright">400.00</td>
                <td class="">
                    <a class="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle(1);">Borrar</a>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="textright">SUBTOTAL S/</td>
                <td class="textright">500</td>
            </tr>
            <tr>
                <td colspan="5" class="textright">IGV (18%)</td>
                <td class="textright">12</td>
            </tr>
            <tr>
              <td colspan="5" class="textright">TOTAL S/</td>
              <td class="textright">1000.00</td>
            </tr>
        </tfoot>
      </table>
    </section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
