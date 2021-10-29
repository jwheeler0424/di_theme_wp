<?php
/**
 * @package diPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\ContactCallbacks;

class ContactController extends BaseController
{
    public $callbacks;
    public $subpages;
    public function register()
    {
        if ( !$this->activated( 'contact_manager' ) ) return;

        $this->settings = new SettingsApi();
        $this->callbacks = new ContactCallbacks();

        add_action( 'init', array( $this, 'contact_message_cpt' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_box' ) );

        add_action( 'manage_contact_posts_columns', array( $this, 'set_custom_columns' ) );
        add_action( 'manage_contact_posts_custom_column', array( $this, 'set_custom_columns_data' ), 10, 2 );
        add_filter( 'manage_edit-contact_sortable_columns', array( $this, 'set_custom_columns_sortable' ) );

        $this->setShortcodePage();

        add_shortcode( 'contact-form', array( $this, 'contact_form' ) );
    }

    public function contact_form()
    {
        ob_start();
        require_once( "$this->plugin_path/templates/contact-form.php" );
        echo "<script src=\"$this->plugin_url/src/js/form.js\"></script>";
        return ob_get_clean();
    }

    public function setShortcodePage()
    {
        $subpage = array(
            array(
                'parent_slug' => 'edit.php?post_type=contact',
                'page_title' => 'Shortcodes',
                'menu_title' => 'Shortcodes',
                'capability' => 'manage_options',
                'menu_slug' => 'di_contact_shortcode',
                'callback' => array( $this->callbacks, 'shortcodePage' )
            ),
        );

        $this->settings->addSubPages( $subpage )->register();
    }

    public function contact_message_cpt()
    {
        $labels = array(
            'name'                  => 'Contacts',
            'singular_name'         => 'Contact',
            'menu_name'             => 'Contacts',
            'name_admin_bar'        => 'Contact',
            'archives'              => 'Contact Archives',
            'attributes'            => 'Contact Attributes',
            'parent_item_colon'     => 'Parent Contact',
            'all_items'             => 'All Contacts',
            'add_new_item'          => 'Add New Contact',
            'add_new'               => 'Add New',
            'new_item'              => 'New Contact',
            'edit_item'             => 'Edit Contact',
            'update_item'           => 'Update Contact',
            'view_item'             => 'View Contact',
            'view_items'            => 'View Contacts',
            'search_items'          => 'Search Contacts',
            'not_found'             => 'No Contact Found',
            'not_found_in_trash'    => 'No Contact Found in Trash',
            'items_list'            => 'Contact List',
            'items_list_navigation' => 'Contact List Navigation',
            'filter_items_list'     => 'Filter Contact List'
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

        register_post_type ( 'contact', $args );
    }

    public function add_meta_boxes()
    {
        add_meta_box (
            'contact_info',
            'Contact Info',
            array( $this, 'render_info_box' ),
            'contact',
            'side',
            'high'
        );

    }

    public function render_info_box( $post )
    {
        wp_nonce_field( 'di_contact', 'di_contact_nonce' );

        $data = get_post_meta( $post->ID, '_di_contact_key', true );
		$name = isset($data['name']) ? $data['name'] : '';
        $company_name = isset($data['company_name']) ? $data['company_name'] : '';
		$email = isset($data['email']) ? $data['email'] : '';
        $phone = isset($data['phone']) ? $data['phone'] : '';
		$responded = isset($data['responded']) ? $data['responded'] : false;

        ?>
		<p>
			<label class="meta-label" for="di_contact_name">Contact Name</label>
			<input type="text" id="di_contact_name" name="di_contact_name" class="widefat" value="<?php echo esc_attr( $name ); ?>">
		</p>
        <p>
			<label class="meta-label" for="di_contact_company_name">Company</label>
			<input type="text" id="di_contact_company_name" name="di_contact_company_name" class="widefat" value="<?php echo esc_attr( $company_name ); ?>">
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
        if ( !isset( $_POST['di_contact_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['di_contact_nonce'];

        if ( !wp_verify_nonce( $nonce, 'di_contact' ) ) {
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
            'company_name' => sanitize_text_field( $_POST['di_contact_company_name'] ),
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
        $company_name = isset($data['company_name']) ? $data['company_name'] : '';
		$email = isset($data['email']) ? $data['email'] : '';
        $phone = isset($data['phone']) ? $data['phone'] : '';
		$responded = isset($data['responded']) && $data['responded'] === 1 ? '✅' : '⛔';

        switch ( $column ) {
            case 'name':
                $company_insert = ($company_name) ? '<em>'. $company_name .'</em><br />' : '';
                $phone_number = sprintf("(%s) %s-%s", substr($phone, 0, 3), substr($phone, 3, 3), substr($phone, 6, 9));

                echo '<strong>'. $name .'</strong><br />'. $company_insert .'<a href="mailto:'. $email .'">'. $email .'</a><br />' . $phone_number;
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