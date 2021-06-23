<?php
    require 'partials/conexion.php';
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
        </form>
    </div>
    
    <script src="assets/plugins/jquery-3.5.1.min.js"></script>
    <script src="assets/scripts/app.js"></script>
</body>
</html>   