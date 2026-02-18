<?php
/**
 * The template for displaying archive pages
 *
 * @package Clean_Modern_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <div class="posts-grid">
                <?php
                // Start the Loop
                while ( have_posts() ) :
                    the_post();
                    ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-card-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'clean-modern-card' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="post-card-content">
                            <header class="entry-header">
                                <?php
                                if ( 'post' === get_post_type() ) {
                                    clean_modern_theme_post_meta();
                                }
                                
                                the_title( '<h2 class="post-card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                ?>
                            </header><!-- .entry-header -->

                            <div class="post-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="read-more">
                                <?php esc_html_e( 'Read More', 'clean-modern-theme' ); ?> &rarr;
                            </a>
                        </div><!-- .post-card-content -->

                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php
                endwhile;
                ?>
            </div><!-- .posts-grid -->

            <?php
            // Pagination
            clean_modern_theme_pagination();

        else :
            ?>

            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'clean-modern-theme' ); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'clean-modern-theme' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .page-content -->
            </section><!-- .no-results -->

            <?php
        endif;
        ?>

    </div><!-- .container -->
</main><!-- #primary -->

<?php
get_footer();
