<?php if (!defined('ABSPATH')) exit;


add_action( 'wp_ajax_nopriv_wiwu_actualizar_productos_por_subcategorias', 'wiwu_actualizar_productos_por_subcategorias' );
add_action( 'wp_ajax_wiwu_actualizar_productos_por_subcategorias', 'wiwu_actualizar_productos_por_subcategorias' );

function wiwu_actualizar_productos_por_subcategorias() {
    // Verificar si se recibe un ID de producto

    if (isset($_POST['product_id'])) {
        $product_id = sanitize_text_field($_POST['product_id']);

        // Recuperar el producto usando el ID
        $product = wc_get_product($product_id);

        if ($product_id) {
            // Generar el shortcode del producto
            $product_shortcode = '[products category="'.$product_id .'" columns="4" orderby="date" order="DESC" paginate="true" per_page="8"]';

            // Ejecutar el shortcode y devolver el contenido
            echo '<div class="elementor-widget-container">
							<div class="elementor-shortcode">';
            echo do_shortcode($product_shortcode);
            echo '</div>';
            echo '</div>';
        } else {
            echo 'Producto no encontrado.';
        }
    } else {
        echo 'ID de producto no proporcionado.';
    }

    // Terminar el proceso
    wp_die();
}
