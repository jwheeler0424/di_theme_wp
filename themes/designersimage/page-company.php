<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME COMPANY PAGE                           |
 *  ##################################################
*/
?>

<?php get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container">
                <div class="company-links">
                    
                </div>
                <?php
                    if ( have_posts() ):

                        while ( have_posts() ) : the_post();?>

                            <h2><?php the_title() ?></h2>
                            <p><?php the_content() ?></p>

                        <?php endwhile;

                    endif;
                ?>
            </div>
        </main>
    </div>

<?php get_footer(); ?>