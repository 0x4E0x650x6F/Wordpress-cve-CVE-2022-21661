<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ECS_Ajax_Load {
  private $post_id='';
  private $current_page=1;
  private $widget_id='';
  private $theme_id='';
  private $query=[];
  
  public function __construct($args=[]) {//["post_id"=>2,"current_page"=>2,"max_num_pages"=>5,"widget_id"=>"65054a0"]
    
    $this->init();
    
    if (!isset($args['post_id']))//debug line comment it
        if(!isset($_POST['ecs_ajax_settings'])) return;
          else $args = json_decode( stripslashes( $_POST['ecs_ajax_settings'] ), true );

    $this->post_id = $args['post_id'];
    $this->current_page = $args['current_page'] + 1;
    $this->widget_id = $args['widget_id'];
    $this->theme_id = isset($args['theme_id']) ? $args['theme_id'] : $args['post_id'];
    $this->query = json_decode( stripslashes( $_POST['query'] ), true );
    if ($this->current_page > $args['max_num_pages']) return;
    $this->init_ajax();

  }

  public function init() {
    add_action( 'wp_enqueue_scripts', [$this,'enqueue_scripts'] ,99);
    add_action( 'elementor/element/before_section_end', [$this,'post_pagination'],10,3);
    add_action( 'elementor/element/after_section_end', [$this,'button_pagination_style'],10,3);
  }
  
  public function init_ajax(){
    //add_action( 'wp_footer',[$this,'get_document_data'],99);// debug line comment it
    add_action( 'wp_ajax_ecsload', [$this,'get_document_data']); 
    add_action( 'wp_ajax_nopriv_ecsload', [$this,'get_document_data']);     
  }
  
  public function post_pagination($element, $section_id='', $args=''){

    if ( ( 'archive-posts' === $element->get_name() || 'posts' === $element->get_name() ) && 'section_pagination' === $section_id ) {
      
      $element->remove_control( 'pagination_type' );

      $element->add_control(
        'pagination_type',
        [
          'label' => __( 'Pagination', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'default' => '',
          'options' => [
            '' => __( 'None', 'elementor-pro' ),
            'numbers' => __( 'Numbers', 'elementor-pro' ),
            'loadmore' => __( 'Load More (Custom Skin)', 'ele-custom-skin' ),
            'lazyload' => __( 'Infinite Load (Custom Skin Pro)', 'ele-custom-skin' ),
            'prev_next' => __( 'Previous/Next', 'elementor-pro' ),
            'numbers_and_prev_next' => __( 'Numbers', 'elementor-pro' ) . ' + ' . __( 'Previous/Next', 'elementor-pro' ),
          ],
        ]
      );
      /* lazyload stuff*/  
      $element->add_control(
          'lazyload_title',
          [
            'label' => __( 'Infinite Load', 'ele-custom-skin' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
              'pagination_type' => 'lazyload',
            ],        
          ]
      );

      $element->add_control(
        'lazyload_animation',
        [
          'label' => __( 'Loading Animation', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'default' => 'default',
          'options' => ECS_Loading_Animation::get_lazy_load_animations_list(),
          'condition' => [
              'pagination_type' => 'lazyload',
          ],  
        ]
      );
      $element->add_control(
        'lazyload_color',
        [
          'label' => __( 'Animation Color', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .ecs-lazyload .ecs-ll-brcolor' => 'border-color: {{VALUE}};',
            '{{WRAPPER}} .ecs-lazyload .ecs-ll-bgcolor' => 'background-color: {{VALUE}} !important;',
          ],
          'condition' => [
            'pagination_type' => 'lazyload',
          ],
        ]
      );      
      
      $element->add_control(
        'lazyload_spacing',
        [
          'label' => __( 'Animation Spacing', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::SLIDER,
          'range' => [
            'px' => [
              'max' => 250,
            ],
          ],
          'default' =>[
            'unit' => 'px',
            'size' => '20',
          ],
          'selectors' => [
            '{{WRAPPER}} .ecs-lazyload' => 'margin-top: {{SIZE}}{{UNIT}};',
          ],
          'condition' => [
            'pagination_type' => 'lazyload',
          ],
        ]
      );
      $element->add_control(
        'lazyload_size',
        [
          'label' => __( 'Animation Size', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::SLIDER,
          'range' => [
            'px' => [
              'max' => 50,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .ecs-lazyload .ecs-lazy-load-animation' => 'font-size: {{SIZE}}{{UNIT}};',
          ],
          'condition' => [
            'pagination_type' => 'lazyload',
          ],
        ]
      );

      
      /* load more button stuff */
      
      $element->add_control(
          'loadmore_title',
          [
            'label' => __( 'Load More Button', 'ele-custom-skin' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
              'pagination_type' => 'loadmore',
            ],        
          ]
      );
      
      $element->add_control(
        'loadmore_text',
        [
          'label' => __( 'Text', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'default' => __( 'Load More', 'elementor' ),
          'placeholder' => __( 'Load More', 'elementor' ),
          'condition' => [
            'pagination_type' => 'loadmore',
          ],
        ]
      );
      
      $element->add_control(
        'loadmore_loading_text',
        [
          'label' => __( 'Loading Text', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'default' => __( 'Loading...', 'elementor' ),
          'placeholder' => __( 'Loading...', 'elementor' ),
          'condition' => [
            'pagination_type' => 'loadmore',
          ],
        ]
      );
      
      $element->add_control(
        'loadmore_spacing',
        [
          'label' => __( 'Button Spacing', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::SLIDER,
          'range' => [
            'px' => [
              'max' => 250,
            ],
          ],
          'default' =>[
            'unit' => 'px',
            'size' => '20',
          ],
          'selectors' => [
            '{{WRAPPER}} .ecs-load-more-button .elementor-button' => 'margin-top: {{SIZE}}{{UNIT}};',
          ],
          'condition' => [
            'pagination_type' => 'loadmore',
          ],
        ]
      );
     $element->add_control(
			'change_url',
			[
				'label' => __( 'Change URL on ajax load?', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'ele-custom-skin' ),
				'label_on' => __( 'Yes', 'ele-custom-skin' ),
        'return_value' => true,
        'separator' => 'before',
				'default' => false,
			]
		);
      
    $element->add_control(
			'reinit_js',
			[
				'label' => __( 'Reinitialize Elementor JS on Ajax Pagination?', 'ele-custom-skin' ),
        'description' => __( 'This is used for the elements loaded through AJAX Pagination. This is experimental feature and it may not work properly.', 'ele-custom-skin'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'ele-custom-skin' ),
				'label_on' => __( 'Yes', 'ele-custom-skin' ),
        'return_value' => true,
        'separator' => 'before',
				'default' => false,
			]
		);


     }
  }
  
  public function button_pagination_style($element, $section_id='', $args=''){

    if ( ( 'archive-posts' === $element->get_name() || 'posts' === $element->get_name() ) && 'section_pagination_style' === $section_id ) {
  
    	$element->start_controls_section(
        'loadmore_section_style',
        [
          'label' => __( 'Load More Button', 'ele-custom-skin' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
          'condition' => [
            'pagination_type' => 'loadmore',
          ],
        ]
      );

      $element->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
          'name' => 'loadmore_typography',
          'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
          'selector' => '{{WRAPPER}} .ecs-load-more-button .elementor-button',
        ]
      );

      $element->add_group_control(
        \Elementor\Group_Control_Text_Shadow::get_type(),
        [
          'name' => 'loadmore_text_shadow',
          'selector' => '{{WRAPPER}} .ecs-load-more-button .elementor-button',
        ]
      );

      $element->start_controls_tabs( 'ecs_load_more_tabs_button_style' );

      $element->start_controls_tab(
        'loadmore_tab_button_normal',
        [
          'label' => __( 'Normal', 'ele-custom-skin' ),
        ]
      );

      $element->add_control(
        'loadmore_button_text_color',
        [
          'label' => __( 'Text Color', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'default' => '',
          'selectors' => [
            '{{WRAPPER}} .ecs-load-more-button .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
          ],
        ]
      );

      $element->add_control(
        'loadmore_background_color',
        [
          'label' => __( 'Background Color', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'scheme' => [
            'type' => \Elementor\Core\Schemes\Color::get_type(),
            'value' => \Elementor\Core\Schemes\Color::COLOR_4,
          ],
          'selectors' => [
            '{{WRAPPER}} .ecs-load-more-button .elementor-button' => 'background-color: {{VALUE}};',
          ],
        ]
      );

      $element->end_controls_tab();

      $element->start_controls_tab(
        'loadmore_tab_button_hover',
        [
          'label' => __( 'Hover', 'ele-custom-skin' ),
        ]
      );

      $element->add_control(
        'loadmore_hover_color',
        [
          'label' => __( 'Text Color', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .ecs-load-more-button .elementor-button:hover, {{WRAPPER}} .ecs-load-more-button .elementor-button:focus' => 'color: {{VALUE}};',
            '{{WRAPPER}} .ecs-load-more-button .elementor-button:hover svg, {{WRAPPER}} .ecs-load-more-button .elementor-button:focus svg' => 'fill: {{VALUE}};',
          ],
        ]
      );

      $element->add_control(
        'loadmore_button_background_hover_color',
        [
          'label' => __( 'Background Color', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .ecs-load-more-button .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'background-color: {{VALUE}};',
          ],
        ]
      );

      $element->add_control(
        'loadmore_button_hover_border_color',
        [
          'label' => __( 'Border Color', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'condition' => [
            'border_border!' => '',
          ],
          'selectors' => [
            '{{WRAPPER}} .ecs-load-more-button .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
          ],
        ]
      );

      $element->add_control(
        'loadmore_hover_animation',
        [
          'label' => __( 'Hover Animation', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
        ]
      );

      $element->end_controls_tab();

      $element->end_controls_tabs();

      $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
          'name' => 'loadmore_border',
          'selector' => '{{WRAPPER}} .elementor-button',
          'separator' => 'before',
        ]
      );

      $element->add_control(
        'loadmore_border_radius',
        [
          'label' => __( 'Border Radius', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%' ],
          'selectors' => [
            '{{WRAPPER}} .ecs-load-more-button .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );

      $element->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
          'name' => 'loadmore_button_box_shadow',
          'selector' => '{{WRAPPER}} .ecs-load-more-button .elementor-button',
        ]
      );

      $element->add_responsive_control(
        'loadmore_text_padding',
        [
          'label' => __( 'Padding', 'ele-custom-skin' ),
          'type' => \Elementor\Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', 'em', '%' ],
          'selectors' => [
            '{{WRAPPER}} .ecs-load-more-button .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
          'separator' => 'before',
        ]
      );
    	$element->end_controls_section();
    }
  }
  
  private function get_element_data($id,$data){
    
    foreach($data as $element){
       //echo "[".$element['id']."] == (".$id.")";
      if (isset($element['id']) && $element['id'] == $id) {
        return $element;
      } else {
        //echo $element['id']." - ".count($element['elements'])." > ";//print_r($element['elements']);
        if(count($element['elements'])) { 
            $element_children=$this->get_element_data($id,$element['elements']);
            if ($element_children) return $element_children ;
        }
        //echo"am ajuns aici?";
      }
    }
    return false;
  }

  public function get_document_data(){
 
    global $wp_query;
    

    $id = $this->widget_id;

    $post_id = $this->post_id;
    $theme_id = $this->theme_id;
    $old_query = $wp_query->query_vars;


    $this->query['paged'] = $this->current_page; // we need current(next) page to be loaded
    $this->query['post_status'] = 'publish';

    $wp_query = new \WP_Query($this->query);
    wp_reset_postdata();//this fixes some issues with some get_the_ID users.
    if (is_archive()){
      $post_id = $theme_id;
    }
 
		$document = \Elementor\Plugin::$instance->documents->get_doc_for_frontend( $post_id );
		$theme_document = \Elementor\Plugin::$instance->documents->get_doc_for_frontend( $theme_id );
   
    $data[] = $this->get_element_data($id,$theme_document->get_elements_data());

		// Change the current post, so widgets can use `documents->get_current`.
		\Elementor\Plugin::$instance->documents->switch_to_document( $document );

    ob_start();
        $document->print_elements_with_wrapper( $data );
    $content = ob_get_clean();
    echo $this->clean_response($content,$id);

    \Elementor\Plugin::$instance->documents->restore_document();
    $wp_query->query_vars = $query_vars;

    die;
  }
  
  private function clean_response($html,$id){
    $content = "";
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    //$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $childs = $xpath->query('//div[@data-id="'.$id.'"]/div[@class="elementor-widget-container"]/div/* | //div[@data-elementor-type="custom_grid"]');
//    $childs = $xpath->query('//div[@data-elementor-type="custom_grid"]');
  //return $dom->saveHTML($childs->item(0));
    foreach($childs as $child){
      $content .= $dom->saveHTML($child);
    }
    //$div = $div->item(0);
    return $content;
  }
  
  public function enqueue_scripts(){
    
    global $wp_query; 
    
    wp_register_script('ecs_ajax_load', plugin_dir_url(__DIR__) . 'assets/js/ecs_ajax_pagination.js',array('jquery'),ELECS_VER);
    
    wp_localize_script( 'ecs_ajax_load', 'ecs_ajax_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
        'posts' => json_encode( $wp_query->query_vars ),
     ) );

    wp_enqueue_script( 'ecs_ajax_load' ); 
  }
  
}


class ECS_Loading_Animation {
  private static function animations(){ 
    return [
      'default'=>[
        'label' => __( 'Default', 'ele-custom-skin' ),
        'html' => '<div class="lds-ellipsis ecs-lazy-load-animation"><div class="ecs-ll-bgcolor"></div><div class="ecs-ll-bgcolor"></div><div class="ecs-ll-bgcolor"></div><div class="ecs-ll-bgcolor"></div></div>',
      ],
      'progress_bar'=>[
        'label' => __( 'Progress Bar', 'ele-custom-skin' ),
        'html' => '<div class="barload-wrapper  ecs-lazy-load-animation"><div class="barload-border ecs-ll-brcolor"><div class="barload-whitespace"><div class="barload-line ecs-ll-bgcolor"></div></div></div></div>',
      ],
      'running_dots'=>[
        'label' => __( 'Running Dots', 'ele-custom-skin' ),
        'html' => '<div class="ballsload-container ecs-lazy-load-animation"><div class="ecs-ll-bgcolor"></div><div class="ecs-ll-bgcolor"></div><div class="ecs-ll-bgcolor"></div><div class="ecs-ll-bgcolor"></div></div>',
      ],
      'ball_slide'=>[
        'label' => __( 'Ball Slide', 'ele-custom-skin' ),
        'html' => '<div id="movingBallG" class="ecs-lazy-load-animation"><div class="movingBallLineG  ecs-ll-bgcolor"></div><div id="movingBallG_1" class="movingBallG ecs-ll-bgcolor"></div></div>',
      ],

    ];
   }


  public static function get_lazy_load_animations_html($animation){
    $arrs = self::animations();
    return $arrs[$animation]['html'];    
  }
  
  public static function get_lazy_load_animations_list(){
    $arrs = self::animations();
    foreach ( $arrs as $key => $arr ) {
      $options[ $key ] = $arr['label'];
    }
    return $options;    
  }
  
}



new ECS_Ajax_Load();
  
  