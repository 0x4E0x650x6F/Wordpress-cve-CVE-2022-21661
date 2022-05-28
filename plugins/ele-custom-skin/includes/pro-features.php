<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
*
*   Plugin notices and links
*
*/

function ecs_admin_notice(){
    if (function_exists('ele_custom_skin_pro')) return;
    $user_id = get_current_user_id();
    if (get_user_meta( $user_id, 'ele_custom_skin_notice_dismissed' )) return;
    $offer = '2019-10-10' > date("Y-m-d") ? 'Limited Offer: <b style="color:red;">Unlimited Sites Lifetime License</b>.':"";
    $image = '<img width="30px" src="'.ELECS_URL . 'assets/dudaster_icon.png" style="width:32px;margin-right:10px;margin-bottom: -11px;"/>';
    $user = wp_get_current_user();
    if ( in_array( 'administrator', (array) $user->roles ) ) {
    echo '<div class="notice notice-info " style="padding-right: 38px; position: relative;">
          <p> '.$image.' Ele Custom Skin <b>PRO</b> is out <a href="https://dudaster.com/ecs-pro/" target="_blank">Check it out!</a>. '.$offer.' <a class="button button-primary" style="margin-left:20px;" href="https://dudaster.com/ecs-pro/" target="_blank">Get it now!</a></p>
        <a href="?ele_custom_skin_notice_dismissed"><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></a>
        </div>';
    }
}
add_action('admin_notices', 'ecs_admin_notice');

function ele_custom_skin_notice_dismissed() {
    $user_id = get_current_user_id();
    if ( isset( $_GET['ele_custom_skin_notice_dismissed'] )  )
        add_user_meta( $user_id, 'ele_custom_skin_notice_dismissed', 'true', true );
}
add_action( 'admin_init', 'ele_custom_skin_notice_dismissed' );

add_filter( 'plugin_row_meta', 'ele_custom_skin_row_meta', 10, 2 );
function ele_custom_skin_row_meta( $links, $file ) {    
    if (ELECS_NAME == $file ) {
        $row_meta = array(
          'video'    => '<a href="' . esc_url( 'https://www.youtube.com/watch?v=DwLFdaZ69KU&feature=youtu.be&t=94' ) . '" target="_blank" aria-label="' . esc_attr__( 'Video Tutorial', 'ele-custom-skin' ) . '" >' . esc_html__( 'Video Tutorial', 'ele-custom-skin' ) . '</a>'
        );

        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}

function elecs_action_links( $links ) {
	$links = array_merge($links, array(
		'<a href="' . esc_url( admin_url( '/edit.php?post_type=elementor_library&tabs_group=theme&elementor_library_type=loop' ) ) . '">' . __( 'Add Loop Template', 'ele-custom-skin' ) . '</a>',
	));
  
  if (!function_exists('ele_custom_skin_pro')) $links = array_merge($links, array(
      '<a href="' . esc_url( 'https://dudaster.com/ecs-pro/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Go Pro', 'ele-custom-skin' ) . '" style="color:#39b54a;font-weight:bold;">' . esc_html__( 'Go Pro', 'ele-custom-skin' ) . '</a>'
	));
	return $links;
}
add_action( 'plugin_action_links_' . ELECS_NAME, 'elecs_action_links' );

/*
*
*   Pro features preview
*
*/

if(!function_exists('ele_custom_skin_pro')){
  require_once ELECS_DIR.'includes/pro-preview.php';
}