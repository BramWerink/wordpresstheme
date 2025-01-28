<!DOCTYPE html>
<html>
    <head>
        <title>Bram Werink</title>
        <?php wp_head(); ?>
        <style>
            .notfound ul{
                list-style-type: none;
                padding: 0;
            }

            .notfound ul li{
                display: inline;
            }

            .notfound ul li a{
                color: var(--blue);
                padding: 1rem;
            }

            .notfound .col-12{
                display:flex;
                flex-direction: column;
                gap:1rem;
                justify-content: center;
            }

            .notfound h1{
                padding-top:10rem;
            }
        </style>
    </head>
    <body>
        <?php get_header(); ?>

        <div class="notfound">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <h1>This pagina kon niet worden gevonden</h1>
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
