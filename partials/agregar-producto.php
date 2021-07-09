<?php

    require 'conexion.php';

    if(!empty($_POST['src_imagen']) && !empty($_POST['producto']) && !empty($_POST['precio']) && 
    !empty($_POST['categoria']) && !empty($_POST['descripcion']) && !empty($_POST['stock']))
    {
        $src_img = $_POST['src_imagen'];
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $stock = $_POST['stock'];

        $sql = "INSERT INTO catalogo (producto, descripcion, precio, src_imagen, categoria, stock) VALUES 
        ('$producto', '$descripcion', '$precio', '$src_img', '$categoria', '$stock')";
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