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
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

    <header class="header-container">

        <div class="row">
            <div class="col-xs-12">

                <div class="container text-center">
                    <div class="header-content">
                        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                    </div> <!-- .header-content -->
                    <div class="nav-container"></div> <!-- .nav-container -->
                </div> <!-- .header-container -->

            </div> <!-- .col-xs-12 -->
        </div> <!-- .row -->

    </header>