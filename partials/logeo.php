<?php
    session_start();
    require 'conexion.php';

    if(isset($_POST['usuario']) && isset($_POST['password']))
    {
        $usuario = $_POST['usuario'];
        $password = sha1($_POST['password']);
        $sql = "SELECT usuario, password FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
        $resultado = mysqli_query($conexion, $sql);
        $numero_fila = mysqli_num_rows($resultado);
        if($numero_fila == '1')
        {
            $data = mysqli_fetch_array($resultado);
            $_SESSION['usuario'] = $data['usuario'];
            echo '1';
        }
        else
        {
            echo 'Usuario o Contraseña incorrectos';
        }
    }
    else
    {
        echo 'Error al cargar los valores contactar con el soporte';
    } 
    mysqli_close($conexion); 
?>