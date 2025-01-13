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

// Custom blocks
add_action('init', function () {

 ?>
    <script>
        console.log('Checking if block.json exists:');
        <?php if ( file_exists(get_template_directory() . '/blocks/custom-block/block.json') ) : ?>
            console.log("block.json file exists");
        <?php else : ?>
            console.log("block.json file NOT found");
        <?php endif; ?>
    </script>
    <?php

    // Editor script
    wp_register_script(
        'bramwerink-custom-block-editor-script', // handle
        get_template_directory_uri() . '/blocks/custom-block/editor.js', // Make sure the path is correct
        ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'], // Dependencies
        filemtime(get_template_directory() . '/blocks/custom-block/editor.js') // Cache busting
    );

    // Editor styles
    wp_register_style(
        'blocks/custom-block-editor-style', // Correct handle
        get_template_directory_uri() . '/blocks/custom-block/editor.css', // Make sure the path is correct
        [], // Dependencies (if any)
        filemtime(get_template_directory() . '/blocks/custom-block/editor.css') // Cache busting
    );
    
    // Frontend styles
    wp_register_style(
        'blocks/custom-block-style', // Correct handle
        get_template_directory_uri() . '/blocks/custom-block/style.css', // Make sure the path is correct
        [], // Dependencies (if any)
        filemtime(get_template_directory() . '/blocks/custom-block/style.css') // Cache busting
    );
    
    // Register block
    register_block_type(get_template_directory() . '/blocks/custom-block/block.json'); // Make sure the path is correct
});

add_theme_support('admin-bar');

?>
