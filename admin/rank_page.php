<?php
add_action( 'admin_menu', 'rank_menu' );

function rank_menu() {
	add_options_page( 'User rank management', 'User rank management', 'manage_options', 'rank-menu', 'rank_menu_admin_output' );
}

function rank_menu_admin_output() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	$cur_rank_field_name = 'cur_rank';
	$pts_field_name = 'pts';
	$pts_date_field_name = 'datepicker_pts';
	
    $hidden_field_name = 'rank_submit_hidden';
	
	$pts_opt_name = '_pts';

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if(($_POST[ $hidden_field_name ] && $_POST[ $hidden_field_name ] == 'Y' )) {
        // Read their posted value
		$user_id = strip_tags($_POST['users']);
		
		$cur_rank_val = strip_tags($_POST[ $cur_rank_field_name ]);
        $pts_val = strip_tags($_POST[ $pts_field_name ]);
		$pts_date_val = strip_tags($_POST[ $pts_date_field_name ]);
		
		$todb_pts_val = get_user_meta($user_id, $pts_opt_name, true);
		$todb_pts_val[] = array('cur_rank' => $cur_rank_val, 'pts' => $pts_val, 'date' => $pts_date_val);
		
        // Save the posted value in the database
		if($cur_rank_val && $pts_val && $pts_date_val){
			update_user_meta($user_id, $pts_opt_name, $todb_pts_val); 
		} ?>
		<div class="updated"><p><strong><?php echo _e('User data was updated.', 'twentythirteen' )?></strong></p></div>
	<?php 
	}
	// display the settings editing screen
	echo '<div class="wrap">';
	
	// header
	echo "<h2>" . __( 'Update User\'s Rank Values', 'twentythirteen' ) . "</h2>";
	
	// settings form
?>
<div id="message"></div>
<form name="form1" id="admin_rank_form" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><label><?php _e("Select user to view/edit rank and PTS value:", 'twentythirteen'); ?> </label><select id="users" name="users">
	<option value=""><?php _e("-------------", 'twentythirteen'); ?></option>
	<?php
		$users = get_users(array('orderby' => 'display_name','order' => 'ASC','fields' => array('ID', 'display_name')));
		foreach($users as $user){
			echo '<option value="' . $user->ID . '">' . $user->display_name . '</option>';
		}
	?>
</select></p>

<h3>Add new PTS/Rank value</h3>
<p>
	<label><?php _e("User rank:", 'twentythirteen' ); ?></label>
	<input type="text" id="<?php echo $cur_rank_field_name; ?>" name="<?php echo $cur_rank_field_name; ?>" value="" size="10">
	<label><?php _e("User PTS value:", 'twentythirteen' ); ?></label>
	<input type="text" id="<?php echo $pts_field_name; ?>" name="<?php echo $pts_field_name; ?>" value="" size="10">
	<label><?php _e("Update date:", 'twentythirteen' ); ?></label>
	<input type="text" id="<?php echo $pts_date_field_name; ?>" name="<?php echo $pts_date_field_name; ?>" value="" size="10">
</p>

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>

</form>
<div id="pts_msg">
	<span class="loader">Loading Data <img src="<?php echo get_template_directory_uri() . '/images/ajax-loader.gif'; ?>" width="16" height="11" alt="loader" /></span>
	<div></div>
</div>
</div>
<script type="text/javascript">
	jQuery(function() {
		jQuery( "#datepicker_pts" ).datepicker({dateFormat:"dd.mm.yy"});
	});
	jQuery('#users').change(function(){
		jQuery('#<?php echo $pts_field_name; ?>').val('');
		var usrID = jQuery('#users').val();
		if (usrID){
			var data = {
				action: 'get_rating_data',
				usrid: usrID
			}
			jQuery.ajax({
				url: ajaxurl,
				type: "POST",
				data: data,
				beforeSend: function(){
					jQuery('#pts_msg div').html('');
					jQuery('.loader').css('display','inline');
				},
				success: function(msg){
					jQuery('.loader').css('display','none');
					if (msg.message_pts){
						jQuery('#pts_msg div').html(msg.message_pts);
					} else {
						jQuery('#pts_msg div').html('No data');
					}
				}
			});
		} else {
			jQuery('#pts_msg div').html('');
		}
	});
</script>
<style>
span.loader{
	display:none;
}

table{
	border-collapse:collapse;
}
table tr:first-child:hover{
	background:none;
	color:#444;
}
table tr{
	transition:all 200ms ease-out;
}
table tr:hover{
	background:rgba(0,0,0,0.5);
	color:#fff;
	transition:all 200ms ease-out;
}
table td, table th{
	padding:5px;
	border:1px solid #666;
}
table th{
	text-align:center;
}
</style>
<?php
}