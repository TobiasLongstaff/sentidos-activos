<?php

    require 'conexion.php';

    if(isset($_POST['id_producto']))
    {
        $id_producto = $_POST['id_producto'];
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $stock = $_POST['stock'];
        $img_src = $_POST['img_src'];

        $sql_update = "UPDATE catalogo SET producto = '$producto', precio = '$precio', 
        descripcion = '$descripcion', categoria = '$categoria', stock = '$stock', 
        src_imagen = '$img_src' WHERE id = '$id_producto'";
        $resultado_update = mysqli_query($conexion, $sql_update);
        if(!$resultado_update)
        {
            echo 'Error consultar con soporte ';
        }
        else
        {
            echo '1';
        }
    }
    mysqli_close($conexion); 
?>