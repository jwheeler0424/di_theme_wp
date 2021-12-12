<?php 
/**
 *  @package diPlugin
 *  ##################################################
 *  |   USER AUTHORIZATION CUSTOM TEMPLATE           |
 *  ##################################################
*/
?>

<?php get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <section class="auth-main">    
                <div class="container">
                    <?php
                        if ( have_posts() ):

                            while ( have_posts() ) : the_post();?>
                                
                                <h2><?php the_title() ?></h2>
                                <?php the_content() ?>

                            <?php endwhile;

                        endif;
                    ?>
                </div>
            </section>
        </main>
    </div>

<?php get_footer(); ?>