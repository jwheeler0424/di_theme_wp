<?php
/**
 * @package diPlugin
*/

namespace Plugin\Api\Widgets;

use WP_Widget;

class MediaWidget extends WP_Widget
{
    public $widget_ID;

	public $widget_name;

	public $widget_options = array();

	public $control_options = array();

	function __construct() {

		$this->widget_ID = 'di_media_widget';
		$this->widget_name = 'di Media Widget';

		$this->widget_options = array(
			'classname' => $this->widget_ID,
			'description' => $this->widget_name,
			'customize_selective_refresh' => true,
		);

		$this->control_options = array(
			'width' => 400,
			'height' => 350,
		);
	}

	public function register()
	{
		parent::__construct( $this->widget_ID, $this->widget_name, $this->widget_options, $this->control_options );

		add_action( 'widgets_init', array( $this, 'widgetsInit' ) );
	}

	public function widgetsInit()
	{
		register_widget( $this );
	}

    public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Custom Text', 'di_plugin' );
        $titleID = esc_attr( $this->get_field_id( 'title' ) )
		?>
		<p>
		<label for="<?php echo $titleID; ?>"><?php esc_attr_e( 'Title:', 'di_plugin' ); ?></label> 
		<input class="widefat" id="<?php echo $titleID; ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;
	}
}