jQuery(document).ready(function() {

	// initialize tabs
	jQuery("#tabs").tabs();
	
	// update user's hobbies
	jQuery('#add-hobbies').click(function(event){
		event.preventDefault();
		var userId = jQuery('#userid').val();
		var hobbies ={};
		jQuery('#hobby-list h5').each(function(indx){
			var acts=[];
			var row_id = jQuery(this).html();
			jQuery('input:checked', jQuery(this).parent()).each(function(indx){
				acts.push(jQuery(this).attr('name'));
			})
			hobbies[row_id]=acts;
		});
		if (userId != '' && hobbies != ''){
			var data = {
				action: 'update_user_hobbies',
				user_id: userId,
				hobbies_list: hobbies
			};
			jQuery.ajax({
				url: karmaAjax.ajaxurl,
				type: "POST",
				data: data,
				success: function(msg){
					if (msg.hob_success == '1'){
						jQuery('#hob_message').html(msg.hobby_message).fadeIn(300).delay(2300).fadeOut(300);
					} else {
						jQuery('#hob_error_message').html(msg.hobby_message).fadeIn(300).delay(2300).fadeOut(300);
					}
				}
			});
		}
	})
	
	// check if passwords match
	jQuery('#userpswdconfirm').each(function() {
		var elem = jQuery(this);
		// Save current value of element
		elem.data('oldVal', elem.val());
		// Look for changes in the value
		elem.bind("keyup input", function(event){
			// If value has changed
			if (elem.data('oldVal') != elem.val()) {
				// Updated stored value
				elem.data('oldVal', elem.val());
				var pwd_match = false;
				// Do action
				if (elem.val() == jQuery('#userpswd').val()){
					jQuery('.pswd_check').css('color','#46c600');
					jQuery('.pswd_check').html('Passwords match');
					jQuery('#userpswd, #userpswdconfirm').css({'border-color':'#46c600','box-shadow':'0 0 5px #46c600'});
					pwd_match = true;
				} else {
					jQuery('.pswd_check').css('color','#FF0000');
					jQuery('.pswd_check').html('Passwords do not match');
					jQuery('#userpswd, #userpswdconfirm').css({'border-color':'#FF0000','box-shadow':'0 0 5px #FF0000'});
				}
				if (pwd_match == true){
					jQuery('.pswd_check').delay(2300).fadeToggle(300);
				}
			}
		});
	});	
});

// ajax to update user options
function update_password_ajax(userid, newpwd, confirmpwd, newMail, newFirstname, newLastname, newDisplayname, newGender, newCity, shifts){
	if (userid != '' && (newpwd != '' || confirmpwd != '' || newMail != '' || newFirstname != '' || newLastname != '' || newDisplayname != '' || newGender != '' || newCity != '' || shifts != '')){
		var data = {
			action: 'update_user_profile',
			user_id: userid,
			new_pwd: newpwd,
			confirm_pwd: confirmpwd,
			newmail: newMail,
			newfirstname: newFirstname,
			newlastname: newLastname,
			newdisplayname: newDisplayname,
			newgender: newGender,
			newcity: newCity,
			newshift: shifts
		}
	};
	jQuery.ajax({
		url: karmaAjax.ajaxurl,
		type: "POST",
		data: data,
		success: function(msg){
			if (msg.success == '1'){
				if (msg.pwd_message){
					jQuery('#service_message').html(msg.pwd_message).fadeIn(300).delay(2300).fadeOut(300);
				}
				if (msg.mail_message){
					jQuery('#email_message').html(msg.mail_message).fadeIn(300).delay(2300).fadeOut(300);
				}
				if (msg.name_message){
					jQuery('#name_message').html(msg.name_message).fadeIn(300).delay(2300).fadeOut(300);
				}
			} else {
				if (msg.pwd_message){
					jQuery('#error_message').html(msg.pwd_message).fadeIn(300).delay(2300).fadeOut(300);
				}
				if (msg.mail_message){
					jQuery('#email_error_message').html(msg.mail_message).fadeIn(300).delay(2300).fadeOut(300);
				}
			}
		}
	});
}