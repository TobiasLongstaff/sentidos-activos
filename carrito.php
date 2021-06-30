<?php
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
    <div class="container-carrito-compra">
        <h1>Carrito <i class="fas fa-shopping-cart"></i></h1>
        <div class="container-table-carrito">
            <table class="table-carrito">
                <tbody id="tr-carrito">
                </tbody>
            </table>            
        </div>
        <div class="container-total">
            <label class="text-precio-total-carrito">Total: $7.949</label>
            <button class="btn-continuar-compra">Continuar compra</button>
        </div>
    </div>
</div>

<?php
    require 'partials/footer.html';
?>