<!DOCTYPE html>
<html>
    <head>
        <title>Bram Werink</title>
        <?php wp_head(); ?>
    </head>
    <body>
        <?php get_header(); ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); // Setup the post data ?>
                <?php the_content(); // Display the content (including Gutenberg blocks) ?>
            <?php endwhile; // End the while loop ?>
        <?php endif; // End the if statement ?>
        <?php get_footer(); ?>
    </body>
</html>
