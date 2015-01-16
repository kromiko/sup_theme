<?php
class WP_Widget_CRS_display extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_crs_display', 'description' => __( "CRS Stats") );
		parent::__construct('crs-display', __('crs stats'), $widget_ops);
		$this->alt_option_name = 'widget_crs_display';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	public function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_crs_display', 'widget' );
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : false;

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );


		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<?php
			$crs_loader_img = '<img src="' . get_template_directory_uri() . '/images/prettyPhoto/default/loader.gif" alt="" />';
			$output = '<div id="crs-stats-container"></div>';
			$output .= '<script>';
			$output .= 'jQuery(document).ready(function(){';
			$output .= 'var crs_loader = \'<div style="margin: 63px 0; font-size: 14px;">' . $crs_loader_img . 'Loading CRS statistics. Please, be patient...</div>\';';
			$output .= 'var request = jQuery.ajax({';
			$output .= 'type: \'GET\',';
			$output .= 'url: \'' . esc_url( home_url('/') ) . 'crs_api_test.php\',';
			$output .= 'beforeSend: function(){';
			$output .= 'jQuery(\'#crs-stats-container\').html(crs_loader);';
			$output .= '}});';
			$output .= 'request.done(function( msg ) {';
			$output .= 'jQuery(\'#crs-stats-container\').html(msg);';
			$output .= '});});';
			$output .= '</script>';
		?>
		<?php echo $output; ?>
		<?php echo $args['after_widget']; ?>
<?php
		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_crs_display', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_crs_display']) )
			delete_option('widget_crs_display');

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete('widget_crs_display', 'widget');
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
<?php
	}
}