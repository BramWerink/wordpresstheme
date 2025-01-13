(function (wp) {
    const { registerBlockType } = wp.blocks;
    const { __ } = wp.i18n;
    const { useBlockProps } = wp.blockEditor;

    registerBlockType('blocks/custom-block', {
        title: __('Your Custom Block', 'bramwerink'),
        icon: 'smiley',
        category: 'text',
        attributes: {
            content: {
                type: 'string',
                source: 'html',
                selector: 'p',
            },
        },
        edit: function (props) {
            const blockProps = useBlockProps();
            const { attributes, setAttributes } = props;

            return wp.element.createElement(
                'p',
                blockProps,
                wp.element.createElement('input', {
                    type: 'text',
                    value: attributes.content || '',
                    onChange: function (event) {
                        setAttributes({ content: event.target.value });
                    },
                    placeholder: __('Enter some text...', 'bramwerink'),
                })
            );
        },
        save: function (props) {
            const blockProps = useBlockProps.save();
            const { attributes } = props;

            return wp.element.createElement('p', blockProps, attributes.content);
        },
    });
})(window.wp);

console.log("Custom block JavaScript loaded");
