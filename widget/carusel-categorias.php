<?php if (!defined('ABSPATH')) exit;

class Elementor_Custom_Carousel extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom_carousel';
    }

    public function get_title() {
        return __('Wiwu Carousel Categoria', 'wiwu-carousel-categoria');
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
                'label' => __('Contenido', 'wiwu-carousel-categoria'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'main_title',
            [
                'label' => __('Título Principal', 'wiwu-carousel-categoria'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Mi Carrusel', 'wiwu-carousel-categoria'),
            ],
 
        );

        $this->add_control(
            'main_title_size',
            [
                'label' => __('Tamaño del titulo', 'wiwu-carousel-categoria'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'mediana',  // Establecer un valor predeterminado
                        'options' => [
                            'xx-large' => __('Muy Grande', 'wiwu-carousel-categoria'),
                            'mediana' => __('Mediana', 'wiwu-carousel-categoria'),
                        ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __('Subcategoria', 'wiwu-carousel-categoria'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __('Título', 'wiwu-carousel-categoria'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __('Título de la categoria', 'wiwu-carousel-categoria'),
                    ],
                    [
                        'name' => 'font_size',
                        'label' => __('Tamaño del titulo', 'wiwu-carousel-categoria'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'medium',  // Establecer un valor predeterminado
                        'options' => [
                            //'xx-large' => __('Muy Grande', 'wiwu-carousel-categoria'),
                            'x-large' => __('Grande', 'wiwu-carousel-categoria'),
                            'large' => __('Mediana', 'wiwu-carousel-categoria'),
                            'small' => __('Pequeña', 'wiwu-carousel-categoria'),
                            //'x-small' => __('Muy Pequeña', 'wiwu-carousel-categoria'),
                        ],
                    ],
                    [
                        'name' => 'id',
                        'label' => __('Id de la subcategoria', 'wiwu-carousel-categoria'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'description',
                        'label' => __('Descripción', 'wiwu-carousel-categoria'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __('Descripción de la categoria', 'wiwu-carousel-categoria'),
                    ],
                    [
                        'name' => 'image_main',
                        'label' => __('Imagen Principal', 'wiwu-carousel-categoria'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'label_block' => true, // Agregado para mejor visualización
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'image_secondary',
                        'label' => __('Imagen Secundaria', 'wiwu-carousel-categoria'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'label_block' => true, // Agregado para mejor visualización
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                   
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $tamanoTitulo = '';
        $tamanoTituloPrincipal = '';
        ?>

        <div class="wiwu-banner-categoria">
            <div class="wiwu-banner-categoria-cont">
                <div class="wiwu-banner-categoria-box">
                <?php 

if($settings['main_title_size'] == 'xx-large'):
    $tamanoTituloPrincipal = 'wiwu-banner-carousel-titulo-muy-grande';
elseif($settings['main_title_size'] == 'x-large'):
    $tamanoTituloPrincipal = 'wiwu-banner-carousel-titulo-grande';
elseif($settings['main_title_size'] == 'mediana'):
    $tamanoTituloPrincipal = 'wiwu-banner-carousel-titulo-mediana';
elseif($settings['main_title_size'] == 'small'):
    $tamanoTituloPrincipal = 'wiwu-banner-carousel-titulo-pequena';
elseif($settings['main_title_size'] == 'x-small'):
    $tamanoTituloPrincipal = 'wiwu-banner-carousel-titulo-muy-pequena';
endif; 
?>
<h2 class="wiwu-banner-categoria-box-titulo <?php echo esc_attr($tamanoTituloPrincipal );?>">
                    <div class="wiwu-banner-categoria-margen">

                
                        <!-- <h2 class="wiwu-banner-categoria-box-titulo <?php echo esc_attr($tamanoTituloPrincipal );?>"> -->

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
                        <?php foreach ($settings['slides'] as $slide) : ?>
                        <?php
                                    if($slide['font_size'] == 'x-large'):
                                        $tamanoTitulo = 'wiwu-banner-carousel-box-informacion-titulo-grande';
                                    elseif($slide['font_size'] == 'large'):
                                        $tamanoTitulo = 'wiwu-banner-carousel-box-informacion-titulo-mediana';
                                        elseif($slide['font_size'] == 'small'):
                                        $tamanoTitulo = 'wiwu-banner-carousel-box-informacion-titulo-pequena';
                                    endif;    
                        ?>
                            <div class="item">
                                <span class="wiwu-banner-slider-id" id="wiwu-banner-slider-id-<?php echo esc_attr($slide['id']);?>"></span>
                                <div class="wiwu-banner-carousel-box-images">
                                    <img src="<?php echo esc_url($slide['image_main']['url']); ?>" class="wiwu-banner-carousel-box-image-principal" alt="">
                                    <img src="<?php echo esc_url($slide['image_secondary']['url']); ?>" class="wiwu-banner-carousel-box-image-secundaria" alt="">
                                </div>
                                <div class="wiwu-banner-carousel-box-informacion">
                                    <h3 class="wiwu-banner-carousel-box-informacion-titulo <?php echo esc_attr($tamanoTitulo);?>"><?php echo esc_html($slide['title']); ?></h3>
                                    <p  class="wiwu-banner-carousel-box-informacion-texto"><?php echo esc_html($slide['description']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="wiwu-banner-subcategoria-anterior-cont">
                <?php if( count($settings['slides']) >=2 ):?>
                    <div class="wiwu-banner-subcategoria-flechas">
                        <div class="owl-nav"></div>
                    </div>
                <?php endif;?>
                    <div class="wiwu-banner-subcategoria-anterior-box">
                    
                    </div>
                </div>
            </div>
        </div>
  
        <script>
            

        </script>
        <?php
    }
}



/*

[products limit="12" columns="4" orderby="date" order="DESC" category="ipad-gadgets, ipad-case, ipad-keyboard-folio-case, ipad-screen-protector " paginate="true"]
*/