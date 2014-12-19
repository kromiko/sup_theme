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
						$user_gender = get_user_meta($ranked_user_id, '_gender', true);
						if ($user_gender == 'male'){
							$usr_ico = '<i class="fa fa-male"></i>';
						} elseif ($user_gender == 'female') {
							$usr_ico = '<i class="fa fa-female"></i>';
						} else {
							$usr_ico = '<i class="fa fa-dot-circle-o"></i>';
						}
						$user_city = get_user_meta($ranked_user_id, '_city', true);
						if ($user_city){
							$city_display = 'City: ' . $user_city . '<br />';
						} else {
							$city_display = '';
						}
						$user_shift = get_user_meta($ranked_user_id, '_shift', true);
						if ($user_shift){
							$shifts = implode(",", $user_shift);
							$shifts_display = 'Shift(s): ' . $shifts;
						} else {
							$shifts_display = '';
						}
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
						
						$min_date = new DateTime(date('d.m.Y'));
						$time_diff = $min_date->diff(new DateTime($latest_date));
						if ($last_rank < 9){
							$time_diff_value = $time_diff->days * 3.9 + 156;
						} else {
							$time_diff_value = $time_diff->days * 3.1 + 156;
						}
						if ($time_diff->days == 0){
							$time_diff_value = 156;
						}
						if ($time_diff_value > 1489){
							$time_diff_value = 1489;
						}
						if ($last_rank < 3) {
							$class = ' pts5500';
						} elseif ($last_rank > 2 && $last_rank < 5){
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
						if ($last_rank < 3){
							$output = '<div style="left:'. $time_diff_value .'px;" class="item static'. $class .'">'. $usr_ico .'<h5>' . $user_display_name->display_name .'</h5><div class="date"><img class="rank_avatar" src="' . $user_avatar_url . '" width="30" height="30" /><br /><span class="pts_val">'. $pts_val .' PTS</span><br />from ' . $latest_date . '<br />'. $time_diff->days .' day(s) on this rank<br />'. $city_display . $shifts_display .'</div></div>';
						} else {
							$output = '<div style="left:'. $time_diff_value .'px;" class="item'. $class .'">'. $usr_ico .'<h5>' . $user_display_name->display_name .'</h5><div class="date"><img class="rank_avatar" src="' . $user_avatar_url . '" width="30" height="30" /><br /><span class="pts_val">'. $pts_val .' PTS</span><br />from ' . $latest_date . '<br />'. $time_diff->days .' day(s) on this rank<br />'. $city_display . $shifts_display .'</div></div>';
						}
						if ($display_rank == $last_rank){
							echo $output;
						}
					}
				}
			?> 
				<div class="rank">
					<div class="twelve">
						<div class="rank_label"><span class="rank_value"><?php echo __( '12', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'magician', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('15', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="eleven"><div class="rank_label"><span class="rank_value"><?php echo __( '11', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'the legend', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('14', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="ten"><div class="rank_label"><span class="rank_value"><?php echo __( '10', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'star<br />technician', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('13', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="nine"><div class="rank_label"><span class="rank_value"><?php echo __( '9', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'grand-<br />master', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('12', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="eight"><div class="rank_label"><span class="rank_value"><?php echo __( '8', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'master', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('11', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="seven"><div class="rank_label"><span class="rank_value"><?php echo __( '7', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'guru', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('10', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="six"><div class="rank_label"><span class="rank_value"><?php echo __( '6', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'expert', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('9', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="five"><div class="rank_label"><span class="rank_value"><?php echo __( '5', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'leading<br />technician', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('8', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="four"><div class="rank_label"><span class="rank_value"><?php echo __( '4', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'senior<br />technician', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('7', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="three"><div class="rank_label"><span class="rank_value"><?php echo __( '3', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'junior<br />technician', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('6', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="two"><div class="rank_label"><span class="rank_value"><?php echo __( '2', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'sophomore', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('5', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="one"><div class="rank_label"><span class="rank_value"><?php echo __( '1', 'twentythirteen' ); ?></span><span class="rank_name"><?php echo __( 'follower', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('4', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="apprentice"><div class="rank_label"><span class="rank_value"></span><span class="rank_name"><?php echo __( 'apprentice', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('3', $ranked_user_ids); ?>
						<div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div><div class="month"></div>
					</div>
					<div class="neophyte"><div class="rank_label"><span class="rank_value"></span><span class="rank_name"><?php echo __( 'neophyte', 'twentythirteen' ); ?></span></div>
						<?php display_user_rank('2', $ranked_user_ids); ?>
					</div>
					<div class="novice"><div class="rank_label"><span class="rank_value"></span><span class="rank_name"><?php echo __( 'novice', 'twentythirteen' ); ?></span></div>
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