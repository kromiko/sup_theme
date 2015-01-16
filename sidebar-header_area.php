<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<?php
if ( is_active_sidebar( 'header_area' ) ) : ?>
	<div id="header_widget" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php
					$the_sidebars = wp_get_sidebars_widgets();
					$widget_count = count($the_sidebars['header_area']);
				?>
				<?php dynamic_sidebar( 'header_area' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>