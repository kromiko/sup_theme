<?php
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function important_add_meta_box() {
	add_meta_box('important_field', __( 'Important post?', 'support_theme' ), 'important_meta_box_callback', 'post', 'normal', 'high');
}

add_action( 'add_meta_boxes', 'important_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function important_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'important_meta_box', 'important_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'important_field', true );
	$read_users = get_post_meta($post->ID, '_read_users', true);

	echo '<p><label for="_field">';
	_e( 'Mark post as must read?', 'support_theme' );
	echo '</label> ';
	
	if ($value == 'mustread'){
		$checked = 'checked';
	} else {
		$checked = '';
	}
	echo '<input type="checkbox" id="important_field_input" name="important_field" value="mustread" ' . $checked . ' /></p>';
	
	if ($read_users){
		echo '<p><label for="_field">';
		_e( 'Already read the post: ', 'support_theme' );
		echo '</label> ';
		echo $read_users;
		echo '</p>';
	}
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function important_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['important_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['important_meta_box_nonce'], 'important_meta_box' ) ) {
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
	if ( ! isset( $_POST['important_field'] ) ) {
		delete_post_meta($post_id, 'important_field');
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['important_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'important_field', $my_data );
}
add_action( 'save_post', 'important_save_meta_box_data' );