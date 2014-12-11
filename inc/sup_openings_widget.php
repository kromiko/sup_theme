<?php
class SupportOpenings_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'sup_openings-widget', 'description' => __( "Support Openings Widget") );
		parent::__construct('sup_openings-widget', __('Support Openings'), $widget_ops);
		$this->alt_option_name = 'sup_openings-widget';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	public function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'sup_openings-widget', 'widget' );
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Support Openings' );
		$url = ( ! empty( $instance['url'] ) ) ? $instance['url'] : __( '' );

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
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'post_type'			  => 'sup_openings',
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'orderby' 			  => 'modified',
			'order'				  => 'DESC',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
		
			$r->the_post();
			$latest_date = get_the_modified_date();
			$cur_date = new DateTime(date("d.m.Y"));
			$time_diff = $cur_date->diff(new DateTime($latest_date));

			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'] . '<a href="' . $url . '"><div class="cloth"></div><img class="sup_open_ico" src="' . get_template_directory_uri() . '/images/hire_me_ico.jpg" width="68" height="80" alt="' . $title . '" /><span>' . $title . '</span></a>' . $args['after_title'];
			} else {
				echo $args['before_title'] . '<a href="' . $url . '"></a>' . $args['after_title'];
			}
			echo $args['after_widget'];

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'sup_openings-widget', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['url'] = strip_tags($new_instance['url']);
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['sup_openings-widget']) )
			delete_option('sup_openings-widget');

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete('sup_openings-widget', 'widget');
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$url     = isset( $instance['url'] ) ? esc_attr( $instance['url'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo $url; ?>" /></p>
<?php
	}
}