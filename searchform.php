<?php
/**
 * Custom search form template
 *
 * @package Clean_Modern_Theme
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'clean-modern-theme' ); ?></span>
        <input 
            type="search" 
            class="search-field" 
            placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'clean-modern-theme' ); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s" 
        />
    </label>
    <button type="submit" class="search-submit">
        <?php echo esc_html_x( 'Search', 'submit button', 'clean-modern-theme' ); ?>
    </button>
</form>
