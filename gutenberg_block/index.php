<?php

/**
 * Plugin Name: AMP Social Share Block
 * Plugin URI: https://github.com/fellyph/wc-amp-workshop
 * Description: This plugin is a exercise from AMP for WordPress Workshop
 * Version: 1.1.0
 * Author: Fellyph
 *
 * @package amp-workshop
 */

defined( 'ABSPATH' ) || exit;

/**
 * Load all translations for our plugin from the MO file.
*/
add_action( 'init', 'amp_social_share_load_textdomain' );

function amp_social_share_load_textdomain() {
	load_plugin_textdomain( 'amp-workshop', false, basename( __DIR__ ) . '/languages' );
}

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function amp_social_share_register_block() {

	// automatically load dependencies and version
	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

	wp_register_script(
		'social-share-amp',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version']
	);

	wp_register_style(
		'social-share-amp-editor',
		plugins_url( 'editor.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
	);

	wp_register_style(
		'social-share-amp',
		plugins_url( 'style.css', __FILE__ ),
		array( ),
		filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
	);

	register_block_type( 'amp-workshop/social-share-amp', array(
		'style' => 'social-share-amp',
		'editor_style' => 'social-share-amp-editor',
		'editor_script' => 'social-share-amp',
	) );

  if ( function_exists( 'wp_set_script_translations' ) ) {
    wp_set_script_translations( 'social-share-amp', 'amp-workshop' );
  }

}
add_action( 'init', 'amp_social_share_register_block' );