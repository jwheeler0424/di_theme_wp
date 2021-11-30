<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   PLUGIN SERVICES CONTROLLER                   |
 *  ##################################################
*/

namespace Plugin\Base;

use Plugin\Api\SettingsApi;
use Plugin\Base\BaseController;
// use Plugin\Api\Callbacks\ServicesCallbacks;

class ServicesController extends BaseController
{
    public $callbacks;
    public $settings;
    
    public function register()
    {
        if ( !$this->activated( 'services_manager' ) ) return;

        $this->settings = new SettingsApi();
        // $this->callbacks = new ServicesCallbacks();

        add_action( 'init', array( $this, 'services_cpt' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_box' ) );

        add_action( 'manage_services_posts_columns', array( $this, 'set_custom_columns' ) );
        add_action( 'manage_services_posts_custom_column', array( $this, 'set_custom_columns_data' ), 10, 2 );
        add_filter( 'manage_edit-services_sortable_columns', array( $this, 'set_custom_columns_sortable' ) );

    }

    public function services_cpt()
    {
        $labels = array(
            'name' => 'Services',
            'singular_name' => 'Service'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'menu_icon' => 'dashicons-superhero',
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'show_in_rest' => true
        );

        register_post_type ( 'services', $args );
    }

    public function add_meta_boxes()
    {
        add_meta_box (
            'services_options',
            'Services Options',
            array( $this, 'render_features_box' ),
            'services',
            'side',
            'default'
        );

    }

    public function render_features_box( $post )
    {
        wp_nonce_field( 'di_service', 'di_service_nonce' );

		$data = get_post_meta( $post->ID, '_di_service_key', true );
		$group = isset($data['group']) ? $data['group'] : '';
        $active = isset($data['active']) ? $data['active'] : false;
		?>
		<p>
			<label class="meta-label" for="di_service_group">Service Group</label>
			<input type="text" id="di_service_group" name="di_service_group" class="widefat" value="<?php echo esc_attr( $group ); ?>">
		</p>
        <div class="meta-container">
			<label class="meta-label w-50 text-left" for="di_service_active">Active</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline"><input type="checkbox" id="di_service_active" name="di_service_active" value="1" <?php echo $active ? 'checked' : ''; ?>>
					<label for="di_service_active"><div></div></label>
				</div>
			</div>
		</div>
		<?php

    }

    public function save_meta_box( $post_id )
    {
        if ( !isset( $_POST['di_service_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['di_service_nonce'];

        if ( !wp_verify_nonce( $nonce, 'di_service' ) ) {
            return $post_id;
        }

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        $data = array(
			'group' => sanitize_text_field( $_POST['di_service_group'] ),
			'active' => isset($_POST['di_service_active']) ? 1 : 0
		);
		update_post_meta( $post_id, '_di_service_key', $data );
    }

    public function set_custom_columns( $columns )
    {
        $title = $columns['title'];
        $date = $columns['date'];
        unset( $columns['title'], $columns['date'] );

        $columns['group'] = 'Service Type';
        $columns['title'] = $title;
        $columns['active'] = 'Active';
        $columns['date'] = $date;

        return $columns;
    }

    public function set_custom_columns_data( $column, $post_id )
    {
        $data = get_post_meta( $post_id, '_di_service_key', true );
		$group = isset($data['group']) ? $data['group'] : '';
		$active = isset($data['active']) && $data['active'] === 1 ? '<span class="dashicons dashicons-yes-alt" style="color: rgb(102, 171, 60);"></span>' : '<span class="dashicons dashicons-dismiss" style="color: rgb(172, 60, 61);"></span>';

        switch ( $column ) {
            case 'group':
                echo $group;
                break;

            case 'active':
                echo $active;
                break;
        }
    }

    public function set_custom_columns_sortable( $columns )
    {
        $columns['group'] = 'group';
        $columns['active'] = 'active';
        return $columns;
    }

}