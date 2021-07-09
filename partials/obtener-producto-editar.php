<?php

    require 'conexion.php';

    if(isset($_POST['id_producto']))
    {
        $id_producto = $_POST['id_producto'];

        $sql = "SELECT * FROM catalogo WHERE id = '$id_producto'";
        $json = array();
        $resultado=mysqli_query($conexion,$sql);
        if($filas = mysqli_fetch_array($resultado))
        {
            $json[] = array(
                'id' => $filas['id'],
                'producto' => $filas['producto'],
                'descripcion' => $filas['descripcion'],
                'precio' => $filas['precio'],
                'src_imagen' => $filas['src_imagen'],
                'stock' => $filas['stock'],
                'categoria' => $filas['categoria']
            );
        }
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;        
    }

    mysqli_close($conexion);       

?>