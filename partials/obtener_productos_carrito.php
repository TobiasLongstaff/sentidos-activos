<?php

    require 'conexion.php';

    $sql = "SELECT * FROM carrito WHERE id_usuario = '1'";
    $json = array();
    $resultado=mysqli_query($conexion,$sql);
    while($filas = mysqli_fetch_array($resultado))
    {
        $json[] = array(
            'producto' => $filas['producto'],
            'descripcion' => $filas['descripcion'],
            'precio' => $filas['precio'],
            'id_producto' => $filas['id_producto'],
            'id' => $filas['id'],
            'cantidad' => $filas['cantidad']
        );
    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion);        
?>