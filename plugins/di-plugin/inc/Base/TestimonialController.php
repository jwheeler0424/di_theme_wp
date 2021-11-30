<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   PLUGIN TESTIMONIAL CONTROLLER                |
 *  ##################################################
*/

namespace Plugin\Base;

use Plugin\Api\SettingsApi;
use Plugin\Base\BaseController;
use Plugin\Api\Callbacks\TestimonialCallbacks;

class TestimonialController extends BaseController
{
    public $callbacks;
    public $settings;
    
    public function register()
    {
        if ( !$this->activated( 'testimonial_manager' ) ) return;

        $this->settings = new SettingsApi();
        $this->callbacks = new TestimonialCallbacks();

        add_action( 'init', array( $this, 'testimonial_cpt' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_box' ) );

        add_action( 'manage_testimonial_posts_columns', array( $this, 'set_custom_columns' ) );
        add_action( 'manage_testimonial_posts_custom_column', array( $this, 'set_custom_columns_data' ), 10, 2 );
        add_filter( 'manage_edit-testimonial_sortable_columns', array( $this, 'set_custom_columns_sortable' ) );

        $this->setShortcodePage();

        add_shortcode( 'testimonial-form', array( $this, 'testimonial_form' ) );
        add_shortcode( 'testimonial-slider', array( $this, 'testimonial_slider' ) );

        add_action( 'wp_ajax_submit_testimonial', array( $this, 'submit_testimonial' ) );
        add_action( 'wp_ajax_nopriv_submit_testimonial', array( $this, 'submit_testimonial' ) );
    }

    public function submit_testimonial()
    {
        if( !DOING_AJAX || !check_ajax_referer( 'testimonial-nonce', 'nonce' )) {
            return $this->return_json( 'error' );
        }

        // Sanitize the data
        $name = sanitize_text_field( $_POST['name'] );
        $company = sanitize_text_field( $_POST['company'] );
        $email = sanitize_email( $_POST['email'] );
        $message = sanitize_textarea_field( $_POST['message'] );

        // Store the data into testimonial CPT
        $data = array(
			'name' => $name,
            'company' => $company,
			'email' => $email,
			'approved' => 0,
			'featured' => 0,
		);

        $args = array(
            'post_title' => 'Testimonial from ' . $name,
            'post_content' => $message,
            'post_author' => 1,
            'post_status' => 'publish',
            'post_type' => 'testimonial',
            'meta_input' => array(
                '_di_testimonial_key' => $data
            )
        );

        $postID = wp_insert_post( $args );

        if ( $postID ) {
            return $this->return_json( 'success' );
        }

        return $this->return_json( 'error' );
    }

    public function return_json($status)
    {
        $return = array(
            'status' => $status
        );
        wp_send_json( $return );

        // Send response
        wp_die();
    }

    public function testimonial_form()
    {
        ob_start();
        require_once( "$this->plugin_path/templates/testimonial-form.php" );
        return ob_get_clean();
    }

    public function testimonial_slider()
    {
        ob_start();
        require_once( "$this->plugin_path/templates/testimonial-slider.php" );
        return ob_get_clean();
    }

    public function setShortcodePage()
    {
        $subpage = array(
            array(
                'parent_slug' => 'edit.php?post_type=testimonial',
                'page_title' => 'Shortcodes',
                'menu_title' => 'Shortcodes',
                'capability' => 'manage_options',
                'menu_slug' => 'di_testimonial_shortcode',
                'callback' => array( $this->callbacks, 'shortcodePage' )
            ),
        );

        $this->settings->addSubPages( $subpage )->register();
    }

    public function testimonial_cpt()
    {
        $labels = array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'menu_icon' => 'dashicons-megaphone',
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'supports' => array( 'title', 'editor' ),
            'show_in_rest' => true
        );

        register_post_type ( 'testimonial', $args );
    }

    public function add_meta_boxes()
    {
        add_meta_box (
            'testimonial_options',
            'Testimonial Options',
            array( $this, 'render_features_box' ),
            'testimonial',
            'side',
            'default'
        );

    }

    public function render_features_box( $post )
    {
        wp_nonce_field( 'di_testimonial', 'di_testimonial_nonce' );

		$data = get_post_meta( $post->ID, '_di_testimonial_key', true );
		$name = isset($data['name']) ? $data['name'] : '';
        $company = isset($data['company']) ? $data['company'] : '';
		$email = isset($data['email']) ? $data['email'] : '';
		$approved = isset($data['approved']) ? $data['approved'] : false;
		$featured = isset($data['featured']) ? $data['featured'] : false;
		?>
		<p>
			<label class="meta-label" for="di_testimonial_author">Author Name</label>
			<input type="text" id="di_testimonial_author" name="di_testimonial_author" class="widefat" value="<?php echo esc_attr( $name ); ?>">
		</p>
        <p>
			<label class="meta-label" for="di_testimonial_company">Author Company</label>
			<input type="text" id="di_testimonial_company" name="di_testimonial_company" class="widefat" value="<?php echo esc_attr( $company ); ?>">
		</p>
		<p>
			<label class="meta-label" for="di_testimonial_email">Author Email</label>
			<input type="email" id="di_testimonial_email" name="di_testimonial_email" class="widefat" value="<?php echo esc_attr( $email ); ?>">
		</p>
		<div class="meta-container">
			<label class="meta-label w-50 text-left" for="di_testimonial_approved">Approved</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline"><input type="checkbox" id="di_testimonial_approved" name="di_testimonial_approved" value="1" <?php echo $approved ? 'checked' : ''; ?>>
					<label for="di_testimonial_approved"><div></div></label>
				</div>
			</div>
		</div>
		<div class="meta-container">
			<label class="meta-label w-50 text-left" for="di_testimonial_featured">Featured</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline"><input type="checkbox" id="di_testimonial_featured" name="di_testimonial_featured" value="1" <?php echo $featured ? 'checked' : ''; ?>>
					<label for="di_testimonial_featured"><div></div></label>
				</div>
			</div>
		</div>
		<?php

    }

    

    public function save_meta_box( $post_id )
    {
        if ( !isset( $_POST['di_testimonial_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['di_testimonial_nonce'];

        if ( !wp_verify_nonce( $nonce, 'di_testimonial' ) ) {
            return $post_id;
        }

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        $data = array(
			'name' => sanitize_text_field( $_POST['di_testimonial_author'] ),
            'company' => sanitize_text_field( $_POST['di_testimonial_company'] ),
			'email' => sanitize_email( $_POST['di_testimonial_email'] ),
			'approved' => isset($_POST['di_testimonial_approved']) ? 1 : 0,
			'featured' => isset($_POST['di_testimonial_featured']) ? 1 : 0,
		);
		update_post_meta( $post_id, '_di_testimonial_key', $data );
    }

    public function set_custom_columns( $columns )
    {
        $title = $columns['title'];
        $date = $columns['date'];
        unset( $columns['title'], $columns['date'] );

        $columns['name'] = 'Author Name';
        $columns['title'] = $title;
        $columns['approved'] = 'Approved';
        $columns['featured'] = 'Featured';
        $columns['date'] = $date;

        return $columns;
    }

    public function set_custom_columns_data( $column, $post_id )
    {
        $data = get_post_meta( $post_id, '_di_testimonial_key', true );
		$name = isset($data['name']) ? $data['name'] : '';
        $company = isset($data['company']) ? $data['company'] : '';
		$email = isset($data['email']) ? $data['email'] : '';
		$approved = isset($data['approved']) && $data['approved'] === 1 ? '<span class="dashicons dashicons-yes-alt" style="color: rgb(102, 171, 60);"></span>' : '<span class="dashicons dashicons-dismiss" style="color: rgb(172, 60, 61);"></span>';
		$featured = isset($data['featured']) && $data['featured'] === 1 ? '<span class="dashicons dashicons-yes-alt" style="color: rgb(102, 171, 60);"></span>' : '<span class="dashicons dashicons-dismiss" style="color: rgb(172, 60, 61);"></span>';

        switch ( $column ) {
            case 'name':
                $company_insert = ($company) ? '<em>'. $company .'</em><br />' : '';
                echo '<strong>'. $name .'</strong><br />'. $company_insert .'<a href="mailto:'. $email .'">'. $email .'</a>';
                break;

            case 'approved':
                echo $approved;
                break;

            case 'featured':
                echo $featured;
                break;
        }
    }

    public function set_custom_columns_sortable( $columns )
    {
        $columns['name'] = 'name';
        $columns['approved'] = 'approved';
        $columns['featured'] = 'featured';
        return $columns;
    }

}