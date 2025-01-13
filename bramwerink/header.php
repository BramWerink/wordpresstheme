<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="pill">
        <?php
if (function_exists('the_custom_logo') && has_custom_logo()) {
    the_custom_logo(); // Displays the custom logo
} else {
    // Fallback if no custom logo is set
    echo '<a href="' . esc_url(home_url('/')) . '">' . bloginfo('name') . '</a>';
}
?>


            <nav class="main-nav">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'main-nav', // Match the registered menu location
                    'menu_class' => 'menu', // Optional: Add custom classes for styling
                ) );
                ?>
            </nav>
        </div>
    </header>   