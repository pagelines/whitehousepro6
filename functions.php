<?php
/*
 *	Tell DMS we are in a subfolder and fire up the flux capacitors!
**/
define( 'DMS_CORE', true );
require_once( 'dms/functions.php' );

/* Excerpt length */
function whp_excerpt_length($length) {
	return 34;
}
add_filter('excerpt_length', 'whp_excerpt_length');

/* Add Google Font to option panel */

add_filter ( 'pagelines_foundry', 'whitehousepro_google_fonts' );

function whitehousepro_google_fonts($fonts){
    $fonts['whitehousepro-domine'] = array(
	'name' => 'Domine',
	'family' => 'Domine, serif',
	'web_safe' => false,
	'google' => false,
	'monospace' => false,
	'free' => true
	);

    return $fonts;
}

//Remove WooCommerce Title & Breadcrumbs

add_filter( 'woocommerce_page_title', 'woo_shop_page_title');

function woo_shop_page_title( $page_title ) {

	if( 'Shop' == $page_title) {
		return false;
	}
}

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

/**
 * Fix uploader issues with DMS2 and WP 4.3 jQuery temporary patch
 */
add_action( 'wp_enqueue_scripts', 'fix_jquery_for_dms_theme' );
function fix_jquery_for_dms_theme() {
	if( ! is_admin() && function_exists( 'pl_draft_mode' ) && pl_draft_mode() ){
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"), false, '1.11.2');
		wp_enqueue_script('jquery');
	}
}
