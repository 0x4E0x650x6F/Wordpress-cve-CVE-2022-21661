<?php
/*
*
*   Pro features preview
*
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'ECS_after_control', function($skin){
  ecs_days_old();
  
    $skin->add_control(
			'pro_features',
			[
				'label' => '<i class="fa fa-lock" aria-hidden="true"></i> '.__( 'See <b>Pro</b> features', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'ele-custom-skin' ),
				'label_on' => __( 'Show', 'ele-custom-skin' ),
        'return_value' => 'yes',
        'separator' => 'before',
				'default' => ecs_days_old() > 8 ? '' : 'yes',
        'frontend_available' => true,
        'selectors' =>[' '=>' '],
			]
		);
  
  $skin->add_control(
			'is_display_conditions',
			[
				'label' => '<i class="fa fa-lock" aria-hidden="true"></i> '.__( '<b>Enable Display Conditions</b>', 'ele-custom-skin' ),
        'description' => __( 'Use templates based on Display Conditions set on Loop Templates', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'ele-custom-skin' ),
				'label_on' => __( 'Yes', 'ele-custom-skin' ),
        'return_value' => 'yes',
        'separator' => 'before',
				'default' => '',
        'frontend_available' => true,
        'selectors' =>[' '=>' '],
         'condition' => [
					$skin->get_id().'_pro_features' => 'yes'
				],

			]
	);
  
  $skin->add_control(
			'alternating_templates',
			[
				'label' => '<i class="fa fa-lock" aria-hidden="true"></i> '.__( '<b>Alternating templates</b>', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'ele-custom-skin' ),
				'label_on' => __( 'Show', 'ele-custom-skin' ),
        'return_value' => 'yes',
        'separator' => 'before',
				'default' => '',
        'frontend_available' => true,
        'selectors' =>[' '=>' '],
         'condition' => [
					$skin->get_id().'_pro_features' => 'yes'
				],

			]
		);
    
   $repeater = new \Elementor\Repeater();
    
    $repeater->add_control(
			'nth',
			[
				'label' => __( '<i><b>n</b></i> th post', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label_block' => false,
        'separator' => 'after',
				'placeholder' => __( 'nth', 'ele-custom-skin' ),
				'default' => __( '1', 'ele-custom-skin' ),
        'min' => 1,
				'dynamic' => [
					'active' => true,
				],
			]
		);
    
   
    $repeater->add_control(
			'skin_template',
			[
				'label' => __( 'Select a default template', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => [],
				'options' => $skin->get_skin_template(),
			]
		);
    
  $skin->add_control(
			'template_list',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
        'default' => [
            [
              'nth' => 1,
              'skin_template' => []
						],
        ],
        'condition' => [
					$skin->get_id().'_alternating_templates' => 'yes',
          $skin->get_id().'_pro_features' => 'yes'
				],
				'title_field' => '<p style="text-align:center;"><i class="fa fa-lock" aria-hidden="true"></i> '.__('Template for every ', 'ele-custom-skin').'{{{nth}}}'.__('th post', 'ele-custom-skin').'</p>',
			]
		);
    

  $skin->add_control(
			'display_title',
			[
				'label' => __( 'Display Mode', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
					$skin->get_id().'_pro_features' => 'yes'
				],        
			]
		);
    if ('2019-09-20' <= date("Y-m-d"))  $skin->add_control(
			'masonrys',
			[
				'label' => '<i class="fa fa-lock" aria-hidden="true"></i> '.__( 'Masonry', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'ele-custom-skin' ),
				'label_on' => __( 'On', 'ele-custom-skin' ),
        'return_value' => 'yes',
				'default' => 'no',
        'frontend_available' => true,
        'condition' => [
					$skin->get_id().'_same_height!' => '100%',
          $skin->get_id().'_post_slider!' => 'yes',
          $skin->get_id().'_pro_features' => 'yes'
				],
			]
		);
    $skin->add_control(
			'same_height',
			[
				'label' => '<i class="fa fa-lock" aria-hidden="true"></i> '.__( 'Same Height', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'ele-custom-skin' ),
				'label_on' => __( 'On', 'ele-custom-skin' ),
        'return_value' => '100%',
				'default' => 'auto',
        'condition' => [
					$skin->get_id().'_pro_features' => 'yes'
				],
			]
		);
  
   
  
  /**
  *
  * Starting the slider part
  *
  **/
  
  $skin->add_control(
			'post_slider',
			[
				'label' => '<i class="fa fa-lock" aria-hidden="true"></i> '.__( 'Show in Slider', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'ele-custom-skin' ),
				'label_on' => __( 'On', 'ele-custom-skin' ),
        'return_value' => 'yes',
				'default' => '',
        'frontend_available' => true,
        'condition' => [
					$skin->get_id().'_masonrys!' => 'yes',
          $skin->get_id().'_pro_features' => 'yes',
				],
			]
		);


  $skin->add_control(
			'slider_title',
			[
				'label' => __( 'Slider Options', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
					$skin->get_id().'_post_slider' => 'yes',
          $skin->get_id().'_pro_features' => 'yes',
				],
			]
		);
  	$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
  	$skin->add_responsive_control(
			'slides_to_show',
			[
				'label' => __( 'Slides to Show', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ele-custom-skin' ),
				] + $slides_to_show,
        'condition' => [
					$skin->get_id().'_post_slider' => 'yes',
          $skin->get_id().'_pro_features' => 'yes',
				],
				'frontend_available' => true,
			]
		);
  	$skin->add_responsive_control(
			'slides_to_scroll',
			[
				'label' => __( 'Slides to Scroll', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' => __( 'Set how many slides are scrolled per swipe.', 'ele-custom-skin' ),
				'options' => [
					'' => __( 'Default', 'ele-custom-skin' ),
				] + $slides_to_show,
				'condition' => [
				  $skin->get_id().'_slides_to_show!' => '1',
          $skin->get_id().'_post_slider' => 'yes',
          $skin->get_id().'_pro_features' => 'yes',
				],
				'frontend_available' => true,
			]
		);
  	$skin->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __( 'Arrows and Dots', 'ele-custom-skin' ),
					'arrows' => __( 'Arrows', 'ele-custom-skin' ),
					'dots' => __( 'Dots', 'ele-custom-skin' ),
					'none' => __( 'None', 'ele-custom-skin' ),
				],
        'condition' => [
					$skin->get_id().'_post_slider' => 'yes',
          $skin->get_id().'_pro_features' => 'yes',
				],
				'frontend_available' => true,
			]
		);
  
	/* 
  
  end slider
  
  */


  $skin->add_control(
			'key_title',
			[
				'label' => __( 'Dynamic Everywhere', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
					$skin->get_id().'_pro_features' => 'yes'
				],
			]
		);
  $skin->add_control(
			'use_keywords',
			[
				'label' => '<i class="fa fa-lock" aria-hidden="true"></i> '.__( 'Using Dynamic Keywords', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'ele-custom-skin' ),
				'label_off' => __( 'No', 'ele-custom-skin' ),
				'return_value' => 'yes',
				'default' => 'no',
        'condition' => [
					$skin->get_id().'_pro_features' => 'yes'
				],
			]
		);
  
     $skin->add_control(
			'keywords_note',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => '<div>Replace all the dynamic &#123;&#123;keywords&#125;&#125; from the Loop Template.</div>',  
        'condition' => [
					$skin->get_id().'_pro_features' => 'yes'
				],
			]
		);
  
    $skin->add_control(
      'link_to',
        [
            'label' => '<i class="fa fa-lock" aria-hidden="true"></i> '.__( '<b>Make entire post a link?</b>', 'ele-custom-skin' ),
            'description' => __( 'Make the entire Loop Template clickable.', 'ele-custom-skin' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_off' => __( 'No', 'ele-custom-skin' ),
            'label_on' => __( 'Yes', 'ele-custom-skin' ),
            'return_value' => 'yes',
            'separator' => 'before',
            'default' => '',
            'frontend_available' => true,
            'selectors' =>[' '=>' '],
                    'condition' => [
                      $skin->get_id().'_pro_features' => 'yes'
                    ],
          ]
      );
  
  		$skin->add_control(
			'postlink',
			[
				'label' => __( 'Link', 'ele-custom-skin' ),
        'description' => __( 'For this link to be SEO friendly please add a link to title or other widgets inside Loop Template.', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'ele-custom-skin' ),
				'condition' => [
					$skin->get_id().'_link_to' => 'yes',
          $skin->get_id().'_pro_features' => 'yes',
				],
				'show_label' => false,
			]
		);
  
   $skin->add_control(
			'upgrade_note',
			[
				'label' => '<i class="fa fa-lock-open" aria-hidden="true"></i> <b>'.__( 'Unlock PRO features. ', 'ele-custom-skin' ).'</b>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
        'separator' => 'before',
				'raw' => '<div style="padding-top:10px;line-height:1.6em;text-align:center;"><p>'.__( 'Get full features with <b><i>Ele Custom Skin PRO</i></b>, ', 'ele-custom-skin' ).'</p><p style="padding-top:10px;"><a class="elementor-button elementor-button-default elementor-button-go-pro" href="https://dudaster.com/ecs-pro/" target="_blank">'.__( 'Go Pro', 'ele-custom-skin' ).'</a></p></div>',  
				'content_classes' => 'your-class',
			]
		);

} , 10, 3 );
