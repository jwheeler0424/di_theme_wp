<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME TESTIMONIAL PAGE                       |
 *  ##################################################
*/
?>

<?php get_header(); ?>

    <div id="primary" class="content-area">
    
        <main id="main" class="site-main" role="main">
            
            <section class="testimonial-main">
                <div class="container">
                    <div class="testimonial-form">
                        <?php
                            if ( have_posts() ):

                                while ( have_posts() ) : the_post();?>

                                    <h2><?php the_title() ?></h2>
                                    <div class="bar"></div>
                                    <?php the_content() ?>

                                <?php endwhile;

                            endif;
                        ?>
                    </div>
                </div>
            </section>
            
        </main>
    </div>

<?php get_footer(); ?>