<?php
    session_start();
    require 'partials/header.html';
    require 'partials/navegacion.php';
    
    if(empty($_SESSION['usuario']))
    {
        header("location: login.php");
    }

    $precio_total = $_SESSION['precio_total_usuario'];

    // include_once "assets/plugins/mercado-pago/vendor/autoload.php";

    // MercadoPago\SDK::setAccessToken('TEST-2816095668975026-062911-2670d33bb8f421ec81c0b6509059e7a4-187226896');

    // $preference = new MercadoPago\Preference();

    // $item = new MercadoPago\Item();
    // $item->title      = "Mis Productos";
    // $item->currency_id = "ARS";
    // $item->quantity   = 1;
    // $item->unit_price = floatval($precio_total);

    // $preference->items = array($item);
    // $preference->save();

?>
<div>
    <div class="container-carrito-compra">
        <h1>Carrito <i class="fas fa-shopping-cart"></i></h1>
        <div class="container-table-carrito">
            <div class="tbl-header">
                <table class="table-carrito">
                    <thead>
                        <td class="text-head-general td-controles">.</td>
                        <td class="text-head-general td-producto">Producto</td>
                        <td class="text-head-general td-cantidad">Cantidad</td>
                        <td class="text-head-general td-precio">Precio</td>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table class="table-carrito">
                    <tbody id="tr-carrito">
                    </tbody>
                </table>                
            </div>
        </div>
        <div class="container-total">
            <label class="text-precio-total-carrito">Total: $<?=$precio_total?></label>
            <button type="button" id="btn-realizar-pedido" class="btn-agregar-al-carro">Realizar pedido</button>
            <!-- <form action="/procesar-pago" method="POST">
                <input type="hidden" name="idprodct" value="2">
                <script src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js" 
                data-preference-id="<?php echo $preference->id; ?>">
                </script>
            </form> -->
        </div>
    </div>    
</div>

<?php
    require 'partials/footer.html';
?>