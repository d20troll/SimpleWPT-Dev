<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Clean_Modern_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container-narrow">

        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( '404 - Page Not Found', 'clean-modern-theme' ); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'clean-modern-theme' ); ?></p>

                <?php get_search_form(); ?>

                <div style="margin-top: 3rem;">
                    <h2><?php esc_html_e( 'Recent Posts', 'clean-modern-theme' ); ?></h2>
                    <?php
                    $recent_posts = wp_get_recent_posts( array(
                        'numberposts' => 5,
                        'post_status' => 'publish',
                    ) );

                    if ( $recent_posts ) {
                        echo '<ul>';
                        foreach ( $recent_posts as $recent ) {
                            printf(
                                '<li><a href="%1$s">%2$s</a></li>',
                                esc_url( get_permalink( $recent['ID'] ) ),
                                esc_html( $recent['post_title'] )
                            );
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>

            </div><!-- .page-content -->
        </section><!-- .error-404 -->

    </div><!-- .container-narrow -->
</main><!-- #primary -->

<?php
get_footer();
