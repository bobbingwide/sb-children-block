<?php
/**
 * Plugin Name:     SB Children block
 * Description:     List children of the current content as links.
 * Version:         0.4.0
 * Author:          bobbingwide
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     sb-children-block
 *
 * @package         sb-children-block
 */

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function sb_children_block_block_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "sb/children-block" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'sb-children-block-block-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	$editor_css = 'build/index.css';
	wp_register_style(
		'sb-children-block-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'sb-children-block-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'sb/children-block', array(
		'editor_script' => 'sb-children-block-block-editor',
		'editor_style'  => 'sb-children-block-block-editor',
		'style'         => 'sb-children-block-block',
		'render_callback'=>'sb_children_block_dynamic_block',
		'attributes' => [
			'depth' => [ 'type' => 'string'],
			'className' => [ 'type' => 'string'],
		]
	) );

	register_block_type( 'sb/parent-block', array(
		'editor_script' => 'sb-children-block-block-editor',
		'editor_style'  => 'sb-children-block-block-editor',
		'style'         => 'sb-children-block-block',
		'render_callback'=>'sb-parent_block_dynamic_block',
		'attributes' => [
			'className' => [ 'type' => 'string'],
		]
	) );
}
add_action( 'init', 'sb_children_block_block_init' );

/**
 * Returns a list of child pages of the current content as links.
 *
 * wp-List_pages supports a tree using the `depth=` parameter.
 *
 * depth= | Meaning
 * ------ | -------
 * 0 | Any depth
 * 1 | Children
 * 2 | Children and grandchildren
 * n>2 | More descendants
 * -1 | Don't show the nesting
 *
 * blank is equivalent to the default: 0
 *
 * Note: This routine doesn't check if the post is of a hierarchical post_type.
 *
 * @param $attributes
 * @return string|void
 */
function sb_children_block_dynamic_block( $attributes ) {
	//bw_trace2();
	$depth = isset( $attributes['depth']) ? $attributes['depth'] : 0;
	$post = get_post();
	$args = [ 'child_of' => $post->ID, 'echo' => false, 'title_li' => null, 'depth' => $depth ];
	$html = '<ul>';
	$html .= wp_list_pages( $args );
	$html .= '</ul>';
	return $html;
}

function sb_parent_block_dynamic_block( $attributes ) {

	$id = wp_get_post_parent_id( null );
	if ( $id ) {
		$url = get_permalink( $id );
		$title = get_the_title( $id );
		$html = "<a href=\"$url\" >$title</a>";
	} else {
		$html = "No parent";
	}
	return $html;

}
