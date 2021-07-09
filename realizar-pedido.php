<?php

    session_start();
    require 'partials/header.html';
    require 'partials/conexion.php';

    /**
     * @version 1.0
     */

    require("assets/plugins/PHPMailer/class.phpmailer.php");
    require("assets/plugins/PHPMailer/class.smtp.php");

    date_default_timezone_set('America/Buenos_Aires');
    $fecha = date('Y-d-m');   

    $pedido = '';
    $id_pedido = '';

    if(isset($_SESSION['id_usuario']))
    {
        $id_usuario = $_SESSION['id_usuario'];

        $sql_select_carrito = "SELECT * FROM carrito WHERE id_usuario = '$id_usuario'";
        $resultado_select_carrito = mysqli_query($conexion, $sql_select_carrito);
        $numero_fila = mysqli_num_rows($resultado_select_carrito);
        if($numero_fila > '1')
        {
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
                $total_pedido = $filas['total_carrito'];
            }

            $sql = "INSERT INTO pedido (id_usuario, usuario, mail, direccion, documento, telefono, 
            nombre_apellido, estado, fecha, total_pedido) VALUES ('$id_usuario', '$usuario', '$mail_cliente', 
            '$direccion', '$documento', '$telefono', '$nombre_apellido', 'Pendiente', '$fecha', 
            '$total_pedido')";
            $resultado = mysqli_query($conexion, $sql);
            if(!$resultado)
            {
                echo 'Error consultar con soporte ';
            }

            $sql_select_pedido = "SELECT * FROM pedido";
            $resultado_select_pedido = mysqli_query($conexion, $sql_select_pedido);
            while($filas_select_pedido = mysqli_fetch_array($resultado_select_pedido))
            {
                $id_pedido = $filas_select_pedido['id'];
            }

            $sql_select = "SELECT * FROM carrito WHERE id_usuario = '$id_usuario'";
            $resultado_select=mysqli_query($conexion,$sql_select);
            while($filas_select = mysqli_fetch_array($resultado_select))
            {
                $id_producto = $filas_select['id_producto'];
                $producto =$filas_select['producto'];
                $precio = $filas_select['precio'];
                $src_imagen = $filas_select['src_imagen'];
                $cantidad = $filas_select['cantidad'];
    
                $sql = "INSERT INTO productos_pedidos (id_pedido, id_producto, producto, precio, src_imagen, cantidad) VALUES 
                ('$id_pedido', '$id_producto', '$producto', '$precio', '$src_imagen', $cantidad)";
                $resultado = mysqli_query($conexion, $sql);
                if(!$resultado)
                {
                    echo 'Error consultar con soporte ';
                }
                
                $sql_delete = "DELETE FROM carrito WHERE id_usuario = '$id_usuario'";
                $resultado_delete = mysqli_query($conexion, $sql_delete);
                if(!$resultado_delete)
                {
                    echo 'Error consultar con soporte ';
                }
    
                $sql_update = "UPDATE usuarios SET total_carrito = '0' WHERE id = '$id_usuario'";
                $resultado_update = mysqli_query($conexion, $sql_update);
                if(!$resultado_update)
                {
                    echo 'Error consultar con soporte ';
                }    
            }

            $nombre = 'Nuevo Pedido!';
            $email = 'emp.sentidosactivos@gmail.com';

            // Datos de la cuenta de correo utilizada para enviar vía SMTP
            $smtpHost = "smtp.gmail.com";  // Dominio alternativo brindado en el email de alta 
            $smtpUsuario = "emp.sentidosactivos@gmail.com";  // Mi cuenta de correo
            $smtpClave = "Paolu2021";  // Mi contraseña

            $emailDestino = "tobiaslongstaff@gmail.com";

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            // $mail->Port = 465; 
            $mail->Port = 587; 
            // $mail->SMTPSecure = 'ssl';
            $mail->SMTPSecure = 'tsl';
            $mail->IsHTML(true); 
            $mail->CharSet = "utf-8";


            // VALORES A MODIFICAR //
            $mail->Host = $smtpHost; 
            $mail->Username = $smtpUsuario; 
            $mail->Password = $smtpClave;

            $mail->From = $email;
            $mail->FromName = $nombre;
            $mail->AddAddress($emailDestino);

            $mail->Subject = $nombre_apellido." realizo un nuevo pedido"; // Este es el titulo del email.
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
                            <a style="color: #ffffff;" href="http://localhost/sentidos-activos/dashboard-pedidos.php?id='.$id_pedido.'">Ver Pedido</a>   
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
        else
        {
            header("Location: index.php");
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
            <?php $_SESSION['precio_total_usuario'] = '0'; ?>
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