<?php
/**
 * Clean Modern Theme Functions
 *
 * @package Clean_Modern_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function clean_modern_theme_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'clean-modern-theme', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 675, true );
    add_image_size( 'clean-modern-featured', 1200, 675, true );
    add_image_size( 'clean-modern-card', 600, 400, true );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'clean-modern-theme' ),
        'footer'  => esc_html__( 'Footer Menu', 'clean-modern-theme' ),
    ) );

    // Switch default core markup to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Add theme support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Add support for responsive embedded content
    add_theme_support( 'responsive-embeds' );

    // Add support for editor styles
    add_theme_support( 'editor-styles' );

    // Enqueue editor styles
    add_editor_style( 'style-editor.css' );

    // Add support for wide and full alignment
    add_theme_support( 'align-wide' );

    // Add support for Block Styles
    add_theme_support( 'wp-block-styles' );

    // Disable custom colors (use theme palette only)
    add_theme_support( 'disable-custom-colors' );

    // Disable custom font sizes (use theme sizes only)
    add_theme_support( 'disable-custom-font-sizes' );
}
add_action( 'after_setup_theme', 'clean_modern_theme_setup' );

/**
 * Set the content width in pixels
 */
function clean_modern_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'clean_modern_theme_content_width', 1200 );
}
add_action( 'after_setup_theme', 'clean_modern_theme_content_width', 0 );

/**
 * Enqueue scripts and styles
 */
function clean_modern_theme_scripts() {
    // Main stylesheet
    wp_enqueue_style( 'clean-modern-theme-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    // Mobile navigation script
    wp_enqueue_script( 
        'clean-modern-theme-navigation', 
        get_template_directory_uri() . '/js/navigation.js', 
        array(), 
        wp_get_theme()->get( 'Version' ), 
        true 
    );

    // Comments reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'clean_modern_theme_scripts' );

/**
 * ACF Integration - Check if ACF is active
 */
function clean_modern_theme_acf_check() {
    if ( ! class_exists( 'ACF' ) && current_user_can( 'activate_plugins' ) ) {
        add_action( 'admin_notices', 'clean_modern_theme_acf_notice' );
    }
}
add_action( 'admin_init', 'clean_modern_theme_acf_check' );

/**
 * Display admin notice if ACF is not active
 */
function clean_modern_theme_acf_notice() {
    ?>
    <div class="notice notice-warning is-dismissible">
        <p><?php esc_html_e( 'Clean Modern Theme: Advanced Custom Fields plugin is recommended for full theme functionality.', 'clean-modern-theme' ); ?></p>
    </div>
    <?php
}

/**
 * ACF Options Page (if needed)
 * Uncomment if you want theme options page
 */
/*
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( array(
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect'   => false
    ) );
}
*/

/**
 * Register Custom Post Type - Example
 * You can add more custom post types here or use ACF to create them
 */
function clean_modern_theme_register_post_types() {
    // Example: Portfolio Custom Post Type
    $portfolio_labels = array(
        'name'               => _x( 'Portfolio', 'post type general name', 'clean-modern-theme' ),
        'singular_name'      => _x( 'Portfolio Item', 'post type singular name', 'clean-modern-theme' ),
        'menu_name'          => _x( 'Portfolio', 'admin menu', 'clean-modern-theme' ),
        'add_new'            => _x( 'Add New', 'portfolio item', 'clean-modern-theme' ),
        'add_new_item'       => __( 'Add New Portfolio Item', 'clean-modern-theme' ),
        'new_item'           => __( 'New Portfolio Item', 'clean-modern-theme' ),
        'edit_item'          => __( 'Edit Portfolio Item', 'clean-modern-theme' ),
        'view_item'          => __( 'View Portfolio Item', 'clean-modern-theme' ),
        'all_items'          => __( 'All Portfolio', 'clean-modern-theme' ),
        'search_items'       => __( 'Search Portfolio', 'clean-modern-theme' ),
    );

    $portfolio_args = array(
        'labels'             => $portfolio_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true, // Enable Gutenberg
    );

    // Uncomment to register the portfolio post type
    // register_post_type( 'portfolio', $portfolio_args );
}
add_action( 'init', 'clean_modern_theme_register_post_types' );

/**
 * Register Custom Taxonomy - Example
 */
function clean_modern_theme_register_taxonomies() {
    // Example: Portfolio Category
    $category_labels = array(
        'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'clean-modern-theme' ),
        'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'clean-modern-theme' ),
        'search_items'      => __( 'Search Categories', 'clean-modern-theme' ),
        'all_items'         => __( 'All Categories', 'clean-modern-theme' ),
        'edit_item'         => __( 'Edit Category', 'clean-modern-theme' ),
        'update_item'       => __( 'Update Category', 'clean-modern-theme' ),
        'add_new_item'      => __( 'Add New Category', 'clean-modern-theme' ),
        'new_item_name'     => __( 'New Category Name', 'clean-modern-theme' ),
        'menu_name'         => __( 'Categories', 'clean-modern-theme' ),
    );

    $category_args = array(
        'labels'            => $category_labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'portfolio-category' ),
        'show_in_rest'      => true, // Enable Gutenberg
    );

    // Uncomment to register the taxonomy
    // register_taxonomy( 'portfolio_category', array( 'portfolio' ), $category_args );
}
add_action( 'init', 'clean_modern_theme_register_taxonomies' );

/**
 * Excerpt Length
 */
function clean_modern_theme_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'clean_modern_theme_excerpt_length' );

/**
 * Excerpt More
 */
function clean_modern_theme_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'clean_modern_theme_excerpt_more' );

/**
 * Add custom classes to body
 */
function clean_modern_theme_body_classes( $classes ) {
    // Add class if sidebar is active
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'has-sidebar';
    }

    // Add class for ACF
    if ( class_exists( 'ACF' ) ) {
        $classes[] = 'has-acf';
    }

    return $classes;
}
add_filter( 'body_class', 'clean_modern_theme_body_classes' );

/**
 * Pagination
 */
function clean_modern_theme_pagination() {
    if ( is_singular() ) {
        return;
    }

    global $wp_query;

    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

    $pagination_args = array(
        'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, $paged ),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
    );

    echo '<nav class="pagination">';
    echo paginate_links( $pagination_args );
    echo '</nav>';
}

/**
 * Template Tags
 */

/**
 * Display post meta
 */
function clean_modern_theme_post_meta() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    $time_string = sprintf(
        $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() )
    );

    $posted_on = sprintf(
        '<a href="%1$s" rel="bookmark">%2$s</a>',
        esc_url( get_permalink() ),
        $time_string
    );

    $byline = sprintf(
        '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_html( get_the_author() )
    );

    echo '<div class="entry-meta">';
    echo '<span class="posted-on">' . $posted_on . '</span>';
    echo '<span class="byline"> by ' . $byline . '</span>';

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'clean-modern-theme' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            )
        );
        echo '</span>';
    }

    echo '</div>';
}

/**
 * Display categories
 */
function clean_modern_theme_categories() {
    $categories_list = get_the_category_list( esc_html__( ', ', 'clean-modern-theme' ) );
    if ( $categories_list ) {
        printf( '<span class="cat-links">%1$s</span>', $categories_list );
    }
}

/**
 * Display tags
 */
function clean_modern_theme_tags() {
    $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'clean-modern-theme' ) );
    if ( $tags_list ) {
        printf( '<span class="tags-links">%1$s</span>', $tags_list );
    }
}
