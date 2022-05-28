<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ECS_Enqueue_Style {
    public function __construct() {
      add_action( 'wp_enqueue_scripts', array( $this, 'frontend_styles' ),99999 );
    }
  	function get_skin_template(){
				global $wpdb;
				$templates = $wpdb->get_results( 
					"SELECT $wpdb->term_relationships.object_id as ID,  $wpdb->posts.post_modified as post_modified  FROM $wpdb->term_relationships
						INNER JOIN $wpdb->term_taxonomy ON
							$wpdb->term_relationships.term_taxonomy_id=$wpdb->term_taxonomy.term_taxonomy_id
						INNER JOIN $wpdb->terms ON 
							$wpdb->term_taxonomy.term_id=$wpdb->terms.term_id AND $wpdb->terms.slug='loop'
						INNER JOIN $wpdb->posts ON
							$wpdb->term_relationships.object_id=$wpdb->posts.ID
          WHERE  $wpdb->posts.post_status='publish'"
				);
				$options=false;
        foreach ( $templates as $template ) {
					$options[ $template->ID ] = strtotime($template->post_modified);
				}
				return $options;
	}
  public function frontend_styles() {
    //adding some css fixes

    wp_enqueue_style('ecs-styles', plugin_dir_url(__DIR__) . 'assets/css/ecs-style.css',array(),ELECS_VER);
    wp_enqueue_script('ecs-script', plugin_dir_url(__DIR__) . 'assets/js/ecs.js',array(),ELECS_VER);
    
    $styles=$this->get_skin_template();
    $upload_dir = wp_upload_dir();
    
    //some people forget to change the http into https and blame the plugin
    $upload_dir['baseurl']=set_url_scheme($upload_dir['baseurl']);
    
    if(is_array($styles)) foreach($styles as $id => $ver){
      $style_url = $upload_dir['baseurl'].'/elementor/css/post-'.$id.'.css';
      $style_file = $upload_dir['basedir'].'/elementor/css/post-'.$id.'.css';
      if (file_exists($style_file)) wp_enqueue_style('elementor-post-'.$id, $style_url, array(), $ver);
    }
  }
  
}
new ECS_Enqueue_Style();