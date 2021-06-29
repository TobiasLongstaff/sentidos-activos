<?php

    require 'conexion.php';

    $cantidad = 0;
    $sql = "SELECT * FROM carrito WHERE id_usuario = '1'";
    $json = array();
    $resultado=mysqli_query($conexion,$sql);
    while($filas = mysqli_fetch_array($resultado))
    {
        $cantidad++;
    }

    $json[] = array(
        'cantidad' => $cantidad
    );
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion);        
?>