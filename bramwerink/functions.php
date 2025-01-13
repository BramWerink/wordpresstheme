<?php 

function register_styles() {
    wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.0', 'all');
}

// Add logo support
function my_theme_setup() {
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'my_theme_setup');

// Enable theme support for menus
function mytheme_register_menus() {
    add_theme_support('menus');
}
add_action('after_setup_theme', 'mytheme_register_menus');

add_action('wp_enqueue_scripts', 'register_styles');

// Register the menu location
function register_my_menu() {
    register_nav_menu('main-nav', 'Main Navigation');
}
add_action('after_setup_theme', 'register_my_menu');

// Add this in your theme's functions.php
add_action('after_setup_theme', function () {
    add_theme_support('editor-styles');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
});

add_action('init', function () {
    // Register the editor script
    wp_register_script(
        'block-editor-script',
        get_template_directory_uri() . '/blocks/custom-block/editor.js',
        ['wp-blocks', 'wp-i18n', 'wp-element', 'wp-block-editor'], // Dependencies
        filemtime(get_template_directory() . '/blocks/custom-block/editor.js')
    );

    // Register the editor styles
    wp_register_style(
        'block-editor-style',
        get_template_directory_uri() . '/blocks/custom-block/editor.css',
        [],
        filemtime(get_template_directory() . '/blocks/custom-block/editor.css')
    );

    // Register the frontend styles
    wp_register_style(
        'blocks/custom-block-style',
        get_template_directory_uri() . '/blocks/custom-block/style.css',
        [],
        filemtime(get_template_directory() . '/blocks/custom-block/style.css')
    );

    // Register the block using block.json
    register_block_type(
        get_template_directory() . '/blocks/custom-block/block.json'
    );
});


add_theme_support('admin-bar');

?>
