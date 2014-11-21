<?php
/**
 * Template Name: User Rating Page
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<header class="archive-header">
				<h1 class="archive-title"><?php echo __( 'User rating', 'twentythirteen' ); ?></h1>
			</header>
			<div class="entry-content">
			<?php
				$args = array(
					'meta_key'     => '_pts',
					'fields'       => 'ID'
				);
				$ranked_user_ids = get_users( $args );
				
				function display_user_rank($display_rank, $ids){
					foreach ($ids as $ranked_user_id){
						$user_rank = get_user_meta($ranked_user_id, '_pts', true);
						$user_avatar = get_user_meta($ranked_user_id, 'simple_local_avatar', true);
						$user_avatar_url = $user_avatar[96];
						$dates_arr = array();
						foreach ($user_rank as $k => $v) {
							$dates_arr[$k] = strtotime( $v['date'] );
						}
						$key = array_search( max($dates_arr), $dates_arr );
						$cur_view = $user_rank[$key];
						$latest_date = $cur_view['date'];
						$last_rank = $cur_view['cur_rank'];
						$user_display_name = get_userdata($ranked_user_id);
						$output = '<div class="item"><img class="rank_avatar" src="' . $user_avatar_url . '" width="96" height="96" /><h5>' . $user_display_name->display_name .'</h5><span class="date">From: ' . $latest_date . '</span></div>';
						if ($display_rank == $last_rank){
							echo $output;
						}
					}
				}
			?> 
				<div class="rank">
					<div class="seven"><span class="rank_value"><?php echo __( '7', 'twentythirteen' ); ?></span>
						<?php
							display_user_rank('7', $ranked_user_ids);
						?>
					</div>
					<div class="six"><span class="rank_value"><?php echo __( '6', 'twentythirteen' ); ?></span>
						<?php display_user_rank('6', $ranked_user_ids); ?>
					</div>
					<div class="five"><span class="rank_value"><?php echo __( '5', 'twentythirteen' ); ?></span>
						<?php display_user_rank('5', $ranked_user_ids); ?>
					</div>
					<div class="four"><span class="rank_value"><?php echo __( '4', 'twentythirteen' ); ?></span>
						<?php display_user_rank('4', $ranked_user_ids); ?>
					</div>
					<div class="three"><span class="rank_value"><?php echo __( '3', 'twentythirteen' ); ?></span>
						<?php display_user_rank('3', $ranked_user_ids); ?>
					</div>
					<div class="two"><span class="rank_value"><?php echo __( '2', 'twentythirteen' ); ?></span>
						<?php display_user_rank('2', $ranked_user_ids); ?>
					</div>
					<div class="one"><span class="rank_value"><?php echo __( '1', 'twentythirteen' ); ?></span>
						<?php display_user_rank('1', $ranked_user_ids); ?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>