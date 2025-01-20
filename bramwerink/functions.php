<?php 

// Function to register general styles (if needed)
function register_styles() {
    wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'register_styles');

// Add theme support for custom logo
function my_theme_setup() {
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'my_theme_setup');

// Enable theme support for menus
function mytheme_register_menus() {
    add_theme_support('menus');
}
add_action('after_setup_theme', 'mytheme_register_menus');

// Register navigation menu
function register_my_menu() {
    register_nav_menu('main-nav', 'Main Navigation');
}
add_action('after_setup_theme', 'register_my_menu');

// Add this in your theme's functions.php for block editor support
add_action('after_setup_theme', function () {
    add_theme_support('editor-styles');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
});

// Adding support for admin bar
add_theme_support('admin-bar');

// Custom Blocks registration
add_action('init', function () {
    $blocks_dir = get_template_directory() . '/blocks/';
    $block_folders = glob($blocks_dir . '*', GLOB_ONLYDIR);

    foreach ($block_folders as $block_folder) {
        $block_json_path = $block_folder . '/block.json';

        if (file_exists($block_json_path)) {
            // Automatically register the block using block.json
            register_block_type($block_folder);

            // Optionally enqueue additional assets if necessary
            $editor_js = $block_folder . '/editor.js';
            $editor_css = $block_folder . '/editor.css';
            $style_css = $block_folder . '/style.css';

            if (file_exists($editor_js)) {
                wp_enqueue_script(
                    basename($block_folder) . '-editor-script',
                    get_template_directory_uri() . '/blocks/' . basename($block_folder) . '/editor.js',
                    ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'],
                    filemtime($editor_js),
                    true // Load in the footer
                );
            }

            if (file_exists($editor_css)) {
                wp_enqueue_style(
                    basename($block_folder) . '-editor-style',
                    get_template_directory_uri() . '/blocks/' . basename($block_folder) . '/editor.css',
                    [],
                    filemtime($editor_css)
                );
            }

            if (file_exists($style_css)) {
                wp_enqueue_style(
                    basename($block_folder) . '-style',
                    get_template_directory_uri() . '/blocks/' . basename($block_folder) . '/style.css',
                    [],
                    filemtime($style_css)
                );
            }
        }
    }
});

function bramwerink_render_svg($atts) {
    // Parse shortcode attributes
    $atts = shortcode_atts(
        [
            'path' => '', // Relative path to the SVG file
        ],
        $atts,
        'svg'
    );

    // Validate and construct the full file path
    $svg_path = get_stylesheet_directory() . '/' . ltrim($atts['path'], '/');

    // Check if the file exists and is readable
    if (file_exists($svg_path) && is_readable($svg_path)) {
        // Get the SVG file contents
        $svg_content = file_get_contents($svg_path);
        return $svg_content;
    }

    // Return an error message if the SVG couldn't be loaded
    return '<!-- SVG not found: ' . esc_html($atts['path']) . ' -->';
}
add_shortcode('svg', 'bramwerink_render_svg');


?>
