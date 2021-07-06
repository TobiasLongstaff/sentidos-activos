<?php

    require 'conexion.php';
    session_start();

    if(isset($_POST['id_producto']) && isset($_SESSION['id_usuario']))
    {
        $id_usuario = $_SESSION['id_usuario'];
        $id_producto = $_POST['id_producto'];
        

        $sql = "SELECT * FROM carrito WHERE id_usuario = '$id_usuario' AND id = '$id_producto'";
        $resultado=mysqli_query($conexion,$sql);
        if($filas = mysqli_fetch_array($resultado))
        {
            $cantidad = $filas['cantidad'];
            $precio = $filas['precio'];
            $total_carrito = $_SESSION['precio_total_usuario'] - $cantidad * $precio;

            $sql = "DELETE FROM carrito WHERE id_usuario = '$id_usuario' AND id = '$id_producto'";
            $resultado = mysqli_query($conexion, $sql);
            if(!$resultado)
            {
                die('2');
            }
            else
            {
                $sql_update = "UPDATE usuarios SET total_carrito = '$total_carrito' WHERE id = '$id_usuario'";
                $resultado_update = mysqli_query($conexion, $sql_update);
                if(!$resultado_update)
                {
                    echo 'Error consultar con soporte ';
                }   
                else
                {
                    $_SESSION['precio_total_usuario'] = $total_carrito;
                    echo '1';
                } 
            }
        }
    }
    mysqli_close($conexion); 
?>