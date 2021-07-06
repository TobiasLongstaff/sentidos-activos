<?php

    require 'conexion.php';
    session_start();

    if(isset($_SESSION['id_usuario']))
    {
        $id_usuario = $_SESSION['id_usuario'];

        $sql = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
        $json = array();
        $resultado=mysqli_query($conexion,$sql);
        if($filas = mysqli_fetch_array($resultado))
        {
            $json[] = array(
                'id' => $filas['id'],
                'usuario' => $filas['usuario'],
                'mail' => $filas['mail'],
                'direccion' => $filas['direccion'],
                'documento' => $filas['documento'],
                'telefono' => $filas['telefono'],
                'nombre_apellido' => $filas['nombre_apellido'],
            );
        }
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
        mysqli_close($conexion);        
    }

?>