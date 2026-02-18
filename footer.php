    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="footer-content">
            <?php
            // Display footer menu if it exists
            if ( has_nav_menu( 'footer' ) ) {
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'depth'          => 1,
                        'container'      => 'nav',
                        'container_class' => 'footer-navigation',
                    )
                );
            }
            ?>

            <div class="site-info">
                <?php
                printf(
                    esc_html__( '&copy; %1$s %2$s. All rights reserved.', 'clean-modern-theme' ),
                    date( 'Y' ),
                    get_bloginfo( 'name' )
                );
                ?>
                <span class="sep"> | </span>
                <?php
                printf(
                    esc_html__( 'Powered by %1$s', 'clean-modern-theme' ),
                    '<a href="' . esc_url( __( 'https://wordpress.org/', 'clean-modern-theme' ) ) . '">WordPress</a>'
                );
                ?>
            </div><!-- .site-info -->
        </div><!-- .footer-content -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
