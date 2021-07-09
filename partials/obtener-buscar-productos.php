<?php

    require 'conexion.php';

    if(!empty($_POST['nombre_producto']))
    {
        $nombre_producto = $_POST['nombre_producto'];

        $sql = "SELECT * FROM catalogo WHERE producto LIKE '%".$nombre_producto."%'";
        $json = array();
        $resultado=mysqli_query($conexion,$sql);
        while($filas = mysqli_fetch_array($resultado))
        {
            $json[] = array(
                'nombre' => $filas['producto'],
                'descripcion' => $filas['descripcion'],
                'precio' => $filas['precio'],
                'src_imagen' => $filas['src_imagen'],
                'id' => $filas['id'],
                'stock' => $filas['stock'],
                'categoria' => $filas['categoria']
            );
        }
    }
    else
    {
        $sql = "SELECT * FROM catalogo";
        $json = array();
        $resultado=mysqli_query($conexion,$sql);
        while($filas = mysqli_fetch_array($resultado))
        {
            $json[] = array(
                'nombre' => $filas['producto'],
                'descripcion' => $filas['descripcion'],
                'precio' => $filas['precio'],
                'src_imagen' => $filas['src_imagen'],
                'id' => $filas['id'],
                'stock' => $filas['stock'],
                'categoria' => $filas['categoria']
            );
        }
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion);    

?>