<?php
/**
 * Plugin Name: Wiwu Banner Categorias
 * Description: Plugin para mostrar un banner de la categorias y mostrar slides con subcategorias y que esta al cambiar de flecha muestre los productos de la subcategoria seleccionada
 * Version: 1.0
 * Author: Tu Nombre
 */

if (!defined('ABSPATH')) exit;

// Registrar y cargar scripts
function custom_elementor_addon_scripts() {
    wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), null, true);
   // wp_enqueue_script('custom-addon-js', plugin_dir_url(__FILE__) . 'custom-addon.js', array('jquery', 'owl-carousel-js'), null, true);
   // wp_enqueue_style('custom-addon-style', plugin_dir_url(__FILE__) . 'custom-addon.css');
    wp_enqueue_style('widget-carusel-categorias', plugin_dir_url(__FILE__) . '/assets/css/widget-carusel-categorias.css');
    wp_enqueue_script('wiwu-banner-js', plugin_dir_url(__FILE__) . 'assets/js/js.js', array('jquery', 'owl-carousel-js'), null, true);
    wp_localize_script('wiwu-banner-js', 'admin_url', array(
      'ajax_url'   =>  admin_url('admin-ajax.php'),
      'nonce'  => wp_create_nonce( 'my-ajax-nonce' )
  ));
}
add_action('wp_enqueue_scripts', 'custom_elementor_addon_scripts');

// Registrar el widget en Elementor
function register_custom_elementor_widget($widgets_manager) {
    require_once(__DIR__ . '/widget/carusel-categorias.php');
    $widgets_manager->register(new \Elementor_Custom_Carousel());
  /*   require_once(__DIR__ . '/widget/carusel-subcategorias.php');
    $widgets_manager->register(new \Elementor_Custom_Carousel_Subcategoria()); */
}
add_action('elementor/widgets/register', 'register_custom_elementor_widget');

require_once plugin_dir_path(__FILE__) .  'functions.php';