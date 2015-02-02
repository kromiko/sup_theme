<?php
//quick-post custom post type
function my_post_type_quick_post() {
	register_post_type( 'quick-post',
                array( 
				'label' => __('Quick post'), 
				'singular_label' => __('Quick post Item', 'support_theme'),
				'_builtin' => false,
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'hierarchical' => true,
				'capability_type' => 'page',
				'menu_icon' => get_template_directory_uri() . '/images/quick-post.png',
				'rewrite' => array(
					'slug' => 'quick-post',
					'with_front' => FALSE,
				),
				'supports' => array(
						'title',
						'editor',
						'thumbnail',
						'excerpt',
						'custom-fields',
						'comments')
					) 
				);
	register_taxonomy('quick_post_category', 'quick_post', array('hierarchical' => true, 'label' => 'Quick post Categories', 'singular_name' => 'Category', "rewrite" => true, "query_var" => true));
}

add_action('init', 'my_post_type_quick_post');

//useful links custom post type
function my_post_type_useful_links() {
	register_post_type( 'useful_links',
                array( 
				'label' => __('Useful links'), 
				'singular_label' => __('Useful links item', 'support_theme'),
				'_builtin' => false,
				'capability_type' => 'post',
				'public' => true,
				'publicly_queryable' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'hierarchical' => true,
				'rewrite' => array(
					'slug' => 'useful-links',
					'with_front' => FALSE,
				),
				'menu_icon' => get_template_directory_uri() . '/images/links-post.png',
				'supports' => array(
						'title',
						'editor',
						'author',
						'comments'
					)
				) 
	);
	register_taxonomy('useful_links_category', 'useful_links', array('hierarchical' => true, 'label' => 'Useful Links Categories', 'singular_name' => 'Useful Links Category', 'rewrite' => true, 'query_var' => true));
}
add_action('init', 'my_post_type_useful_links');

//private enterprise news custom post type
function my_post_type_private_enterprise() {
	register_post_type( 'private_enterprise',
                array( 
				'label' => __('Private Enterprise News'), 
				'singular_label' => __('Private Enterprise News item', 'support_theme'),
				'_builtin' => false,
				'capability_type' => 'post',
				'public' => true,
				'publicly_queryable' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'hierarchical' => false,
				'rewrite' => array(
					'slug' => 'pe-news',
					'with_front' => FALSE,
				),
				'menu_icon' => get_template_directory_uri() . '/images/pe-post.png',
				'supports' => array(
						'title',
						'editor',
						'author',
						'comments'
					)
				) 
	);
}
add_action('init', 'my_post_type_private_enterprise');

//support openings custom post type
function my_post_type_sup_openings() {
	register_post_type( 'sup_openings',
                array( 
				'label' => __('Support openings'), 
				'singular_label' => __('Support openings item', 'support_theme'),
				'_builtin' => false,
				'capability_type' => 'post',
				'public' => true,
				'publicly_queryable' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'hierarchical' => true,
				'rewrite' => array(
					'slug' => 'sup-opening',
					'with_front' => FALSE,
				),
				'menu_icon' => 'dashicons-megaphone',
				'supports' => array(
						'title',
						'editor',
						'author',
						'comments'
					)
				) 
	);
	register_taxonomy('sup_openings_category', 'sup_openings', array('hierarchical' => true, 'label' => 'Support openings Categories', 'singular_name' => 'Support openings Category', 'rewrite' => true, 'query_var' => true));
}
add_action('init', 'my_post_type_sup_openings');

// support brainstorming custom post type
function my_post_type_sup_brainstorm() {
	register_post_type( 'sup_brainstorm',
                array( 
				'label' => __('Support Brainstorming'), 
				'singular_label' => __('Support Brainstorming item', 'support_theme'),
				'_builtin' => false,
				'capability_type' => 'post',
				'public' => true,
				'publicly_queryable' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'hierarchical' => true,
				'rewrite' => array(
					'slug' => 'sup-opening',
					'with_front' => FALSE,
				),
				'menu_icon' => 'dashicons-schedule',
				'supports' => array(
						'title',
						'editor',
						'author',
						'comments'
					)
				) 
	);
	register_taxonomy('sup_brainstorm_category', 'sup_brainstorm', array('hierarchical' => true, 'label' => 'Support Brainstorming Categories', 'singular_name' => 'Support Brainstorming Category', 'rewrite' => true, 'query_var' => true));
}
add_action('init', 'my_post_type_sup_brainstorm');

// QAS custom post type
function my_post_type_qas() {
	register_post_type( 'qas',
                array( 
				'label' => __('QAS'), 
				'singular_label' => __('QAS item', 'support_theme'),
				'_builtin' => false,
				'capability_type' => 'post',
				'public' => true,
				'publicly_queryable' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'hierarchical' => true,
				'rewrite' => array(
					'slug' => 'sup-qas',
					'with_front' => FALSE,
				),
				'menu_icon' => 'dashicons-visibility',
				'supports' => array(
						'title',
						'editor',
						'author',
						'comments'
					)
				) 
	);
	register_taxonomy('qas_category', 'qas', array('hierarchical' => true, 'label' => 'QAS Categories', 'singular_name' => 'QAS Category', 'rewrite' => true, 'query_var' => true));
}
add_action('init', 'my_post_type_qas');