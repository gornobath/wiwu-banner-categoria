<?php if (!defined('ABSPATH')) exit;

class Elementor_Custom_Carousel_Subcategoria extends \Elementor\Widget_Base {

    public function get_name() {
        return 'carusel_subcategorias';
    }

    public function get_title() {
        return __('Wiwu Carousel Subategoria', 'wiwu-carousel-subcategoria');
    }

    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Contenido', 'wiwu-carousel-subcategoria'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'main_title',
            [
                'label' => __('Categoria Principal', 'wiwu-carousel-subcategoria'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Mi Carrusel', 'wiwu-carousel-subcategoria'),
            ],
            'title',
            [
                        'label' => __('Título del Subcategoria', 'wiwu-carousel-subcategoria'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __('Título de la categoria', 'wiwu-carousel-subcategoria'),
            ],
            'font_size',
            [
                'label' => __('Tamaño del titulo', 'wiwu-carousel-subcategoria'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'medium',  // Establecer un valor predeterminado
                        'options' => [
                            //'xx-large' => __('Muy Grande', 'wiwu-carousel-subcategoria'),
                            'x-large' => __('Grande', 'wiwu-carousel-subcategoria'),
                            'large' => __('Mediana', 'wiwu-carousel-subcategoria'),
                            'small' => __('Pequeña', 'wiwu-carousel-subcategoria'),
                            //'x-small' => __('Muy Pequeña', 'wiwu-carousel-subcategoria'),
                        ],
            ],
            'description',
            [
                'label' => __('Descripción', 'wiwu-carousel-subcategoria'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Descripción de la categoria', 'wiwu-carousel-subcategoria'),
            ],
            'image_main',
            [
                'label' => __('Imagen Principal', 'wiwu-carousel-subcategoria'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true, // Agregado para mejor visualización
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
            'image_secondary',
            [
                'label' => __('Imagen Secundaria', 'wiwu-carousel-subcategoria'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true, // Agregado para mejor visualización
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
                
        );

        
        

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $tamanoTitulo = '';
        ?>

        <div class="wiwu-banner-categoria">
            <div class="wiwu-banner-categoria-cont">
                <div class="wiwu-banner-categoria-box">
                    <div class="wiwu-banner-categoria-margen">
                        <h2 class="wiwu-banner-categoria-box-titulo">

                        <?php 
                            echo wp_kses($settings['main_title'], array(
                                'strong' => array(),
                                'em' => array(),
                                'b' => array(),
                                'i' => array(),
                                'a' => array('href' => array(), 'title' => array()),
                                'span' => array('class' => array())
                            ));
                        ?>
                        </h2>
                
                    </div>
                </div>
                <div class="wiwu-banner-subcategoria-box">
                    <div class="owl-carousel wiwu-banner-carousel">
                        <?php
                                    if($settings['font_size'] == 'x-large'):
                                        $tamanoTitulo = 'wiwu-banner-carousel-box-informacion-titulo-grande';
                                    elseif($settings['font_size'] == 'large'):
                                        $tamanoTitulo = 'wiwu-banner-carousel-box-informacion-titulo-mediana';
                                        elseif($settings['font_size'] == 'small'):
                                        $tamanoTitulo = 'wiwu-banner-carousel-box-informacion-titulo-pequena';
                                    endif;    
                        ?>
                            <div class="item">
                                    <div class="wiwu-banner-carousel-box-images">
                                        <img src="<?php echo esc_url($settings['image_main']['url']); ?>" class="wiwu-banner-carousel-box-image-principal" alt="">
                                        <img src="<?php echo esc_url($settings['image_secondary']['url']); ?>" class="wiwu-banner-carousel-box-image-secundaria" alt="">
                                    </div>
                                    <div class="wiwu-banner-carousel-box-informacion">
                                        <h3 class="wiwu-banner-carousel-box-informacion-titulo <?php echo esc_attr($tamanoTitulo);?>"><?php echo esc_html($settings['title']); ?></h3>
                                        <p  class="wiwu-banner-carousel-box-informacion-texto"><?php echo esc_html($settings['description']); ?></p>
                                    </div>

                            </div>
                    </div>
                </div>
                <div class="wiwu-banner-subcategoria-anterior-cont">
                <div class="wiwu-banner-subcategoria-flechas">
                    <div class="owl-nav">
                        <!-- <button type="button" role="presentation" class="owl-prev">
                            <span aria-label="Previous">‹</span>
                        </button>
                        <button type="button" role="presentation" class="owl-next">
                            <span aria-label="Next">›</span>
                        </button> -->
                    </div>
                </div>
                    <div class="wiwu-banner-subcategoria-anterior-box">
                    
                    </div>
                </div>
            </div>
        </div>
  
        <script>
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
            $('.wiwu-banner-subcategoria-anterior-box').html('');

            // Verificar si hay al menos 2 elementos en el carrusel
            if (event.item.count >= 1) {
                // Obtener el índice del slide anterior
                var prevItem = event.item.index - 1;

                // Si prevItem es negativo (estamos en el primer ítem), tomamos el último ítem
                if (prevItem < 0) {
                    prevItem = event.item.count - 1;  // Tomamos el último ítem del carrusel
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

        </script>
        <?php
    }
}
