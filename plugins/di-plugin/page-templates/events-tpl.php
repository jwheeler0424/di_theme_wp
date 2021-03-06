<?php 
/**
 *  @package diPlugin
 *  ##################################################
 *  |   EVENTS CUSTOM TEMPLATE                       |
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

                            <h3><?php the_title() ?></h3>
                            <p>The Events Section</p>
                            <p><?php the_content() ?></p>

                        <?php endwhile;

                    endif;
                ?>
            </div>
        </main>
    </div>

<?php get_footer(); ?>