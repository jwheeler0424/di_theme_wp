<?php 
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME HEADER                                 |
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
        <title><?php bloginfo( 'name' ); wp_title('|', true, 'left'); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>

<body <?php body_class( $theme_classes ); ?>>

    <?php 
        $slug = basename(get_permalink());

        if ( $slug !== basename(get_site_url())) {
            get_template_part( 'template-parts/theme', 'header' );
        }
    ?>