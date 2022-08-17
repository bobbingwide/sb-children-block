<?php
/**
 * Plugin Name:     SB Children block
 * Plugin URI: 		https://www.oik-plugins.com/oik-plugins/sb-children-block
 * Description:     List children of the current content as links.
 * Version:         1.2.0
 * Author:          bobbingwide
 * Author URI: 		https://www.bobbingwide.com/about-bobbing-wide
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
/**
 * Registers the oik-sb/children block.
 *
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes it also registers all assets, so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function sb_children_block_block_init() {

	$dir = dirname( __FILE__ );
	load_plugin_textdomain( 'sb-children-block', false, 'sb-children-block/languages' );
	$args = [ 'render_callback' => 'sb_children_block_dynamic_block'];
	register_block_type_from_metadata( __DIR__, $args );
	/**
	 * Localise the script by loading the required strings for the build/index.js file
	 * from the locale specific .json file in the languages folder.
	 */
	$ok = wp_set_script_translations( 'sb-children-block-editor-script', 'sb-children-block' , __DIR__ .'/languages' );

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
 * If it isn't, or if there are no descendants the result is an empty list.
 *
 * @param $attributes
 * @return string|void
 */
function sb_children_block_dynamic_block( $attributes ) {
	//load_plugin_textdomain( 'sb-children-block', false, 'sb-children-block/languages' );
	$className = isset( $attributes['className']) ? $attributes['className'] : 'wp-block-oik-sb-children';
	$depth = isset( $attributes['depth']) ? $attributes['depth'] : 0;
	$post = get_post();
	$args = [ 'child_of' => $post->ID, 'echo' => false, 'title_li' => null, 'depth' => $depth, 'post_type' => $post->post_type ];
	$html = '<ul class="'. $className . '">';
	$html .= wp_list_pages( $args );
	$html .= '</ul>';
	$classes = '';
	if ( isset( $attributes['textAlign'] ) ) {
		$classes .= 'has-text-align-' . $attributes['textAlign'];
	}
	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $classes ) );
	$html = sprintf( '<div %1$s>%2$s</div>', $wrapper_attributes, $html );
	return $html;
}
