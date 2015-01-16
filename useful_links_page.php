<?php
/**
 * Template Name: Useful Links Page
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
					'post_type'   => 'useful_links',
					'post_status' => 'publish',
					'order'       => 'DESC',
					'orderby'     => 'date'
				);
				
				// The Query
				$query = new WP_Query( $args );?>
				<ul>
				<?php // The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$post_id = $query->post->ID;
			?>
				<?php
					$link_url = get_post_meta($post_id, 'link_field', true);
				?>
                    <li>
                            <a href="<?php if ($link_url) { echo $link_url; } else { echo get_permalink($post->ID); } ?>" title="<?php the_title(); ?>" target="_blank">
                                <?php the_title(); ?>
                            </a>
                    </li>

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

			<?php }
				} else { ?>
			<?php } ?>
            <?php 
				// Restore original Post Data
				wp_reset_postdata();
			?>
            </ul>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>