<?php

	include "../conexion.php";

	if (!empty($_POST))
	{
		$alert='';
		if (empty($_POST['nombre']) || empty($_POST['correo']) ||
	      empty($_POST['usuario']) || empty($_POST['clave']) ||
		   	empty($_POST['rol']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{

			$nombre = $_POST['nombre'];
			$email = $_POST['correo'];
			$user   = $_POST['usuario'];
			$clave  = md5($_POST['clave']);
			$rol    = $_POST['rol'];

			$query = mysqli_query($conexion,"SELECT * FROM usuario where usuario='$user' or correo='$email' ");
			$result = mysqli_fetch_array($query);

			if ($result > 0) {
				$alert='<p class="msg_error">El usuario ya existe</p>';
			}else{
				$query_insert = mysqli_query($conexion,"INSERT INTO usuario(nombre,correo,usuario,clave,rol)
																										VALUES('$nombre','$email','$user','$clave','$rol')");
				if ($query_insert) {
					$alert='<p class="msg_save">usuario creado correcto</p>';
				}else{
					$alert='<p class="msg_error">no se pudo crear usuario</p>';
				}
			}
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'includes/scripts.php'; ?>
	<title>Registro Usuario</title>
	<!-- <style media="screen">
	.form_register{
		width: 450px;
		margin: auto;
	}

	.form_register h1{
		color: #3c93b0;
	}

	hr{
		border: 0;
		background: #000;
		height: 1px;
		margin: 10px 0;
		display: block;
	}

	form{
		background: #fff;
		margin: auto;
		padding: 20px 50px;
		border: 1px solid #d1d1d1;
	}

	label{
		display: block;
		font-size: 12pt;
		font-family: 'arial';
		margin: 15px auto 5px auto;
	}

	input,select{
		display: block;
		width: 100%;
		font-size: 11pt;
		padding: 5px;
		border: 1px solid #85929e;
		border-radius: 5px;
	}

	.btn_save{
		font-size: 12pt;
		background: #12a4c6;
		padding: 10px;
		color: black;
		letter-spacing: 1px;
		border: 0;
		cursor: pointer;
		margin: 15px auto;
	}

	.alert{
		width: 100%;
		background: #66e07d66;
		border-radius: 6px;
		margin: 20px auto;
	}
	.msg_error{
		color: red;
	}
	.msg_save{
		color: blue;
	}
	.alert p{
		padding: 10px;
	}
</style> -->
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<div class="form_register">
			<h1>Registro usuario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>

			<form action="" method="post">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
				<label for="correo">Correo electrónico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electrónico">
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario">
				<label for="clave">Contraseña</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">
				<label for="rol">Tipo Usuario</label>
				<?php
					$query_rol = mysqli_query($conexion,"SELECT * FROM rol");
					$result_rol =  mysqli_num_rows($query_rol);
				 ?>
				<select  name="rol" id="rol">
					<?php
					if ($result_rol>0) {
						while ($rol =  mysqli_fetch_array($query_rol)) {
					?>
						<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
					<?php
						}
					}
					 ?>
				</select>
				<input type="submit" value="Crear usuario" class="btn_save">
			</form>

		</div>
	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
