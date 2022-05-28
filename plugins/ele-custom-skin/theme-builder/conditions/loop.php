<?php


use ElementorPro\Modules\ThemeBuilder\Module;
use ElementorPro\Core\Utils;
use ElementorPro\Modules\ThemeBuilder\Conditions\Post;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ECS_Loop_Conditions  extends ElementorPro\Modules\ThemeBuilder\Conditions\Condition_Base {

	protected $sub_conditions = [
		'front_page',
	];

	public static function get_type() {
		return 'loop';
	}

	public function get_name() {
		return 'loop';
	}

	public static function get_priority() {
		return 60;
	}

	public function get_label() {
		return __( 'Loop', 'ele-custom-skin' );
	}

	public function get_all_label() {
		return __( 'No Conditions', 'ele-custom-skin' );
	}

	public function register_sub_conditions() {
		$post_types = Utils::get_public_post_types();

		$post_types['attachment'] = get_post_type_object( 'attachment' )->label;

		foreach ( $post_types as $post_type => $label ) {
			$condition = new Post( [
				'post_type' => $post_type,
			] );

			$this->register_sub_condition( $condition );
		}

		$this->sub_conditions[] = 'child_of';

		$this->sub_conditions[] = 'any_child_of';

		$this->sub_conditions[] = 'by_author';

		// Last condition.
		$this->sub_conditions[] = 'not_found404';
	}

	public function check( $args ) {
		return false;
	}
}

add_action( 'elementor/theme/register_conditions', function( $conditions_manager ) {
  $conditions_manager->get_condition('general')->register_sub_condition( new ECS_Loop_Conditions() );

},100);
