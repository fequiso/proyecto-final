<?php

    include "../conexion.php";

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
    }
    exit;

?>