<?php
class WP_Widget_WIB_display extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_wib_display', 'description' => __( "Latest WIB from dreamteam site") );
		parent::__construct('wib-display', __('Latest WIBs'), $widget_ops);
		$this->alt_option_name = 'widget_wib_display';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	public function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_wib_display', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest WIBs' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
		if ( ! $number )
			$number = 3;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$curlInit = curl_init();
		$ds = new DateTime('2014-01-01');
		$de = new DateTime();
		$ds = $ds->format('Y-m-d');
		$de = $de->format('Y-m-d');
		$lim = $number;

		if (!($lim)){
			$url = 'http://dreamteam.bunker.devoffice.com/wib_api.php?search_date_from='.$ds.'&search_date_to='.$de.'';
		} else {
			$url = 'http://dreamteam.bunker.devoffice.com/wib_api.php?search_date_from='.$ds.'&search_date_to='.$de.'&limit='.$lim.'';
		}
		curl_setopt($curlInit, CURLOPT_URL, $url);
		curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);

		$output = json_decode(curl_exec($curlInit));
		curl_close($curlInit);
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . '<span class="dashicons dashicons-lightbulb '. $output->class_val .'"></span>' . $title . $args['after_title'];
		} ?>
		<?php echo $output->output; ?>
		<?php echo $args['after_widget']; ?>
<?php
		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_wib_display', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_wib_display']) )
			delete_option('widget_wib_display');

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete('widget_wib_display', 'widget');
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of entries to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}