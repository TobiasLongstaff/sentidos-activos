<nav class="nav-catalogo">
    <div class="container-btn-nav">
        <button class="btn-nav-general" id="btn-catalogo">Catalogo</button>
        <button class="btn-nav-general" id="btn-nosotros">Nosotros</button>
    </div>
    <img src="https://res.cloudinary.com/dme0nznkz/image/upload/v1625834012/sf7anc90moeszrj0qcr6.jpg" alt="" class="img-nav-logo">
    <div class="container-reder">
        <button type="button" class="btn-carro-de-compra" id="btn-carro-de-compra"><i class="btn-redes fas fa-search"></i></button>            
        <button id="btn-carrito-compra" type="button" class="btn-carro-de-compra">
            <i class="btn-redes fas fa-shopping-cart"></i>
            <div id="cantidad-producto-carrito"></div>
        </button>
        <button type="button" class="btn-cuenta"><i class="btn-redes fas fa-user-circle"></i></button>
        <?php
            if(!empty($_SESSION['usuario']))
            {
        ?>
                <a href="cerrar-sesion.php">
                    <button type="button" id="btn-cerrar-sesion" class="btn-cerrar-sesion"><i class="btn-redes fas fa-sign-out-alt"></i></button>
                </a>
        <?php
            }
        ?>
    </div>
</nav>