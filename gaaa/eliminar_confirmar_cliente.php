<?php
	session_start();
	if ($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2) {
		header("location: ./");
	}
	include "../conexion.php";

	if (!empty($_POST)) {

		if (empty($_POST['idcliente'])) {
			header("location: lista_clientes.php");
			mysqli_close($conexion);
		}

		$idcliente = $_POST['idcliente'];

		//$query_delete = mysqli_query($conexion,"DELETE FROM usuario WHERE idusuario=$idusuario"); para eliminar
		$query_delete = mysqli_query($conexion,"UPDATE cliente SET estatus=0 WHERE idcliente=$idcliente");//solo ocultar
		mysqli_close($conexion);
		if ($query_delete) {
			header("location: lista_clientes.php");
		}else {
			echo "Error al eliminar";
		}
	}

	if (empty($_REQUEST['id'])) {
		header("location: lista_clientes.php");
		mysqli_close($conexion);
	}else {

		$idcliente = $_REQUEST['id'];
		$query = mysqli_query($conexion,"SELECT * FROM cliente WHERE idcliente = $idcliente");
		mysqli_close($conexion);

		$result = mysqli_num_rows($query);

		if ($result > 0) {
			while ($data = mysqli_fetch_array($query)) {
				$nit = $data['nit'];
				$nombre = $data['nombre'];
			}
		}else{
			header("location: lista_clientes.php");
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="/css/master.css"> <!-- agregar icono -->
	<?php include 'includes/scripts.php'; ?>
	<title>Eliminar cliente</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<br>
		<div class="data_delete">
			<h2>¿Está serguro que quiere eliminar al cliente?</h2>
			<p>Nombre:<span><?php echo $nombre; ?></span></p>
			<p>NIT:<span><?php echo $nit; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
				<a href="lista_clientes.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Eliminar" class="btn_ok">
			</form>
		</div>

	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
