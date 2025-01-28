<!DOCTYPE html>
<html>
    <head>
<title>Bram Werink</title>
<?php wp_head(); ?>
<?php get_header()?>
    </head>
    <body>
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>
    <?php endwhile; ?>
<?php endif; ?>

        <p>Version 2</p>
    </body>
</html>