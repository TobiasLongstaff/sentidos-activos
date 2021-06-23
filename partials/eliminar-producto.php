<?php

    require 'conexion.php';

    if(isset($_POST['id_producto']))
    {
        $id_producto = $_POST['id_producto'];
        $sql = "DELETE FROM catalogo WHERE id = '$id_producto'";
        $resultado = mysqli_query($conexion, $sql);
        if(!$resultado)
        {
            die('2');
        }
        else
        {
            echo "1";
        }
    }
    mysqli_close($conexion); 
?>