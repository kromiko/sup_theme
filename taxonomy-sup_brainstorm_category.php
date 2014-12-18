<?php
/**
 * The template for displaying Support Brainstorming Category pages.
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
				<h1 class="archive-title"><?php printf( __( 'Support Brainstorming Category: %s', 'twentythirteen' ), single_cat_title( '', false ) ); ?></h1>
			</header><!-- .archive-header -->

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
            	<?php
					$deadline = get_post_meta($post->ID, 'deadline_field', true);
					$status = get_post_meta($post->ID, 'status_field', true);
					$coautors = get_post_meta($post->ID, 'coautor_field', true);
					$solution = get_post_meta($post->ID, 'solution_field', true);
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<header class="entry-header">
						<h1 class="entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
						</h1>
						<div class="entry-meta">
							<?php if ($deadline) { ?>
								<span class="deadline"><strong><?php echo __( 'Deadline: ', 'twentythirteen' ); ?></strong><?php echo $deadline; ?></span>
							<?php } ?>
							<span class="the_author"><strong><?php echo __( 'Author: ', 'twentythirteen' ); ?></strong><?php the_author(); ?></span>
							<?php if ($coautors) { ?>
								<span class="coautors">
									<strong>
										<?php echo __( 'Co-autor/s: ', 'twentythirteen' ); ?>
									</strong>
									<?php
										$tot_num = count($coautors);
										$i = 1;
										foreach($coautors as $author){
											$user = get_userdata($author);
											if($i != $tot_num){
												$comma = ', ';
											} else {
												$comma = '';
											}
											echo '<span class="coautor">' . $user->display_name . $comma . '</span>';
											$i++;
										}
									?>
								</span>
							<?php } ?>
							<?php if ($status){ ?>
								<span class="status"><strong><?php echo __( 'Status: ', 'twentythirteen' ); ?></strong>
									<section class="pb_container">
									<?php if (($status == 'Open') || ($status == 'Under Review') || ($status == 'Rejected')) { ?>
										<?php if ($status == 'Open'){ ?>
											<input type="radio" class="radio zero" name="progress<?php echo rand(); ?>" value="zero" checked>
										<?php } else { ?>
											<input type="radio" class="radio zero" name="progress<?php echo rand(); ?>" value="zero">
										<?php } ?>
										<label for="zero" class="label zero"><span class="open"><?php echo __( 'Open', 'twentythirteen' ); ?></span></label>
										
										<?php if ($status == 'Under Review'){ ?>
											<input type="radio" class="radio fifty" name="progress<?php echo rand(); ?>" value="fifty" checked>
										<?php } else { ?>
											<input type="radio" class="radio fifty" name="progress<?php echo rand(); ?>" value="fifty">
										<?php } ?>
										<label for="fifty" class="label fifty"><span class="review"><?php echo __( 'Under Review', 'twentythirteen' ); ?></span></label>
										
										<?php if ($status == 'Rejected'){ ?>
											<input type="radio" class="radio onehundred reject" name="progress<?php echo rand(); ?>" value="onehundred" checked>
										<?php } else { ?>
											<input type="radio" class="radio onehundred" name="progress<?php echo rand(); ?>" value="onehundred">
										<?php } ?>
										<label for="onehundred" class="label onehundred reject"><span class="rejected"><?php echo __( 'Rejected', 'twentythirteen' ); ?></span></label>
									<?php } else { ?>
										<?php if ($status == 'Open'){ ?>
											<input type="radio" class="radio zero" name="progress<?php echo rand(); ?>" value="zero" checked>
										<?php } else { ?>
											<input type="radio" class="radio zero" name="progress<?php echo rand(); ?>" value="zero">
										<?php } ?>
										<label for="zero" class="label zero"><span class="open"><?php echo __( 'Open', 'twentythirteen' ); ?></span></label>

										<?php if ($status == 'Under Review'){ ?>
											<input type="radio" class="radio fifty" name="progress<?php echo rand(); ?>" value="fifty" checked>
										<?php } else { ?>
											<input type="radio" class="radio fifty" name="progress<?php echo rand(); ?>" value="fifty">
										<?php } ?>
										<label for="fifty" class="label fifty"><span class="review"><?php echo __( 'Under Review', 'twentythirteen' ); ?></span></label>
										
										<?php if ($status == 'In Progress'){ ?>
											<input type="radio" class="radio seventyfive" name="progress<?php echo rand(); ?>" value="seventyfive" checked>
										<?php } else { ?>
											<input type="radio" class="radio seventyfive" name="progress<?php echo rand(); ?>" value="seventyfive">
										<?php } ?>
										<label for="seventyfive" class="label seventyfive"><span class="prog"><?php echo __( 'In Progress', 'twentythirteen' ); ?></span></label>
										
										<?php if ($status == 'Finished'){ ?>
											<input type="radio" class="radio onehundred" name="progress<?php echo rand(); ?>" value="onehundred" checked>
										<?php } else { ?>
											<input type="radio" class="radio onehundred" name="progress<?php echo rand(); ?>" value="onehundred">
										<?php } ?>
										<label for="onehundred" class="label onehundred"><span class="finished"><?php echo __( 'Finished', 'twentythirteen' ); ?></span></label>
									<?php } ?>
										<div class="progress">
											<div class="progress-bar"></div>
										</div>
									</section>
								</span>
								<?php } ?>
							<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-meta -->
						<div class="karma_block">
							<a class="karma plus"><i class="fa fa-thumbs-up"></i></a><span class="karma_val"><?php if(function_exists('karma_results_display')) { echo karma_results_display(get_the_ID()); } ?></span><a class="karma minus"><i class="fa fa-thumbs-down"></i></a>
							<div class="msg"></div>
						</div>
						<div class="fav_post"><?php wpfp_link(); ?></div>
						<div class="clear"></div>
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
					<?php if ($solution) { ?>
					<div class="entry-content">
						<strong><?php echo __( 'Solution has been proposed! ', 'twentythirteen' ); ?></strong><a href="<?php the_permalink(); ?>"><?php echo __( 'Click to read the solution.', 'twentythirteen' ); ?></a>
						<?php //echo $solution; ?>
					</div>
				<?php } ?>
					<?php endif; ?>

					<footer class="entry-meta">
						<?php if ( comments_open() && ! is_single() ) : ?>
							<div class="comments-link">
								<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
							</div><!-- .comments-link -->
						<?php endif; // comments_open() ?>

					</footer><!-- .entry-meta -->
				</article><!-- #post -->
				<script type="text/javascript">
				jQuery('#post-<?php the_ID(); ?> .karma').click(function() {
					var direction;
					if (jQuery(this).hasClass("minus")){
						direction = "-";
					} else {
						direction = "+";
					}
					karma_rate_ajax(
						'article#post-<?php echo get_the_ID(); ?>',
						'<?php echo get_the_ID(); ?>',
						direction,
						'<?php echo get_current_user_id(); ?>',
						'<?php echo get_the_author_meta('ID') ?>'
					);
				});
				</script>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>