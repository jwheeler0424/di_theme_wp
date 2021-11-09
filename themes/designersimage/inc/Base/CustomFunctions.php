<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME CUSTOM FUNCTIONS                       |
 *  ##################################################
*/

namespace ThemeInc\Base;

class CustomFunctions
{
    public function register() {
        
        add_action( 'wp_enqueue_scripts', array( $this, 'alt_text_display' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'di_posted_meta' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'di_posted_footer' ) );

    }

    public static function alt_text_display()
    {
    
        $data =  get_object_vars(get_theme_mod('header_image_data'));
        
        if ( $data ) {
            $image_id = is_array($data) && isset($data['attachment_id']) ? $data['attachment_id'] : false;
    
            if ($image_id) {
    
                $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
                return $image_alt;
    
            }
        }
    }

    public function di_posted_meta() {
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
    
    public function di_posted_footer() {
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

}