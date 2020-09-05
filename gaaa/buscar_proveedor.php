<?php
  session_start();
  if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
		header("location: ./");
	}
	include "../conexion.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'includes/scripts.php'; ?>
	<title>Lista de proveedores</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<?php
			$busqueda = strtolower($_REQUEST['busqueda']);
			if (empty($busqueda)) {
				header("location: lista_proveedor.php");
				mysqli_close($conexion);
			}
		 ?>

		<h1>lista de proveedores</h1>
		<a href="registro_proveedor.php" class="btn_new">Crear proveedor</a>

		<form action="buscar_proveedor.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda"  placeholder="buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="buscar" class="btn_search">
		</form>

		<table>
				<tr>
					<th>ID</th>
					<th>PROVEEDOR</th>
					<th>CONTACTO</th>
					<th>TELÉFONO</th>
					<th>DIRECCIÓN</th>
          <th>FECHA</th>
					<th>ACCIONES</th>
				</tr>

				<?php
				// paginador

				  $sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM proveedor
																													  	WHERE(codproveedor like '%$busqueda%' or
																																		proveedor like '%$busqueda%' or
																																		contacto like '%$busqueda%' or
																																		telefono like '%$busqueda%'
																															      ) and estatus = 1");
				 	$result_register = mysqli_fetch_array($sql_registe);
					$total_registro = $result_register['total_registro'];

					$por_pagina = 10;

					if (empty($_GET['pagina'])){
						$pagina = 1;
					}else{
						$pagina = $_GET['pagina'];
					}

					$desde = ($pagina - 1) * $por_pagina;
					$total_paginas = ceil($total_registro / $por_pagina);


					$query = mysqli_query($conexion,"SELECT * FROM proveedor WHERE
																											 (codproveedor like '%$busqueda%' or
																												proveedor like '%$busqueda%' or
																												contacto like '%$busqueda%' or
																												telefono like '%$busqueda%') and
																									      estatus=1	ORDER BY codproveedor ASC limit $desde,$por_pagina");
					mysqli_close($conexion);
					$result = mysqli_num_rows($query);

					if ($result > 0) {

						while ($data = mysqli_fetch_array($query)) {
              $formato = 'Y-m-d H:i:s';
              $fecha = DateTime::createFromFormat($formato,$data["date_add"]);

				?>
				<tr>
					<td><?php echo $data["codproveedor"]; ?></td>
					<td><?php echo $data["proveedor"]; ?></td>
					<td><?php echo $data["contacto"]; ?></td>
					<td><?php echo $data["telefono"]; ?></td>
					<td><?php echo $data["direccion"]; ?></td>
          <td><?php echo $fecha->format('d-m-Y'); ?></td>
					<td>
						<a class="link_edit" href="editar_proveedor.php?id=<?php echo $data["codproveedor"]; ?>">editar</a>
						|
						<a class="link_delete" href="eliminar_confirmar_proveedor.php?id=<?php echo $data["codproveedor"]; ?>">eliminar</a>
					</td>
				</tr>
	<?php
			}
		}
	 ?>
		</table>
		<?php
			if ($total_registro != 0) {
		 ?>
		<div class="paginador">
			<ul>
				<?php
					if ($pagina !=1) {
				 ?>
					<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
					<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
				<?php
			   }
					for ($i=1; $i <= $total_paginas ; $i++) {
						if ($i == $pagina) {
							echo '<li class="pageSelected">'.$i.'</li>';
						}else {
							echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
						}
					}
					if ($pagina != $total_paginas) {
				 ?>
				<li><a href="?pagina=<?php echo $pagina+1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?>">>|</a></li>
			<?php } ?>
			</ul>
		</div>
		<?php } ?>
	</section>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
