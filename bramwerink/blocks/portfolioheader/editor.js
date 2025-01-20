(function (wp) {
    const { registerBlockType } = wp.blocks;
    const { __ } = wp.i18n;
    const { useBlockProps } = wp.blockEditor;
    const { element } = wp;

    // Fetch the HTML for the block
    fetch(`${window.location.origin}/wp-content/themes/bramwerink/blocks/portfolioheader/block.php`)
        .then(function (response) {
            return response.text();
        })
        .then(function (html) {
            // Register the block once HTML is fetched
            registerBlockType('blocks/portfolioheader', {
                title: __('portfolioheader', 'bramwerink'),
                icon: 'smiley',
                category: 'text',
                attributes: {
                    content: {
                        type: 'string',
                        default: html, // Set the fetched HTML as the default content
                    },
                },
                edit: function (props) {
                    const blockProps = useBlockProps();
                    const { attributes } = props;

                    // Render the block edit form with the fetched HTML (non-editable)
                    return element.createElement(
                        'div',
                        blockProps,
                        element.createElement('div', {
                            dangerouslySetInnerHTML: { __html: attributes.content || '' },
                        })
                    );
                },
                save: function (props) {
                    const blockProps = useBlockProps.save();
                    const { attributes } = props;

                    // Render the block's saved content
                    return element.createElement(
                        'div',
                        blockProps,
                        element.createElement('div', {
                            dangerouslySetInnerHTML: { __html: attributes.content || '' },
                        })
                    );
                },
            });
        })
        .catch(function (error) {
            console.error('Error loading block HTML:', error);
        });

})(window.wp);

console.log("Custom block JavaScript loaded");
