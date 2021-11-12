<?php 
/**
 *  @package diTheme
 *  ##################################################
 *  |   CUSTOM FOOTER                                |
 *  ##################################################
*/
?>
        <footer class="di-footer__main">

            <div class="di-footer__info">
                <div class="container"></div>
            </div>

            <div class="di-footer__nav">
                <div class="container">

                    <div class="copyright">Copyright &copy; <?php echo date("Y"); ?> <a href="<?php echo home_url( '/' ); ?>" class="link-copyright"><?php bloginfo( 'name' ); ?></a>. All Rights Reserved.</div>

                    <nav class="di-menu__footer" id="di-menu__footer">
                        <?php
                            $args = array(
                                'theme_location' => 'footer',
                                'container' => false,
                                'menu_class' => 'di-menu__footer-nav',
                                // 'walker' => new WalkerNavPrimary()
                            );
                            wp_nav_menu( $args );
                        ?>
                    </nav>

                </div>
            </div>

        </footer>

        <?php wp_footer(); ?>
    </body>
</html>