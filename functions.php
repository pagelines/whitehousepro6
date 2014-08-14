<?php
/*
 *	Tell DMS we are in a subfolder and fire up the flux capacitors!
**/
define( 'DMS_CORE', true );
require_once( 'dms/functions.php' );


/* Add Google Font to option panel */

add_filter ( 'pagelines_foundry', 'whitehousepro_google_fonts' );

function whitehousepro_google_fonts($fonts){
    $fonts['whitehousepro-playfair'] = array(
	'name' => 'Payfair Display',
	'family' => 'Payfair Display, serif',
	'web_safe' => false,
	'google' => false,
	'monospace' => false,
	'free' => true
	);

	$fonts['whitehousepro-PT-sans'] = array(
	'name' => 'PT Sans',
	'family' => 'PT Sans, sans-serif',
	'web_safe' => false,
	'google' => false,
	'monospace' => false,
	'free' => true
	);

	$fonts['whitehousepro-PT-serif'] = array(
	'name' => 'PT Serif',
	'family' => 'PT Serif, serif',
	'web_safe' => false,
	'google' => false,
	'monospace' => false,
	'free' => true
	);

    return $fonts;
}