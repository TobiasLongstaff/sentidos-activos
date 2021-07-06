<?php
    session_start();
    require 'conexion.php';

    if(isset($_POST['usuario']) && isset($_POST['password']))
    {
        $usuario = $_POST['usuario'];
        $password = sha1($_POST['password']);
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
        $resultado = mysqli_query($conexion, $sql);
        $numero_fila = mysqli_num_rows($resultado);
        if($numero_fila == '1')
        {
            $filas = mysqli_fetch_array($resultado);

            $_SESSION['usuario'] = $filas['usuario'];
            $_SESSION['id_usuario'] = $filas['id'];
            $_SESSION['tipo_usuario'] = $filas['tipo'];
            $_SESSION['precio_total_usuario'] = $filas['total_carrito'];
            $_SESSION['mail_usuario'] = $filas['mail'];
            $_SESSION['documento_usuario'] = $filas['documento'];

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