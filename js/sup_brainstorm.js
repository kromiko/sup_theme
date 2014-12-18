jQuery(function(){
	if ((jQuery('.post-type-sup_brainstorm input.status[value="In Progress"]:checked')) || (jQuery('.post-type-sup_brainstorm input.status[value="Finished"]:checked'))){
		jQuery('.post-type-sup_brainstorm input.status[value="Finished"], span.finished').css('display', 'inline');
	}
	jQuery('.post-type-sup_brainstorm input.status[value="In Progress"]').click(function(){
		jQuery('.post-type-sup_brainstorm input.status[value="Finished"], span.finished').css('display', 'inline');
	});
	jQuery('.post-type-sup_brainstorm input.status[value="Rejected"], .post-type-sup_brainstorm input.status[value="Under Review"], .post-type-sup_brainstorm input.status[value="Open"]').click(function(){
		jQuery('.post-type-sup_brainstorm input.status[value="Finished"], span.finished').css('display', 'none');
	});
	jQuery("#deadline_field_input").datepicker({dateFormat:"dd.mm.yy"});
});