<?php 
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME HEADER                                 |
 *  ##################################################
*/
    namespace Theme\Base;

?>

<header class="di-header__main">
    <div class="container">
    
        <a href="<?php echo home_url( '/' ); ?>" class="di-header__logo">
            <?php get_template_part( 'img/svg/logo', 'di_logo.svg' ); ?>
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
                    //'walker' => new WalkerNavPrimary()
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