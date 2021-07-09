<?php
    session_start();
    if(empty($_SESSION['usuario']) or $_SESSION['tipo_usuario'] != '1')
    {
        header("location: index.php");
    }

    require 'partials/conexion.php';
    require 'partials/header.html'; 
?>
    <div class="container-dashboard-pedidos">
        <div class="container-pedidos">
<?php
    if(isset($_GET['id']))
    {
        $id_pedido = $_GET['id'];

        $sql = "SELECT * FROM pedido WHERE id = '$id_pedido'";
        $resultado=mysqli_query($conexion,$sql);
        if($filas = mysqli_fetch_array($resultado))
        {
            $id = $filas['id'];
            $usuario = $filas['usuario'];
            $email = $filas['mail'];
            $direccion = $filas['direccion'];
            $documento = $filas['documento'];
            $telefono = $filas['telefono'];
            $nombre_apellido = $filas['nombre_apellido'];
            $total_precio = $filas['total_pedido'];
?>
        <div class="container-card-pedidos">
            <h2>Pedido N°<?=$id?></h2>
            <hr class="ht-popup">
            <div class="container-datos-de-usuario">
                <label>Usuario: <?=$usuario?></label>
                <label>Nombre y apellido: <?=$nombre_apellido?></label><br>
                <label>E-mail: <?=$email?></label>
                <label>Telefono: <?=$telefono?></label><br>
                <label>Documento: <?=$documento?></label>
                <label>Direccion: <?=$direccion?></label>
            </div>
            <div class="container-productos-pedidos">
                <table class="table-pedido">
                    <tr class="tr-head-pedido">
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
<?php
                    $sql_select = "SELECT * FROM productos_pedidos WHERE id_pedido = $id_pedido";
                    $resultado_select=mysqli_query($conexion,$sql_select);
                    while($filas_select = mysqli_fetch_array($resultado_select))
                    {
                        $src_imagen = $filas_select['src_imagen'];
                        $producto = $filas_select['producto'];
                        $precio = $filas_select['precio'];
                        $cantidad = $filas_select['cantidad'];
?>
                        <tr class="tr-fila-pedido">
                            <td><img class="img-producto-pedido" src="<?=$src_imagen?>" alt=""></td>
                            <td><?=$producto?></td>
                            <td><?=$cantidad?></td>
                            <td class="text-precio-pedido">$<?=$precio?></td>
                        </tr>
<?php
                    }  
?>
                </table>
            </div>
            <div class="container-footer-card-pedido">
                <h2>Precio total: $<?=$total_precio?></h2>
                <button class="btn-pedido-completado">Pedido Completado</button>
            </div>
        </div>
<?php
        }
    }
?>
        </div>
    </div>
    <script src="assets/plugins/jquery-3.5.1.min.js"></script>
    <script src="assets/plugins/sweetalert2.all.min.js"></script>
    <script src="assets/scripts/app.js"></script>
</body>
</html>  