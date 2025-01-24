<footer>
    <?php
    if (function_exists('the_custom_logo') && has_custom_logo()) {
    the_custom_logo(); // Displays the custom logo
} else {
    // Fallback if no custom logo is set
    echo '<a href="' . esc_url(home_url('/')) . '">' . bloginfo('name') . '</a>';
}
?>
    <p>Bram Werink</p>
</footer>