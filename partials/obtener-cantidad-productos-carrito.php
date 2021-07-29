<?php

    require 'conexion.php';
    session_start();

    $id_usuario = $_SESSION['id_usuario'];

    if(!empty($id_usuario))
    {
        $cantidad = 0;
        $sql = "SELECT * FROM carrito WHERE id_usuario = '$id_usuario'";
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
    }


    mysqli_close($conexion);        
?>