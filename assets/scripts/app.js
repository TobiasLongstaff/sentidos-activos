window.onload = function recargar_pagina()
{
    $('#form-login').css('opacity', '1'); 
    $('.container-catalogo-dashboard-agregar').css('opacity', '1'); 
    $('.btn-menu-editar').css('opacity', '1');
    $('.nav-catalogo').css('opacity', '1');
}

$(document).ready(() =>
{
    obtener_catalogo();
    obtener_card_catalogo()
    obtener_cantidad_productos_carrito()

    $('#btn-nosotros').click(function()
    {
        $(location).attr('href','nosotros.php');
    });

    $('#btn-catalogo').click(function()
    {
        $(location).attr('href','index.php');
    });

    $('#btn-carrito-compra').click(function()
    {
        $(location).attr('href','carrito.php');
    });

    $('#btn-dashboard-agregar').click(function()
    {
        $('.container-catalogo-dashboard-editar').css('opacity', '0'); 
        $('.btn-menu-agregar').css('opacity', '0'); 
        $('.container-catalogo-dashboard-editar').css('display', 'none'); 
        $('.container-catalogo-dashboard-agregar').css('display', 'flex'); 
        $('.container-catalogo-dashboard-agregar').css('opacity', '1'); 
        $('.btn-menu-editar').css('opacity', '1'); 
    });

    $('#btn-dashboard-editar').click(function()
    {
        $('.container-catalogo-dashboard-agregar').css('opacity', '0'); 
        $('.btn-menu-editar').css('opacity', '0');     
        $('.container-catalogo-dashboard-agregar').css('display', 'none');   
        $('.container-catalogo-dashboard-editar').css('display', 'block');    
        $('.container-catalogo-dashboard-editar').css('opacity', '1'); 
        $('.btn-menu-agregar').css('opacity', '1'); 
    });

    $('#form-login').submit(function (e)
    {
        const postData =
        {
            usuario: $('#usuario').val(),
            password: $('#password').val()
        };
        $.post('partials/logeo.php', postData, function (data)
        {
            if(data == "1")
            {
                $(location).attr('href','dashboard.php');
            }
            else
            {
                let plantilla = '';
                plantilla +=
                `
                    <span class="text-error"><i class="fas fa-exclamation-triangle"></i> ${data}</span>
                `
                $('#alerta-login').html(plantilla);  
            }
        }); 
        e.preventDefault();            
    });

    $('#form-agregar-catalogo').submit(function (e)
    {
        const postData =
        {
            src_imagen: $('#src-img').val(),
            producto: $('#producto').val(),
            precio: $('#precio').val(),
            descripcion: $('#descripcion').val()
        };
        $.post('partials/agregar-producto.php', postData, function (data)
        {
            if(data == "1")
            {
                const form = document.getElementById("form-agregar-catalogo");
                form.reset();
                Swal.fire(
                    '¡Producto agregado correctamente!',
                    'El producto ya se encuentra publicado correctamente',
                    'success'
                )
            }
            else
            {
                let plantilla = '';
                plantilla +=
                `
                    <span class="text-error"><i class="fas fa-exclamation-triangle"></i> ${data}</span>
                `
                $('#alerta-agregar-producto').html(plantilla);  
            }
        }); 
        e.preventDefault();         
    });

    $(document).on('click','.btn-card-editar', function(e)
    {
        alert('editar');

        e.preventDefault();
    });

    $(document).on('click','.btn-card-eliminar', function(e)
    {
        Swal.fire(
        {
            title: '¿Seguro que quieres eliminar el producto?',
            text: "Una vez se elimine el producto se perdera la informacion del mismo",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Eliminar'
        }).then((result) => 
        {    
            if(result.isConfirmed) 
            {
                let element = $(this)[0].parentElement.parentElement.parentElement;
                let id_producto = $(element).attr('filaid');
                console.log(id_producto);
                $.post('partials/eliminar-producto.php', {id_producto}, function(data)
                {
                    if(data == '1')
                    {
                        obtener_card_catalogo();
                    }
                    else
                    {
                        Swal.fire(
                            'Error',
                            'Volver a intentar mas tarde',
                            'error'
                        )
                    }
                });                
            }
        })
        e.preventDefault();
    });

    $('#btn-agregar-carrito').click(function(e)
    {
        let id_producto = document.getElementById('id-producto').value
        $.post('partials/agregar-producto-carrito.php', {id_producto}, function (data)
        {
            if(data == '1')
            {
                Swal.fire(
                {
                    icon: 'success',
                    title: 'Producto agregado al carrito',
                    showConfirmButton: false,
                    timer: 1500
                })    
                obtener_cantidad_productos_carrito();           
            }
        })
        e.preventDefault();
    })

    $("#producto").keyup(function()
    {
        var text_producto = $(this).val();
        $('#text-producto').html(text_producto);
    });

    $("#precio").keyup(function()
    {
        var text_precio = $(this).val();
        $('#text-precio').html('$'+text_precio);
    });

    $("#descripcion").keyup(function()
    {
        var text_descripcion = $(this).val();
        $('#text-descripcion').html(text_descripcion);
    });

    $('input[type=file]').change(function(){
        var filename = $(this).val().split('\\').pop();
        var idname = $(this).attr('id');
        $('span.'+idname).next().find('span').html(filename);
    });

    const imagePreview = document.getElementById('img-producto');
    const imageUploader = document.getElementById('btn-subir-imagen-producto');
    const imageUploadbar = document.getElementById('img-upload-bar');

    const CLOUDINARY_URL = `https://api.cloudinary.com/v1_1/dme0nznkz/image/upload`
    const CLOUDINARY_UPLOAD_PRESET = 'svzl7mgz';

    imageUploader.addEventListener('change', async (e) => {
        // console.log(e);
        const file = e.target.files[0];
        const formData = new FormData();
        formData.append('file', file);
        formData.append('upload_preset', CLOUDINARY_UPLOAD_PRESET);

        // Send to cloudianry
        const res = await axios.post(
            CLOUDINARY_URL,
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress (e) {
                    let progress = Math.round((e.loaded * 100.0) / e.total);
                    console.log(progress);
                    imageUploadbar.setAttribute('value', progress);
                }
            }
        );
        console.log(res);
        imagePreview.src = res.data.secure_url;
        document.getElementById('src-img').value = res.data.secure_url;
    });

    function obtener_cantidad_productos_carrito()
    {
        $.ajax(
            {
                url: 'partials/obtener-cantidad-productos-carrito.php',
                type: 'GET',
                success: function (response)
                {
                    console.log(response)
                    let productos = JSON.parse(response);
                    let plantilla = '';
                    productos.forEach(producto => 
                    {
                        plantilla += 
                        `
                        <span class="btn-redes">(${producto.cantidad})</span>
                        ` 
                    });
                    $('#cantidad-producto-carrito').html(plantilla);
                }
            }
        )
    }

    function obtener_catalogo()
    {
        $.ajax(
            {
                url: 'partials/obtener-catalogo.php',
                type: 'GET',
                success: function (response)
                {
                    let productos = JSON.parse(response);
                    let plantilla = '';
                    productos.forEach(producto => 
                    {
                        plantilla += 
                        `
                        <div filaId="${producto.id}" class="container-producto-home">
                            <img class="img-producto" id="img-producto" src="${producto.src_img}" alt="">
                            <div class="container-datos">
                                <p class="text-nombre" id="text-producto">${producto.producto}</p>
                                <p class="text-descripcion" id="text-descripcion">${producto.descripcion}</p>
                                <div class="container-precio-btn">
                                    <div class="container-precio">
                                        <label class="text-precio" id="text-precio">$${producto.precio}</label> 
                                    </div>
                                    <div class="container-btn-producto">
                                        <a href="producto.php?id=${producto.id}">
                                            <button class="btn-ver-producto">Ver</button>
                                        </a>
                                        
                                    </div>               
                                </div> 
                            </div>
                        </div>
                        ` 
                    });
                    $('#container-catalogo').html(plantilla);
                }
            }
        )
    }

    function obtener_card_catalogo()
    {
        $.ajax(
            {
                url: 'partials/obtener-catalogo.php',
                type: 'GET',
                success: function (response)
                {
                    let productos = JSON.parse(response);
                    let plantilla = '';
                    productos.forEach(producto => 
                    {
                        plantilla += 
                        `
                        <div filaId="${producto.id}" class="container-card-producto">
                            <div class="container-card-info">
                                <div>
                                    <button class="btn-card-general btn-card-editar"><i class="fas fa-pen"></i></button>
                                    <button class="btn-card-general btn-card-eliminar"><i class="fas fa-trash"></i></button>                                
                                </div>
                                <h3 class="text-nombre">${producto.producto}</h3>
                                <label class="text-descripcion">${producto.descripcion}</label>  
                                <h3>$${producto.precio}</h3>                      
                            </div>
                            <img class="img-card-producto" src="${producto.src_img}">
                        </div>
                        ` 
                    });
                    $('#card-editar').html(plantilla);
                }
            }
        )
    }

    function obtener_productos_carrito()
    {
        $.ajax(
            {
                url: 'partials/obtener_productos_carrito.php',
                type: 'GET',
                success: function (response)
                {
                    let productos = JSON.parse(response);
                    let plantilla = '';
                    productos.forEach(producto => 
                    {
                        plantilla += 
                        `
                        <div class="tr-carrito">
                            <td><button class="btn-card-general btn-eliminar-producto-carro"><i class="fas fa-trash"></i></button> </td>
                            <td><label class="text-producto-carrito">Smartwatch Amazfit Basic Bip U 1.43 Caja De Policarbonato</label></td>
                            <td>
                                <div class="container-cantidad">
                                    <button class="btn-cantidad">-</button>
                                        <label>1</label>
                                    <button class="btn-cantidad">+</button>
                                </div>
                            </td>
                            <td><span class="text-precio-carrito">$7.949</span></td>                        
                        </div>
                        ` 
                    });
                    $('#tr-carrito').html(plantilla);
                }
            }
        )
    }
    
});

// SLIDE DE IMAGENES

$(function() 
{
    var SliderModule = (function() 
    {
        var pb = {};
        pb.el = $('#slider');
        pb.items = {
        panels: pb.el.find('.slider-wrapper > li'),
    }
  
    var SliderInterval,
    currentSlider = 0,
    nextSlider = 1,
    lengthSlider = pb.items.panels.length;
  
    pb.init = function(settings) 
    {
        this.settings = settings || {duration: 8000};
        var items = this.items, lengthPanels = items.panels.length, output = '';
  
        for(var i = 0; i < lengthPanels; i++) 
        {
            if(i == 0) 
            {
                output += '<li class="active"></li>';
            } else 
            {
                output += '<li></li>';
            }
        }
  
        $('#control-buttons').html(output);
  
        activateSlider();
        $('#control-buttons').on('click', 'li', function(e) 
        {
            var $this = $(this);
            if(!(currentSlider === $this.index())) 
            {
                changePanel($this.index());
            }
        });
    }
  
    var activateSlider = function() 
    {
        SliderInterval = setInterval(pb.startSlider, pb.settings.duration);
    }
  
    pb.startSlider = function() 
    {
        var items = pb.items,
        controls = $('#control-buttons li');

        if(nextSlider >= lengthSlider) 
        {
            nextSlider = 0;
            currentSlider = lengthSlider-1;
        }
  
        controls.removeClass('active').eq(nextSlider).addClass('active');
        items.panels.eq(currentSlider).fadeOut('slow');
        items.panels.eq(nextSlider).fadeIn('slow');
  
        currentSlider = nextSlider;
        nextSlider += 1;
    }
  
    var changePanel = function(id) 
    {
        clearInterval(SliderInterval);
        var items = pb.items, controls = $('#control-buttons li');

        if(id >= lengthSlider) 
        {
            id = 0;
        } else if(id < 0) 
        {
            id = lengthSlider-1;
        }
  
        controls.removeClass('active').eq(id).addClass('active');
        items.panels.eq(currentSlider).fadeOut('slow');
        items.panels.eq(id).fadeIn('slow');
  
        currentSlider = id;
        nextSlider = id+1;
        activateSlider();
    }
  
    return pb;
}());
  
SliderModule.init({duration: 10000});
  
});