import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/block-editor';

registerBlockType( 'amp-workshop/social-share-amp', {
	title: __( 'AMP Social Share', 'amp-workshop' ),
	icon: 'universal-access-alt',
	category: 'layout',
	attributes: {
		content: {
			type: 'array',
			source: 'children',
			selector: 'p',
		},
	},
	example: {
		attributes: {
			content: __( 'Social Share' ),
		},
	},
	edit: ( props ) => {
		const {
			attributes: { content },
			setAttributes,
			className,
		} = props;
		const onChangeContent = ( newContent ) => {
			setAttributes( { content: newContent } );
		};
		return (
			<RichText
				tagName="p"
				className={ className }
				onChange={ onChangeContent }
				value={ content }
			/>
		);
	},
	save: ( props ) => {
        const {
			className,
		} = props;
		return (
            <div className={className}>
                <amp-social-share type="twitter"></amp-social-share>
                <amp-social-share type="linkedin"></amp-social-share>
                <amp-social-share type="email"></amp-social-share>
            </div>
		);
	},
} );