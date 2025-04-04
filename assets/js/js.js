jQuery(document).ready(function($) {
    var owl = $('.wiwu-banner-carousel').owlCarousel({
    loop: false,
    margin: 0,
    nav: true,
    items: 1,
    navText: [
        '<span aria-label="Previous">‹</span>', // Flecha anterior
        '<span aria-label="Next">›</span>'      // Flecha siguiente
    ],
    navContainer: '.wiwu-banner-subcategoria-flechas .owl-nav', // Especifica dónde irán los botones
    onChanged: function(event) {

     
      /*   var currentSlideID = $('#wiwu-banner-slider-id-' + event.item.index).attr('id');
        // Verificar si se encontró el ID del slide
        if (currentSlideID) {
            alert('El ID del slide actual es: ' + currentSlideID);
        } else {
            console.error("No se encontró el ID del slide.");
        } */

        $('.wiwu-banner-subcategoria-anterior-box').html('');

        // Verificar si hay al menos 2 elementos en el carrusel
        if (event.item.count >= 2) {
            // Obtener el índice del slide anterior
            var prevItem = event.item.index - 1;

            // Si prevItem es negativo (estamos en el primer ítem), tomamos el último ítem
            if (prevItem < 0) {
                prevItem = event.item.count - 1;  // Tomamos el último ítem del carrusel
            }

            var idSubCategoria = $('.wiwu-banner-carousel .item').eq(event.item.index).find('.wiwu-banner-slider-id').attr('id');
            if(idSubCategoria){
                var productID =  idSubCategoria.split('-').pop();
                $.ajax({
                url: admin_url.ajax_url, // Este es el URL de administración en WordPress
                type: 'POST',
                data: {
                    action: 'wiwu_mostrar_productos_subcategoria',  // El nombre de la acción AJAX
                    product_id: productID               // Pasamos el ID del producto
                },
                success: function(response) {
                    // Aquí puedes actualizar el contenido con la respuesta, por ejemplo:
                    //$('.wiwu-product-container').html(response);
                    $('.wiwu-woo-products').html(response);
                    
                },
                error: function() {
                    console.log("Error en la solicitud AJAX");
                }
            });

            /*
             data: {
                    action: 'wiwu_actualizar_productos_por_subcategorias',  // El nombre de la acción AJAX
                    product_id: productID               // Pasamos el ID del producto
                },
                success: function(response) {
                    // Aquí puedes actualizar el contenido con la respuesta, por ejemplo:
                    $('#wiwu-product-container').html(response);
                    
                },
            */
            }

            // Clonamos los elementos deseados del slide anterior, asegurándonos de que existen
            var imageClone = $('.wiwu-banner-carousel .owl-item').eq(prevItem).find('.wiwu-banner-carousel-box-image-principal');
            var titleClone = $('.wiwu-banner-carousel .owl-item').eq(prevItem).find('.wiwu-banner-carousel-box-informacion-titulo');
            var descriptionClone = $('.wiwu-banner-carousel .owl-item').eq(prevItem).find('.wiwu-banner-carousel-box-informacion-texto');

            // Verificar que los elementos no sean vacíos antes de intentar acceder a .outerHTML
            if (imageClone.length > 0 && titleClone.length > 0 && descriptionClone.length > 0) {
                // Crear el HTML a insertar
                var htmlClone = '';
                htmlClone += '<div class="wiwu-banner-subcategoria-anterior-box-imagen">';
                htmlClone += imageClone[0].outerHTML;  // Convertimos el objeto jQuery en HTML con .outerHTML
                htmlClone += '</div>';
                htmlClone += '<div class="wiwu-banner-subcategoria-anterior-box-info">'; // Puedes modificar esto si es necesario
                htmlClone += '<div class="wiwu-banner-subcategoria-anterior-box-info-1">';
                htmlClone += '<h3 class="wiwu-banner-subcategoria-anterior-box-info-titulo">' + titleClone.html() + '</h3>';
                htmlClone += '<p class="wiwu-banner-subcategoria-anterior-box-info-texto">' + descriptionClone.html() + '</p>';
                htmlClone += '</div>';
                htmlClone += '</div>';

                $('.wiwu-banner-subcategoria-anterior-box').append(htmlClone);
            } else {
                console.error("No se encontraron los elementos necesarios para clonar.");
            }
        }
    }
});
});