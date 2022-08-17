/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * These imports were added using the best guess technique.
 * @TODO Confirm what they should be!
 */
import ServerSideRender from '@wordpress/server-side-render';
import { Fragment} from '@wordpress/element';
import { InspectorControls } from '@wordpress/block-editor';
//const { InspectorControls } = wp.blockEditor;
// deprecated.js?ver=cd9e35508705772fbc5e2d9736bde31b:177 wp.editor.InspectorControls is deprecated. Please use wp.blockEditor.InspectorControls instead.
import { TextControl, PanelBody } from '@wordpress/components';
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @param {Object} [props]           Properties passed from the editor.
 * @param {string} [props.className] Class name generated for the block.
 *
 * @return {WPElement} Element to render.
 */
export default function edit ( { attributes, className, isSelected, setAttributes } )   {

	const onChangeDepth = ( event ) => {
			setAttributes( { depth: event } );
		};
	const help = __( "0 for all levels, 1-n for defined,-1 for flat.", 'sb-children-block');
	const blockProps = useBlockProps();

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody>
					<TextControl label={__("Depth",'sb-children-block')} value={attributes.depth} onChange={onChangeDepth} help={help} />
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps}>
			<ServerSideRender
				block="oik-sb/children" attributes={attributes}
			/>
			</div>
		</Fragment>
	);
}
