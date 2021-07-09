<?php
    session_start();
    require 'partials/conexion.php';
    require 'partials/header.html'; 
?>
    <div class="container-login">
        <form id="form-registro" method="post">
            <div class="container-titulo-login">
                <label class="titulo-login">Registro</label><br>
            </div>
            <div class="contianer-info-registro">
                <div>
                    <div class="container-textbox-login">
                        <input class="textbox-login-general" type="text" id="usuario" required>
                        <label>Usuario</label>        
                    </div>
                    <div class="container-textbox-login">
                        <input class="textbox-login-general" type="text" id="mail" required>
                        <label>E-mail</label>          
                    </div>
                    <div class="container-textbox-login">
                        <input class="textbox-login-general" type="text" id="nombre-apellido" required>
                        <label>Nombre y apellido</label>          
                    </div>
                    <div class="container-textbox-login">
                        <input class="textbox-login-general" type="password" id="password" required>
                        <label>Contraseña</label>          
                    </div>
                    <div class="container-textbox-login">
                        <input class="textbox-login-general" type="password" id="password-con" required>
                        <label>Confirmar contraseña</label>          
                    </div>                
                </div>
                <div>
                    <div class="container-textbox-login">
                        <input class="textbox-login-general" type="text" id="documento" required>
                        <label>Documento</label>          
                    </div>
                    <div class="container-textbox-login">
                        <input class="textbox-login-general" type="text" id="domicilio" required>
                        <label>Domicilio</label>          
                    </div>
                    <div class="container-textbox-login">
                        <input class="textbox-login-general" type="text" id="telefono" required>
                        <label>Telefono</label>          
                    </div>                
                </div>                
            </div>
            <div id="alerta-login"></div>
            <input type="submit" class="btn-login" value="Crear cuenta">   
        </form>
    </div>
    
    <script src="assets/plugins/jquery-3.5.1.min.js"></script>
    <script src="assets/scripts/app.js"></script>
</body>
</html>  