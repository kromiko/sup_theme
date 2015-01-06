<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<?php get_sidebar( 'left' ); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
		<?php
			// WP_Query arguments
			$args = array (
				'post_status' => 'publish',
				'meta_value'  => 'mustread',
				'order'       => 'DESC',
				'orderby'     => 'date'
			);
			
			// The Query
			$query = new WP_Query( $args );
			
			$must_read_ids = array();
			
			if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$post_id = $query->post->ID;
						$must_read_ids[] = $post_id;
						if (is_user_logged_in()){
							$read_posts = get_user_meta(get_current_user_id(), '_read_post', true);
							$read_posts_arr = explode(", ", $read_posts);
							if (!in_array((string)$post_id, $read_posts_arr, true)){
								get_template_part( 'content', get_post_format($post_id) );
							}
						} else {
							get_template_part( 'content', get_post_format($post_id) );
						}
					}
					wp_reset_postdata();
				}
			
			if (is_user_logged_in()){
				$user_read_posts = get_user_meta(get_current_user_id(), '_read_post', true);
				$user_read_posts_arr = explode(", ", $user_read_posts);
				$posts_to_exclude = array_diff($must_read_ids, $user_read_posts_arr);
				$args1 = array (
					'post_status' => 'publish',
					'post__not_in' => $posts_to_exclude,
					'order'       => 'DESC',
					'orderby'     => 'date'
				);
			} else {
				$args1 = array (
					'post_status' => 'publish',
					'meta_query' => array(
						array(
							'key' => 'important_field',
							'compare' => 'NOT EXISTS'
						),
					),
					'order'       => 'DESC',
					'orderby'     => 'date'
				);
			}
			$query1 = new WP_Query( $args1 );
			if ( $query1->have_posts() ) {
					while ( $query1->have_posts() ) {
						$query1->the_post();
						$post_id1 = $query1->post->ID;
						get_template_part( 'content', get_post_format($post_id1) );
					}
					wp_reset_postdata();
				}
			
				twentythirteen_paging_nav(); ?>

		<?php// } else { ?>
			<?php// get_template_part( 'content', 'none' ); ?>
		<?php// } ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>