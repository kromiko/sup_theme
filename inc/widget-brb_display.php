<?php
class WP_Widget_BRB_display extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_brb_display', 'description' => __( "BRB Stats") );
		parent::__construct('brb-display', __('BRB stats'), $widget_ops);
		$this->alt_option_name = 'widget_brb_display';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	public function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_brb_display', 'widget' );
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

		//$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'BRB Stats' );
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
		$curlInit = curl_init();

		$url = 'http://brb2.devoffice.com/api.php?month_stats';
		curl_setopt($curlInit, CURLOPT_URL, $url);
		curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);

		$pre_output = json_decode(curl_exec($curlInit));
		curl_close($curlInit);
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<?php
			$output = '<p>Total bugs submitted: ' . $pre_output->brb->total_bugs . '</p>';
			$top_colors = array('#FFCF37', '#809D46', '#9DBA65', '#C2D69A', '#D7E4BC');
			$i=0;
			$output .= '<table>';
			foreach($pre_output->brb->top_submitters as $item){
				if ($i < 5){
					$output .= '<tr style="background:' . $top_colors[$i] . '"><td>' . $item->user_login . '</td><td>' . $item->counter . ' BRB</td></tr>';
				}
				$i++;
			}
			$output .= '</table>';
		?>
		<?php echo $output; ?>
		<?php echo $args['after_widget']; ?>
<?php
		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_brb_display', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_brb_display']) )
			delete_option('widget_brb_display');

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete('widget_brb_display', 'widget');
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
<?php
	}
}