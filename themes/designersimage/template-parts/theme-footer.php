<?php 
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME FOOTER                                 |
 *  ##################################################
*/

$contact_info = get_option( 'di_theme_ci' );
$contact_phone_formatted = isset($contact_info[ 'contact_phone' ]) ? '+1 (' . substr($contact_info[ 'contact_phone' ], 0, 3) . ') ' . substr($contact_info[ 'contact_phone' ], 3, 3) . '-' . substr($contact_info[ 'contact_phone' ], 6) : '';
$args = array(
    'name' => 'services',
    'post_type' => 'page',
    'post_status' => 'publish',
    'numberposts' => 1,
);

$services_page = get_posts($args);

$subpages = get_pages( array(
    'title_li'    => '',
    'child_of'    => $services_page[0]->ID,
    'sort_column' => 'menu_order'
) );
?>

<footer class="di-footer__main">

    <div class="di-footer__info">
        <div class="container">
            <div class="footer_logo">
                <?php get_template_part( 'img/svg/logo', 'di_logo.svg' ); ?>
                <h3><?php bloginfo( 'name' ); ?></h3>
            </div>
            <div class="divider_events"></div>
            <div class="events">
                <h3>Community Events</h3>
                <div class="footer_bar"></div>
                <?php echo do_shortcode( '[event-list-footer]' ) ?>
            </div>
            <div class="divider_services"></div>
            <div class="services">
                <h3>Services</h3>
                <div class="footer_bar"></div>
                <?php echo do_shortcode( '[service-links-footer]' ) ?>
            </div>
            <div class="divider_contact"></div>
            <div class="contact_info">
                <h3>Contact Info</h3>
                <div class="footer_bar"></div>
                <div class="info">
                    <div class="phone">
                        <div class="icon">
                            <?php get_template_part( 'img/svg/icon', 'phone.svg' ); ?>
                        </div>
                        <a href="tel: +1<?php echo $contact_info['contact_phone'] ?>"><?php echo $contact_phone_formatted ?></a>
                    </div>
                    <div class="email">
                        <div class="icon">
                            <?php get_template_part( 'img/svg/icon', 'email.svg' ); ?>
                        </div>
                        <a href="mailto: <?php echo $contact_info['contact_email'] ?>"><?php echo $contact_info['contact_email'] ?></a>
                    </div>
                    <div class="website">
                        <div class="icon">
                            <?php get_template_part( 'img/svg/icon', 'website.svg' ); ?>
                        </div>
                        <a href="<?php echo $contact_info['contact_website'] ?>"><?php echo $contact_info['contact_website'] ?></a>
                    </div>
                    <div class="location">
                        <div class="icon">
                            <?php get_template_part( 'img/svg/icon', 'location.svg' ); ?>
                        </div>
                        <span>Fresno, CA</span>
                    </div>
                </div>
                <div class="social">
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
            </div>
        </div>
    </div>

    <div class="di-footer__nav">
        <div class="container">

            <div class="copyright">Copyright &copy; <?php echo date("Y"); ?> <a href="<?php echo home_url( '/' ); ?>" class="link-copyright"><?php bloginfo( 'name' ); ?></a>. All Rights Reserved.</div>

            <nav class="di-menu__footer" id="di-menu__footer">
                <?php
                    $args = array(
                        'theme_location' => 'footer',
                        'container' => false,
                        'menu_class' => 'di-menu__footer-nav',
                        // 'walker' => new WalkerNavPrimary()
                    );
                    wp_nav_menu( $args );
                ?>
            </nav>

        </div>
    </div>

</footer>