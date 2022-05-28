<?php

require_once ELECS_DIR.'theme-builder/conditions/loop.php';
require_once ELECS_DIR.'theme-builder/documents/loop.php';
require_once ELECS_DIR.'theme-builder/conditions/custom-grid.php';
require_once ELECS_DIR.'theme-builder/documents/custom-grid.php';
require_once ELECS_DIR.'theme-builder/dynamic-tags/ele-tags.php';
//add new tags
$newtags=new ElementorPro\Modules\DynamicTags\Eletags();
$newtags::instance();
//require_once ELECS_DIR.'theme-builder/classes/custom-types-manager.php';

use Elementor\TemplateLibrary\Source_Local;
use ElementorPro\Modules\ThemeBuilder\Documents\Loop;
use ElementorPro\Plugin;
use ElementorPro\Modules\ThemeBuilder\Documents\Theme_Document;
use Elementor\Core\Documents_Manager;
use ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager;


Plugin::elementor()->documents->register_document_type( 'loop', Loop::get_class_full_name() );
Source_Local::add_template_type( 'loop' );

function elecs_get_document( $post_id ) {
		$document = null;

		try {
			$document = Plugin::elementor()->documents->get( $post_id );
		} catch ( \Exception $e ) {}

		if ( ! empty( $document ) && ! $document instanceof Theme_Document ) {
			$document = null;
		}

		return $document;
	}

function elecs_add_more_types($settings){
  $post_id = get_the_ID();
  $document = elecs_get_document( $post_id );

  if ( ! $document || !array_key_exists('theme_builder', $settings)) {
		return $settings;
	}
  
  $new_types=['loop'=>Loop::get_properties()];
  $add_settings=['theme_builder' => ['types' =>$new_types]];
  if (!array_key_exists('loop', $settings['theme_builder']['types'])) $settings = array_merge_recursive($settings, $add_settings);
  return $settings;
}

add_filter( 'elementor_pro/editor/localize_settings', 'elecs_add_more_types' );


function elecs_register_elementor_locations( $elementor_theme_manager ) {

	$elementor_theme_manager->register_location(
		'loop',
		[
			'label' => __( 'Loop', 'ele-custom-skin' ),
			'multiple' => true,
			'edit_in_content' => true,
		]
	);

}
add_action( 'elementor/theme/register_locations', 'elecs_register_elementor_locations' );

function elecs_enqueue_scripts($post){
  $document = elecs_get_document( $post->get_post_id() );
  //print_r($document->get_location());
  if($document)
  if('loop' == $document->get_location()){
      wp_enqueue_script(
        'ecs-preview',
        ELECS_URL.'assets/js/ecs_preview.js',
        array( 'jquery', 'elementor-frontend' ),
        ELECS_VER,
        true
      );
  }
}
add_action( 'elementor/preview/init', 'elecs_enqueue_scripts' );

/* register custom grid document */
	function elecs_register_documents_grid( Documents_Manager $documents_manager ) {
		$documents_manager->register_document_type( 'custom_grid', customGrid::get_class_full_name() );
	}


add_action( 'elementor/documents/register', 'elecs_register_documents_grid' );

	function elecs_register_location_grid( Locations_Manager $location_manager ) {
		$location_manager->register_location(
			'custom_grid',
			[
				'label' => __( 'Custom Grid', 'ele-custom-skin' ),
				'multiple' => true,
				'edit_in_content' => true,
			]
		);
	}

add_action( 'elementor/theme/register_locations', 'elecs_register_location_grid' );
