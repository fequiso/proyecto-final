<?php
	include "../conexion.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'includes/scripts.php'; ?>
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
