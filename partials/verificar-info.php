<?php

    session_start();

    if($_SESSION['documento_usuario'] == '')
    {
        header("location: ../cuenta.php");
    }
    else
    {
        header("location: ../realizar-pedido.php");
    }
?>