<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
$value = get_post_meta( get_the_ID(), 'important_field', true );
if ($value == 'mustread'){
	if (is_user_logged_in()){
		$read_posts = get_user_meta(get_current_user_id(), '_read_post', true);
		$read_posts_arr = explode(", ", $read_posts);
		if (!in_array((string)get_the_ID(), $read_posts_arr, true)){ ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('must_read'); ?>>
		<?php } else { ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php }
	} else { ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('must_read'); ?>>
	<?php }
} else { ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php } ?>
	<header class="entry-header">
		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>

		<div class="entry-meta">
			<?php twentythirteen_entry_meta(); ?>
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
    <?php if ( has_post_thumbnail() && ! post_password_required() && ( is_single() ) ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php
			if ($value == 'mustread'){
				if (is_single()){
					$read_users = get_post_meta(get_the_ID(), '_read_users', true);
					$all_users = my_group_listing('Group 1');
					$read_users_arr = explode(", ", $read_users);
					$not_read = array_diff($all_users,$read_users_arr);
					$not_read_string = implode(", ", $not_read);
					if ($not_read){
						echo '<p class="nonread"><label>';
						_e( 'Not read the post: ', 'support_theme' );
						echo '</label> ';
						echo $not_read_string;
						echo '</p>';
					}
					if (is_user_logged_in()){
						if (!in_array((string)get_the_ID(), $read_posts_arr, true)){
							echo '<input type="submit" value="I\'ve Read" class="submit" id="mark_read" name="mark_read" />';
						}
					} else {
						echo '<input type="submit" value="Login to mark the post as Read" class="submit" id="mark_read" name="mark_read" />';
					}
				} else {
					if (is_user_logged_in()){
						$read_posts1 = get_user_meta(get_current_user_id(), '_read_post', true);
						$read_posts_arr1 = explode(", ", $read_posts1);
						if (!in_array((string)get_the_ID(), $read_posts_arr1, true)){
							echo '<a class="important_msg" href="' . get_the_permalink() . '"><strong>This post is important, so please read it carefully!</strong></a>';
						}
					} else {
						echo '<a class="important_msg" href="' . get_the_permalink() . '"><strong>This post is important, so please read it carefully!</strong></a>';
					}
				}
			}
		?>
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
<script type="text/javascript">
<?php if (($value == 'mustread') && (is_single())) { ?>
<?php if (is_user_logged_in()) { ?>
jQuery('#mark_read').click(function(){
	readHelper(<?php echo get_current_user_id(); ?>, <?php echo get_the_ID(); ?>);
});
<?php } else { ?>
jQuery('#mark_read').click(function(){
	window.location.replace("<?php echo wp_login_url( get_permalink() ); ?>");
});
<?php } ?>
<?php } ?>
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