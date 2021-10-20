window.onload = function recargar_pagina()
{
    $('#form-login').css('opacity', '1'); 
    $('#form-registro').css('opacity', '1'); 
    $('.container-catalogo-dashboard-agregar').css('opacity', '1'); 
    $('.btn-menu-editar').css('opacity', '1');
    $('.nav-catalogo').css('opacity', '1');
    $('.container-info-pedido').css('opacity', '1');
    $('#form-buscar-dashboard-pedido').css('opacity', '1');
}

$(document).ready(() =>
{
    obtener_catalogo();
    obtener_card_catalogo();
    obtener_cantidad_productos_carrito();
    obtener_productos_carrito();
    obtener_datos_usuario();
    obtener_buscar_productos();

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
        obtener_productos_carrito();
    });

    $('#btn-realizar-pedido').click(function()
    {
        Swal.fire(
        {
            title: '¿Realizar pedido?',
            text: "Una vez realizas este pedido se nos enviara un mail y nos contactaremos con usted para la entrega de los productos del pedido.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Continuar'
        }).then((result) => 
        {    
            if(result.isConfirmed) 
            {
                $(location).attr('href','partials/verificar-info.php');
            }
        }) 
    })

    $('#btn-dashboard-productos').click(function()
    {
        $(location).attr('href','dashboard-productos.php');
    });
    
    $('#btn-dashboard-pedidos').click(function()
    {
        $(location).attr('href','dashboard-pedidos.php');
    });

    $('#btn-dashboard-agregar').click(function()
    {
        $('.container-catalogo-dashboard-editar').css('opacity', '0'); 
        $('.btn-menu-agregar').css('opacity', '0'); 
        $('.container-catalogo-dashboard-editar').css('display', 'none'); 
        $('.container-catalogo-dashboard-agregar').css('display', 'flex'); 
        $('.container-catalogo-dashboard-agregar').css('opacity', '1'); 
        $('.btn-menu-editar').css('opacity', '1'); 
        $('.container-barra-busqueda-dashboard').css('opacity', '0'); 
    });

    $('#btn-dashboard-editar').click(function()
    {
        $('.container-catalogo-dashboard-agregar').css('opacity', '0'); 
        $('.btn-menu-editar').css('opacity', '0');     
        $('.container-catalogo-dashboard-agregar').css('display', 'none');   
        $('.container-catalogo-dashboard-editar').css('display', 'block');    
        $('.container-catalogo-dashboard-editar').css('opacity', '1'); 
        $('.btn-menu-agregar').css('opacity', '1'); 
        $('.container-barra-busqueda-dashboard').css('opacity', '1'); 
    });

    $('.btn-cuenta').click(function()
    {
        $(location).attr('href','login.php');
    });

    $('#btn-carro-de-compra').click(function()
    {
        $(location).attr('href','buscar.php');
        obtener_buscar_productos();
    })

    $('#btn-cerrar-popup').click(function()
    {
        $('#overlay').removeClass("active");
        $('#popup').removeClass("active");
    });

    $(document).on('click','.btn-card-editar', function(e)
    {
        $('#overlay').addClass("active");
        $('#popup').addClass("active"); 

        let element = $(this)[0].parentElement.parentElement.parentElement;
        let id_producto = $(element).attr('filaid');
        
        $.post('partials/obtener-producto-editar.php', {id_producto}, function (data)
        {
            let productos = JSON.parse(data);

            let img_src = productos.src_imagen;

            $('#id-producto-editar').val(id_producto);
            $('#producto-editar').val(productos.producto);
            $('#precio-editar').val(productos.precio);
            $('#stock-editar').val(productos.stock);
            $('#descripcion-editar').val(productos.descripcion);
            $('#img-producto-editar').attr("src", img_src);
            $('#src-img-editar').val(img_src);

            var producto_categoria = "op-"+productos.categoria;
            producto_categoria = producto_categoria.replace(' ', '-').toLowerCase();

            var selectlist_producto_categoria = document.getElementById(producto_categoria);
            selectlist_producto_categoria.selected = true;
        }); 

        e.preventDefault();
    });

    $(document).on('click','.btn-cantidad_mas', function()
    {
        let producto = $('.contador-producto').html();
        let precio = 0;
        producto = parseInt(producto);

        precio = $('#precio-producto').html();
        precio = parseInt(precio);

        producto = producto + 1;
        let precio_final = precio * producto;

        $('.precio-producto-label').val(precio_final);
        $('.contador-producto').text(producto);
    })

    $(document).on('click','.btn-cantidad_menos', function()
    {
        let producto = $('.contador-producto').html();
        producto = parseInt(producto);

        let precio_total = $('.precio-producto-label').val();
        precio_total = parseInt(precio_total);

        if(producto > 1)
        {
            producto = producto - 1;
            
            let precio = $('#precio-producto').html();
            precio = parseInt(precio);
            let precio_final = precio_total - precio;

            $('.precio-producto-label').val(precio_final);
            $('.contador-producto').text(producto);            
        }
        else
        {
            console.log(producto);
        }
    })

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
                $(location).attr('href','index.php');
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

    $('#form-registro').submit(function (e)
    {
        const postData =
        {
            usuario: $('#usuario').val(),
            mail: $('#mail').val(),
            nombre_apellido: $('#nombre-apellido').val(),
            password: $('#password').val(),
            password_con: $('#password-con').val(),
            documento: $('#documento').val(),
            domicilio: $('#domicilio').val(),
            telefono: $('#telefono').val()
        };
        $.post('partials/crear-cuenta.php', postData, function (data)
        {
            if(data == "1")
            {
                $(location).attr('href','index.php');
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

    $('#guardar-perfil').submit(function(e)
    {
        const postData =
        {
            nombre_apellido: $('#nombre-apellido').val(),
            documento: $('#documento').val(),
            telefono: $('#telefono').val(),
            direccion: $('#direccion').val()
        };
        $.post('partials/guardar-perfil.php', postData, function (data)
        {
            Swal.fire(
                '¡Perfil actualizado correctamente!',
                'Tu perfil ahora esta completo y puedes realizar compras en la pagina',
                'success'
            )
            obtener_datos_usuario();
        })
        e.preventDefault();
    })

    $('#form-agregar-catalogo').submit(function (e)
    {
        const postData =
        {
            src_imagen: $('#src-img').val(),
            producto: $('#producto').val(),
            precio: $('#precio').val(),
            descripcion: $('#descripcion').val(),
            categoria: $('#selectlist-categoria').val(),
            stock: $('#stock').val()
        };
        $.post('partials/agregar-producto.php', postData, function (data)
        {
            if(data == "1")
            {
                const form = document.getElementById("form-agregar-catalogo");
                form.reset();
                obtener_card_catalogo();
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

    $('#form-buscar').submit(function (e)
    {
        let nombre_producto = $('#buscar').val()

        $.post('partials/obtener-buscar-productos.php', {nombre_producto}, function (response)
        {
            let productos = JSON.parse(response);
            let plantilla = '';
            productos.forEach(producto => 
            {
                plantilla += 
                `
                <div filaId="${producto.id}" class="container-fila-buscar-producto">
                    <img class="img-buscar-producto" src="${producto.src_imagen}">
                    <div>
                        <h3 class="text-nombre">${producto.nombre}</h3>
                        <label class="text-descripcion-buscar">${producto.descripcion}</label>  
                        <h2>$${producto.precio}</h2>                  
                    </div>       
                </div>
                ` 
            });
            $('#container-productos-buscar').html(plantilla);
        });
        e.preventDefault();
    });

    $('#form-buscar-dashboard').submit(function (e)
    {
        let nombre_producto = $('#buscar').val()

        $.post('partials/obtener-buscar-productos.php', {nombre_producto}, function (response)
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
                        <h3>${producto.nombre}</h3>
                        <label class="text-descripcion">${producto.descripcion}</label>  
                        <label>Stock: ${producto.stock}</label> 
                        <label>${producto.categoria}</label> 
                        <h3>$${producto.precio}</h3>                
                    </div>
                    <img class="img-card-producto" src="${producto.src_imagen}">
                </div>
                ` 
            });
            $('#card-editar').html(plantilla);
        });
        e.preventDefault();
    });

    $('#form-editar-producto').submit(function (e)
    {
        const postData =
        {
            id_producto: $('#id-producto-editar').val(),
            producto: $('#producto-editar').val(),
            precio: $('#precio-editar').val(),
            descripcion: $('#descripcion-editar').val(),
            categoria: $('#selectlist-categoria-editar').val(),
            stock: $('#stock-editar').val(),
            img_src: $('#src-img-editar').val()
        };

        $.post('partials/editar-producto.php', postData, function (response)
        {
            if(response == '1')
            {
                Swal.fire(
                {
                    icon: 'success',
                    title: 'Producto Guardado!',
                    showConfirmButton: false,
                    timer: 1500
                })
                obtener_card_catalogo();                
            }
        });
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

    $(document).on('click','.btn-eliminar-producto-carro',function(e)
    {
        let element = $(this)[0].parentElement.parentElement;
        let id_producto = $(element).attr('filaid');
        $.post('partials/eliminar-producto-carrito.php', {id_producto}, function (data)
        {
            if(data == '1')
            {
                Swal.fire(
                {
                    icon: 'success',
                    title: 'Producto eliminardo!',
                    showConfirmButton: false,
                    timer: 1500
                })
                document.location.reload();

            }
        })
        e.preventDefault();
    })

    $('#btn-agregar-carrito').click(function(e)
    {
        let id_producto = document.getElementById('id-producto').value;
        let cantidad_producto = $('.contador-producto').html();
        let precio = $('#precio-producto').html();
        $.post('partials/agregar-producto-carrito.php', {id_producto, cantidad_producto, precio}, function (data)
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
            else if(data == '3')
            {
                $(location).attr('href','login.php');
            }
            else
            {
                Swal.fire(
                {
                    icon: 'warning',
                    title: 'Este producto ya se encuentra agregado',
                    showConfirmButton: false,
                    timer: 1500
                })    
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

    const imageUploader_edit = document.getElementById('btn-subir-imagen-producto-editar');
    const imagePreview_edit = document.getElementById('img-producto-editar');
    const imageUploadbar_edit = document.getElementById('img-upload-bar-editar');

    imageUploader_edit.addEventListener('change', async (e) => {
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
                    imageUploadbar_edit.setAttribute('value', progress);
                }
            }
        );
        console.log(res);
        imagePreview_edit.src = res.data.secure_url;
        document.getElementById('src-img-editar').value = res.data.secure_url;
    });

    function obtener_buscar_productos()
    {
        $.post('partials/obtener-buscar-productos.php', function (response)
        {
            let productos = JSON.parse(response);
            let plantilla = '';
            productos.forEach(producto => 
            {
                plantilla += 
                `
                <div filaId="${producto.id}" class="container-fila-buscar-producto">
                    <img class="img-buscar-producto" src="${producto.src_imagen}">
                    <div>
                        <h3 class="text-nombre">${producto.nombre}</h3>
                        <label class="text-descripcion-buscar">${producto.descripcion}</label>  
                        <div class="container-btn-buscar">
                            <h2>$${producto.precio}</h2>  
                            <a href="producto.php?id=${producto.id}">
                                <button class="btn-ver-producto">Ver</button>
                            </a>
                        </div>   
                    </div>       
                </div>
                ` 
            });
            $('#container-productos-buscar').html(plantilla);
        })
    }

    function obtener_datos_usuario()
    {
        $.ajax(
            {
                url: 'partials/obtener-datos-usuario.php',
                type: 'GET',
                success: function (response)
                {
                    const usuario = JSON.parse(response);
                    $('#nombre-apellido').val(usuario.nombre_apellido);
                    $('#documento').val(usuario.documento);
                    $('#telefono').val(usuario.telefono);
                    $('#direccion').val(usuario.direccion);
                }
            }
        )
    }

    function obtener_cantidad_productos_carrito()
    {
        $.ajax(
            {
                url: 'partials/obtener-cantidad-productos-carrito.php',
                type: 'GET',
                success: function (response)
                {
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
                                <h3>${producto.producto}</h3>
                                <label class="text-descripcion">${producto.descripcion}</label>  
                                <label>Stock: ${producto.stock}</label> 
                                <label>${producto.categoria}</label> 
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
                    let plantilla = '';
                    if(response == '[]')
                    {
                        plantilla += 
                        `<div class="container-carrito-productos">
                            <h3>Tu carrito está vacío</h3><br>
                            <label>¿No sabés qué comprar? ¡Muchos productos te esperan!</label>
                        </div>`
                        $('#tr-carrito').html(plantilla);
                    }
                    else
                    {
                        let productos = JSON.parse(response);
                        productos.forEach(producto => 
                        {
                            plantilla += 
                            `
                            <tr class="tr-carrito" filaId="${producto.id}">
                                <td class="td-controles"><button class="btn-card-general btn-eliminar-producto-carro"><i class="fas fa-trash"></i></button></td>
                                <td class="td-producto"><label class="text-producto-carrito">${producto.producto}</label></td>
                                <td class="td-cantidad">
                                    <label class="contador-producto">${producto.cantidad}</label>
                                </td>
                                <td class="td-precio"><span class="text-precio-carrito">$${producto.precio}</span></td>                        
                            </tr>
                            ` 
                        });
                        $('#tr-carrito').html(plantilla);
                    }
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