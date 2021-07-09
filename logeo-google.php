<?php
    require_once 'assets/plugins/google-login-api/vendor/autoload.php';
    require_once 'partials/config.php';

    require 'partials/conexion.php';
    session_start();

    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($recirect_url);
    $client->addScope("email");
    $client->addScope("profile");

    if(isset($_GET['code']))
    {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);    

        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;    

        if(!empty($email) && !empty($name))
        {
            $sql = "SELECT * FROM usuarios WHERE mail = '$email'";
            $resultado = mysqli_query($conexion, $sql);
            if(mysqli_num_rows($resultado) > 0)
            {
                $filas = mysqli_fetch_array($resultado);
                $_SESSION['usuario'] = $name;
                $_SESSION['id_usuario'] = $filas['id'];
                $_SESSION['tipo_usuario'] = $filas['tipo'];
                $_SESSION['precio_total_usuario'] = $filas['total_carrito'];
                $_SESSION['mail_usuario'] = $email;
                $_SESSION['documento_usuario'] = $filas['documento'];
            }
            else
            {
                $hash = md5(rand(0,1000));

                $sql_insert = "INSERT INTO usuarios (mail, usuario, hash, password, tipo, total_carrito, direccion, documento, telefono, nombre_apellido ) VALUES ('$email', '$name', '$hash', '', '0', '0', '', '', '', '$name')";
                $resultado_insert = mysqli_query($conexion, $sql_insert);
                if(!$resultado_insert)
                {
                    echo 'Error al cargar los datos, consultar con soporte';
                }
                else
                {     
                    $sql = "SELECT * FROM usuarios WHERE mail = '$email'";
                    $resultado = mysqli_query($conexion, $sql);
                    if(mysqli_num_rows($resultado) > 0)
                    {
                        $filas = mysqli_fetch_array($resultado);
                        $_SESSION['usuario'] = $name;
                        $_SESSION['id_usuario'] = $filas['id'];
                        $_SESSION['tipo_usuario'] = $filas['tipo'];
                        $_SESSION['precio_total_usuario'] = $filas['total_carrito'];
                        $_SESSION['mail_usuario'] = $email;
                        $_SESSION['documento_usuario'] = $filas['documento'];
                    }
                }
            }
        }
    } 

    echo("<script>location.href = 'index.php'</script>");
?> 