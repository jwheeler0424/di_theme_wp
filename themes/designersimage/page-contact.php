<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME CONTACT PAGE                           |
 *  ##################################################
*/

$contact_info = get_option( 'di_theme_ci' );
?>
<?php get_header(); ?>

    <div id="primary" class="content-area">
    
        <main id="main" class="site-main" role="main">
            
            <section class="contact-main">
                <div class="container">
                    <div class="contact-links">
                        <a href="tel: +1<?php echo $contact_info['contact_phone'] ?>">
                            <?php get_template_part( 'img/svg/icon', 'phone.svg' ); ?>
                        </a>
                        <a href="mailto: <?php echo $contact_info['contact_email'] ?>">
                            <?php get_template_part( 'img/svg/icon', 'mail.svg' ); ?>
                        </a>
                        <?php
                            if ( isset($contact_info['contact_facebook']) && $contact_info['contact_facebook'] != '' ):
                        ?>
                        <a class="facebook" href="<?php echo $contact_info['contact_facebook'] ?>">
                            <?php get_template_part( 'img/svg/icon', 'facebook.svg' ); ?>
                        </a>
                        <?php
                            endif;

                            if ( isset($contact_info['contact_instagram']) && $contact_info['contact_instagram'] != '' ):
                        ?>
                        <a class="instagram" href="<?php echo $contact_info['contact_instagram'] ?>">
                            <?php get_template_part( 'img/svg/icon', 'instagram.svg' ); ?>
                        </a>
                        <?php
                            endif;
                            
                            if ( isset($contact_info['contact_twitter']) && $contact_info['contact_twitter'] != '' ):
                        ?>
                        <a class="twitter" href="<?php echo $contact_info['contact_twitter'] ?>">
                            <?php get_template_part( 'img/svg/icon', 'twitter.svg' ); ?>
                        </a>
                        <?php
                            endif;
                            
                            if ( isset($contact_info['contact_youtube']) && $contact_info['contact_youtube'] != '' ):
                        ?>
                        <a class="youtube" href="<?php echo $contact_info['contact_youtube'] ?>">
                            <?php get_template_part( 'img/svg/icon', 'youtube.svg' ); ?>
                        </a>
                        <?php
                            endif;
                            
                            if ( isset($contact_info['contact_github']) && $contact_info['contact_github'] != '' ):
                        ?>
                        <a class="github" href="<?php echo $contact_info['contact_github'] ?>">
                            <?php get_template_part( 'img/svg/icon', 'github.svg' ); ?>
                        </a>
                        <?php
                            endif;
                            
                            if ( isset($contact_info['contact_linkedin']) && $contact_info['contact_linkedin'] != '' ):
                        ?>
                        <a class="linkedin" href="<?php echo $contact_info['contact_linkedin'] ?>">
                            <?php get_template_part( 'img/svg/icon', 'linkedin.svg' ); ?>
                        </a>
                        <?php
                            endif;
                        ?>
                    </div>
                    <div class="contact-form">
                        <?php
                            if ( have_posts() ):

                                while ( have_posts() ) : the_post();?>

                                    <h2><?php the_title() ?></h2>
                                    <div class="contact-bar"></div>
                                    <?php the_content() ?>

                                <?php endwhile;

                            endif;
                        ?>
                    </div>
                </div>
                <div class="bg">
                    <?php get_template_part( 'img/svg/bg', 'contact.svg' ); ?>
                </div>
            </section>
            
        </main>
    </div>

<?php get_footer(); ?>