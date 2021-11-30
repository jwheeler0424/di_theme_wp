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
            'name' => 'Portfolio',
            'singular_name' => 'Portfolio'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'menu_icon' => 'dashicons-portfolio',
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'show_in_rest' => true
        );

        register_post_type ( 'portfolio', $args );
    }

    public function add_meta_boxes()
    {
        add_meta_box (
            'portfolio_options',
            'Portfolio Options',
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
        $company = isset($data['company']) ? $data['company'] : '';
		$approved = isset($data['approved']) ? $data['approved'] : false;
		$featured = isset($data['featured']) ? $data['featured'] : false;
		?>
		<p>
			<label class="meta-label" for="di_portfolio_author">Client Name</label>
			<input type="text" id="di_portfolio_author" name="di_portfolio_author" class="widefat" value="<?php echo esc_attr( $name ); ?>">
		</p>
        <p>
			<label class="meta-label" for="di_portfolio_company">Client Company</label>
			<input type="text" id="di_portfolio_company" name="di_portfolio_company" class="widefat" value="<?php echo esc_attr( $company ); ?>">
		</p>
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
			'name' => sanitize_text_field( $_POST['di_portfolio_author'] ),
            'company' => sanitize_text_field( $_POST['di_portfolio_company'] ),
			'approved' => isset($_POST['di_portfolio_approved']) ? 1 : 0,
			'featured' => isset($_POST['di_portfolio_featured']) ? 1 : 0,
		);
		update_post_meta( $post_id, '_di_portfolio_key', $data );
    }

    public function set_custom_columns( $columns )
    {
        $title = $columns['title'];
        $date = $columns['date'];
        unset( $columns['title'], $columns['date'] );

        $columns['name'] = 'Client Name';
        $columns['title'] = $title;
        $columns['approved'] = 'Approved';
        $columns['featured'] = 'Featured';
        $columns['date'] = $date;

        return $columns;
    }

    public function set_custom_columns_data( $column, $post_id )
    {
        $data = get_post_meta( $post_id, '_di_portfolio_key', true );
		$name = isset($data['name']) ? $data['name'] : '';
        $company = isset($data['company']) ? $data['company'] : '';
		$approved = isset($data['approved']) && $data['approved'] === 1 ? '<span class="dashicons dashicons-yes-alt" style="color: rgb(102, 171, 60);"></span>' : '<span class="dashicons dashicons-dismiss" style="color: rgb(172, 60, 61);"></span>';
		$featured = isset($data['featured']) && $data['featured'] === 1 ? '<span class="dashicons dashicons-yes-alt" style="color: rgb(102, 171, 60);"></span>' : '<span class="dashicons dashicons-dismiss" style="color: rgb(172, 60, 61);"></span>';

        switch ( $column ) {
            case 'name':
                $company_insert = ($company) ? '<em>'. $company .'</em><br />' : '';
                echo '<strong>'. $name .'</strong><br />'. $company_insert;
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