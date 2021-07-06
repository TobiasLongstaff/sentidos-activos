<?php

    require 'partials/header.html';
    require 'partials/conexion.php';
    session_start();

    /**
     * @version 1.0
     */

    require("assets/plugins/PHPMailer/class.phpmailer.php");
    require("assets/plugins/PHPMailer/class.smtp.php");

    if(isset($_SESSION['id_usuario']))
    {
        $id_usuario = $_SESSION['id_usuario'];

        $sql = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
        $resultado=mysqli_query($conexion,$sql);
        if($filas = mysqli_fetch_array($resultado))
        {
            $usuario = $filas['usuario'];
            $mail_cliente = $filas['mail'];
            $direccion = $filas['direccion'];
            $documento = $filas['documento'];
            $telefono = $filas['telefono'];
            $nombre_apellido = $filas['nombre_apellido'];
        }

        $nombre = 'Abilitaciones';
        $email = 'emp.sentidosactivos@gmail.com';

        // Datos de la cuenta de correo utilizada para enviar vía SMTP
        $smtpHost = "smtp.gmail.com";  // Dominio alternativo brindado en el email de alta 
        $smtpUsuario = "emp.sentidosactivos@gmail.com";  // Mi cuenta de correo
        $smtpClave = "Paolu2021";  // Mi contraseña

        $emailDestino = "tobilongstaff@outlook.com";

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Port = 465; 
        // $mail->Port = 587; 
        $mail->SMTPSecure = 'ssl';
        // $mail->SMTPSecure = 'tsl';
        $mail->IsHTML(true); 
        $mail->CharSet = "utf-8";


        // VALORES A MODIFICAR //
        $mail->Host = $smtpHost; 
        $mail->Username = $smtpUsuario; 
        $mail->Password = $smtpClave;

        $mail->From = $email;
        $mail->FromName = $nombre;
        $mail->AddAddress($emailDestino);

        $mail->Subject = "DonWeb - Ejemplo de formulario de contacto"; // Este es el titulo del email.
        $mail->isHTML(true);
        $mail->Body = '
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
            <style type="text/css">
                body
                {
                    margin: 0;
                    padding: 0;
                    background-color: #ffffff;
                }
    
                table
                {
                    border-spacing: 0;
                }
    
                td
                {
                    padding: 0;
                }
    
                .contenido
                {
                    width: 100%;
                    padding-bottom: 40px;
                    display: flex;
                    justify-content: center;
                    margin-top: 2%;
                }
    
                a
                {
                    color: #ffffff;
                    background-color: #0555bd;
                    border-radius: 5px;
                    padding: 20px;
                    font-size: 25px;
                    text-decoration: none;
                }
    
    
                h1
                {
                    color: #0555bd;
                }
    
                h2
                {
                    margin-bottom: 50px;
                }
    
            </style>
        </head>
        <body>
            <div class="contenido">
                <div>
                    <div>
                        <h1>¡Nuevo pedido!</h1>
                        <h2 style="color: #7D7D7D;">Usuario: '.$usuario.'</h2>     
                        <h2 style="color: #7D7D7D;">Nombre y apellido: '.$nombre_apellido.'</h2>  
                        <h2 style="color: #7D7D7D;">E-mail: '.$mail_cliente.'</h2>  
                        <h2 style="color: #7D7D7D;">Direccion: '.$direccion.'</h2>        
                        <h2 style="color: #7D7D7D;">Documento: '.$documento.'</h2>       
                        <h2 style="color: #7D7D7D;">Telefono: '.$telefono.'</h2>
                    </div>               
                </div>
            </div>
        </body>';

        $estadoEnvio = $mail->Send(); 
        if($estadoEnvio)
        {
            echo "El correo fue enviado correctamente.";
        } else 
        {
            echo "Ocurrió un error inesperado.";
        }
    }
?>
    <div class="container-realizar-pedido">
        <div class="container-info-pedido">
            <div class="container-titulo-relizar-pedido">
                <i class="ico-bien fas fa-check-circle"></i>
                <h2>Pedido Relizado</h2>
            </div>
            <p>Listo, su pedido ya fue recibido por nosotros, pronto nos comunicaremos con usted vía mail o teléfono para coordinar la entrega. En caso de inconveniente comunicarse con nosotros<br> 
            Gracias por su compra.
            </p>
            <label class="text-precio-carrito">Precio final: $<?=$_SESSION['precio_total_usuario']?></label><br>
            <a href="index.php">
                <button type="button" class="btn-continuar-predido-realizado">Continuar</button>
            </a>
        </div>
    </div>
    <script src="assets/plugins/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="assets/scripts/app.js"></script>
</body>
</html>  