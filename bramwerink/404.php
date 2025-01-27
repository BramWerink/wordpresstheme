<!DOCTYPE html>
<html>
    <head>
        <title>Bram Werink</title>
        <?php wp_head(); ?>
    </head>
    <body>
        <?php get_header(); ?>

        <div class="404">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <h1 style="padding-top:10rem">This pagina kon niet worden gevonden</h1>
            <p>Deze pagina bestaat niet, controleer de URL of bezoek een andere pagina</p>
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'site-map', // Match the registered menu location
                    'menu_class' => 'site-map', // Optional: Add custom classes for styling
                ) );
                ?>
                    </div>
                </div>
            </div>
            
        </div>
    </body>
</html>
