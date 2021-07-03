<?php
    require 'partials/conexion.php';
    require_once 'assets/plugins/google-login-api/vendor/autoload.php';
    require_once 'partials/config.php';
    
    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($recirect_url);
    $client->addScope("email");
    $client->addScope("profile");

    require 'partials/header.html'; 
?>
    <div class="container-login">
        <form id="form-login" method="post">
            <div class="container-titulo-login">
                <label class="titulo-login">Login</label><br>
            </div>
            <div class="container-textbox-login">
                <input class="textbox-login-general" type="text" id="usuario" required="">
                <label>Usuario</label>        
            </div>
            <div class="container-textbox-login">
                <input class="textbox-login-general" type="password" id="password" required="">
                <label>Contraseña</label>          
            </div>
            <div id="alerta-login"></div>
            <input type="submit" class="btn-login" value="Iniciar Sesion">   
            <label class="text-cuenta-login">No tenes una cuenta?</label>   
            <div class="container-btn-registro">
                <a class="btn-registro-google" href='<?=$client->createAuthUrl()?>'>Login <i class="fab fa-google-plus-g"></i></a>  
                <a href="" class="btn-registro">Registrarse</a>                   
            </div>   
        </form>

    </div>
    
    <script src="assets/plugins/jquery-3.5.1.min.js"></script>
    <script src="assets/scripts/app.js"></script>
</body>
</html>   