<?php

    include "../conexion.php";

    session_start();

    //print_r($_POST);  exit;

    if (!empty($_POST)) {

        //extraer datos del producto
        if ($_POST['action'] == 'infoProducto') {

            $producto_id = $_POST['producto'];

            $query = mysqli_query($conexion,"SELECT codproducto,descripcion from producto
                                             where codproducto=$producto_id and estatus=1");
            mysqli_close($conexion);

            $result = mysqli_num_rows($query);
            if ($result > 0) {
                $data = mysqli_fetch_assoc($query);
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "ERROR";
            exit;
        }

        //agreagar productos a entrada
        if ($_POST['action'] == 'addProduct') {

            if (!empty($_POST['cantidad']) || !empty($_POST['precio']) || !empty($_POST['producto_id'])) {

                $cantidad = $_POST['cantidad'];
                $precio = $_POST['precio'];
                $producto_id = $_POST['producto_id'];
                $usuario_id = $_SESSION['idUser'];

                $query_insert = mysqli_query($conexion,"INSERT INTO entradas(codproducto,cantidad,precio,usuario_id)
                                                                values($producto_id,$cantidad,$precio,$usuario_id)");

                if ($query_insert) {
                    //ejecutar procedimento almacenado
                    $query_upd = mysqli_query($conexion,"CALL actualizar_precio_producto($cantidad,$precio,$producto_id)");
                    $result_pro = mysqli_num_rows($query_upd);

                    if ($result_pro  > 0) {
                        $data = mysqli_fetch_assoc($query_upd);
                        $data['$producto_id'] = $producto_id;
                        echo json_encode($data,JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                }else{
                    echo "error";
                }
                mysqli_close($conexion);
            }else{
                echo "error";
            }
            exit;
        }

        //eliminar producto
        if ($_POST['action'] == 'delProduct') {
          if (empty($_POST['producto_id']) || !is_numeric($_POST['producto_id'])) {
            echo "error";
          }else {
              $idproducto = $_POST['producto_id'];
              //$query_delete = mysqli_query($conexion,"DELETE FROM usuario WHERE idusuario=$idusuario"); para eliminar
              $query_delete = mysqli_query($conexion,"UPDATE producto SET estatus=0 WHERE codproducto=$idproducto");//solo ocultar
              mysqli_close($conexion);

              if ($query_delete) {
                echo "ok";
              }else {
                echo "Error";
              }
           }
           echo "error";
           exit;
        }

        //buscar Cliente
        if ($_POST['action'] == 'searchCliente')
        {
            if (!empty($_POST['cliente'])) {

              $nit = $_POST['cliente'];
              $query = mysqli_query($conexion,"SELECT * FROM cliente WHERE nit LIKE '$nit' AND estatus=1");

              mysqli_close($conexion);
              $result = mysqli_num_rows($query);

              $data = '';
              if ($result > 0) {
                $data = mysqli_fetch_assoc($query);
              }else{
                $data = 0;
              }
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }

        //registrar cliente - venta
        if ($_POST['action'] == 'addCliente')
        {
          $nit = $_POST['nit_cliente'];
          $nombre = $_POST['nom_cliente'];
          $telefono = $_POST['tel_cliente'];
          $direccion = $_POST['dir_cliente'];
          $usuario_id = $_SESSION['idUser'];

          $query_insert = mysqli_query($conexion,"INSERT INTO cliente(nit,nombre,telefono,direccion,usuario_id)
                                                        VALUES('$nit','$nombre','$telefono','$direccion','$usuario_id')");
          if ($query_insert) {
            $codCliente = mysqli_insert_id($conexion);
            $msg = $codCliente;
            }else {
              $msg='error';
            }
            mysqli_close($conexion);
            echo $msg;
            exit;
        }
    }
    exit;

?>
