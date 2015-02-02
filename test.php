<?php
/**
 * Template Name: Test Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<?php
	$query = new WP_Query( array(
		'post_type' => 'qas',
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' => 'qas_status_field',
				'value' => 'Approved',
			),
		),
	) );
	$authors_array = array();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id = $query->post->ID;
			$post_author_id = $query->post->post_author;
			$usr_data = get_userdata($post_author_id);
			$usr_name = $usr_data->display_name;
			$authors_array[] = $post_author_id;
			//echo '<pre>';
			//print_r($query);
			//print_r(array_unique($authors_array));
			//echo '</pre>';
		}
	}
	wp_reset_postdata();
	$nondupe_authors_array = array_unique($authors_array);
	
	foreach ($nondupe_authors_array as $author){
		$count_query = new WP_Query( array(
			'post_type' => 'qas',
			'posts_per_page' => -1,
			'author'		=> $author,
			'meta_query' => array(
				array(
					'key' => 'qas_status_field',
					'value' => 'Approved',
				),
			),
		) );
		if ( $count_query->have_posts() ) {
			$i = 0;
			while ( $count_query->have_posts() ) {
				$count_query->the_post();
				$post_id = $count_query->post->ID;
				$i++;
			}
			$usr_data = get_userdata($author);
			$usr_name = $usr_data->display_name;
			echo '<pre>';
			echo $usr_name . ': (' . $i . ')';
			echo '</pre>';
		}
	}
?>