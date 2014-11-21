<?php
	/**
 * Useful Links Categories widget class
 */
class WP_Widget_Useful_Links_Categories extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_useful_categories', 'description' => __( "A list of Useful Links categories." ) );
		parent::__construct('useful_categories', __('Useful Links Categories'), $widget_ops);
	}

	public function widget( $args, $instance ) {
		$taxonomy = 'useful_links_category';
		$tax_terms = get_terms($taxonomy);
		if ($tax_terms) {
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Useful Links Categories' ) : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<ul>
<?php
			foreach ($tax_terms as $tax_term) {
				echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
			} ?>
			<li><a href="/?page_id=27421">All</a></li>
		</ul>
<?php

		echo $args['after_widget'];
	}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	public function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] ); ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
<?php
	}
} ?>