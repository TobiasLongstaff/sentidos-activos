<?php
    require 'conexion.php';
    session_start();

    if(isset($_POST['mail']))
    {
        $usuario = $_POST['usuario'];
        $mail = $_POST['mail'];        
        $nombre_apellido = $_POST['nombre_apellido'];
        $password = sha1($_POST['password']);
        $password_con = sha1($_POST['password_con']);
        $documento = $_POST['documento'];
        $domicilio = $_POST['domicilio'];
        $telefono = $_POST['telefono'];

        $hash = md5(rand(0,1000));

        $sql = "SELECT mail FROM usuarios WHERE mail = '$mail'";
        $resultado = mysqli_query($conexion, $sql);
        if(mysqli_num_rows($resultado) > 0)
        {
            echo 'El mail ya estan asociados a una cuenta';
        }
        else
        {
            if($password == $password_con)
            {
                $sql = "INSERT INTO usuarios (mail, password, nombre_apellido, hash, documento, 
                telefono, direccion, usuario, tipo, total_carrito) VALUES ('$mail', '$password', '$nombre_apellido', 
                '$hash', '$documento', '$telefono', '$domicilio', '$usuario', '0', '0')";
                $resultado = mysqli_query($conexion, $sql);
                if(!$resultado)
                {
                    echo 'Error al cargar los datos, consultar con soporte';
                }
                else
                { 
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
                }
            }
        }
    }
?>