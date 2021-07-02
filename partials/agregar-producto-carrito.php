<?php

    require 'conexion.php';
    session_start();

    if(!empty($_POST['id_producto']))
    {
        $id_producto = $_POST['id_producto'];
        $cantidad_producto = $_POST['cantidad_producto'];
        $precio = $_POST['precio'];

        $sql = "SELECT * FROM carrito WHERE id_producto = '$id_producto'";
        $resultado=mysqli_query($conexion,$sql);
        $numero_fila = mysqli_num_rows($resultado);
        if($numero_fila != '1')
        {
            $sql_select = "SELECT * FROM catalogo WHERE id = '$id_producto'";
            $resultado_select=mysqli_query($conexion,$sql_select);
            if($filas_select = mysqli_fetch_array($resultado_select))
            {
                $producto = $filas_select['producto'];
                $descripcion = $filas_select['descripcion'];
                $src_imagen = $filas_select['src_imagen'];
                
                $sql_insert = "INSERT INTO carrito (id_producto ,producto, descripcion, precio, src_imagen, id_usuario, cantidad) VALUES 
                ('$id_producto', '$producto', '$descripcion', '$precio', '$src_imagen', '1','$cantidad_producto')";
                $resultado_insert = mysqli_query($conexion, $sql_insert);
                if(!$resultado_insert)
                {
                    echo 'Error consultar con soporte ';
                }
                else
                {
                    $sql_select_usuario = "SELECT total_carrito FROM usuarios WHERE id = '1'";
                    $resultado_select_usuario =mysqli_query($conexion,$sql_select_usuario);
                    if($filas_select_usuario = mysqli_fetch_array($resultado_select_usuario))
                    {
                        $total_carrito = $filas_select_usuario['total_carrito'];
                        $total_carrito = $total_carrito + $precio;
                        $_SESSION['precio_total_usuario'] = $total_carrito;

                        $sql_update = "UPDATE usuarios SET total_carrito = '$total_carrito'";
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

                }            
            }
        }
        else
        {
            echo '2';
        }
    }
    else
    {
        echo 'Error rellenar todos los campos';
    }
    mysqli_close($conexion);

?>