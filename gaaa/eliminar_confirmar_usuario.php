<?php

	include "../conexion.php";

	if (!empty($_POST)) {
		if ($_POST['idusuario'] == 1) {
			header("location: lista_usuarios.php");
			mysqli_close($conexion);
			exit;
		}
		$idusuario = $_POST['idusuario'];

		//$query_delete = mysqli_query($conexion,"DELETE FROM usuario WHERE idusuario=$idusuario"); para eliminar
		$query_delete = mysqli_query($conexion,"UPDATE usuario SET estatus=0 WHERE idusuario=$idusuario");//solo ocultar

		if ($query_delete) {
			header("location: lista_usuarios.php");
		}else {
			echo "Error al eliminar";
		}
	}

	if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
		header("location: lista_usuarios.php");
		mysqli_close($conexion);
	}else {

		$idusuario = $_REQUEST['id'];
		$query = mysqli_query($conexion,"SELECT u.nombre,u.usuario,r.rol FROM usuario u
																			INNER JOIN rol r ON u.rol=r.idrol
																			WHERE u.idusuario = $idusuario");
		mysqli_close($conexion);

		$result = mysqli_num_rows($query);

		if ($result > 0) {
			while ($data = mysqli_fetch_array($query)) {
				$nombre = $data['nombre'];
				$usuario = $data['usuario'];
				$rol = $data['rol'];
			}
		}else{
			header("location: lista_usuarios.php");
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="/css/master.css"> <!-- agregar icono -->
	<?php include 'includes/scripts.php'; ?>
	<title>Eliminar usuario</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<br>
		<div class="data_delete">
			<h2>¿Está serguro que quiere eliminar el usuario?</h2>
			<p>Nombre:<span><?php echo $nombre; ?></span></p>
			<p>Usuario:<span><?php echo $usuario; ?></span></p>
			<p>Tipo de usuario:<span><?php echo $rol; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
				<a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>

	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
