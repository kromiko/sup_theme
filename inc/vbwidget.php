<?php
/*
Widget to display tickets RMS
*/
class Tickets_RMS extends WP_Widget {

	private $root = '/var/www/forum.bunker.loc/';
	
	//pull needed files in wordpress template
	private function connect_files($forum_root)
	{			
		$curdir = getcwd();
		chdir($forum_root);
		//require_once($forum_root . 'global.php');
		require_once('./wp_recent_threads.php');
		require_once('./wp_get_threads_content.php');
		//chdir($curdir);
	}
	
	public function __construct() {
		
		/* Widget settings. */
		$widget_ops = array(
			'classname' => 'widget_tickets_rms', 
			'description' => 'Allows you to display a list of latest threads from one of Tickets RMS forum.');

		/* Widget control settings. */
		$control_ops = array(
			'width' => 250, 
			'height' => 250, 
			'id_base' => 'tickets_rms-widget');
			
		parent::__construct('tickets_rms-widget','Latest threads from from one of Tickets RMS forum',$widget_ops,$control_ops);	
	}
	
	function widget ($args,$instance) {
		$this->connect_files($this->root);
		//extract($args);
		$numberposts = $instance['numberposts'];
		$title=$instance['title'];
		$forum_root=$instance['forum_root'];
		//$forumid = $instance['forumid'];
		$forumname = $instance['forumname'];
        
		//$forum_url=$vbulletin->options['bburl'];			
        //Begin Thread Counts 
        $toutput = get_last_threads($forumname, $numberposts); 
         
		//print the widget for the sidebar
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'] . $toutput . $args['after_widget'];
	}
	
	function form ($instance) {
		
		$this->connect_files($this->root);
		
		/* Set up some default widget settings. */
		$defaults = array('title'=>'Tickets RMS','forum_root'=>$this->root,'numberposts' => '5','forumid' => '417','forumname' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" size="20">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('forum_root'); ?>">Forum root:</label>
			<input type="text" name="<?php echo $this->get_field_name('forum_root') ?>" id="<?php echo $this->get_field_id('forum_root') ?> " value="<?php echo $instance['forum_root'] ?>" size="20">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('numberposts'); ?>">Number of posts <em>(0 - display all posts)</em>:</label>
			<input type="text" name="<?php echo $this->get_field_name('numberposts') ?>" id="<?php echo $this->get_field_id('numberposts') ?> " value="<?php echo $instance['numberposts'] ?>" size="20">	
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('forumid'); ?>">Forum ID:</label>
			<input type="text" name="<?php echo $this->get_field_name('forumid') ?>" id="<?php echo $this->get_field_id('forumid') ?> " value="<?php echo $instance['forumid'] ?>" size="20">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('forumname'); ?>">Forum Name:</label>
			<select id="<?php echo $this->get_field_id('forumname'); ?>" name="<?php echo $this->get_field_name('forumname'); ?>">
				<?php get_threads($instance['forumid'], $instance['forumname']); ?>
			</select>
		</p>
		<?php
	}

	function update ($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title']=$new_instance['title'];
		$instance['numberposts'] = $new_instance['numberposts'];
		$instance['forum_root'] = $new_instance['forum_root'];
		$instance['forumid'] = $new_instance['forumid'];
		$instance['forumname'] = $new_instance['forumname'];

		return $instance;
	}
}
?>