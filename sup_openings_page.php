<?php
/**
 * Template Name: Support Openings Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
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
					'post_type'   => 'sup_openings',
					'post_status' => 'publish',
					'order'       => 'DESC',
					'orderby'     => 'date'
				);
				
				// The Query
				$query = new WP_Query( $args );?>
				<?php // The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$post_id = $query->post->ID;
			?>
				<?php
					$city = get_post_meta($post_id, 'city_field', true);
					$gender = get_post_meta($post_id, 'gender_field', true);
					$shift = get_post_meta($post_id, 'shift_field', true);
					$language = get_post_meta($post_id, 'language_field', true);
					$number_needed = get_post_meta($post_id, 'number_needed_field', true);
					$reqs = get_post_meta($post_id, 'requirements_field', true);
					$contacts = get_post_meta($post_id, 'contacts_field', true);
					$bonus = get_post_meta($post_id, 'bonus_field', true);
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
						<header class="entry-header">
						<h3 class="entry-title">
							<?php the_title(); ?>
						</h3>
						</header>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<div class="entry-meta">
							<?php
								echo '<span class="itm"><strong>City:</strong> ' . $city . '</span><br /><span class="itm"><strong>Gender:</strong> ' . $gender . '</span><br /><span class="itm"><strong>Shift:</strong> ' . $shift . '</span><br /><span class="itm"><strong>Languages Needed:</strong> ' . $language . '</span><br /><span class="itm"><strong>Vacancies:</strong> ' . $number_needed . '</span><br /><span class="itm"><strong>Requirements:</strong> ' . $reqs . '</span><br /><span class="itm"><strong>Contacts:</strong> ' . $contacts . '</span><br /><span class="itm"><strong>Bonus:</strong> ' . $bonus . '</span>';
							?>
						</div>
						<footer class="entry-meta">
							<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- .entry-meta -->

				</article>
			<?php }
				} else { ?>
                <?php // no posts found ?>
			<?php } ?>
            <?php 
				// Restore original Post Data
				wp_reset_postdata();
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>