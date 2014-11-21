<?php
/**
 * Template Name: User Profile Page
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 */

get_header(); ?>

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
								<li><a href="#tabs-1">User account options</a></li>
								<li><a href="#tabs-2">User custom options</a></li>
							</ul>
							
							<div id="tabs-1">
								<input type="text" disabled name="userid" id="userid" hidden value="<?php echo $current_user->ID; ?>" />
								<p><label for="username">Username </label>
								<input type="text" disabled name="username" id="username" value="<?php echo $current_user->user_login; ?>" /></p>
								<p><label for="useremail">User email </label>
								<input type="text" name="useremail" id="useremail" value="<?php echo $current_user->user_email; ?>" /></p>
								<p><label for="userfirstname">User first name </label>
								<input type="text" name="userfirstname" id="userfirstname" value="<?php echo $current_user->user_firstname; ?>" /></p>
								<p><label for="userlastname">User last name </label>
								<input type="text" name="userlastname" id="userlastname" value="<?php echo $current_user->user_lastname; ?>" /></p>
								<p><label for="userdisplayname">User display name </label>
								<input type="text" name="userdisplayname" id="userdisplayname" value="<?php echo $current_user->display_name; ?>" /></p>
								<p><label for="userpswd">New password </label>
								<input type="password" name="userpswd" id="userpswd" value="" /></p>
								<p>
									<label for="userpswdconfirm">Confirm new password </label>
									<input type="password" name="userpswdconfirm" id="userpswdconfirm" value="" />
									<span class="pswd_check"></p>
								</p>
								<p><input id="upd-profile" type="submit" value="Update profile" /></p>
							</div>
							
							<div id="tabs-2">
								<p class="userhobby"><label for="userhobby">User hobby </label>
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
                                        	<strong>Nothing found. Please ask blog admin to add some hobbies.</strong>
                                        <?php } ?>
										<input type="submit" id="add-hobbies" name="add-hobbies" value="Add hobbies" />
									</div>
							</div>
						</div>
                    </form>
    
					<?php } else { ?>
                        You need to <?php wp_loginout($_SERVER['REQUEST_URI']); ?> to view your profile information.
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
			update_password_ajax(
				'<?php echo $usr_id ?>',
				newPswd,
				confPswd,
				newMail,
				newFirstname,
				newLastname,
				newDisplayname
			);
		});
	</script>
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>