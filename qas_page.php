<?php
/**
 * Template Name: QAS Page
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
					'post_type'   => 'qas',
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
					$status = get_post_meta(get_the_ID(), 'qas_status_field', true);
					$template_type = get_post_meta(get_the_ID(), 'template_type_field', true);
					$problem_type = get_post_meta(get_the_ID(), 'problem_type_field', true);
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
						<header class="entry-header">
							<h3 class="entry-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="entry-meta">
								<span class="the_author"><strong><?php echo __( 'Author: ', 'twentythirteen' ); ?></strong><?php the_author(); ?></span>
								<?php if ($template_type) { ?>
									<span class="template_type">
										<strong>
											<?php echo __( 'Template type(s): ', 'twentythirteen' ); ?>
										</strong>
										<?php
											$tot_num = count($template_type);
											$i = 1;
											foreach($template_type as $item){
												if($i != $tot_num){
													$comma = ', ';
												} else {
													$comma = '';
												}
												echo '<span class="coautor">' . $item . $comma . '</span>';
												$i++;
											}
										?>
									</span>
								<?php } ?>
								<?php if ($problem_type) { ?>
									<span class="problem_type">
										<strong>
											<?php echo __( 'Problem type(s): ', 'twentythirteen' ); ?>
										</strong>
										<?php
											$tot_num = count($problem_type);
											$i = 1;
											foreach($problem_type as $item){
												if($i != $tot_num){
													$comma = ', ';
												} else {
													$comma = '';
												}
												echo '<span class="coautor">' . $item . $comma . '</span>';
												$i++;
											}
										?>
									</span>
								<?php } ?>
								<?php if ($status){ ?>
								<span class="status"><strong><?php echo __( 'Status: ', 'twentythirteen' ); ?></strong>
									<section class="pb_container">
									<?php if (($status == 'Open') || ($status == 'In Progress') || ($status == 'Approved') || ($status == 'final_reject')) { ?>
										<?php if ($status == 'Open'){ ?>
											<input type="radio" class="radio zero" name="progress<?php echo rand(); ?>" value="zero" checked>
										<?php } else { ?>
											<input type="radio" class="radio zero" name="progress<?php echo rand(); ?>" value="zero">
										<?php } ?>
										<label for="zero" class="label zero"><span class="open"><?php echo __( 'Open', 'twentythirteen' ); ?></span></label>
										
										<?php if ($status == 'In Progress'){ ?>
											<input type="radio" class="radio fifty" name="progress<?php echo rand(); ?>" value="fifty" checked>
										<?php } else { ?>
											<input type="radio" class="radio fifty" name="progress<?php echo rand(); ?>" value="fifty">
										<?php } ?>
										<label for="fifty" class="label fifty"><span class="prog"><?php echo __( 'In progress', 'twentythirteen' ); ?></span></label>
										
										<?php if ($status == 'Approved'){ ?>
											<input type="radio" class="radio onehundred finished" name="progress<?php echo rand(); ?>" value="onehundred" checked>
											<label for="onehundred" class="label onehundred finished"><span class="finished"><?php echo __( 'Approved', 'twentythirteen' ); ?></span></label>
										<?php } elseif ($status == 'final_reject') { ?>
											<input type="radio" class="radio onehundred reject" name="progress<?php echo rand(); ?>" value="onehundred" checked>
											<label for="onehundred" class="label onehundred reject"><span class="reject"><?php echo __( 'Rejected', 'twentythirteen' ); ?></span></label>
										<?php } else { ?>
											<input type="radio" class="radio onehundred" name="progress<?php echo rand(); ?>" value="onehundred">
											<label for="onehundred" class="label onehundred finished"><span class="finished"><?php echo __( 'Approved', 'twentythirteen' ); ?></span></label>
										<?php } ?>
										
									<?php } else { ?>
										<?php if ($status == 'Open'){ ?>
											<input type="radio" class="radio zero" name="progress<?php echo rand(); ?>" value="zero" checked>
										<?php } else { ?>
											<input type="radio" class="radio zero" name="progress<?php echo rand(); ?>" value="zero">
										<?php } ?>
										<label for="zero" class="label zero"><span class="open"><?php echo __( 'Open', 'twentythirteen' ); ?></span></label>
										
										<?php if ($status == 'Rejected'){ ?>
											<input type="radio" class="radio onehundred reject" name="progress<?php echo rand(); ?>" value="onehundred" checked>
											<label for="onehundred" class="label onehundred reject"><span class="reject"><?php echo __( 'Rejected', 'twentythirteen' ); ?></span></label>
										<?php } else { ?>
											<input type="radio" class="radio onehundred" name="progress<?php echo rand(); ?>" value="onehundred">
											<label for="onehundred" class="label onehundred"><span class="reject"><?php echo __( 'Rejected', 'twentythirteen' ); ?></span></label>
										<?php } ?>
									<?php } ?>
										<div class="progress">
											<div class="progress-bar"></div>
										</div>
									</section>
								</span>
								<?php } ?>
								<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
							</div>
							<div class="karma_block">
								<a class="karma plus"><i class="fa fa-thumbs-up"></i></a><span class="karma_val"><?php if(function_exists('karma_results_display')) { echo karma_results_display(get_the_ID()); } ?></span><a class="karma minus"><i class="fa fa-thumbs-down"></i></a>
								<div class="msg"></div>
							</div>
							<div class="fav_post"><?php wpfp_link(); ?></div>
							<div class="clear"></div>
						</header>
						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div>
						<footer class="entry-meta">
							<?php if ( comments_open() && ! is_single() ) : ?>
								<div class="comments-link">
									<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
								</div><!-- .comments-link -->
							<?php endif; // comments_open() ?>
						</footer><!-- .entry-meta -->
				</article>
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