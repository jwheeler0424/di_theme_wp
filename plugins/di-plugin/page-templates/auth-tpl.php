<?php 
/**
 *  @package diPlugin
 *  ##################################################
 *  |   USER AUTHORIZATION CUSTOM TEMPLATE           |
 *  ##################################################
*/
$path = get_page_uri();
$page_slug = strtok($path, '/');

if ( is_user_logged_in() ) {
    $user = wp_get_current_user();
    if ( user_can( $user, 'manage_options' ) ) {
        wp_redirect( admin_url() );
    } elseif ( $user->roles[0] === 'member') {
        wp_redirect( home_url( 'member-account' ) );
    } else {
        wp_redirect( home_url( 'client-account' ) );
    }
    exit;
}

if ( $page_slug == 'member-register' && !get_option( 'users_can_register' ) ) {
    wp_redirect( home_url( 'member-login' ) );
    exit;
}

if ( $page_slug == 'member-password-reset' && ( !isset($_REQUEST['login']) || !isset($_REQUEST['key']) ) ) {
    wp_redirect( home_url( 'member-password-lost?errors=invalidkey' ) );
    exit;
}

if ( $page_slug == 'member-password-lost' && !get_option( 'users_can_register' ) ) {
    wp_redirect( home_url( 'member-login' ) );
    exit;
}



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