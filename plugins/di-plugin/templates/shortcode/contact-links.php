<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN CONTACT LINKS                         |
 *  ##################################################
*/

$contact_info = get_option( 'di_theme_ci' );
?>

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
    <a class="facebook" href="<?php echo $contact_info['contact_facebook'] ?>" target="_blank">
        <?php get_template_part( 'img/svg/icon', 'facebook.svg' ); ?>
    </a>
    <?php
        endif;

        if ( isset($contact_info['contact_instagram']) && $contact_info['contact_instagram'] != '' ):
    ?>
    <a class="instagram" href="<?php echo $contact_info['contact_instagram'] ?>" target="_blank">
        <?php get_template_part( 'img/svg/icon', 'instagram.svg' ); ?>
    </a>
    <?php
        endif;
        
        if ( isset($contact_info['contact_twitter']) && $contact_info['contact_twitter'] != '' ):
    ?>
    <a class="twitter" href="<?php echo $contact_info['contact_twitter'] ?>" target="_blank">
        <?php get_template_part( 'img/svg/icon', 'twitter.svg' ); ?>
    </a>
    <?php
        endif;
        
        if ( isset($contact_info['contact_youtube']) && $contact_info['contact_youtube'] != '' ):
    ?>
    <a class="youtube" href="<?php echo $contact_info['contact_youtube'] ?>" target="_blank">
        <?php get_template_part( 'img/svg/icon', 'youtube.svg' ); ?>
    </a>
    <?php
        endif;
        
        if ( isset($contact_info['contact_github']) && $contact_info['contact_github'] != '' ):
    ?>
    <a class="github" href="<?php echo $contact_info['contact_github'] ?>" target="_blank">
        <?php get_template_part( 'img/svg/icon', 'github.svg' ); ?>
    </a>
    <?php
        endif;
        
        if ( isset($contact_info['contact_linkedin']) && $contact_info['contact_linkedin'] != '' ):
    ?>
    <a class="linkedin" href="<?php echo $contact_info['contact_linkedin'] ?>" target="_blank">
        <?php get_template_part( 'img/svg/icon', 'linkedin.svg' ); ?>
    </a>
    <?php
        endif;
    ?>
</div>