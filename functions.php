<?php

function register_theme_styles() {
    // Enqueue the root style.css file in the theme's root directory
    wp_enqueue_style('main-style', get_stylesheet_uri(), array(), '1.0', 'all');

    // Base directory for additional styles
    $base_directory = get_template_directory() . '/styles';

    // Use RecursiveDirectoryIterator to find all .css files inside the styles directory
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base_directory));
    $css_files = array();

    foreach ($iterator as $file) {
        // Check if the file is a CSS file
        if ($file->isFile() && pathinfo($file->getFilename(), PATHINFO_EXTENSION) === 'css') {
            $css_files[] = $file->getPathname();
        }
    }

    // Enqueue each CSS file from the styles directory
    foreach ($css_files as $file_path) {
        // Convert the file path to a URL
        $file_url = str_replace(get_template_directory(), get_template_directory_uri(), $file_path);

        // Generate a unique handle for each file (based on its path)
        $handle = 'style-' . md5($file_path);

        // Enqueue the CSS file
        wp_enqueue_style($handle, $file_url, array(), '1.0', 'all');
    }
}
add_action('wp_enqueue_scripts', 'register_theme_styles');


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

// sitemap
function register_my_menus() {
  register_nav_menus(
    array(
      'sitemap' => __( 'Site Map' ),
     )
   );
 }
 add_action( 'init', 'register_my_menus' );

// Add this in your theme's functions.php for block editor support
add_action('after_setup_theme', function () {
    add_theme_support('editor-styles');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
});

// Adding support for admin bar
add_theme_support('admin-bar');

// Register Custom Blocks and Enqueue Assets
add_action('init', function () {
    $blocks_dir = get_template_directory() . '/blocks/';
    $block_folders = glob($blocks_dir . '*', GLOB_ONLYDIR);

    foreach ($block_folders as $block_folder) {
        $block_json_path = $block_folder . '/block.json';

        if (file_exists($block_json_path)) {
            // Enqueue assets if necessary
            $editor_js = $block_folder . '/editor.js';
            $editor_css = $block_folder . '/editor.css';
            $style_css = $block_folder . '/style.css';

            if (file_exists($editor_js)) {
                wp_enqueue_script(
                    basename($block_folder) . '-editor-script',
                    get_template_directory_uri() . '/blocks/' . basename($block_folder) . '/editor.js',
                    ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'],
                    filemtime($editor_js),
                    true
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

            // Register the block and set the render_callback to the PHP function
            register_block_type_from_metadata($block_json_path, [
                'render_callback' => 'render_dynamic_block', // Render callback for dynamic blocks
            ]);
        }
    }
});

// Generic Render Callback for All Blocks
function render_dynamic_block($attributes, $content) {
    // Determine the block's folder name
    $block_name = str_replace('blocks/', '', $attributes['name']);
    $block_folder = get_template_directory() . '/blocks/' . $block_name;

    // Make sure block.php exists before including
    if (file_exists($block_folder . '/block.php')) {
        ob_start();
        include $block_folder . '/block.php'; // Include the block's PHP file
        return ob_get_clean();
    }

    return $content; // Return content if block.php doesn't exist
}

// Define the custom block rendering function
function render_workrepeater_block($attributes) {
    // Ensure you're in the correct post context
    $post_id = get_the_ID(); // Get the current post ID
    
    // Get the ACF field value for 'bedrijfsnaam'
    $bedrijfsnaam = get_field('bedrijfsnaam', $post_id); // Pass the post ID to ensure ACF retrieves the correct value
    
    // Return the HTML output based on the ACF value
    if ($bedrijfsnaam) {
        return '<p>' . esc_html($bedrijfsnaam) . '</p>';
    } else {
        return '<p>No value for bedrijfsnaam</p>';
    }
}

// Handle SVG Shortcode Rendering (if needed)
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

function my_custom_theme_editor_styles() {
    add_editor_style('styles/style.css'); // Replace with the path to your stylesheet.
}
add_action('admin_init', 'my_custom_theme_editor_styles');


function custom_image_sizes() {
    // Add a custom image size with hard cropping
    add_image_size('custom-cropped', 800, 600, true); // Width: 800px, Height: 600px
}
add_action('after_setup_theme', 'custom_image_sizes');

add_theme_support( 'spacing' );
add_theme_support( 'custom-line-height' );
add_theme_support( 'custom-units' );
add_theme_support( 'block-editor-settings' );
add_theme_support( 'align-wide' );



?>

