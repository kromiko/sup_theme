<?php
/*
Widget to display tickets RMS
*/
class Work_Duty extends WP_Widget {

	public function __construct() {
	
		function admin_setup() {
			wp_enqueue_media();
			wp_enqueue_script( 'widget_media_lib_script', get_template_directory_uri() . '/js/widget_media_lib_script.js', array( 'jquery', 'media-upload', 'media-views' ));
		}
		add_action('sidebar_admin_setup', 'admin_setup');
		
		/* Widget settings. */
		$widget_ops = array(
			'classname' => 'widget_work_duty', 
			'description' => 'Allows you to display a list of icons linked to custom resource');

		/* Widget control settings. */
		$control_ops = array(
			'width' => 250, 
			'height' => 250, 
			'id_base' => 'work_duty-widget');
			
		parent::__construct('work_duty-widget','Work Duty Widget',$widget_ops,$control_ops);	
	}
	
	function widget ($args,$instance) {
		$title=$instance['title'];
		
		$ico_url1 = $instance['ico_url1'];
		$icon1 = $instance['icon1'];
		$ico_title1 = $instance['ico_title1'];
		
		$ico_url2 = $instance['ico_url2'];
		$icon2 = $instance['icon2'];
		$ico_title2 = $instance['ico_title2'];
		
		$ico_url3 = $instance['ico_url3'];
		$icon3 = $instance['icon3'];
		$ico_title3 = $instance['ico_title3'];
		
		$ico_url4 = $instance['ico_url4'];
		$icon4 = $instance['icon4'];
		$ico_title4 = $instance['ico_title4'];
		
		$ico_url5 = $instance['ico_url5'];
		$icon5 = $instance['icon5'];
		$ico_title5 = $instance['ico_title5'];
		
		$ico_url6 = $instance['ico_url6'];
		$icon6 = $instance['icon6'];
		$ico_title6 = $instance['ico_title6'];
		
        //Widget content
		$toutput .= '<div class="row">';
		if ($instance['ico_url1']){
			$toutput .= '<div class="wig-item">';
			$toutput .= '<a href="'. $instance['ico_url1'] .'" target="_blank"><img src="'. $instance['icon1'] .'" width="65" height="65" alt="'. $instance['ico_title1'] .'" /><span>'. $instance['ico_title1'] .'</span></a>';
			$toutput .= '</div>';
		}
		if ($instance['ico_url2']){
			$toutput .= '<div class="wig-item">';
			$toutput .= '<a href="'. $instance['ico_url2'] .'" target="_blank"><img src="'. $instance['icon2'] .'" width="65" height="65" alt="'. $instance['ico_title2'] .'" /><span>'. $instance['ico_title2'] .'</span></a>';
			$toutput .= '</div>';
		}
		if ($instance['ico_url3']){
			$toutput .= '<div class="wig-item">';
			$toutput .= '<a href="'. $instance['ico_url3'] .'" target="_blank"><img src="'. $instance['icon3'] .'" width="65" height="65" alt="'. $instance['ico_title3'] .'" /><span>'. $instance['ico_title3'] .'</span></a>';
			$toutput .= '</div>';
		}
		if ($instance['ico_url4']){
			$toutput .= '<div class="wig-item">';
			$toutput .= '<a href="'. $instance['ico_url4'] .'" target="_blank"><img src="'. $instance['icon4'] .'" width="65" height="65" alt="'. $instance['ico_title4'] .'" /><span>'. $instance['ico_title4'] .'</span></a>';
			$toutput .= '</div>';
		}
		if ($instance['ico_url5']){
			$toutput .= '<div class="wig-item">';
			$toutput .= '<a href="'. $instance['ico_url5'] .'" target="_blank"><img src="'. $instance['icon5'] .'" width="65" height="65" alt="'. $instance['ico_title5'] .'" /><span>'. $instance['ico_title5'] .'</span></a>';
			$toutput .= '</div>';
		}
		if ($instance['ico_url6']){
			$toutput .= '<div class="wig-item">';
			$toutput .= '<a href="'. $instance['ico_url6'] .'" target="_blank"><img src="'. $instance['icon6'] .'" width="65" height="65" alt="'. $instance['ico_title6'] .'" /><span>'. $instance['ico_title6'] .'</span></a>';
			$toutput .= '</div>';
		}
		$toutput .= '</div>';
        
		//print the widget for the sidebar
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'] . $toutput . $args['after_widget'];
	}
	
	function form ($instance) {
		
		/* Set up some default widget settings. */
		$defaults = array('title'=>'Work Duty','ico_img_url1' => '','ico_url1' => '','ico_title1' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<style type="text/css">#widget-work_duty-widget-2-icon1-preview, #widget-work_duty-widget-2-icon2-preview, #widget-work_duty-widget-2-icon3-preview, #widget-work_duty-widget-2-icon4-preview, #widget-work_duty-widget-2-icon5-preview, #widget-work_duty-widget-2-icon6-preview{height:auto;width:45px;}</style>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" size="20">
		</p>
		<hr />
		
		<p>
			<label for="<?php echo $this->get_field_id('icon1'); ?>"><?php echo __( 'Icon 1 image:', 'twentythirteen' ); ?></label>
			<img id="<?php echo $this->get_field_id('icon1');?>-preview" style="max-width:100%;" <?php if (isset($instance['icon1'])) echo 'src="'.$instance['icon1'].'"'?> >
			<input type="submit" class="button upload_image_button" value="<?php echo __( 'Select Image', 'twentythirteen' ); ?>" data-target-id="<?php echo $this->get_field_id('icon1');?>"/><em style="color:#ff0000;"><strong><?php echo __( '  Square images only please!', 'twentythirteen' ); ?></strong></em>
			<input type="hidden" id="<?php echo $this->get_field_id('icon1');?>" name="<?php echo $this->get_field_name('icon1');?>" value="<?php echo $instance['icon1']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_url1'); ?>"><?php echo __( 'Icon 1 URL:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_url1') ?>" id="<?php echo $this->get_field_id('ico_url1') ?> " value="<?php echo $instance['ico_url1'] ?>" size="20">	
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_title1'); ?>"><?php echo __( 'Icon 1 title:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_title1') ?>" id="<?php echo $this->get_field_id('ico_title1') ?> " value="<?php echo $instance['ico_title1'] ?>" size="20">
		</p>
		<hr />
		
		<p>
			<label for="<?php echo $this->get_field_id('icon2'); ?>"><?php echo __( 'Icon 2 image:', 'twentythirteen' ); ?></label>
			<img id="<?php echo $this->get_field_id('icon2');?>-preview" style="max-width:100%;" <?php if (isset($instance['icon2'])) echo 'src="'.$instance['icon2'].'"'?> >
			<input type="submit" class="button upload_image_button" value="<?php echo __( 'Select Image', 'twentythirteen' ); ?>" data-target-id="<?php echo $this->get_field_id('icon2');?>"/><em style="color:#ff0000;"><strong><?php echo __( '  Square images only please!', 'twentythirteen' ); ?></strong></em>
			<input type="hidden" id="<?php echo $this->get_field_id('icon2');?>" name="<?php echo $this->get_field_name('icon2');?>" value="<?php echo $instance['icon2']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_url2'); ?>"><?php echo __( 'Icon 2 URL:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_url2') ?>" id="<?php echo $this->get_field_id('ico_url2') ?> " value="<?php echo $instance['ico_url2'] ?>" size="20">	
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_title2'); ?>"><?php echo __( 'Icon 2 title:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_title2') ?>" id="<?php echo $this->get_field_id('ico_title2') ?> " value="<?php echo $instance['ico_title2'] ?>" size="20">
		</p>
		<hr />
		
		<p>
			<label for="<?php echo $this->get_field_id('icon3'); ?>"><?php echo __( 'Icon 3 image:', 'twentythirteen' ); ?></label>
			<img id="<?php echo $this->get_field_id('icon3');?>-preview" style="max-width:100%;" <?php if (isset($instance['icon3'])) echo 'src="'.$instance['icon3'].'"'?> >
			<input type="submit" class="button upload_image_button" value="<?php echo __( 'Select Image', 'twentythirteen' ); ?>" data-target-id="<?php echo $this->get_field_id('icon3');?>"/><em style="color:#ff0000;"><strong><?php echo __( '  Square images only please!', 'twentythirteen' ); ?></strong></em>
			<input type="hidden" id="<?php echo $this->get_field_id('icon3');?>" name="<?php echo $this->get_field_name('icon3');?>" value="<?php echo $instance['icon3']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_url3'); ?>"><?php echo __( 'Icon 3 URL:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_url3') ?>" id="<?php echo $this->get_field_id('ico_url3') ?> " value="<?php echo $instance['ico_url3'] ?>" size="20">	
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_title3'); ?>"><?php echo __( 'Icon 3 title:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_title3') ?>" id="<?php echo $this->get_field_id('ico_title3') ?> " value="<?php echo $instance['ico_title3'] ?>" size="20">
		</p>
		<hr />
		
		<p>
			<label for="<?php echo $this->get_field_id('icon4'); ?>"><?php echo __( 'Icon 4 image:', 'twentythirteen' ); ?></label>
			<img id="<?php echo $this->get_field_id('icon4');?>-preview" style="max-width:100%;" <?php if (isset($instance['icon4'])) echo 'src="'.$instance['icon4'].'"'?> >
			<input type="submit" class="button upload_image_button" value="<?php echo __( 'Select Image', 'twentythirteen' ); ?>" data-target-id="<?php echo $this->get_field_id('icon4');?>"/><em style="color:#ff0000;"><strong><?php echo __( '  Square images only please!', 'twentythirteen' ); ?></strong></em>
			<input type="hidden" id="<?php echo $this->get_field_id('icon4');?>" name="<?php echo $this->get_field_name('icon4');?>" value="<?php echo $instance['icon4']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_url4'); ?>"><?php echo __( 'Icon 4 URL:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_url4') ?>" id="<?php echo $this->get_field_id('ico_url4') ?> " value="<?php echo $instance['ico_url4'] ?>" size="20">	
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_title4'); ?>"><?php echo __( 'Icon 4 title:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_title4') ?>" id="<?php echo $this->get_field_id('ico_title4') ?> " value="<?php echo $instance['ico_title4'] ?>" size="20">
		</p>
		<hr />
		
		<p>
			<label for="<?php echo $this->get_field_id('icon5'); ?>"><?php echo __( 'Icon 5 image:', 'twentythirteen' ); ?></label>
			<img id="<?php echo $this->get_field_id('icon5');?>-preview" style="max-width:100%;" <?php if (isset($instance['icon5'])) echo 'src="'.$instance['icon5'].'"'?> >
			<input type="submit" class="button upload_image_button" value="<?php echo __( 'Select Image', 'twentythirteen' ); ?>" data-target-id="<?php echo $this->get_field_id('icon5');?>"/><em style="color:#ff0000;"><strong><?php echo __( '  Square images only please!', 'twentythirteen' ); ?></strong></em>
			<input type="hidden" id="<?php echo $this->get_field_id('icon5');?>" name="<?php echo $this->get_field_name('icon5');?>" value="<?php echo $instance['icon5']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_url5'); ?>"><?php echo __( 'Icon 5 URL:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_url5') ?>" id="<?php echo $this->get_field_id('ico_url5') ?> " value="<?php echo $instance['ico_url5'] ?>" size="20">	
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_title5'); ?>"><?php echo __( 'Icon 5 title:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_title5') ?>" id="<?php echo $this->get_field_id('ico_title5') ?> " value="<?php echo $instance['ico_title5'] ?>" size="20">
		</p>
		<hr />
		
		<p>
			<label for="<?php echo $this->get_field_id('icon6'); ?>"><?php echo __( 'Icon 6 image:', 'twentythirteen' ); ?></label>
			<img id="<?php echo $this->get_field_id('icon6');?>-preview" style="max-width:100%;" <?php if (isset($instance['icon6'])) echo 'src="'.$instance['icon6'].'"'?> >
			<input type="submit" class="button upload_image_button" value="<?php echo __( 'Select Image', 'twentythirteen' ); ?>" data-target-id="<?php echo $this->get_field_id('icon6');?>"/><em style="color:#ff0000;"><strong><?php echo __( '  Square images only please!', 'twentythirteen' ); ?></strong></em>
			<input type="hidden" id="<?php echo $this->get_field_id('icon6');?>" name="<?php echo $this->get_field_name('icon6');?>" value="<?php echo $instance['icon6']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_url6'); ?>"><?php echo __( 'Icon 6 URL:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_url6') ?>" id="<?php echo $this->get_field_id('ico_url6') ?> " value="<?php echo $instance['ico_url6'] ?>" size="20">	
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ico_title6'); ?>"><?php echo __( 'Icon 6 title:', 'twentythirteen' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ico_title6') ?>" id="<?php echo $this->get_field_id('ico_title6') ?> " value="<?php echo $instance['ico_title6'] ?>" size="20">
		</p>
		
		<?php
	}

	function update ($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title']=$new_instance['title'];
		
		$instance['ico_url1'] = $new_instance['ico_url1'];
		$instance['ico_title1'] = $new_instance['ico_title1'];
		$instance['icon1'] = $new_instance['icon1'];
		
		$instance['ico_url2'] = $new_instance['ico_url2'];
		$instance['ico_title2'] = $new_instance['ico_title2'];
		$instance['icon2'] = $new_instance['icon2'];
		
		$instance['ico_url3'] = $new_instance['ico_url3'];
		$instance['ico_title3'] = $new_instance['ico_title3'];
		$instance['icon3'] = $new_instance['icon3'];
		
		$instance['ico_url4'] = $new_instance['ico_url4'];
		$instance['ico_title4'] = $new_instance['ico_title4'];
		$instance['icon4'] = $new_instance['icon4'];
		
		$instance['ico_url5'] = $new_instance['ico_url5'];
		$instance['ico_title5'] = $new_instance['ico_title5'];
		$instance['icon5'] = $new_instance['icon5'];
		
		$instance['ico_url6'] = $new_instance['ico_url6'];
		$instance['ico_title6'] = $new_instance['ico_title6'];
		$instance['icon6'] = $new_instance['icon6'];

		return $instance;
	}
}
?>