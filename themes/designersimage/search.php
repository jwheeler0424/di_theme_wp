<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME SEARCH RESULTS PAGE                    |
 *  ##################################################
*/
?>

<?php get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container">
            <?php
                    if ( have_posts() ):

                        while ( have_posts() ) : the_post();?>

                            <?php get_template_part( 'content', 'search' ); ?>

                        <?php endwhile;

                    endif;
                ?>
            </div>
        </main>
    </div>

<?php get_footer(); ?>