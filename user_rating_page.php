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
						if (!$user_avatar_url){
							$user_avatar_url = get_template_directory_uri() . '/images/mystery-man.jpg';
						}
						$dates_arr = array();
						foreach ($user_rank as $k => $v) {
							$dates_arr[$k] = strtotime( $v['date'] );
						}
						$key = array_search( max($dates_arr), $dates_arr );
						$cur_view = $user_rank[$key];
						$latest_date = $cur_view['date'];
						$last_rank = $cur_view['cur_rank'];
						$pts_val = $cur_view['pts'];
						if ($last_rank < 5){
							if ($pts_val < 501){
								$class = ' pts500';
							} elseif ($pts_val > 500 && $pts_val < 1001){
								$class = ' pts1000';
							} elseif ($pts_val > 1000 && $pts_val < 1501){
								$class = ' pts1500';
							} elseif ($pts_val > 1500 && $pts_val < 2001){
								$class = ' pts2000';
							} elseif ($pts_val > 2000 && $pts_val < 2501){
								$class = ' pts2500';
							} elseif ($pts_val > 2500 && $pts_val < 3001){
								$class = ' pts3000';
							} elseif ($pts_val > 3000 && $pts_val < 3501){
								$class = ' pts3500';
							} elseif ($pts_val > 3500 && $pts_val < 4001){
								$class = ' pts4000';
							} elseif ($pts_val > 4000 && $pts_val < 4501){
								$class = ' pts4500';
							} elseif ($pts_val > 4500 && $pts_val < 5001){
								$class = ' pts5000';
							} elseif ($pts_val > 5000 && $pts_val < 5501){
								$class = ' pts5500';
							} elseif ($pts_val > 5500 && $pts_val < 6001){
								$class = ' pts6000';
							} elseif ($pts_val > 6000 && $pts_val < 6501){
								$class = ' pts6500';
							} elseif ($pts_val > 6500 && $pts_val < 7001){
								$class = ' pts7000';
							} elseif ($pts_val > 7000 && $pts_val < 7501){
								$class = ' pts7500';
							} elseif ($pts_val > 7500 && $pts_val < 8001){
								$class = ' pts8000';
							} elseif ($pts_val > 8000 && $pts_val < 8501){
								$class = ' pts8500';
							} elseif ($pts_val > 8500 && $pts_val < 9001){
								$class = ' pts9000';
							} elseif ($pts_val > 9000 && $pts_val < 9501){
								$class = ' pts9500';
							} elseif ($pts_val > 9500 && $pts_val < 10000){
								$class = ' pts10000';
							} elseif ($pts_val >= 10000){
								$class = ' pts-peak';
							} else {
								$class = '';
							}
						} elseif ($last_rank > 4 && $last_rank < 7){
							if ($pts_val < 701){
								$class = ' pts500';
							} elseif ($pts_val > 700 && $pts_val < 1401){
								$class = ' pts1000';
							} elseif ($pts_val > 1400 && $pts_val < 2101){
								$class = ' pts1500';
							} elseif ($pts_val > 2100 && $pts_val < 2801){
								$class = ' pts2000';
							} elseif ($pts_val > 2800 && $pts_val < 3501){
								$class = ' pts2500';
							} elseif ($pts_val > 3500 && $pts_val < 4201){
								$class = ' pts3000';
							} elseif ($pts_val > 4200 && $pts_val < 4901){
								$class = ' pts3500';
							} elseif ($pts_val > 4900 && $pts_val < 5601){
								$class = ' pts4000';
							} elseif ($pts_val > 5600 && $pts_val < 6301){
								$class = ' pts4500';
							} elseif ($pts_val > 6300 && $pts_val < 7001){
								$class = ' pts5000';
							} elseif ($pts_val > 7000 && $pts_val < 7701){
								$class = ' pts5500';
							} elseif ($pts_val > 7700 && $pts_val < 8401){
								$class = ' pts6000';
							} elseif ($pts_val > 8400 && $pts_val < 9101){
								$class = ' pts6500';
							} elseif ($pts_val > 9100 && $pts_val < 9801){
								$class = ' pts7000';
							} elseif ($pts_val > 9800 && $pts_val < 10501){
								$class = ' pts7500';
							} elseif ($pts_val > 10500 && $pts_val < 11201){
								$class = ' pts8000';
							} elseif ($pts_val > 11200 && $pts_val < 11901){
								$class = ' pts8500';
							} elseif ($pts_val > 11900 && $pts_val < 12601){
								$class = ' pts9000';
							} elseif ($pts_val > 12600 && $pts_val < 13301){
								$class = ' pts9500';
							} elseif ($pts_val > 13300 && $pts_val < 15000){
								$class = ' pts10000';
							} elseif ($pts_val >= 15000){
								$class = ' pts-peak';
							} else {
								$class = '';
							}
						} elseif ($last_rank > 6 && $last_rank < 9){
							if ($pts_val < 1001){
								$class = ' pts500';
							} elseif ($pts_val > 1000 && $pts_val < 2001){
								$class = ' pts1000';
							} elseif ($pts_val > 2000 && $pts_val < 3001){
								$class = ' pts1500';
							} elseif ($pts_val > 3000 && $pts_val < 4001){
								$class = ' pts2000';
							} elseif ($pts_val > 4000 && $pts_val < 5001){
								$class = ' pts2500';
							} elseif ($pts_val > 5000 && $pts_val < 6001){
								$class = ' pts3000';
							} elseif ($pts_val > 6000 && $pts_val < 7001){
								$class = ' pts3500';
							} elseif ($pts_val > 7000 && $pts_val < 8001){
								$class = ' pts4000';
							} elseif ($pts_val > 8000 && $pts_val < 9001){
								$class = ' pts4500';
							} elseif ($pts_val > 9000 && $pts_val < 10001){
								$class = ' pts5000';
							} elseif ($pts_val > 10000 && $pts_val < 11001){
								$class = ' pts5500';
							} elseif ($pts_val > 11000 && $pts_val < 12001){
								$class = ' pts6000';
							} elseif ($pts_val > 12000 && $pts_val < 13001){
								$class = ' pts6500';
							} elseif ($pts_val > 13000 && $pts_val < 14001){
								$class = ' pts7000';
							} elseif ($pts_val > 14000 && $pts_val < 15001){
								$class = ' pts7500';
							} elseif ($pts_val > 15000 && $pts_val < 16001){
								$class = ' pts8000';
							} elseif ($pts_val > 16000 && $pts_val < 17001){
								$class = ' pts8500';
							} elseif ($pts_val > 17000 && $pts_val < 18001){
								$class = ' pts9000';
							} elseif ($pts_val > 18000 && $pts_val < 19001){
								$class = ' pts9500';
							} elseif ($pts_val > 19000 && $pts_val < 20000){
								$class = ' pts10000';
							} elseif ($pts_val >= 20000){
								$class = ' pts-peak';
							} else {
								$class = '';
							}
						} elseif ($last_rank > 8 && $last_rank < 11){
							if ($pts_val < 1251){
								$class = ' pts500';
							} elseif ($pts_val > 1250 && $pts_val < 2501){
								$class = ' pts1000';
							} elseif ($pts_val > 2500 && $pts_val < 3751){
								$class = ' pts1500';
							} elseif ($pts_val > 3750 && $pts_val < 5001){
								$class = ' pts2000';
							} elseif ($pts_val > 5000 && $pts_val < 6251){
								$class = ' pts2500';
							} elseif ($pts_val > 6250 && $pts_val < 7501){
								$class = ' pts3000';
							} elseif ($pts_val > 7500 && $pts_val < 8751){
								$class = ' pts3500';
							} elseif ($pts_val > 8750 && $pts_val < 10001){
								$class = ' pts4000';
							} elseif ($pts_val > 10000 && $pts_val < 11251){
								$class = ' pts4500';
							} elseif ($pts_val > 11250 && $pts_val < 12501){
								$class = ' pts5000';
							} elseif ($pts_val > 12500 && $pts_val < 13751){
								$class = ' pts5500';
							} elseif ($pts_val > 13750 && $pts_val < 15001){
								$class = ' pts6000';
							} elseif ($pts_val > 15000 && $pts_val < 16251){
								$class = ' pts6500';
							} elseif ($pts_val > 16250 && $pts_val < 17501){
								$class = ' pts7000';
							} elseif ($pts_val > 17500 && $pts_val < 18751){
								$class = ' pts7500';
							} elseif ($pts_val > 18750 && $pts_val < 20001){
								$class = ' pts8000';
							} elseif ($pts_val > 20000 && $pts_val < 21251){
								$class = ' pts8500';
							} elseif ($pts_val > 21250 && $pts_val < 22501){
								$class = ' pts9000';
							} elseif ($pts_val > 22500 && $pts_val < 23751){
								$class = ' pts9500';
							} elseif ($pts_val > 23750 && $pts_val < 25000){
								$class = ' pts10000';
							} elseif ($pts_val >= 25000){
								$class = ' pts-peak';
							} else {
								$class = '';
							}
						} else {
							if ($pts_val < 1501){
								$class = ' pts500';
							} elseif ($pts_val > 1500 && $pts_val < 3001){
								$class = ' pts1000';
							} elseif ($pts_val > 3000 && $pts_val < 4501){
								$class = ' pts1500';
							} elseif ($pts_val > 4500 && $pts_val < 6001){
								$class = ' pts2000';
							} elseif ($pts_val > 6000 && $pts_val < 7501){
								$class = ' pts2500';
							} elseif ($pts_val > 7500 && $pts_val < 9001){
								$class = ' pts3000';
							} elseif ($pts_val > 9000 && $pts_val < 10501){
								$class = ' pts3500';
							} elseif ($pts_val > 10500 && $pts_val < 12001){
								$class = ' pts4000';
							} elseif ($pts_val > 12000 && $pts_val < 13501){
								$class = ' pts4500';
							} elseif ($pts_val > 13500 && $pts_val < 15001){
								$class = ' pts5000';
							} elseif ($pts_val > 15000 && $pts_val < 16501){
								$class = ' pts5500';
							} elseif ($pts_val > 16500 && $pts_val < 18001){
								$class = ' pts6000';
							} elseif ($pts_val > 18000 && $pts_val < 19501){
								$class = ' pts6500';
							} elseif ($pts_val > 19500 && $pts_val < 21001){
								$class = ' pts7000';
							} elseif ($pts_val > 21000 && $pts_val < 22501){
								$class = ' pts7500';
							} elseif ($pts_val > 22500 && $pts_val < 24001){
								$class = ' pts8000';
							} elseif ($pts_val > 24000 && $pts_val < 25501){
								$class = ' pts8500';
							} elseif ($pts_val > 25500 && $pts_val < 27001){
								$class = ' pts9000';
							} elseif ($pts_val > 27000 && $pts_val < 28501){
								$class = ' pts9500';
							} elseif ($pts_val > 28500 && $pts_val < 30000){
								$class = ' pts10000';
							} elseif ($pts_val >= 30000){
								$class = ' pts-peak';
							} else {
								$class = '';
							}
						}
						$user_display_name = get_userdata($ranked_user_id);
						$output = '<div class="item'. $class .'"><img class="rank_avatar" src="' . $user_avatar_url . '" width="45" height="45" /><h5>' . $user_display_name->display_name .'</h5><span class="pts_val">PTS: '. $pts_val .'</span><div class="date">From: ' . $latest_date . '</div></div>';
						if ($display_rank == $last_rank){
							echo $output;
						}
					}
				}
			?> 
				<div class="rank">
					<div class="twelve">
						<span class="rank_value"><?php echo __( '12', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'magician', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('15', $ranked_user_ids); ?>
					</div>
					<div class="eleven"><span class="rank_value"><?php echo __( '11', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'star technician', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('14', $ranked_user_ids); ?>
					</div>
					<div class="ten"><span class="rank_value"><?php echo __( '10', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'the legend', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('13', $ranked_user_ids); ?>
					</div>
					<div class="nine"><span class="rank_value"><?php echo __( '9', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'grand-master', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('12', $ranked_user_ids); ?>
					</div>
					<div class="eight"><span class="rank_value"><?php echo __( '8', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'master', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('11', $ranked_user_ids); ?>
					</div>
					<div class="seven"><span class="rank_value"><?php echo __( '7', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'guru', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('10', $ranked_user_ids); ?>
					</div>
					<div class="six"><span class="rank_value"><?php echo __( '6', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'expert', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('9', $ranked_user_ids); ?>
					</div>
					<div class="five"><span class="rank_value"><?php echo __( '5', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'leading technician', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('8', $ranked_user_ids); ?>
					</div>
					<div class="four"><span class="rank_value"><?php echo __( '4', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'senior technician', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('7', $ranked_user_ids); ?>
					</div>
					<div class="three"><span class="rank_value"><?php echo __( '3', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'junior technician', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('6', $ranked_user_ids); ?>
					</div>
					<div class="two"><span class="rank_value"><?php echo __( '2', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'sophomore', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('5', $ranked_user_ids); ?>
					</div>
					<div class="one"><span class="rank_value"><?php echo __( '1', 'twentythirteen' ); ?><span class="rank_name"><?php echo __( 'follower', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('4', $ranked_user_ids); ?>
					</div>
					<div class="apprentice"><span class="rank_value"><span class="rank_name"><?php echo __( 'apprentice', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('3', $ranked_user_ids); ?>
					</div>
					<div class="neophyte"><span class="rank_value"><span class="rank_name"><?php echo __( 'neophyte', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('2', $ranked_user_ids); ?>
					</div>
					<div class="novice"><span class="rank_value"><span class="rank_name"><?php echo __( 'novice', 'twentythirteen' ); ?></span></span>
						<?php display_user_rank('1', $ranked_user_ids); ?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<script type="text/javascript">
jQuery('.item').hover(function(){
	jQuery('.date', this).fadeToggle(200);
});
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>