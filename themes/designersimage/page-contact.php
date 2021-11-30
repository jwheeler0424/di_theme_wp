<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME CONTACT PAGE                           |
 *  ##################################################
*/
?>
<?php get_header(); ?>

    <div id="primary" class="content-area">
    
        <main id="main" class="site-main" role="main">
            
            <section class="contact-main">
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
                <div class="bg">
                    <?php get_template_part( 'img/svg/bg', 'contact.svg' ); ?>
                </div>
            </section>
            
        </main>
    </div>

<?php get_footer(); ?>