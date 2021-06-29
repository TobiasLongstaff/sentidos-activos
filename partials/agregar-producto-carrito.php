<?php

    require 'conexion.php';

    if(!empty($_POST['id_producto']))
    {
        $id_producto = $_POST['id_producto'];

        $sql_select = "SELECT * FROM catalogo WHERE id = '$id_producto'";
        $resultado_select=mysqli_query($conexion,$sql_select);
        if($filas_select = mysqli_fetch_array($resultado_select))
        {
            $producto = $filas_select['producto'];
            $precio = $filas_select['precio'];
            $descripcion = $filas_select['descripcion'];
            $src_imagen = $filas_select['src_imagen'];
            
            $sql = "INSERT INTO carrito (id_producto ,producto, descripcion, precio, src_imagen, id_usuario) VALUES 
            ('$id_producto', '$producto', '$descripcion', '$precio', '$src_imagen', '1')";
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
    }
    else
    {
        echo 'Error rellenar todos los campos';
    }
    mysqli_close($conexion);

?>