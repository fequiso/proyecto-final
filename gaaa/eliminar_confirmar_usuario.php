<?php
	if (empty($_REQUEST['id'])) {
		header("location: lista_usuarios.php");

	}else {
		include "../conexion.php";
		$idusuario = $_REQUEST['id'];
		$query = mysqli_query($conexion,"SELECT u.nombre,u.usuario,r.rol FROM usuario u
																			INNER JOIN rol r ON u.rol=r.idrol
																			WHERE u.idusuario = $idusuario");

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
	<style>
	.data_delete{
		text-align: center;
	}
	.data_delete h2{
		font-size: 12pt;
		color: red;
	}
	.data_delete span{
		font-weight: bold;
		color: #000032; /*color de letra*/
		font-size: 12pt;
	}
 .btn_cancel,.btn_ok{
	width: 124px;
	background: #0030CB;
	color:  #fff;
	display: inline-block;
	padding: 5px;
	border-radius: 5px;
	cursor: pointer;
	margin: 15px;
 }
 .data_delete form{
	 background: initial;
	 margin: auto;
	 padding: 20px 5px;
	 border: 0;
 }
	</style>
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

			<form>
				<a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
				<input type="submit" name="" value="Aceptar" class="btn_ok">
			</form>
		</div>

	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
