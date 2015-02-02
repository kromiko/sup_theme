<?php
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function template_type_add_meta_box() {
	add_meta_box('template_type_field', __( 'Template Type', 'support_theme' ), 'template_type_meta_box_callback', 'qas');
}

add_action( 'add_meta_boxes', 'template_type_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function template_type_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'template_type_meta_box', 'template_type_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'template_type_field', true );

	echo '<label for="_field">';
	_e( 'Template Type', 'support_theme' );
	echo '</label> ';
	echo '<select multiple id="template_type_field" name="template_type_field[]">';
		$template_type = get_option('_template_type');
		foreach($template_type as $item){
			$selected = '';
			if ($value){
				foreach($value as $elem){
					if ($elem == $item){
						$selected = 'selected';
					}
				}
			}
			echo '<option ' . $selected . ' value="' . $item . '">' . $item . '</option>';
		}
	echo '</select><em class="note">Hold "Ctrl" on your keyboard and left click on template types to make multiple selection</em>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function template_type_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['template_type_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['template_type_meta_box_nonce'], 'template_type_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['template_type_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = $_POST['template_type_field'];

	// Update the meta field in the database.
	update_post_meta( $post_id, 'template_type_field', $my_data );
}
add_action( 'save_post', 'template_type_save_meta_box_data' );


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function problem_type_add_meta_box() {
	add_meta_box('problem_type_field', __( 'Problem Type', 'support_theme' ), 'problem_type_meta_box_callback', 'qas');
}

add_action( 'add_meta_boxes', 'problem_type_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function problem_type_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'problem_type_meta_box', 'problem_type_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'problem_type_field', true );

	echo '<label for="_field">';
	_e( 'Problem Type', 'support_theme' );
	echo '</label> ';
	echo '<select multiple id="problem_type_field" name="problem_type_field[]">';
		$problem_type = get_option('_problem_type');
		foreach($problem_type as $item){
			$selected = '';
			if ($value){
				foreach($value as $elem){
					if ($elem == $item){
						$selected = 'selected';
					}
				}
			}
			echo '<option ' . $selected . ' value="' . $item . '">' . $item . '</option>';
		}
	echo '</select><em class="note">Hold "Ctrl" on your keyboard and left click on problem types to make multiple selection</em>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function problem_type_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['problem_type_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['problem_type_meta_box_nonce'], 'problem_type_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['problem_type_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = $_POST['problem_type_field'];

	// Update the meta field in the database.
	update_post_meta( $post_id, 'problem_type_field', $my_data );
}
add_action( 'save_post', 'problem_type_save_meta_box_data' );



/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function qas_status_add_meta_box() {
	add_meta_box('qas_status_field', __( 'Status', 'support_theme' ), 'qas_status_meta_box_callback', 'qas');
}

add_action( 'add_meta_boxes', 'qas_status_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function qas_status_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'qas_status_meta_box', 'qas_status_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'qas_status_field', true );

	echo '<label for="_field"><strong>';
	_e( 'Status', 'support_theme' );
	echo '</strong></label> ';
	if ($value == 'Open'){
		echo '<input type="radio" class="status" name="qas_status_field" value="Open" checked /><span class="open">Open</span>';
	} else {
		echo '<input type="radio" class="status" name="qas_status_field" value="Open" /><span class="open">Open</span>';
	}
	if ($value == 'Rejected'){
		echo '<input type="radio" class="status" name="qas_status_field" value="Rejected" checked /><span class="rejected">Rejected</span>';
	} else {
		echo '<input type="radio" class="status" name="qas_status_field" value="Rejected" /><span class="rejected">Rejected</span>';
	}
	echo '<em class="or">or</em>';
	if ($value == 'In Progress'){
		echo '<input type="radio" class="status" name="qas_status_field" value="In Progress" checked /><span class="progress">In Progress</span>';
	} else {
		echo '<input type="radio" class="status" name="qas_status_field" value="In Progress" /><span class="progress">In Progress</span>';
	}
	if ($value == 'Approved'){
		echo '<input type="radio" class="status" name="qas_status_field" value="Approved" checked /><span class="approved">Approved</span>';
	} else {
		echo '<input type="radio" class="status" name="qas_status_field" value="Approved" /><span class="approved">Approved</span>';
	}
	echo '<em class="or">or</em>';
	if ($value == 'final_reject'){
		echo '<input type="radio" class="status" name="qas_status_field" value="final_reject" checked /><span class="final_reject">Rejected</span>';
	} else {
		echo '<input type="radio" class="status" name="qas_status_field" value="final_reject" /><span class="final_reject">Rejected</span>';
	}
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function qas_status_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['qas_status_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['qas_status_meta_box_nonce'], 'qas_status_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['qas_status_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['qas_status_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'qas_status_field', $my_data );
}
add_action( 'save_post', 'qas_status_save_meta_box_data' );