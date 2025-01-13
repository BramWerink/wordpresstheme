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

// Custom Blocks registration
add_action('init', function () {

    // Editor script for the block
    wp_register_script(
        'block-editor-script', // Handle
        get_template_directory_uri() . '/blocks/hero/editor.js', // Path to JS
        ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'], // Dependencies
        filemtime(get_template_directory() . '/blocks/hero/editor.js') // Cache busting
    );

    // Editor styles for the block
    wp_register_style(
        'block-editor-style', // Handle
        get_template_directory_uri() . '/blocks/hero/editor.css', // Path to CSS
        [], // Dependencies
        filemtime(get_template_directory() . '/blocks/hero/editor.css') // Cache busting
    );
    
    // Frontend styles for the block
    wp_register_style(
        'block-front-end-style', // Handle
        get_template_directory_uri() . '/blocks/hero/style.css', // Path to CSS
        [], // Dependencies
        filemtime(get_template_directory() . '/blocks/hero/style.css') // Cache busting
    );

    // Register the block type with the block.json configuration
    register_block_type(get_template_directory() . '/blocks/hero/block.json');
});

// Adding support for admin bar
add_theme_support('admin-bar');

?>
