<?php
/**
 * Loads up all the widgets defined by this theme. Note that this function will not work for versions of WordPress 2.7 or lower
 *
 */
function sup_theme_load_widgets() {
	$widget_files = array(
		'WP_Widget_Useful_Links_Categories'    => 'widget-useful_categories.php',
		'Tickets_RMS' 						   => 'vbwidget.php',
		'My_WP_Widget_Recent_Posts'			   => 'pe_news_widget.php',
		'WP_Widget_WIB_display' 			   => 'widget-wib_display.php',
		'Work_Duty'							   => 'work_duty_widget.php',
		'SupportOpenings_Widget'			   => 'sup_openings_widget.php',
		'WP_Widget_Recent_Brainstorm'		   => 'brainstorming_widget.php'
	);
	foreach ( $widget_files as $class_name => $file_name ) {
		$widget_dir = get_template_directory() . '/inc/' . $file_name;
		include_once ( $widget_dir );
		if ( class_exists( $class_name ) ) {
			register_widget( $class_name );
		}
	}
}
add_action( 'widgets_init', 'sup_theme_load_widgets' );