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
                <svg id="di_logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 429.65 439.04">
                    <g id="di_box"><rect class="cls-1" x="97.98" y="102.98" width="233.09" height="233.09" transform="translate(-92.39 215.99) rotate(-45)"/><polygon class="cls-2" points="379.34 219.52 214.52 384.34 214.83 422.63 417.93 219.52 379.34 219.52"/><polygon class="cls-3" points="379.34 219.52 417.93 219.52 214.83 16.42 214.52 54.7 379.34 219.52"/><polygon class="cls-4" points="49.7 219.52 11.72 219.52 214.83 422.63 214.52 384.34 49.7 219.52"/><polygon class="cls-5" points="214.52 54.7 214.83 16.42 11.72 219.52 49.7 219.52 214.52 54.7"/></g><g id="di_stroke"><path class="cls-6" d="M221.46,280.54h-15V264.66h-.37q-10.4,18.07-32.11,18.07-17.61,0-28.15-12.55T135.34,236q0-23.18,11.67-37.14t31.11-13.95q19.26,0,28,15.14h.37V142.23h15Zm-15-42.24V224.52A26.76,26.76,0,0,0,199,205.36q-7.49-7.85-19-7.84-13.68,0-21.53,10t-7.85,27.74q0,16.14,7.53,25.5t20.21,9.35q12.49,0,20.3-9T206.5,238.3Z"/><path class="cls-6" d="M259.41,163.39a9.5,9.5,0,0,1-6.84-2.73,9.28,9.28,0,0,1-2.83-6.94,9.58,9.58,0,0,1,9.67-9.76,9.67,9.67,0,0,1,7,2.78,9.74,9.74,0,0,1,0,13.83A9.58,9.58,0,0,1,259.41,163.39Zm7.3,117.15h-15V187.11h15Z"/></g>
                </svg>
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