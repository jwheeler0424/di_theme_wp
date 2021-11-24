<?php 
/**
 *  @package diTheme
 *  ##################################################
 *  |   CUSTOM HEADER                                |
 *  ##################################################
*/
    namespace ThemeInc\Base;

    if ( is_front_page() ):
        $theme_classes = array( 'home-class' );
    else:
        $theme_classes = array( 'page-class' );
    endif;
    
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, minimal-ui, initial-scale=1">
        <title><?php bloginfo( 'name' ); wp_title(); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>

<body <?php body_class( $theme_classes ); ?>>

    <header class="di-header__main">
        <div class="container">
        
            <a href="<?php echo home_url( '/' ); ?>" class="di-header__logo">
                <?php get_template_part( 'img/svg/inline', 'di_logo.svg' ); ?>
            </a>
            <a href="<?php echo home_url( '/' ); ?>" class="di-header__title">
                <h1><?php bloginfo( 'name' ); ?></h1>
            </a>

            <nav class="di-menu closed" id="di-menu">
                <?php
                    $args = array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'di-menu__nav',
                        // 'walker' => new WalkerNavPrimary()
                    );
                    wp_nav_menu( $args );
                    get_search_form();
                ?>
            </nav>

            <button class="di-menu-toggle closed" id="di-menu-toggle" type="button">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </button>

        </div>
    </header>