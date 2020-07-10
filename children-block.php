<?php
/**
 * Plugin Name:     Children block
 * Description:     List children of the current content as links.
 * Version:         0.1.0
 * Author:          bobbingwide
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     oik
 *
 * @package         oik
 */

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function oik_children_block_block_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "oik/children-block" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'oik-children-block-block-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	$editor_css = 'build/index.css';
	wp_register_style(
		'oik-children-block-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'oik-children-block-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'oik/children-block', array(
		'editor_script' => 'oik-children-block-block-editor',
		'editor_style'  => 'oik-children-block-block-editor',
		'style'         => 'oik-children-block-block',
		'render_callback'=>'oik_children_block_dynamic_block',
	) );
}
add_action( 'init', 'oik_children_block_block_init' );

function oik_children_block_dynamic_block() {
	return "Children block - Server side rendered";
}
