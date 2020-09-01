<?php
	include "../conexion.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'includes/scripts.php'; ?>
	<style media="screen">
		#container h1{
			font-size: 35px;
			display: inline-block;
		}

		.btn_new{
			display: inline-block;
			background: #239baa;
			color: #fff;
			padding: 5px 25px;
			border-radius: 4px;
			margin: 20px;
		}

		table{
			border-collapse: collapse;
			font-size: 12pt;
			font-family: arial;
			width: 100%;
		}

		table th{
			text-align: left;
			padding: 10px;
			background: #FE6A00;
			color: #000;
		}

		table tr:nth-child(odd){
			background: #FFF;
		}

		table td{
			padding: 10px;
		}

		.link_edit{
			color: #0200CD;
		}

		.link_delete{
			color: #000; /* cambiar color a rojo*/
		}

	</style>
	<title>Usuarios</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<h1>lista de usuarios</h1>
		<a href="registro_usuario.php" class="btn_new">Crear usuario</a>
		<table>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Correo</th>
					<th>rol</th>
					<th>Acciones</th>
				</tr>

				<?php
					$query = mysqli_query($conexion,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol
						                                      FROM usuario u inner join rol r on u.rol=r.idrol");
					$result = mysqli_num_rows($query);

					if ($result > 0) {

						while ($data = mysqli_fetch_array($query)) {
				?>
				<tr>
					<td><?php echo $data["idusuario"]; ?></td>
					<td><?php echo $data["nombre"]; ?></td>
					<td><?php echo $data["correo"]; ?></td>
					<td><?php echo $data["rol"]; ?></td>
					<td>
						<a class="link_edit" href="#">editar</a>
						|
						<a class="link_delete" href="#">eliminar</a>
					</td>
				</tr>
	<?php
			}
		}
	 ?>
		</table>

	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
