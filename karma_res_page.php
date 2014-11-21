<?php
/**
 * Template Name: Karma Results Page
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<header class="archive-header">
				<h1 class="archive-title"><?php echo __( 'Total karma by author', 'twentythirteen' ); ?></h1>
			</header>
			<?php
				if (function_exists('karma_list_results')){ echo karma_list_results();}
			?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>