<?php
/**
 * @package diPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class ContactMessageController extends BaseController
{
    public $callbacks;
    public $subpages;
    public function register()
    {
        if ( !$this->activated( 'contact_manager' ) ) return;

        add_action( 'init', array( $this, 'contact_message_cpt' ) );
        // add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        // add_action( 'save_post', array( $this, 'save_meta_box' ) );
    }

    public function contact_message_cpt()
    {
        $labels = array(
            'name' => 'Contacts',
            'singular_name' => 'Contact'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'menu_icon' => 'dashicons-email-alt',
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'supports' => array( 'title', 'editor' )
        );

        register_post_type ( 'contact_message', $args );
    }

    // public function add_meta_boxes()
    // {
    //     add_meta_box (
    //         'testimonial_author',
    //         'Author',
    //         array( $this, 'render_author_box' ),
    //         'testimonial',
    //         'advanced',
    //         'default'
    //     );

    //     add_meta_box (
    //         'testimonial_email',
    //         'Email',
    //         array( $this, 'render_email_box' ),
    //         'testimonial',
    //         'advanced',
    //         'high'
    //     );

    // }

    public function render_author_box( $post )
    {
        wp_nonce_field( 'di_testimonial_author', 'di_testimonial_author_nonce' );

        $value = get_post_meta( $post->ID, '_di_testimonial_author_key', true );

        ?>

        <label for="di_testimonial_author">Testimonial Author</label>
        <input type="text" id="di_testimonial_author" name="di_testimonial_author" value="<?php echo esc_attr( $value ) ?>"

        <?php

    }

    public function render_email_box( $post )
    {
        wp_nonce_field( 'di_testimonial_email', 'di_testimonial_email_nonce' );

        $value = get_post_meta( $post->ID, '_di_testimonial_email_key', true );

        ?>

        <label for="di_testimonial_email">Author Email</label>
        <input type="text" id="di_testimonial_email" name="di_testimonial_email" value="<?php echo esc_attr( $value ) ?>"

        <?php
    }

    public function save_meta_box( $post_id )
    {
        if ( !isset( $_POST['di_testimonial_author_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['di_testimonial_author_nonce'];

        if ( !wp_verify_nonce( $nonce, 'di_testimonial_author' ) ) {
            return $post_id;
        }

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        $author = sanitize_text_field( $_POST['di_testimonial_author'] );
        update_post_meta( $post_id, '_di_testimonial_author_key', $author );

        $email = sanitize_text_field( $_POST['di_testimonial_email'] );
        update_post_meta( $post_id, '_di_testimonial_email_key', $email );
    }

}