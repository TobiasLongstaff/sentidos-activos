<?php
    session_start();
    if(!isset($_SESSION['usuario']))
    {
        header("location: index.php");
    }

    require 'partials/conexion.php';
    require 'partials/header.html'; 
?>
    <div class="container-dashboard">
        <nav class="nav-dashboard">
            <button class="btn-menu-general" id="btn-dashboard-agregar">Agregar</button>
            <button class="btn-menu-general" id="btn-dashboard-editar">Editar</button>
        </nav>
        <div class="container-contenido-dashboard">
            <div class="container-catalogo-dashboard-agregar">
                <div>
                    <form method="POST" id="form-agregar-catalogo">
                        <h1>Agregar Producto</h1>
                        <div class="container-textbox-dashboard">
                            <input class="textbox-dashboard-general" id="producto" type="text" require="">
                            <label>Producto</label>
                        </div>
                        <div class="container-textbox-dashboard">
                            <input class="textbox-dashboard-general" type="text" id="precio" require="">
                            <label>Precio</label>                
                        </div>
                        <div class="container-textbox-dashboard">
                            <textarea class="textarea-dashboard-general" id="descripcion" require=""></textarea>
                            <label>Descripcion</label>           
                        </div>            
                        <span class="btn-subir-imagen-producto">
                            <input type="file" name="btn-subir-imagen-producto" id="btn-subir-imagen-producto">
                        </span>
                        <input type="hidden" id="src-img">
                        <label for="btn-subir-imagen-producto">
                            <i class="fas fa-paperclip"></i>
                            <span>Agregar Imágen</span> 
                        </label>
                        <progress class="barra-progreso" id="img-upload-bar" value="0" max="100"></progress>
                        <div id="alerta-agregar-producto"></div>
                        <input type="submit" class="btn-login" value="Publicar">
                    </form>
                </div>
                <div class="container-producto">
                    <img class="img-producto" id="img-producto" src="assets/img/1.jpeg" alt="">
                    <div class="container-datos">
                        <p class="text-nombre" id="text-producto">Libros</p>
                        <p class="text-descripcion" id="text-descripcion">Muchos libros descripcion </p>
                        <div class="container-precio-btn">
                            <div class="container-precio">
                                <label class="text-precio" id="text-precio">$200</label> 
                            </div>
                            <div class="container-btn-producto">
                                <button class="btn-ver-producto">Ver</button>
                            </div>                    
                        </div> 
                    </div>
                </div>
            </div> 
            <div class="container-catalogo-dashboard-editar" id="card-editar">
            </div>                       
        </div>
    </div>
    <script src="assets/plugins/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="assets/plugins/sweetalert2.all.min.js"></script>
    <script src="assets/scripts/app.js"></script>
</body>
</html>   