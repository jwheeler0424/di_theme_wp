<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   PLUGIN PORTFOLIO CONTROLLER                  |
 *  ##################################################
*/

namespace Plugin\Base;

use Plugin\Api\SettingsApi;
use Plugin\Base\BaseController;
use Plugin\Api\Callbacks\PortfolioCallbacks;

class PortfolioController extends BaseController
{
    public $callbacks;
    public $settings;
    
    public function register()
    {
        if ( !$this->activated( 'portfolio_manager' ) ) return;

        $this->settings = new SettingsApi();
        $this->callbacks = new PortfolioCallbacks();

        add_action( 'init', array( $this, 'portfolio_cpt' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_box' ) );

        add_action( 'manage_portfolio_posts_columns', array( $this, 'set_custom_columns' ) );
        add_action( 'manage_portfolio_posts_custom_column', array( $this, 'set_custom_columns_data' ), 10, 2 );
        add_filter( 'manage_edit-portfolio_sortable_columns', array( $this, 'set_custom_columns_sortable' ) );

        $this->setShortcodePage();

        add_shortcode( 'portfolio-carousel', array( $this, 'portfolio_carousel' ) );
    }

    public function portfolio_carousel()
    {
        ob_start();
        require_once( "$this->plugin_path/templates/portfolio-carousel.php" );
        return ob_get_clean();
    }

    public function setShortcodePage()
    {
        $subpage = array(
            array(
                'parent_slug' => 'edit.php?post_type=portfolio',
                'page_title' => 'Shortcodes',
                'menu_title' => 'Shortcodes',
                'capability' => 'manage_options',
                'menu_slug' => 'di_portfolio_shortcode',
                'callback' => array( $this->callbacks, 'shortcodePage' )
            ),
        );

        $this->settings->addSubPages( $subpage )->register();
    }

    public function portfolio_cpt()
    {
        $labels = array(
            'name'                  => 'Projects',
            'singular_name'         => 'Project',
            'menu_name'             => 'Portfolio',
            'name_admin_bar'        => 'Portfolio',
            'archives'              => 'Project Archives',
            'attributes'            => 'Project Attributes',
            'parent_item_colon'     => 'Parent Project',
            'all_items'             => 'All Projects',
            'add_new_item'          => 'Add New Project',
            'add_new'               => 'Add New',
            'new_item'              => 'New Project',
            'edit_item'             => 'Edit Project',
            'update_item'           => 'Update Project',
            'view_item'             => 'View Project',
            'view_items'            => 'View Projects',
            'search_items'          => 'Search Project',
            'not_found'             => 'No Project Found',
            'not_found_in_trash'    => 'No Project Found in Trash',
            'items_list'            => 'Project List',
            'items_list_navigation' => 'Project List Navigation',
            'filter_items_list'     => 'Filter Project List'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'menu_icon' => 'dashicons-portfolio',
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'supports' => array( 'title', 'editor', 'thumbnail', 'post-formats', 'page-attributes' ),
            'show_in_rest' => true
        );

        register_post_type ( 'portfolio', $args );
    }

    public function add_meta_boxes()
    {
        add_meta_box (
            'project_options',
            'Project Options',
            array( $this, 'render_features_box' ),
            'portfolio',
            'side',
            'default'
        );

    }

    public function render_features_box( $post )
    {
        wp_nonce_field( 'di_portfolio', 'di_portfolio_nonce' );

		$data = get_post_meta( $post->ID, '_di_portfolio_key', true );
		$name = isset($data['name']) ? $data['name'] : '';
        $url = isset($data['url']) ? $data['url'] : '';
		$approved = isset($data['approved']) ? $data['approved'] : false;
		$featured = isset($data['featured']) ? $data['featured'] : false;
		?>
		<div class="meta-container">
			<label class="meta-label" for="di_portfolio_name">Client Name</label>
			<input type="text" id="di_portfolio_name" name="di_portfolio_name" class="widefat" value="<?php echo esc_attr( $name ); ?>">
        </div>
        <div class="meta-container">
			<label class="meta-label" for="di_portfolio_demo">Project Url</label>
			<input type="url" id="di_portfolio_url" name="di_portfolio_url" class="widefat" value="<?php echo esc_attr( $url ); ?>">
        </div>
		<div class="meta-container">
			<label class="meta-label w-50 text-left" for="di_portfolio_approved">Approved</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline"><input type="checkbox" id="di_portfolio_approved" name="di_portfolio_approved" value="1" <?php echo $approved ? 'checked' : ''; ?>>
					<label for="di_portfolio_approved"><div></div></label>
				</div>
			</div>
		</div>
		<div class="meta-container">
			<label class="meta-label w-50 text-left" for="di_portfolio_featured">Featured</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline"><input type="checkbox" id="di_portfolio_featured" name="di_portfolio_featured" value="1" <?php echo $featured ? 'checked' : ''; ?>>
					<label for="di_portfolio_featured"><div></div></label>
				</div>
			</div>
		</div>
		<?php

    }

    public function save_meta_box( $post_id )
    {
        if ( !isset( $_POST['di_portfolio_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['di_portfolio_nonce'];

        if ( !wp_verify_nonce( $nonce, 'di_portfolio' ) ) {
            return $post_id;
        }

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        $data = array(
			'name' => sanitize_text_field( $_POST['di_portfolio_name'] ),
            'url' => esc_url_raw( $_POST['di_portfolio_url'] ),
			'approved' => isset($_POST['di_portfolio_approved']) ? 1 : 0,
			'featured' => isset($_POST['di_portfolio_featured']) ? 1 : 0,
		);
		update_post_meta( $post_id, '_di_portfolio_key', $data );
    }

    public function set_custom_columns( $columns )
    {
        $title = $columns['title'];
        $date = $columns['date'];
        unset( $columns['title'], $columns['date'], $columns['taxonomy-project_type'] );

        $columns['name'] = 'Client';
        $columns['url'] = 'Project URL';
        $columns['taxonomy-project_type'] = 'Project Type';
        $columns['approved'] = 'Approved';
        $columns['featured'] = 'Featured';
        $columns['date'] = $date;

        return $columns;
    }

    public function set_custom_columns_data( $column, $post_id )
    {
        $data = get_post_meta( $post_id, '_di_portfolio_key', true );
        $client = get_the_title( $post_id );
		$name = isset($data['name']) ? $data['name'] : '';
        $url = isset($data['url']) ? $data['url'] : '';
		$approved = isset($data['approved']) && $data['approved'] === 1 ? '<span class="dashicons dashicons-yes-alt" style="color: rgb(102, 171, 60);"></span>' : '<span class="dashicons dashicons-dismiss" style="color: rgb(172, 60, 61);"></span>';
		$featured = isset($data['featured']) && $data['featured'] === 1 ? '<span class="dashicons dashicons-yes-alt" style="color: rgb(102, 171, 60);"></span>' : '<span class="dashicons dashicons-dismiss" style="color: rgb(172, 60, 61);"></span>';

        switch ( $column ) {
            case 'name':
                $name_insert = ($name) ? '<em>'. $name .'</em><br />' : '';
                echo '<a href="'.get_edit_post_link( $post_id ).'"><strong>'. $client .'</strong></a><br />'. $name;
                break;

            case 'url':
                echo '<a href="' . $url . '" target="_blank" rel="noopener noreferrer">'. $url .'</a>';
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
        $columns['name'] = 'title';
        $columns['taxonomy-project_type'] = 'taxonomy-project_type';
        $columns['approved'] = 'approved';
        $columns['featured'] = 'featured';
        return $columns;
    }

}