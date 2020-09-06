<?php
	session_start();
	include "../conexion.php";

	if (!empty($_POST))
	{
		$alert='';
		if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{

			$idCliente = $_POST['id'];
			$nit       = $_POST['nit'];
			$nombre    = $_POST['nombre'];
			$telefono  = $_POST['telefono'];
			$direccion = $_POST['direccion'];

			$result = 0;
			if (is_numeric($nit) and $nit != 0) {
				$query = mysqli_query($conexion,"SELECT * FROM cliente
																									where (nit = '$nit' and idcliente != $idCliente)");
			$result = mysqli_fetch_array($query);
			//$result = count($result);
			}

			if ($result > 0) {
				$alert='<p class="msg_error">El NIT ya existe, ingrese otro</p>';
			}else{
				if ($nit == '') {
					$nit = 0;
				}
					$sql_update = mysqli_query($conexion,"UPDATE cliente
																								SET nit = $nit, nombre='$nombre',telefono='$telefono',direccion='$direccion'
																								WHERE idcliente=$idCliente");

				if ($sql_update) {
					$alert='<p class="msg_save">Cliente actualizado correcto</p>';
				}else{
					$alert='<p class="msg_error">no se pudo actualizar cliente</p>';
				}
			}
		}
	}
	//mostrar datos

	if (empty($_REQUEST['id'])) {
		header('location: lista_clientes.php');
		mysqli_close($conexion);
	}
	$idcliente = $_REQUEST['id'];

	$sql = mysqli_query($conexion,"SELECT * FROM cliente  WHERE idcliente=$idcliente and estatus=1");
	mysqli_close($conexion);

	$result_sql = mysqli_num_rows($sql);

	if ($result_sql == 0) {
		header('location: lista_clientes.php');
	}else {

		while ($data = mysqli_fetch_array($sql)) {
			$idcliente  = $data['idcliente'];
			$nit  = $data['nit'];
			$nombre  = $data['nombre'];
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
	<title>Actualizar Cliente</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<div class="form_register">
			<h1>Actualizar Cliente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $idcliente; ?>">
				<label for="nit">NIT</label>
				<input type="number" name="nit" id="nit" placeholder="Número de NIT" value="<?php echo $nit;  ?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre;  ?>">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo $telefono;  ?>">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion completo" value="<?php echo $direccion;  ?>">
				<input type="submit" value="Actualizar cliente" class="btn_save">
			</form>

		</div>
	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
