<?php
	session_start();
	if ($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2) {
		header("location: ./");
	}
	include "../conexion.php";

	if (!empty($_POST)) {

		if (empty($_POST['idproveedor'])) {
			header("location: lista_proveedor.php");
			mysqli_close($conexion);
		}

		$idproveedor = $_POST['idproveedor'];

		//$query_delete = mysqli_query($conexion,"DELETE FROM usuario WHERE idusuario=$idusuario"); para eliminar
		$query_delete = mysqli_query($conexion,"UPDATE proveedor SET estatus=0 WHERE codproveedor=$idproveedor");//solo ocultar
		mysqli_close($conexion);
		if ($query_delete) {
			header("location: lista_proveedor.php");
		}else {
			echo "Error al eliminar";
		}
	}

	if (empty($_REQUEST['id'])) {
		header("location: lista_proveedor.php");
		mysqli_close($conexion);
	}else {

		$idproveedor = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT * FROM proveedor WHERE codproveedor = $idproveedor");
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if ($result > 0) {
			while ($data = mysqli_fetch_array($query)) {

				$proveedor = $data['proveedor'];
			}
		}else{
			header("location: lista_proveedor.php");
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="/css/master.css"> <!-- agregar icono -->
	<?php include 'includes/scripts.php'; ?>
	<title>Eliminar proveedor</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<br>
		<div class="data_delete">
			<h2>¿Está serguro que quiere eliminar al proveedor?</h2>
			<p>Nombre del proveedor:<span><?php echo $proveedor; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idproveedor" value="<?php echo $idproveedor; ?>">
				<a href="lista_proveedor.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Eliminar" class="btn_ok">
			</form>
		</div>

	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
