<?php
add_action( 'admin_menu', 'hobbies_menu' );

function hobbies_menu() {
	add_options_page( 'Hobbies management', 'Hobbies management', 'manage_options', 'hobbies-menu', 'hobbies_menu_admin_output' );
}

function hobbies_menu_admin_output() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	 // variables for the field and option names 
    $opt_name = 'hobby';
    $hidden_field_name = 'hobby_submit_hidden';
	$cat_field_name = 'category';
    $data_field_name = 'hobby';

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if(($_POST[ $hidden_field_name ] && $_POST[ $hidden_field_name ] == 'Y' ) && ($_POST[ $cat_field_name ] && $_POST[ $cat_field_name ] != '' ) && ($_POST[ $data_field_name ] && $_POST[ $data_field_name ] != '' )) {
        // Read their posted value
		$cat_val = strip_tags($_POST[ $cat_field_name ]);
        $opt_val = strip_tags($_POST[ $data_field_name ]);
		$opt_val_arr = explode(",", $opt_val);
		
		$data_to_db = get_option($opt_name);
		
		$data_to_db[$cat_val] = $opt_val_arr;

        // Save the posted value in the database
        update_option( $opt_name, $data_to_db );
?>
<div class="updated"><p><strong><?php _e('Hobbies updated.', 'twentythirteen' ); ?></strong></p></div>
<?php
	}
	
	// display the settings editing screen
	echo '<div class="wrap">';
	
	// header
	echo "<h2>" . __( 'Add/Remove Hobbies', 'twentythirteen' ) . "</h2>";
	
	// settings form
?>
<form name="form1" id="admin_hobby_form" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><label><?php _e("Add hobby category:", 'twentythirteen'); ?></label>
<input type="text" name="<?php echo $cat_field_name; ?>" value="" size="60"></p>

<p><label><?php _e("Add hobbies:", 'twentythirteen' ); ?></label>
<input type="text" name="<?php echo $data_field_name; ?>" value="" size="140"></p>

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>

</form>
<div id="message"></div>
<table class="hob_lst">
<tr>
<th class="cat"><strong>Hobby Category</strong></th>
<th><strong>Hobbies</strong></th>
<th class="last"><strong>Remove<br />Category</strong></th>
</tr>
<?php
	$get_hobbies = get_option($opt_name);
	if ($get_hobbies){
		foreach($get_hobbies as $key => $value){
			echo '<tr class="' . $key . '"><td class="cat">' . $key . '</td><td>';
			foreach ($value as $idx => $hob_el){
				echo '<span class="' . $idx . '">' . $hob_el . '<div class="dashicons dashicons-no"></div>, </span> ';
			}
			echo '</td><td class="last"><div class="cat_del dashicons dashicons-trash"></div></td></tr>';
		}
	} else {
		echo '<tr><td colspan=3 align="center"><strong>Nothing Found</strong></td></tr>';
	}
?>
</table>
</div>
<style type="text/css">
	#message{
		display:none;
		border:1px solid #666;
		color:#fff;
		background:rgba(0,0,0,0.5);
		font-weight:bold;
		padding:5px;
		width:50%;
		margin:0 0 10px 0;
	}
	.hob_lst{
		border-collapse:collapse;
	}
	.hob_lst span .dashicons-no{
		font-size:18px;
		line-height:21px;
		width:auto;
		cursor:pointer;
	}
	.hob_lst tr:first-child:hover{
		background:none;
		color:#444;
	}
	.hob_lst tr{
		transition:all 200ms ease-out;
	}
	.hob_lst tr:hover{
		background:rgba(0,0,0,0.5);
		color:#fff;
		transition:all 200ms ease-out;
	}
	.hob_lst td, .hob_lst th{
		padding:5px;
		border:1px solid #666;
		width:80%;
	}
	.hob_lst th{
		text-align:center;
	}
	.hob_lst .cat{
		width:15%;
	}
	.hob_lst .last{
		text-align:center;
		cursor:pointer;
		width:5%;
	}
	#admin_hobby_form label{
		display:inline-block;
		min-width:125px;
	}
</style>
<script type="text/javascript">
	jQuery(".cat_del").click(function(){
		var catNameToRemove = jQuery(this).parent().parent().attr("class");
		var catToRemove = jQuery(this).parent().parent();
		jQuery(catToRemove).remove();
		
		var data = {
			action: 'rem_hobby_cat',
			cat_name: catNameToRemove
		}
		jQuery.ajax({
			url: ajaxurl,
			type: "POST",
			data: data,
			success: function(msg){
				if (msg.message){
					jQuery('#message').html(msg.message).fadeIn(300).delay(2300).fadeOut(300);
				}
			}
		});
	});
	
	jQuery(".dashicons-no").click(function(){
		var hobbyKeyToRemove = jQuery(this).parent().attr("class");
		var hobbyToRemove = jQuery(this).parent();
		var catName = jQuery(this).parent().parent().parent().attr("class");
		jQuery(hobbyToRemove).remove();
		
		var data = {
			action: 'rem_hobby',
			cat_name: catName,
			hobby_key: hobbyKeyToRemove
		}
		jQuery.ajax({
			url: ajaxurl,
			type: "POST",
			data: data,
			success: function(msg){
				if (msg.message_hob){
					jQuery('#message').html(msg.message_hob).fadeIn(300).delay(2300).fadeOut(300);
				}
			}
		});
	});
</script>
<?php
}