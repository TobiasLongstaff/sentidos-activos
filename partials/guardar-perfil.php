<?php

    require 'conexion.php';
    session_start();

    if(isset($_SESSION['id_usuario']))
    {
        $id_usuario = $_SESSION['id_usuario'];
        $nombre_apellido = $_POST['nombre_apellido'];
        $documento = $_POST['documento'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        $sql_update = "UPDATE usuarios SET nombre_apellido = '$nombre_apellido', documento = '$documento',
        telefono = '$telefono', direccion = '$direccion' WHERE id = '$id_usuario'";
        $resultado_update = mysqli_query($conexion, $sql_update);
        if(!$resultado_update)
        {
            echo 'Error consultar con soporte ';
        }   
        else
        {
            $_SESSION['documento_usuario'] = $documento;
            echo '1';
        }     
    }
    else
    {
        echo 'Error consultar con soporte ';
    }
    mysqli_close($conexion);
?>