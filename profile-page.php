<?php
/**
 * Template Name: User Profile Page
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 */

get_header(); ?>
<?php get_sidebar( 'left' ); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
        	
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->
                <div class="entry-content">
					<?php if (is_user_logged_in()){ ?>
					<?php
						global $current_user;
						get_currentuserinfo();
						$gender = get_user_meta($current_user->ID, '_gender', true);
						$city = get_user_meta($current_user->ID, '_city', true);
						$shift = get_user_meta($current_user->ID, '_shift', true);
						if ($shift){
							asort($shift);
						}
					?>
					<div id="service_message"></div>
					<div id="error_message"></div>
					<div id="email_message"></div>
					<div id="email_error_message"></div>
					<div id="name_message"></div>
					<div id="hob_message"></div>
					<div id="hob_error_message"></div>
                    <form id="userform">
						
						<div id="tabs">
							<ul>
								<li><a href="#tabs-1"><?php echo __( 'User account options', 'twentythirteen' ); ?></a></li>
								<li><a href="#tabs-2"><?php echo __( 'User custom options', 'twentythirteen' ); ?></a></li>
							</ul>
							
							<div id="tabs-1">
								<input type="text" disabled name="userid" id="userid" hidden value="<?php echo $current_user->ID; ?>" />
								<p><label for="username"><?php echo __( 'Username', 'twentythirteen' ); ?></label>
								<input type="text" disabled name="username" id="username" value="<?php echo $current_user->user_login; ?>" /></p>
								<p><label for="useremail"><?php echo __( 'User email', 'twentythirteen' ); ?></label>
								<input type="text" name="useremail" id="useremail" value="<?php echo $current_user->user_email; ?>" /></p>
								<p><label for="userfirstname"><?php echo __( 'User first name', 'twentythirteen' ); ?></label>
								<input type="text" name="userfirstname" id="userfirstname" value="<?php echo $current_user->user_firstname; ?>" /></p>
								<p><label for="userlastname"><?php echo __( 'User last options', 'twentythirteen' ); ?></label>
								<input type="text" name="userlastname" id="userlastname" value="<?php echo $current_user->user_lastname; ?>" /></p>
								<p><label for="userdisplayname"><?php echo __( 'User display name', 'twentythirteen' ); ?></label>
								<input type="text" name="userdisplayname" id="userdisplayname" value="<?php echo $current_user->display_name; ?>" /></p>
								<p>
									<label for="usergender"><?php echo __( 'User gender', 'twentythirteen' ); ?></label>
									<input type="radio" name="usergender" id="usergender_male" value="male" <?php if ($gender == 'male') { ?>checked<?php } ?> /> <?php echo __( 'Male', 'twentythirteen' ); ?>
									<input type="radio" name="usergender" id="usergender_female" value="female" <?php if ($gender == 'female') { ?>checked<?php } ?> /> <?php echo __( 'Female', 'twentythirteen' ); ?>
								</p>
								<p>
									<label for="usercity"><?php echo __( 'City', 'twentythirteen' ); ?></label>
									<input type="radio" name="usercity" id="usercity_niko" value="Nikolaev" <?php if ($city == 'Nikolaev') { ?>checked<?php } ?> /><?php echo __( ' Nikolaev', 'twentythirteen' ); ?>
									<input type="radio" name="usercity" id="usercity_kher" value="Kherson" <?php if ($city == 'Kherson') { ?>checked<?php } ?> /><?php echo __( ' Kherson', 'twentythirteen' ); ?>
									<input type="radio" name="usercity" id="usercity_lviv" value="Lviv" <?php if ($city == 'Lviv') { ?>checked<?php } ?> /><?php echo __( ' Lviv', 'twentythirteen' ); ?>
								</p>
								<p>
									<label for="usershift"><?php echo __( 'Shift', 'twentythirteen' ); ?></label>
									<input type="checkbox" name="usershift" id="usershift_night" value="Night" <?php if (in_array('Night', $shift)) { ?>checked<?php } ?> /><?php echo __( ' Night', 'twentythirteen' ); ?>
									<input type="checkbox" name="usershift" id="usershift_morning" value="Morning" <?php if (in_array('Morning', $shift)) { ?>checked<?php } ?> /><?php echo __( ' Morning', 'twentythirteen' ); ?>
									<input type="checkbox" name="usershift" id="usershift_day" value="Day" <?php if (in_array('Day', $shift)) { ?>checked<?php } ?> /><?php echo __( ' Day', 'twentythirteen' ); ?>
									<input type="checkbox" name="usershift" id="usershift_weekend" value="Weekend" <?php if (in_array('Weekend', $shift)) { ?>checked<?php } ?> /><?php echo __( ' Weekend', 'twentythirteen' ); ?>
								</p>
								<p><label for="userpswd"><?php echo __( 'New password', 'twentythirteen' ); ?></label>
								<input type="password" name="userpswd" id="userpswd" value="" /></p>
								<p>
									<label for="userpswdconfirm"><?php echo __( 'Confirm new password', 'twentythirteen' ); ?></label>
									<input type="password" name="userpswdconfirm" id="userpswdconfirm" value="" />
									<span class="pswd_check"></p>
								</p>
								<p><input id="upd-profile" type="submit" value="Update profile" /></p>
							</div>
							
							<div id="tabs-2">
								<p class="userhobby"><label for="userhobby"><?php echo __( 'User hobby', 'twentythirteen' ); ?></label>
								<?php
									$usr_id = $current_user->ID;
									$hobbs = get_user_meta($usr_id, '_hobbies', true);
								?>
								<input type="text" name="userhobby" id="userhobby" value="<?php echo $hobbs; ?>" hidden="hidden" />
									<div id="hobby-list">
										<?php
											$hobbies_list = get_option('hobby');
											if ($hobbies_list) {
											foreach($hobbies_list as $cat => $value){
												echo '<div class="hobby_cat"><h5>' . $cat . '</h5>';
												$hob_compare = $hobbs[$cat];
												foreach($value as $hobby => $hob_value){ 
													$checked = ''; ?>
													<?php
														if ($hob_compare){
															if (in_array($hob_value, $hob_compare)){
																$checked = 'checked = "checked"';
															}
														}
													?>
													<label><input name="<?php echo $hob_value; ?>" id="<?php echo $hob_value; ?>" type="checkbox" <?php echo $checked; ?> name="<?php echo $hob_value; ?>" /> <?php echo $hob_value; ?></label>
										<?php											
												}
												echo '</div>';
											}
											} else {
										?>
                                        	<strong><?php echo __( 'Nothing found. Please ask blog admin to add some hobbies.', 'twentythirteen' ); ?></strong>
                                        <?php } ?>
										<input type="submit" id="add-hobbies" name="add-hobbies" value="Add hobbies" />
									</div>
							</div>
						</div>
                    </form>
    
					<?php } else { ?>
                        <?php echo __( 'You need to ', 'twentythirteen' ); ?><?php wp_loginout($_SERVER['REQUEST_URI']); ?><?php echo __( ' to view your profile information.', 'twentythirteen' ); ?>
                    <?php } ?>
                </div>
            
            </article>

		</div><!-- #content -->
	</div><!-- #primary -->

	<script type="text/javascript">
		jQuery('#upd-profile').click(function(event){
			event.preventDefault();
			var newPswd = jQuery('#userpswd').val();
			var confPswd = jQuery('#userpswdconfirm').val();
			var newMail = jQuery('#useremail').val();
			var oldMail = '<?php echo $current_user->user_email; ?>';
			var newFirstname = jQuery('#userfirstname').val();
			var oldFirstname = '<?php echo $current_user->user_firstname; ?>';
			var newLastname = jQuery('#userlastname').val();
			var oldLastname = '<?php echo $current_user->user_lastname; ?>';
			var newDisplayname = jQuery('#userdisplayname').val();
			var oldDisplayname = '<?php echo $current_user->display_name; ?>';
			var oldGender = '<?php echo $gender; ?>';
			var newGender = jQuery('input[name="usergender"]:checked').val();
			var oldCity = '<?php echo $city; ?>';
			var newCity = jQuery('input[name="usercity"]:checked').val();
			var oldShifts = <?php echo json_encode($shift); ?>;
			var shiftsRaw = [];
			jQuery('input[name="usershift"]:checked').each(function(indx){
				shiftsRaw.push(jQuery(this).val());
			});
			var shifts = shiftsRaw.sort();
			oldShiftsStr = oldShifts.toString();
			console.log(oldShiftsStr);
			shiftsStr = shifts.toString();
			console.log(shiftsStr);
			if (newMail == oldMail){
				newMail = 'false';
			}
			if (newFirstname == oldFirstname){
				newFirstname = 'false';
			}
			if (newLastname == oldLastname){
				newLastname = 'false';
			}
			if (newDisplayname == oldDisplayname){
				newDisplayname = 'false';
			}
			if (newGender == oldGender){
				newGender = 'false';
			}
			if (newCity == oldCity){
				newCity = 'false';
			}
			if (shiftsStr == oldShiftsStr){
				shifts = 'false';
			}
			update_password_ajax(
				'<?php echo $usr_id ?>',
				newPswd,
				confPswd,
				newMail,
				newFirstname,
				newLastname,
				newDisplayname,
				newGender,
				newCity,
				shifts
			);
		});
	</script>
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>