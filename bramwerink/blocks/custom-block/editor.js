import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

registerBlockType('blocks/custom-block', {
    title: __('Your Custom Block', 'bramwerink'), // Use your theme text domain
    icon: 'smiley',
    category: 'text',
    attributes: {
        content: {
            type: 'string',
            source: 'html',
            selector: 'p',
        },
    },
    edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps();

        return (
            <p {...blockProps}>
                <input
                    type="text"
                    value={attributes.content || ''}
                    onChange={(event) => setAttributes({ content: event.target.value })}
                    placeholder={__('Enter some text...', 'bramwerink')} // Correct text domain
                />
            </p>
        );
    },
    save({ attributes }) {
        const blockProps = useBlockProps.save();

        return <p {...blockProps}>{attributes.content}</p>;
    },

    
});

console.log("Custom block JavaScript loaded");
