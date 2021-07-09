<?php
    session_start();
    require 'partials/conexion.php';
    require 'partials/header.html';
    require 'partials/navegacion.php';
?>
<div>
    <form method="POST" id="form-buscar" class="container-barra-busqueda">
        <input type="text" class="textbox-buscar" id="buscar" placeholder="Buscar...">
        <button type="submit" class="btn-buscar"><i class="fas fa-search"></i></button>
    </form>
    <div class="container-productos-buscar" id="container-productos-buscar">
    </div>
</div>
<?php
    require 'partials/footer.html';
?>