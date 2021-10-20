<?php 
    /* 
        @package designersimage
        ========================================
        |   HEADER TEMPLATE                    |
        ========================================
    */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php bloginfo( 'name' ); wp_title(); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

    <header class="header-container">
        <div class="col-xs-12">

            <div class="container text-center">
                <div class="header-content">
                    <a href="#">
                        <img class="site-logo" src="<?php header_image() ?>" alt="<?php echo alt_text_display(); ?>" />
                        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                    </a>
                </div><!-- .header-content -->
                <div class="nav-container">

                    <nav class="navbar navbar-expand-lg navbar-light navbar-di">
                        <?php
                            $args = array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'menu_class' => 'nav navbar-nav'
                            );
                            wp_nav_menu( $args );
                        ?>
                    </nav>

                </div><!-- .nav-container -->
            </div><!-- .header-container -->

        </div><!-- .col-xs-12 -->
    </header>