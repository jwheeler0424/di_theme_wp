<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME HOME PAGE                              |
 *  ##################################################
*/

?>
<?php get_header(); ?>
    <div id="primary" class="content-area">
    
        <main id="main" class="site-main" role="main">
            <?php get_template_part( 'template-parts/theme', 'header' ); ?>
            <?php
                if ( have_posts() ):

                    while ( have_posts() ) : the_post();?>

                        <?php echo do_shortcode(the_content()) ?>

                    <?php endwhile;

                endif;
            ?>
            <?php get_template_part( 'template-parts/theme', 'footer' ); ?>
        </main>
    </div>
<?php get_footer(); ?>