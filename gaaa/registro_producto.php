<?php
	session_start();
	if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
		header("location: ./");
	}
	include "../conexion.php";

	if (!empty($_POST))
	{

		$alert='';
		if (empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || $_POST['precio']<=0 || empty($_POST['cantidad']) || $_POST['cantidad'] <=0)
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios y no negativos</p>';
		}else{

			$proveedor = $_POST['proveedor'];
			$producto = $_POST['producto'];
			$precio = $_POST['precio'];
			$cantidad = $_POST['cantidad'];
			$usuario_id = $_SESSION['idUser'];

			$foto  = $_FILES['foto'];
			$nombre_foto = $foto['name'];
			$type  = $foto['type'];
			$url_temp  = $foto['tmp_name'];

			$imgProducto = 'img_producto.png';

			if ($nombre_foto != '') {
				$destino = 'img/uploads/';
				$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
				$imgProducto = $img_nombre.'.jpg';
				$src = $destino.$imgProducto;
			}

				$query_insert = mysqli_query($conexion,"INSERT INTO producto(proveedor,descripcion,precio,existencia,usuario_id,foto)
																										VALUES('$proveedor','$producto','$precio','$cantidad','$usuario_id','$imgProducto')");
					if ($query_insert) {
						if ($nombre_foto != '') {
							move_uploaded_file($url_temp,$src);
						}
							$alert='<p class="msg_save">Producto guardado correcto</p>';
					}else{
							$alert='<p class="msg_error">no se pudo guardar Producto</p>';
					}
			}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'includes/scripts.php'; ?>
	<title>Registro producto</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<div class="form_register">
			<h1>Registro producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>

			<form action="" method="post" enctype="multipart/form-data">
					<label for="proveedor">Proveedor</label>

					<?php
						$query_proveedor = mysqli_query($conexion,"SELECT codproveedor,proveedor FROM proveedor where estatus=1
																												order by proveedor ASC");
						$result_proveedor = mysqli_num_rows($query_proveedor);
						mysqli_close($conexion);
					 ?>

					<select name="proveedor" id="proveedor">
						<?php
							if ($result_proveedor > 0) {
								while ($proveedor = mysqli_fetch_array($query_proveedor)) {
						?>

								<option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>

						<?php
								}
							}
						 ?>

					</select>

					<label for="producto">producto</label>
					<input type="text" name="producto" id="producto" placeholder="Nombre del producto">

					<label for="precio">precio</label>
					<input type="number" name="precio" id="precio" placeholder="precio del producto">

					<label for="cantidad">cantidad</label>
					<input type="number" name="cantidad" id="cantidad" placeholder="cantidad del producto">

				  <div class="photo">
				   <label for="foto">Foto</label>
			        <div class="prevPhoto">
			        <span class="delPhoto notBlock">X</span>
			        <label for="foto"></label>
			        </div>
			        <div class="upimg">
			        <input type="file" name="foto" id="foto">
			        </div>
			        <div id="form_alert"></div>
			    </div>

				<input type="submit" value="Guardar producto" class="btn_save">
			</form>

		</div>
	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
