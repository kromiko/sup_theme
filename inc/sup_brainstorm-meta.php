<?php
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function deadline_add_meta_box() {
	add_meta_box('deadline_field', __( 'Deadline', 'support_theme' ), 'deadline_meta_box_callback', 'sup_brainstorm');
}

add_action( 'add_meta_boxes', 'deadline_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function deadline_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'deadline_meta_box', 'deadline_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'deadline_field', true );

	echo '<label for="_field">';
	_e( 'Deadline', 'support_theme' );
	echo '</label> ';
	echo '<input type="text" id="deadline_field_input" name="deadline_field" value="' . esc_attr( $value ) . '" size="15" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function deadline_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['deadline_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['deadline_meta_box_nonce'], 'deadline_meta_box' ) ) {
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
	if ( ! isset( $_POST['deadline_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['deadline_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'deadline_field', $my_data );
}
add_action( 'save_post', 'deadline_save_meta_box_data' );



/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function status_add_meta_box() {
	add_meta_box('status_field', __( 'Status', 'support_theme' ), 'status_meta_box_callback', 'sup_brainstorm');
}

add_action( 'add_meta_boxes', 'status_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function status_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'status_meta_box', 'status_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'status_field', true );

	echo '<label for="_field"><strong>';
	_e( 'Status', 'support_theme' );
	echo '</strong></label> ';
	if ($value == 'Open'){
		echo '<input type="radio" class="status" name="status_field" value="Open" checked /><span class="open">Open</span>';
	} else {
		echo '<input type="radio" class="status" name="status_field" value="Open" /><span class="open">Open</span>';
	}
	if ($value == 'Under Review'){
		echo '<input type="radio" class="status" name="status_field" value="Under Review" checked /><span class="review">Under Review</span>';
	} else {
		echo '<input type="radio" class="status" name="status_field" value="Under Review" /><span class="review">Under Review</span>';
	}
	if ($value == 'Rejected'){
		echo '<input type="radio" class="status" name="status_field" value="Rejected" checked /><span class="rejected">Rejected</span>';
	} else {
		echo '<input type="radio" class="status" name="status_field" value="Rejected" /><span class="rejected">Rejected</span>';
	}
	echo '<em class="or">or</em>';
	if ($value == 'In Progress'){
		echo '<input type="radio" class="status" name="status_field" value="In Progress" checked /><span class="progress">In Progress</span>';
	} else {
		echo '<input type="radio" class="status" name="status_field" value="In Progress" /><span class="progress">In Progress</span>';
	}
	if ($value == 'Finished'){
		echo '<input type="radio" class="status" name="status_field" value="Finished" checked /><span class="finished">Finished</span>';
	} else {
		echo '<input type="radio" class="status" name="status_field" value="Finished" /><span class="finished">Finished</span>';
	}
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function status_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['status_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['status_meta_box_nonce'], 'status_meta_box' ) ) {
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
	if ( ! isset( $_POST['status_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['status_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'status_field', $my_data );
}
add_action( 'save_post', 'status_save_meta_box_data' );



/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function coautor_add_meta_box() {
	add_meta_box('coautor_field', __( 'Co-autors', 'support_theme' ), 'coautor_meta_box_callback', 'sup_brainstorm');
}

add_action( 'add_meta_boxes', 'coautor_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function coautor_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'coautor_meta_box', 'coautor_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'coautor_field', true );
	echo '<label for="_field">';
	_e( 'Co-autors', 'support_theme' );
	echo '</label> ';
	echo '<select multiple id="coautor_field" name="coautor_field[]">';
		$users = get_users(array('orderby' => 'display_name','order' => 'ASC','fields' => array('ID', 'display_name')));
		foreach($users as $user){
			$selected = '';
			foreach($value as $elem){
				if ($elem == $user->ID){
					$selected = 'selected';
				}
			}
			echo '<option ' . $selected . ' value="' . $user->ID . '">' . $user->display_name . '</option>';
		}
	echo '</select><em class="note">Hold "Ctrl" on your keyboard and left click on users to make multiple selection</em>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function coautor_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['coautor_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['coautor_meta_box_nonce'], 'coautor_meta_box' ) ) {
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
	if ( ! isset( $_POST['coautor_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = $_POST['coautor_field'];

	// Update the meta field in the database.
	update_post_meta( $post_id, 'coautor_field', $my_data );
}
add_action( 'save_post', 'coautor_save_meta_box_data' );




/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function solution_add_meta_box() {
	add_meta_box('solution_field', __( 'Solution', 'support_theme' ), 'solution_meta_box_callback', 'sup_brainstorm');
}

add_action( 'add_meta_boxes', 'solution_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function solution_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'solution_meta_box', 'solution_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'solution_field', true );
	if($value){
		$content = $value;
	} else {
		$content = '';
	}

	$settings = array(
		'textarea_name' => 'solution_field',
		'textarea_rows' => 5
	);
	wp_editor( $content, 'solutionfield', $settings);
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function solution_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['solution_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['solution_meta_box_nonce'], 'solution_meta_box' ) ) {
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
	if ( ! isset( $_POST['solution_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = wpautop($_POST['solution_field']);

	// Update the meta field in the database.
	update_post_meta( $post_id, 'solution_field', $my_data );
}
add_action( 'save_post', 'solution_save_meta_box_data' );