function karma_rate_ajax(contID, post_id, direction, rater, owner){
	if (post_id != ''){
		var data = {
			action: 'karma_save_rating',
			post_id: post_id,
			direction: direction,
			rater: rater,
			owner: owner
		};
		jQuery.ajax({
			url: karmaAjax.ajaxurl,
			type: "POST",
			data: data,
			success: function(msg){
				jQuery(contID + ' .msg').html(msg.message).slideDown().delay(2000).slideUp();
				if (msg.karma){
					jQuery(contID + ' .karma_val').html(msg.karma);
				}
			}
		});
	}
}

function karma_comment_rate_ajax(com_contID, comment_id, com_rater, com_owner){
	if (comment_id != ''){
		var data = {
			action: 'comment_karma_save_rating',
			comment_id: comment_id,
			com_rater: com_rater,
			com_owner: com_owner
		};
		jQuery.ajax({
			url: karmaAjax.ajaxurl,
			type: "POST",
			data: data,
			success: function(msg){
				jQuery(com_contID + ' .msg').html(msg.comment_message).slideDown().delay(2000).slideUp();
				if (msg.comment_karma){
					jQuery(com_contID + ' .karma_val').html(msg.comment_karma);
				}
				if (msg.comment_auth_karma){
					jQuery('.comment-author cite').html(function(indx, oldHtml){
						var updUsrname = jQuery(com_contID + ' cite').html();
						if (oldHtml == updUsrname)
						jQuery(this).next('.rate_val').html(msg.comment_auth_karma);
					})
				}
			}
		});
	}
}