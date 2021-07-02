<?php

    require 'partials/conexion.php';

    if(isset($_GET['id']))
    {
        $id_catalogo = $_GET['id'];
        $sql = "SELECT * FROM catalogo WHERE id = '$id_catalogo'";
        $resultado=mysqli_query($conexion,$sql);
        while($filas = mysqli_fetch_array($resultado))
        {
            $nombre_producto = $filas['producto'];
            $descripcion = $filas['descripcion'];
            $precio = $filas['precio'];
            $src_img = $filas['src_imagen'];
        }
    }

    require 'partials/header.html'; 
?>

<div>
    <nav class="nav-catalogo">
        <div class="container-btn-nav">
            <button class="btn-nav-general" id="btn-catalogo">Catalogo</button>
            <button class="btn-nav-general" id="btn-nosotros">Nosotros</button>
        </div>
        <img src="assets/img/logo.jpg" alt="" class="img-nav-logo">
        <div class="container-reder">
            <button type="button" class="btn-carro-de-compra"><i class="btn-redes fas fa-search"></i></button>
            <button id="btn-carrito-compra" type="button" class="btn-carro-de-compra">
                <i class="btn-redes fas fa-shopping-cart"></i>
                <div id="cantidad-producto-carrito"></div>
            </button>
        </div>
    </nav>
    <div class="container-producto-general">
        <img class="container-img-producto" src="<?=$src_img?>" alt="">
        <div>
            <input type="hidden" id="id-producto" value="<?=$id_catalogo?>">
            <h1><?=$nombre_producto?></h1>
            <label class="text-descripcion-producto"><?=$descripcion?></label><br> 
            <div class="container-cantidad-producto">
                <label>Cantidad</label>
                <div class="container-cantidad">
                    <button class="btn-cantidad btn-cantidad_menos">-</button>
                        <label class="contador-producto">1</label>
                    <button class="btn-cantidad btn-cantidad_mas">+</button>
                </div>                  
            </div>
            <hr>
            <div class="container-btn-carro">
                <div>
                    <label class="text-precio-producto">Precio: $</label>
                    <input type="hidden" class="precio-producto" value="<?=$precio?>">
                    <label id="precio-producto" class="text-precio-producto precio-producto-label"><?=$precio?></label>
                </div>
                <button type="button" id="btn-agregar-carrito" class="btn-agregar-al-carro"><i class="fas fa-shopping-cart"></i> Agregar al carro</button>
            </div>
        </div>
    </div>
</div>
<?php
    require 'partials/footer.html';
?>
