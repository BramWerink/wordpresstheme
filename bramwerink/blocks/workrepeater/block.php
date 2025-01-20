<?php
// Custom query for posts in the 'portfolio' category
$args = array(
    'category_name' => 'portfolio',  // Query posts from the 'portfolio' category
    'posts_per_page' => -1,          // Retrieve all posts (you can limit it if needed)
);

$portfolio_query = new WP_Query( $args );

if ( $portfolio_query->have_posts() ) : 
    while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
        ?>
        <div class="portfolio-post">
            <h2><?php the_title(); ?>title</h2>
            <div class="portfolio-excerpt">
                <?php the_excerpt(); ?>
            </div>
        </div>
        <?php
    endwhile;
    wp_reset_postdata(); // Reset post data after custom query
else :
    echo '<p>No portfolio posts found.</p>';
endif;

echo 'test'; // Debug output, check if it's displaying
?>
