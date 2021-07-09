<?php

    require 'conexion.php';

    if(isset($_POST['id_producto']))
    {
        $id_producto = $_POST['id_producto'];
        
        $sql = "SELECT * FROM productos_pedidos WHERE id_producto = $id_producto";
        $json = array();
        $resultado=mysqli_query($conexion,$sql);
        while($filas = mysqli_fetch_array($resultado))
        {
            $json[] = array(
                'id' => $filas['id'],
                'src_img' => $filas['src_imagen'],
                'precio' => $filas['precio'],
                'descripcion' => $filas['descripcion'],
                'producto' => $filas['producto']
            );
        }        
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion); 

?>