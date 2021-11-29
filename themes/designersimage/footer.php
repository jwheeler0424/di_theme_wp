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
                <button class="close">&times;</button>
                <h3></h3>
                <main class="content">

                </main>
                <button class="okay">Okay</button>
                <button class="cancel">Cancel</button>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>