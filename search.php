<?php
/**
 * The template for displaying search results
 *
 * @package Clean_Modern_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf(
                        esc_html__( 'Search Results for: %s', 'clean-modern-theme' ),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </header><!-- .page-header -->

            <div class="posts-grid">
                <?php
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
                                <?php the_title( '<h2 class="post-card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                            </header>

                            <div class="post-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="read-more">
                                <?php esc_html_e( 'Read More', 'clean-modern-theme' ); ?> &rarr;
                            </a>
                        </div>

                    </article>

                    <?php
                endwhile;
                ?>
            </div>

            <?php clean_modern_theme_pagination(); ?>

        else :
            ?>

            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'clean-modern-theme' ); ?></h1>
                </header>

                <div class="page-content">
                    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'clean-modern-theme' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </section>

            <?php
        endif;
        ?>

    </div>
</main>

<?php
get_footer();
