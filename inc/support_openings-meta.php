<?php
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function city_add_meta_box() {
	add_meta_box('city_field', __( 'City', 'support_theme' ), 'city_meta_box_callback', 'sup_openings');
}

add_action( 'add_meta_boxes', 'city_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function city_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'city_meta_box', 'city_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'city_field', true );

	echo '<label for="_field">';
	_e( 'City', 'support_theme' );
	echo '</label> ';
	echo '<input type="text" id="city_field" name="city_field" value="' . esc_attr( $value ) . '" size="25" />';
	/*echo '<select id="city_field" name="city_field">';
		echo '<option value="">choose city</option>';
		if ($value == 'Nikolaev'){
			echo '<option selected="selected" value="Nikolaev">Nikolaev</option>';
		} else {
			echo '<option value="Nikolaev">Nikolaev</option>';
		}
		if ($value == 'Kherson'){
			echo '<option selected="selected" value="Kherson">Kherson</option>';
		} else {
			echo '<option value="Kherson">Kherson</option>';
		}
		if ($value == 'Lviv'){
			echo '<option selected="selected" value="Lviv">Lviv</option>';
		} else {
			echo '<option value="Lviv">Lviv</option>';
		}
	echo '</select>';*/
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function city_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['city_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['city_meta_box_nonce'], 'city_meta_box' ) ) {
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
	if ( ! isset( $_POST['city_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['city_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'city_field', $my_data );
}
add_action( 'save_post', 'city_save_meta_box_data' );



/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function shift_add_meta_box() {
	add_meta_box('shift_field', __( 'Shift', 'support_theme' ), 'shift_meta_box_callback', 'sup_openings');
}

add_action( 'add_meta_boxes', 'shift_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function shift_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'shift_meta_box', 'shift_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'shift_field', true );

	echo '<label for="_field">';
	_e( 'Shift', 'support_theme' );
	echo '</label> ';
	echo '<input type="text" id="shift_field" name="shift_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function shift_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['shift_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['shift_meta_box_nonce'], 'shift_meta_box' ) ) {
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
	if ( ! isset( $_POST['shift_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['shift_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'shift_field', $my_data );
}
add_action( 'save_post', 'shift_save_meta_box_data' );



/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function gender_add_meta_box() {
	add_meta_box('gender_field', __( 'Gender', 'support_theme' ), 'gender_meta_box_callback', 'sup_openings');
}

add_action( 'add_meta_boxes', 'gender_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function gender_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'gender_meta_box', 'gender_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'gender_field', true );

	echo '<label for="_field">';
	_e( 'Gender', 'support_theme' );
	echo '</label> ';
	echo '<select id="gender_field" name="gender_field">';
		echo '<option value="Male and Female">Male and Female</option>';
		if ($value == 'Male'){
			echo '<option selected="selected" value="Male">Male</option>';
		} else {
			echo '<option value="Male">Male</option>';
		}
		if ($value == 'Female'){
			echo '<option selected="selected" value="Female">Female</option>';
		} else {
			echo '<option value="Female">Female</option>';
		}
	echo '</select>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function gender_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['gender_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['gender_meta_box_nonce'], 'gender_meta_box' ) ) {
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
	if ( ! isset( $_POST['gender_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['gender_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'gender_field', $my_data );
}
add_action( 'save_post', 'gender_save_meta_box_data' );




/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function requirements_add_meta_box() {
	add_meta_box('requirements_field', __( 'Requirements', 'support_theme' ), 'requirements_meta_box_callback', 'sup_openings');
}

add_action( 'add_meta_boxes', 'requirements_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function requirements_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'requirements_meta_box', 'requirements_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'requirements_field', true );

	echo '<label for="_field">';
	_e( 'Requirements', 'support_theme' );
	echo '</label> ';
	echo '<input type="text" id="requirements_field" name="requirements_field" value="' . esc_attr( $value ) . '" size="25" />';
	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function requirements_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['requirements_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['requirements_meta_box_nonce'], 'requirements_meta_box' ) ) {
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
	if ( ! isset( $_POST['requirements_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['requirements_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'requirements_field', $my_data );
}
add_action( 'save_post', 'requirements_save_meta_box_data' );




/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function contacts_add_meta_box() {
	add_meta_box('contacts_field', __( 'contacts', 'support_theme' ), 'contacts_meta_box_callback', 'sup_openings');
}

add_action( 'add_meta_boxes', 'contacts_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function contacts_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'contacts_meta_box', 'contacts_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'contacts_field', true );

	echo '<label for="_field">';
	_e( 'contacts', 'support_theme' );
	echo '</label> ';
	echo '<input type="text" id="contacts_field" name="contacts_field" value="' . esc_attr( $value ) . '" size="25" />';
	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function contacts_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['contacts_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['contacts_meta_box_nonce'], 'contacts_meta_box' ) ) {
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
	if ( ! isset( $_POST['contacts_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['contacts_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'contacts_field', $my_data );
}
add_action( 'save_post', 'contacts_save_meta_box_data' );




/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function bonus_add_meta_box() {
	add_meta_box('bonus_field', __( 'bonus', 'support_theme' ), 'bonus_meta_box_callback', 'sup_openings');
}

add_action( 'add_meta_boxes', 'bonus_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function bonus_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'bonus_meta_box', 'bonus_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'bonus_field', true );

	echo '<label for="_field">';
	_e( 'bonus', 'support_theme' );
	echo '</label> ';
	echo '<input type="text" id="bonus_field" name="bonus_field" value="' . esc_attr( $value ) . '" size="25" />';
	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function bonus_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['bonus_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['bonus_meta_box_nonce'], 'bonus_meta_box' ) ) {
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
	if ( ! isset( $_POST['bonus_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['bonus_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'bonus_field', $my_data );
}
add_action( 'save_post', 'bonus_save_meta_box_data' );



/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function language_add_meta_box() {
	add_meta_box('language_field', __( 'Languages required', 'support_theme' ), 'language_meta_box_callback', 'sup_openings');
}

add_action( 'add_meta_boxes', 'language_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function language_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'language_meta_box', 'language_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'language_field', true );

	echo '<label for="_field">';
	_e( 'Languages required', 'support_theme' );
	echo '</label> ';
	echo '<input type="text" id="language_field" name="language_field" value="' . esc_attr( $value ) . '" size="25" />';
	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function language_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['language_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['language_meta_box_nonce'], 'language_meta_box' ) ) {
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
	if ( ! isset( $_POST['language_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['language_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'language_field', $my_data );
}
add_action( 'save_post', 'language_save_meta_box_data' );




/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function number_needed_add_meta_box() {
	add_meta_box('number_needed_field', __( 'Vacancies', 'support_theme' ), 'number_needed_meta_box_callback', 'sup_openings');
}

add_action( 'add_meta_boxes', 'number_needed_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function number_needed_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'number_needed_meta_box', 'number_needed_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'number_needed_field', true );

	echo '<label for="_field">';
	_e( 'Vacancies', 'support_theme' );
	echo '</label> ';
	echo '<input type="text" id="number_needed_field" name="number_needed_field" value="' . esc_attr( $value ) . '" size="25" />';
	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function number_needed_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['number_needed_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['number_needed_meta_box_nonce'], 'number_needed_meta_box' ) ) {
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
	if ( ! isset( $_POST['number_needed_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['number_needed_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'number_needed_field', $my_data );
}
add_action( 'save_post', 'number_needed_save_meta_box_data' );