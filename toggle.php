<?php
/**
 * Plugin Name:     Toggle
 * Description:     Example block written with ESNext standard and JSX support – build step required.
 * Version:         0.1.0
 * Author:          The WordPress Contributors
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     toggle
 *
 * @package         create-block
 */

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function create_block_toggle_block_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/toggle" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-toggle-block-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);
	wp_set_script_translations( 'create-block-toggle-block-editor', 'toggle' );

	$editor_css = 'build/index.css';
	wp_register_style(
		'create-block-toggle-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'create-block-toggle-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	// custom script
	wp_register_script(
		'create-block-toggle-frontend-script', // handle
		plugins_url( 'scripts/toggle.js', __FILE__ ),
		[
			'jquery'
		],
		'initial'
	);

	register_block_type( 'create-block/toggle', array(
		'editor_script' => 'create-block-toggle-block-editor', // editor script
		'editor_style'  => 'create-block-toggle-block-editor', // editor style
		'style'         => 'create-block-toggle-block', // frontend style
		'script'		=> 'create-block-toggle-frontend-script', // frontend script
	) );

}

add_action( 'init', 'create_block_toggle_block_init' );
