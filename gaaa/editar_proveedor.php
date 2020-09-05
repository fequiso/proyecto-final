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

			$idproveedor = $_POST['id'];
			$proveedor   = $_POST['proveedor'];
			$contacto    = $_POST['contacto'];
			$telefono  = $_POST['telefono'];
			$direccion = $_POST['direccion'];


					$sql_update = mysqli_query($conexion,"UPDATE proveedor
																								SET proveedor = '$proveedor', contacto='$contacto',telefono='$telefono',direccion='$direccion'
																								WHERE codproveedor=$idproveedor");

				if ($sql_update) {
					$alert='<p class="msg_save">Proveedor actualizado correcto</p>';
				}else{
					$alert='<p class="msg_error">no se pudo actualizar Proveedor</p>';
			}
		}
	}
	//mostrar datos

	if (empty($_REQUEST['id'])) {
		header('location: lista_proveedor.php');
		mysqli_close($conexion);
	}
	$idproveedor = $_REQUEST['id'];

	$sql = mysqli_query($conexion,"SELECT * FROM proveedor  WHERE codproveedor=$idproveedor");
	mysqli_close($conexion);

	$result_sql = mysqli_num_rows($sql);

	if ($result_sql == 0) {
		header('location: lista_proveedor.php');
	}else {

		while ($data = mysqli_fetch_array($sql)) {
			$idproveedor  = $data['codproveedor']; // ojo $idcliente
			$proveedor  = $data['proveedor'];
			$contacto  = $data['contacto'];
			$telefono = $data['telefono'];
			$direccion   = $data['direccion'];

		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'includes/scripts.php'; ?>
	<title>Actualizar proveedor</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<div class="form_register">
			<h1>Actualizar proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $idproveedor; ?>">
				<label for="proveedor">Proveedor</label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor" value="<?php echo $proveedor; ?>">
				<label for="contacto">Contacto</label>
				<input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto" value="<?php echo $contacto; ?>">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo $telefono; ?>">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion completo" value="<?php echo $direccion; ?>">
				<input type="submit" value="Actualizar proveedor" class="btn_save">
			</form>

		</div>
	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
