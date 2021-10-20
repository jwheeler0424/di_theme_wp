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

    <div class="header-container">
        <header class="container text-center">
            <div class="header-content">
                <a href="#">
                    <img class="site-logo" src="<?php header_image() ?>" alt="<?php echo alt_text_display(); ?>" />
                    <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                </a>
            </div><!-- .header-content -->
            <div class="nav-container">

                <nav class="navbar-di">
                    <?php
                        $args = array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'navbar-di__menu',
                            'walker' => new di_Walker_Nav_Primary
                        );
                        wp_nav_menu( $args );
                    ?>
                </nav>

            </div><!-- .nav-container -->
        </header><!-- .header-container -->

    </div><!-- .header-container -->