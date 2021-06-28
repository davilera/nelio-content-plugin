<?php
/**
 * Plugin Name: Customizations
 * Description: My customizations in one single place.
 * Version:     1.0.0
 * Author:      David Aguilera
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}//end if

add_action( 'admin_init', function() {
	$url = untrailingslashit( plugin_dir_url( __FILE__ ) );
	$dir = untrailingslashit( plugin_dir_path( __FILE__ ) );
	$asset = include "{$dir}/build/index.asset.php";

	wp_register_script(
		'customizations',
		"{$url}/build/index.js",
		array_merge( $asset['dependencies'], [ 'nelio-content-edit-post' ] ),
		$asset['version']
	);
} );

add_action( 'enqueue_block_editor_assets', function() {
	if ( ! wp_script_is( 'nelio-content-edit-post', 'enqueued' ) ) {
		return;
	} //end if
	wp_enqueue_script( 'customizations' );
}, 99 );
