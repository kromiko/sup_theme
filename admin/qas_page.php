<?php
add_action( 'admin_menu', 'qas_menu' );

function qas_menu() {
	add_options_page( 'Template and problem types management', 'Template and problem types management', 'manage_options', 'qas-menu', 'qas_menu_admin_output' );
}

function qas_menu_admin_output() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	 // variables for the field and option names
	$templatetype_opt = '_template_type';
	$problemtype_opt = '_problem_type';
    $templatefield_name = 'template_type';
	$problemfield_name = 'problem_type';
    $hidden_field_name = 'qas_submit_hidden';

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if(($_POST[ $hidden_field_name ] && $_POST[ $hidden_field_name ] == 'Y' ) && ($_POST[ $templatefield_name ] || $_POST[ $problemfield_name ])) {
        // Read and save their posted value
		if ($_POST[ $templatefield_name ] != ''){
			$template_type = strip_tags($_POST[$templatefield_name]);
			$template_type_arr = explode(",", $template_type);
			$template_type_to_db = get_option($templatetype_opt);
			foreach($template_type_arr as $temp_itm){
				$template_type_to_db[] = $temp_itm;
			}
			$template_type_onearr=array_combine(range(1, count($template_type_to_db)), $template_type_to_db);
			update_option( $templatetype_opt, $template_type_onearr );
		}
		if ($_POST[ $problemfield_name ] != ''){
			$problem_type = strip_tags($_POST[$problemfield_name]);
			$problem_type_arr = explode(",", $problem_type);
			$problem_type_to_db = get_option($problemtype_opt);
			foreach($problem_type_arr as $prob_itm){
				$problem_type_to_db[] = $prob_itm;
			}
			$problem_type_onearr=array_combine(range(1, count($problem_type_to_db)), $problem_type_to_db);
			update_option( $problemtype_opt, $problem_type_onearr );
		}
?>
<div class="updated"><p><strong><?php _e('Values updated.', 'twentythirteen' ); ?></strong></p></div>
<?php
	}
	
	// display the settings editing screen
	echo '<div class="wrap">';
	
	// header
	echo "<h2>" . __( 'Add/Remove template and problem types', 'twentythirteen' ) . "</h2>";
	
	// settings form
?>
<form name="form1" id="admin_hobby_form" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><label><strong><?php _e("Add template type (comma separated):", 'twentythirteen'); ?></strong></label>
<input type="text" name="<?php echo $templatefield_name; ?>" value="" size="60"></p>

<p><label><strong><?php _e("Add problem type (comma separated):", 'twentythirteen' ); ?></strong></label>
<input type="text" name="<?php echo $problemfield_name; ?>" value="" size="60"></p>

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>

</form>
<div id="message"></div>
<table class="templates">
	<tr>
		<th class="type"><strong>Template Type</strong></th>
	</tr>
	<tr>
		<td align="center">
			<?php
				$get_templates = get_option($templatetype_opt);
				if ($get_templates){
					foreach($get_templates as $key => $value){
						echo '<span class="' . $key . '">' . $value . '<div class="dashicons dashicons-no"></div>, </span> ';
					}
				} else {
					echo '<strong>Bummer, no template types defined</strong>';
				}
			?>
		</td>
	</tr>
</table>

<table class="problems">
	<tr>
		<th class="type"><strong>Problem Type</strong></th>
	</tr>
	<tr>
		<td align="center">
			<?php
				$get_problems = get_option($problemtype_opt);
				if ($get_problems){
					foreach($get_problems as $key => $value){
						echo '<span class="' . $key . '">' . $value . '<div class="dashicons dashicons-no"></div>, </span> ';
					}
				} else {
					echo '<strong>No problems found ;)</strong>';
				}
			?>
		</td>
	</tr>
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
	.templates, .problems{
		border-collapse:collapse;
	}
	.templates span .dashicons-no, .problems span .dashicons-no{
		font-size:18px;
		line-height:21px;
		width:auto;
		cursor:pointer;
	}
	.templates span .dashicons-no:hover, .problems span .dashicons-no:hover{
		color:#ff0000;
	}
	.templates tr:first-child:hover, .problems tr:first-child:hover{
		background:none;
		color:#444;
	}
	.templates tr, .problems tr{
		transition:all 200ms ease-out;
	}
	.templates tr:hover, .problems tr:hover{
		background:rgba(0,0,0,0.5);
		color:#fff;
		transition:all 200ms ease-out;
	}
	.templates td, .templates th, .problems td, .problems th{
		padding:5px;
		border:1px solid #666;
		width:80%;
	}
	.templates th, .problems th{
		text-align:center;
	}
	
	.templates .last, .problems .last{
		text-align:center;
		cursor:pointer;
		width:5%;
	}
	#admin_hobby_form label{
		display:inline-block;
		min-width:125px;
	}
	.problems{
		margin:80px 0 0 0;
	}
</style>
<script type="text/javascript">
	jQuery(".dashicons-no").hover(
		function(){
			jQuery(this).parent().css('color','#ff0000');
		},
		function(){
			jQuery(this).parent().removeAttr('style');
		}
	);
	
	jQuery(".templates .dashicons-no").click(function(){
		var templateKeyToRemove = jQuery(this).parent().attr("class");
		var templateToRemove = jQuery(this).parent();
		jQuery(templateToRemove).remove();
		
		var data = {
			action: 'rem_template_type',
			templ_key: templateKeyToRemove
		}
		jQuery.ajax({
			url: ajaxurl,
			type: "POST",
			data: data,
			success: function(msg){
				if (msg.message_template){
					jQuery('#message').html(msg.message_template).fadeIn(300).delay(2300).fadeOut(300);
				}
			}
		});
	});
	
	jQuery(".problems .dashicons-no").click(function(){
		var problemKeyToRemove = jQuery(this).parent().attr("class");
		var problemToRemove = jQuery(this).parent();
		jQuery(problemToRemove).remove();
		
		var data = {
			action: 'rem_problem_type',
			problem_key: problemKeyToRemove
		}
		jQuery.ajax({
			url: ajaxurl,
			type: "POST",
			data: data,
			success: function(msg){
				if (msg.message_problem){
					jQuery('#message').html(msg.message_problem).fadeIn(300).delay(2300).fadeOut(300);
				}
			}
		});
	});
</script>
<?php
}