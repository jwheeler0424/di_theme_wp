<?php

/* 
    @package designersimage 
    ========================================
    |   THEME SUPPORT                      |
    ========================================
*/

$options = get_option( 'post_formats' );
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$output = array();

foreach ( $formats as $format ) {
    $output[] = ( @$options[$format] == 1 ? $format : '');
}
if ( !empty( $options ) ) {
    add_theme_support( 'post-formats', $output );
}

$header = get_option( 'custom_header' );
if ( @$header == 1) {
    add_theme_support( 'custom-header');
}

$background = get_option( 'custom_background' );
if ( @$background == 1) {
    add_theme_support( 'custom-background');
}

add_theme_support( 'post-thumbnails' );

/* Activate Nav Menu Option */
function di_register_nav_menu() {
    register_nav_menu( 'primary', 'Header Navigation Menu' );
}
add_action( 'after_setup_theme', 'di_register_nav_menu' );

/*
    ========================================
    |   BLOG LOOP CUSTOM FUNCTIONS         |
    ========================================
*/

function di_posted_meta() {
    $posted_on = human_time_diff( get_the_time('U'), current_time('timestamp') );

    $categories = get_the_category();
    $separator = ', ';
    $output = '';
    $i = 1;

    if ( !empty($categories) ):
        foreach ( $categories as $category ):

            ( $i > 1 ) ? $output .= $separator : '';

            $output .= '<a href="'. esc_url( get_category_link( $category->term_id) ) .'" alt="'. esc_attr( 'View all posts in%s', $category->name ) .'">'. esc_html( $category->name ) .'</a>';
            $i++;
        endforeach;
    endif;

    return '<span class="posted-on">Posted <a href="'. esc_url( get_permalink() ) .'">'. $posted_on .'</a> ago</span> / <span class="posted-in">'. $output .'</span>';
}

function di_posted_footer() {
    $tags = get_the_tag_list( '<div class="tags-list"><span class="material-icons">sell</span>', ' ', '</div>' );
    $comments_num = get_comments_number();
    
    if ( comments_open() ) {
        // get comments link
        if ( $comments_num == 0 ) {
            $comments = __('No Comments');
        } else if ( $comments_num > 1 ) {
            $comments = $comments_num . __(' Comments');
        } else {
            $comments = __('1 Comment');
        }
        $comments = '<a href="'. get_comments_link() .'">'. $comments .' <span class="material-icons">mode_comment</span></a>';        
    } else {
        $comments = __('Comments are closed');
    }

    return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'. $tags .'</div><div class="col-xs-12 col-sm-6">'. $comments .'</div></div></div>';
}