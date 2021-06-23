<?php

    require 'conexion.php';

    $sql = "SELECT * FROM catalogo";
    $json = array();
    $resultado=mysqli_query($conexion,$sql);
    while($filas = mysqli_fetch_array($resultado))
    {
        $json[] = array(
            'id' => $filas['id'],
            'src_img' => $filas['src_imagen'],
            'precio' => $filas['precio'],
            'descripcion' => $filas['descripcion'],
            'producto' => $filas['producto']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion);        
?>