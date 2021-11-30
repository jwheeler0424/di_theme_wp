<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   EVENT CONTROLLER                            |
 *  ##################################################
*/

namespace Plugin\Base;

use Plugin\Api\SettingsApi;
use Plugin\Base\BaseController;
use Plugin\Api\Callbacks\EventCallbacks;

class EventController extends BaseController
{
    public $callbacks;
    public $settings;

    public function register()
    {
        if ( !$this->activated( 'event_manager' ) ) return;

        $this->settings = new SettingsApi();
        $this->callbacks = new EventCallbacks();

        add_action( 'init', array( $this, 'event_cpt' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_box' ) );

        add_action( 'manage_event_posts_columns', array( $this, 'set_custom_columns' ) );
        add_action( 'manage_event_posts_custom_column', array( $this, 'set_custom_columns_data' ), 10, 2 );
        add_filter( 'manage_edit-event_sortable_columns', array( $this, 'set_custom_columns_sortable' ) );

        // $this->setShortcodePage();

        // add_shortcode( 'contact-form', array( $this, 'contact_form' ) );

        // add_action( 'wp_ajax_submit_contact', array( $this, 'submit_contact' ) );
        // add_action( 'wp_ajax_nopriv_submit_contact', array( $this, 'submit_contact' ) );
    }

    public function submit_event()
    {
        if( !DOING_AJAX || !check_ajax_referer( 'event-nonce', 'nonce' )) {
            return $this->return_json( 'error' );
        }

        // Sanitize the data
        $title = sanitize_text_field( $_POST['title'] );
        $name = sanitize_text_field( $_POST['name'] );
        $company = sanitize_text_field( $_POST['company'] );
        $email = sanitize_email( $_POST['email'] );
        $phone = $_POST['phone'];
        $message = sanitize_textarea_field( $_POST['message'] );

        // Store the data into contact CPT
        $data = array(
			'name' => $name,
            'company' => $company,
			'email' => $email,
			'phone' => $phone,
			'responded' => 0,
		);

        $args = array(
            'post_title' => $subject,
            'post_content' => $message,
            'post_author' => 1,
            'post_status' => 'publish',
            'post_type' => 'contact',
            'meta_input' => array(
                '_di_contact_key' => $data
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

    public function sanitize_phone_number ( $phone )
    {
        $phone = preg_replace( "/[^0-9]/", "", $phone );
        if ( strlen( $phone ) == 10 ) {
                 if ( is_numeric( $phone ) ) {
                     return intval( $phone );
                 }
        }
    }

    public function event_form()
    {
        ob_start();
        require_once( "$this->plugin_path/templates/event-form.php" );
        echo "<script src=\"$this->plugin_url/src/js/form.js\"></script>";
        return ob_get_clean();
    }

    public function setShortcodePage()
    {
        $subpage = array(
            array(
                'parent_slug' => 'edit.php?post_type=event',
                'page_title' => 'Shortcodes',
                'menu_title' => 'Shortcodes',
                'capability' => 'manage_options',
                'menu_slug' => 'di_event_shortcode',
                'callback' => array( $this->callbacks, 'shortcodePage' )
            ),
        );

        $this->settings->addSubPages( $subpage )->register();
    }

    public function event_cpt()
    {
        $labels = array(
            'name'                  => 'Events',
            'singular_name'         => 'Event',
            'menu_name'             => 'Events',
            'name_admin_bar'        => 'Event',
            'archives'              => 'Event Archives',
            'attributes'            => 'Event Attributes',
            'parent_item_colon'     => 'Parent Event',
            'all_items'             => 'All Events',
            'add_new_item'          => 'Add New Event',
            'add_new'               => 'Add New',
            'new_item'              => 'New Event',
            'edit_item'             => 'Edit Event',
            'update_item'           => 'Update Event',
            'view_item'             => 'View Event',
            'view_items'            => 'View Events',
            'search_items'          => 'Search Events',
            'not_found'             => 'No Event Found',
            'not_found_in_trash'    => 'No Event Found in Trash',
            'items_list'            => 'Event List',
            'items_list_navigation' => 'Event List Navigation',
            'filter_items_list'     => 'Filter Event List'
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'has_archive'           => false,
            'menu_icon'             => 'dashicons-tickets-alt',
            'exclude_from_search'   => true,
            'publicly_queryable'    => false,
            'supports'              => array( 'title', 'editor' ),
            'show_in_rest'          => true
        );

        register_post_type ( 'event', $args );
    }

    public function add_meta_boxes()
    {
        add_meta_box (
            'event_info',
            'Event Info',
            array( $this, 'render_info_box' ),
            'event',
            'side',
            'high'
        );

    }

    public function render_info_box( $post )
    {
        wp_nonce_field( 'di_event', 'di_event_nonce' );

        $data = get_post_meta( $post->ID, '_di_event_key', true );
		$name = isset($data['name']) ? $data['name'] : '';
        $company = isset($data['company']) ? $data['company'] : '';
		$email = isset($data['email']) ? $data['email'] : '';
        $phone = isset($data['phone']) ? $data['phone'] : '';
		$responded = isset($data['responded']) ? $data['responded'] : false;

        ?>
		<p>
			<label class="meta-label" for="di_contact_name">Contact Name</label>
			<input type="text" id="di_contact_name" name="di_contact_name" class="widefat" value="<?php echo esc_attr( $name ); ?>">
		</p>
        <p>
			<label class="meta-label" for="di_contact_company">Company Name</label>
			<input type="text" id="di_contact_company" name="di_contact_company" class="widefat" value="<?php echo esc_attr( $company ); ?>">
		</p>
		<p>
			<label class="meta-label" for="di_contact_email">Email Address</label>
			<input type="email" id="di_contact_email" name="di_contact_email" class="widefat" value="<?php echo esc_attr( $email ); ?>">
		</p>
        <p>
			<label class="meta-label" for="di_contact_phone">Phone Number</label>
			<input type="phone" id="di_contact_phone" name="di_contact_phone" class="widefat" value="<?php echo esc_attr( $phone ); ?>">
		</p>
		<div class="meta-container">
			<label class="meta-label w-50 text-left" for="di_contact_responded">Responded</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline"><input type="checkbox" id="di_contact_responded" name="di_contact_responded" value="1" <?php echo $responded ? 'checked' : ''; ?>>
					<label for="di_contact_responded"><div></div></label>
				</div>
			</div>
		</div>
		<?php

    }

    public function save_meta_box( $post_id )
    {
        if ( !isset( $_POST['di_event_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['di_event_nonce'];

        if ( !wp_verify_nonce( $nonce, 'di_event' ) ) {
            return $post_id;
        }

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        $data = array(
			'name' => sanitize_text_field( $_POST['di_contact_name'] ),
            'company' => sanitize_text_field( $_POST['di_contact_company'] ),
			'email' => sanitize_text_field( $_POST['di_contact_email'] ),
            'phone' => sanitize_text_field( $_POST['di_contact_phone'] ),
			'responded' => isset($_POST['di_contact_responded']) ? 1 : 0
		);
		update_post_meta( $post_id, '_di_contact_key', $data );
    }

    public function set_custom_columns( $columns )
    {
        unset( $columns['title'], $columns['date'] );

        $columns['name'] = 'Contact Info';
        $columns['title'] = 'Subject';
        $columns['message'] = 'Message';
        $columns['datetime'] = 'Date Requested';
        $columns['responded'] = 'Responded';

        return $columns;
    }

    public function set_custom_columns_data( $column, $post_id )
    {
        $data = get_post_meta( $post_id, '_di_contact_key', true );
		$name = isset($data['name']) ? $data['name'] : '';
        $company = isset($data['company']) ? $data['company'] : '';
		$email = isset($data['email']) ? $data['email'] : '';
        $phone = isset($data['phone']) ? $data['phone'] : '';
		$responded = isset($data['responded']) && $data['responded'] === 1 ? '✅' : '⛔';

        switch ( $column ) {
            case 'name':
                $company_insert = ($company) ? '<em>'. $company .'</em><br />' : '';
                $phone_number = sprintf("(%s) %s-%s", substr($phone, 0, 3), substr($phone, 3, 3), substr($phone, 6, 9));

                echo '<strong>'. $name .'</strong><br />'. $company_insert .'<a href="mailto:'. $email .'">'. $email .'</a><br /><a href="tel:'. $phone_number .'">' . $phone_number . '</a>';
                break;

            case 'message':
                // message column
                echo get_the_excerpt();
                break;
        
            case 'datetime':
                $date_format = 'm/d/Y \<\/\b\r\>@ g:i a';
                echo get_the_date( $date_format, $post_id );
                break;

            case 'responded':
                echo $responded;
                break;
           
        }
    }

    public function set_custom_columns_sortable( $columns )
    {
        $columns['name'] = 'name';
        $columns['datetime'] = 'date';
        $columns['responded'] = 'responded';
        return $columns;
    }

}