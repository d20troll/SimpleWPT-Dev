<?php
/**
 * The template for displaying single posts
 *
 * @package Clean_Modern_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container-narrow">

        <?php
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail( 'clean-modern-featured' ); ?>
                    </div>
                <?php endif; ?>

                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <?php clean_modern_theme_post_meta(); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    the_content(
                        sprintf(
                            wp_kses(
                                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'clean-modern-theme' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post( get_the_title() )
                        )
                    );

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'clean-modern-theme' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

                <footer class="entry-footer">
                    <?php
                    echo '<div class="post-categories">';
                    clean_modern_theme_categories();
                    echo '</div>';
                    
                    echo '<div class="post-tags">';
                    clean_modern_theme_tags();
                    echo '</div>';
                    ?>
                </footer><!-- .entry-footer -->

            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

            // Previous/Next post navigation
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'clean-modern-theme' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'clean-modern-theme' ) . '</span> <span class="nav-title">%title</span>',
                )
            );

        endwhile; // End of the loop
        ?>

    </div><!-- .container-narrow -->
</main><!-- #primary -->

<?php
get_footer();
