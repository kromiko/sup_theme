<?php
/**
 * The template for displaying Useful Links Category pages.
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

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Useful Links Category: %s', 'twentythirteen' ), single_cat_title( '', false ) ); ?></h1>
			</header><!-- .archive-header -->

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
            	<?php $link_url = get_post_meta($post->ID, 'link_field', true); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<header class="entry-header">
						<h1 class="entry-title">
							<?php if ( $link_url ) { ?>
								<a class="external_site" href="<?php echo $link_url; ?>" title="<?php the_title(); ?>" target="_blank">
							<?php } ?>
									<?php the_title(); ?>
							<?php if ( $link_url ) { ?>
								</a>
							<?php } ?>
						</h1>
						<div class="entry-meta">
							<?php twentythirteen_entry_meta(); ?>
							<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-meta -->
						<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
					</header><!-- .entry-header -->

					<?php if ( is_search() ) : // Only display Excerpts for Search ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
					<?php else : ?>
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->
					<?php endif; ?>

					<footer class="entry-meta">
						<?php if ( comments_open() && ! is_single() ) : ?>
							<div class="comments-link">
								<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
							</div><!-- .comments-link -->
						<?php endif; // comments_open() ?>

					</footer><!-- .entry-meta -->
				</article><!-- #post -->
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>