<?php
	session_start();
	if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
		header("location: ./");
	}
	include "../conexion.php";

	if (!empty($_POST))
	{
		$alert='';
		if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{

			$proveedor = $_POST['proveedor'];
			$contacto = $_POST['contacto'];
			$telefono = $_POST['telefono'];
			$direccion   = $_POST['direccion'];
			$usuario_id = $_SESSION['idUser'];

				$query_insert = mysqli_query($conexion,"INSERT INTO proveedor(proveedor,contacto,telefono,direccion,usuario_id)
																										VALUES('$proveedor','$contacto','$telefono','$direccion','$usuario_id')");
					if ($query_insert) {
							$alert='<p class="msg_save">Proveedor guardado correcto</p>';
					}else{
							$alert='<p class="msg_error">no se pudo guardar Proveedor</p>';
					}
			}
		mysqli_close($conexion); //cerrar conexion
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'includes/scripts.php'; ?>
	<title>Registro proveedor</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<div class="form_register">
			<h1>Registro proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>

			<form action="" method="post">
				<label for="proveedor">Proveedor</label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor">
				<label for="contacto">Contacto</label>
				<input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion completo">
				<input type="submit" value="Guardar proveedor" class="btn_save">
			</form>

		</div>
	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
