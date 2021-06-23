<?php

    require 'conexion.php';

    if(!empty($_POST['src_imagen']) && !empty($_POST['producto']) && !empty($_POST['precio']) 
    && !empty($_POST['descripcion']))
    {
        $src_img = $_POST['src_imagen'];
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $sql = "INSERT INTO catalogo (producto, descripcion, precio, src_imagen) VALUES 
        ('$producto', '$descripcion', '$precio', '$src_img')";
        $resultado = mysqli_query($conexion, $sql);
        if(!$resultado)
        {
            echo 'Error consultar con soporte ';
        }
        else
        {
            echo '1';
        }
    }
    else
    {
        echo 'Error rellenar todos los campos';
    }
    mysqli_close($conexion);

?>