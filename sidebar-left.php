<?php
/**
 * Left sidebar, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
	<div id="left-hidden" class="sidebar-container" role="complementary">
		<div class="open-tag"><?php echo __( 'Show Sidebar', 'twentythirteen' ); ?></div>
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #left-hidden -->
<?php endif; ?>