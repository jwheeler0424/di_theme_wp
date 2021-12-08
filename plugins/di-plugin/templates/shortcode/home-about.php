<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN HOME ABOUT SECTION                    |
 *  ##################################################
*/
?>

<section class="home-about">
    <div class="top-left">
        <?php get_template_part( 'img/svg/bg', 'topLeft.svg' ); ?>
    </div>
    <div class="top-right">
        <?php get_template_part( 'img/svg/bg', 'topRight.svg' ); ?>
    </div>
    <div class="container">
    <?php echo do_shortcode($content); ?>
    </div>
</section>