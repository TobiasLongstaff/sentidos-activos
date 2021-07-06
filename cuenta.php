<?php
    require 'partials/conexion.php';
    require 'partials/header.html'; 
    require 'partials/navegacion.php';
?>
<div class="container-cuenta">
    <form method="POST" id="guardar-perfil" class="container-info-cuenta">
        <?php
            if($_SESSION['documento_usuario'] == '')
            {
        ?>
                <div id="container-alerta-general">
                    <div class="alerta-general">
                        <label><i class="fas fa-exclamation-triangle"></i> Debes completar tu perfil para realizar una compra en nuestro sitio web</label>
                    </div>      
                </div>
        <?php
            }
        ?>
        <h2>Mis datos</h2>
        <h4>Datos de cuenta</h4>
        <div>
            <label>Usuario: <?=$_SESSION['usuario']?></label><br>
            <label>E-mail: <?=$_SESSION['mail_usuario']?></label>  
        </div>
        <h4>Datos personales</h4>
        <div>
            <div class="container-textbox-dashboard">
                <input class="textbox-dashboard-general" type="text" id="nombre-apellido" required>
                <label>Nombre y apellido</label>
            </div>
            <div class="container-textbox-dashboard">
                <input class="textbox-dashboard-general" type="text" id="documento" required>
                <label>Documento</label>                
            </div>
            <div class="container-textbox-dashboard">
                <input class="textbox-dashboard-general" type="text" id="telefono" required>
                <label>teléfono</label>                
            </div>
            <div class="container-textbox-dashboard">
                <input class="textbox-dashboard-general" type="text" id="direccion" required>
                <label>Domicilio</label>                
            </div>
        </div>
        <div>
            <input class="btn-login" type="submit" value="Guardar cambios">
            <?php 
                if($_SESSION['tipo_usuario'] == '1')
                {
            ?>
                    <button type="button" id="btn-dashboard">Dashboard</button>
            <?php
                }
            ?>
        </div>
    </form>
</div>
<?php
    require 'partials/footer.html';
?>