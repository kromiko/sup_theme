<?php
//PrettyPhoto shortcode
function shortcode_prettyPhoto($atts, $content = null) {

		extract(shortcode_atts(array(
				'url' => '',
		), $atts));
		
		if ($url !=''){
			$set = wp_upload_dir();
			$uploads = $set['basedir'];//absolute path to uploads dir
			$uploads_url = $set['baseurl'];//url to uploads dir
			$upload_num = strlen($uploads_url);
			$cutURL = substr($url,$upload_num);
			$img_url = $uploads_url.$cutURL;//original image URL
			$img_path = $uploads.$cutURL;
			
			$image = wp_get_image_editor( $img_path );
			if ( ! is_wp_error( $image ) ) {
				$image->resize( 150, 150, false );
				$filename = $image->generate_filename( 'th-150x150' );
				$image->save($filename);
			}
			
			$temp = strrchr($filename,"/");//new file name
			$slashNum = strripos($img_url,"/");//slash position in original image URL
			$thumbPart = substr($img_url, 0, $slashNum);//url without original file name
			$thumbURL = $thumbPart.$temp;//url to new image
			
			$output = '<a data-rel="prettyPhoto" href="'.$url.'"><img src="'.$thumbURL.'" /></a>';
			
			return $output;
		}

}

add_shortcode('ph', 'shortcode_prettyPhoto');


//poll
function shortcode_poll_answers($atts, $content = null) {

		extract(shortcode_atts(array(
				'url' => '',
		), $atts));
		
		if (function_exists('get_pollvotes')){
			$output = get_pollvotes();
		}
		/*if (function_exists('get_pollanswers')){
			$output = get_pollanswers();
		}*/
		
		return $output;
}
add_shortcode('poll_answers', 'shortcode_poll_answers');