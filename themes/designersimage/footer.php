<?php 
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME FOOTER                                 |
 *  ##################################################
*/
?>
        <?php 
            $slug = basename(get_permalink());

            if ( $slug !== basename(get_site_url())) {
                get_template_part( 'template-parts/theme', 'footer' );
            }
        ?>

        <div class="modal">
            <div class="modal-content">
                <button class="close" disabled>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </button>
                <h3></h3>
                <main class="content"></main>
                <?php get_template_part( 'img/svg/loader', 'wedges.svg' ); ?>
                <button class="btn btn-cancel" disabled>Cancel</button>
                <button class="btn btn-submit">Okay</button>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>