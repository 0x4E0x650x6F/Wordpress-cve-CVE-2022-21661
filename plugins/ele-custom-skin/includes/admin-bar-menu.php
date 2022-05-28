<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ECS_Admin_Bar_Menu {
  
  private static $admin_bar_edit_documents = [];
  private static $wp_admin_bar=[];
  
  public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}
  
  public function __construct() {

		$this->init();

	}
  
  public function init() {

  }
 
  public static function add_document( $post_id ) {
		if ( post_password_required( $post_id ) ) {
			return '';
		}

		if ( ! \Elementor\Plugin::$instance->db->is_built_with_elementor( $post_id ) ) {
			return '';
		}

		$document = \Elementor\Plugin::$instance->documents->get_doc_for_frontend( $post_id );

		// Change the current post, so widgets can use `documents->get_current`.
		\Elementor\Plugin::$instance->documents->switch_to_document( $document );

		if ( $document->is_editable_by_current_user() ) {
			self::$admin_bar_edit_documents[ $document->get_main_id() ] = $document;
		}
    \Elementor\Plugin::$instance->documents->restore_document();
  }
  
  private static function add_menu_in_admin_bar() {
		if ( empty( self::$admin_bar_edit_documents ) ) {
			return;
		}

		$queried_object_id = get_queried_object_id();


		if ( is_singular() && isset( self::$admin_bar_edit_documents[ $queried_object_id ] ) ) {
			$menu_args['href'] = self::$admin_bar_edit_documents[ $queried_object_id ]->get_edit_url();
			unset( self::$admin_bar_edit_documents[ $queried_object_id ] );
		}

		

		foreach ( self::$admin_bar_edit_documents as $document ) {
			self::$wp_admin_bar[] = [
				'id' => 'wp-admin-bar-elementor_edit_doc_' . $document->get_main_id(),
				'parent' => 'wp-admin-bar-elementor_edit_page-default',
				'title' => sprintf( '<span class="elementor-edit-link-title">%s</span><span class="elementor-edit-link-type">%s</span>', $document->get_post()->post_title, $document::get_title() ),
				'href' => $document->get_edit_url(),
			] ;
    }
	}
  public static function get_menu_args(){
    self::add_menu_in_admin_bar();
    return json_encode(self::$wp_admin_bar);
  }
  
  public static function write_js(){
    if(is_admin_bar_showing()){

      echo '<script src="'.ELECS_URL.'assets/js/ecs_admin_bar_menu.js"></script><script>';
      echo 'ECS_update_admin_bar_menu('.self::get_menu_args().');';
      echo '</script>';
    }
  }
	
}

add_action('wp_footer',function(){
  ECS_Admin_Bar_Menu::write_js();
});