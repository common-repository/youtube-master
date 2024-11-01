<?php
//Hook Widget
add_action( 'widgets_init', 'youtube_master_widget_hangouts_basic' );
//Register Widget
function youtube_master_widget_hangouts_basic() {
register_widget( 'youtube_master_widget_hangouts_basic' );
}

class youtube_master_widget_hangouts_basic extends WP_Widget {
	function __construct(){
	$widget_ops = array( 'classname' => 'Hangouts Basic', 'description' => __('Hangouts Basic widget is a fast loading, easy to configure hangouts launcher.', 'youtube_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'youtube_master_widget_hangouts_basic' );
	parent::__construct( 'youtube_master_widget_hangouts_basic', __('Hangouts Basic', 'youtube_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
	global $wpdb, $blog_id;
		extract( $args );
		//Set Dropdown options
		$youtubemaster_hangouts_basic_button_size_s = "small";
		$youtubemaster_hangouts_basic_button_size_m = "medium";
		$youtubemaster_hangouts_basic_button_size_l = "large";
		if(is_multisite()){
			add_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_s', $youtubemaster_hangouts_basic_button_size_s);
			add_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_m', $youtubemaster_hangouts_basic_button_size_m);
			add_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_l', $youtubemaster_hangouts_basic_button_size_l);
		}
		else{
			add_option('youtubemaster_hangouts_basic_button_size_s', $youtubemaster_hangouts_basic_button_size_s);
			add_option('youtubemaster_hangouts_basic_button_size_m', $youtubemaster_hangouts_basic_button_size_m);
			add_option('youtubemaster_hangouts_basic_button_size_l', $youtubemaster_hangouts_basic_button_size_l);
		}
		//Our variables from the widget settings.
		$youtube_title = isset( $instance['youtube_title'] ) ? $instance['youtube_title'] :false;
		$youtube_title_new = isset( $instance['youtube_title_new'] ) ? $instance['youtube_title_new'] :false;
		$youtubespacer ="'";
		$show_youtubemaster_hangouts_basic_button = isset( $instance['show_youtubemaster_hangouts_basic_button'] ) ? $instance['show_youtubemaster_hangouts_basic_button'] :false;
		$youtubemaster_hangouts_basic_button_size_choice = isset( $instance['youtubemaster_hangouts_basic_button_size_choice'] ) ? $instance['youtubemaster_hangouts_basic_button_size_choice'] :false;
		$youtubemaster_hangouts_basic_lang = isset( $instance['youtubemaster_hangouts_basic_lang'] ) ? $instance['youtubemaster_hangouts_basic_lang'] :false;
		echo $before_widget;
		
// Display the widget title
	if ( $youtube_title ){
		if (empty ($youtube_title_new)){
			$youtube_title_new = constant('YOUTUBE_MASTER_NAME');
			echo $before_title . $youtube_title_new . $after_title;
		}
		else{
			echo $before_title . $youtube_title_new . $after_title;
		}
	}
	else{
	}
	if(is_multisite()){
		if($youtubemaster_hangouts_basic_button_size_choice == get_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_s')){
			$youtubemaster_hangouts_basic_button_size = '75';
		}
		if($youtubemaster_hangouts_basic_button_size_choice == get_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_m')){
			$youtubemaster_hangouts_basic_button_size = '138';
		}
		if($youtubemaster_hangouts_basic_button_size_choice == get_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_l')){
			$youtubemaster_hangouts_basic_button_size = '175';
		}
	}
	else{
		if($youtubemaster_hangouts_basic_button_size_choice == get_option('youtubemaster_hangouts_basic_button_size_s')){
			$youtubemaster_hangouts_basic_button_size = '75';
		}
		if($youtubemaster_hangouts_basic_button_size_choice == get_option('youtubemaster_hangouts_basic_button_size_m')){
			$youtubemaster_hangouts_basic_button_size = '138';
		}
		if($youtubemaster_hangouts_basic_button_size_choice == get_option('youtubemaster_hangouts_basic_button_size_l')){
			$youtubemaster_hangouts_basic_button_size = '175';
		}
	}
//Prepare Language
	if ( empty ($youtubemaster_hangouts_basic_lang ) ) {
		$youtubemaster_hangouts_basic_lang = 'en-US';
	}
//Prepare Button Size
	if ( empty ($youtubemaster_hangouts_basic_button_size ) ) {
		$youtubemaster_hangouts_basic_button_size = '138';
	}
//Display Hanghouts Button
		if ( $show_youtubemaster_hangouts_basic_button ){
		echo '<script>
			window.___gcfg = {
			lang: '.$youtubespacer.''.$youtubemaster_hangouts_basic_lang.''.$youtubespacer.'
			};
			</script>'.
			'<script src="https://apis.google.com/js/platform.js" async defer></script>'.
			'<g:hangout render="createhangout" widget_size="'.$youtubemaster_hangouts_basic_button_size.'"></g:hangout>';
		}
		else{
		}
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
	global $wpdb, $blog_id;
		$instance = $old_instance;
		//Dropdown
		$instance['youtubemaster_hangouts_basic_button_size_choice'] = $new_instance['youtubemaster_hangouts_basic_button_size_choice'];
		//Strip tags from title and name to remove HTML
		$instance['youtube_title'] = strip_tags( $new_instance['youtube_title'] );
		$instance['youtube_title_new'] = $new_instance['youtube_title_new'];
		$instance['show_youtubemaster_hangouts_basic_button'] = $new_instance['show_youtubemaster_hangouts_basic_button'];
		$instance['youtubemaster_hangouts_basic_lang'] = $new_instance['youtubemaster_hangouts_basic_lang'];
		if(is_multisite()){
			update_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_choice', $new_instance['youtubemaster_hangouts_basic_button_size_choice']);
		}
		else{
			update_option('youtubemaster_hangouts_basic_button_size_choice', $new_instance['youtubemaster_hangouts_basic_button_size_choice']);
		}
		return $instance;
	}
	function form( $instance ) {
	global $wpdb, $blog_id;
	$plugin_master_name = constant('YOUTUBE_MASTER_NAME');
	//Set up some default widget settings.
	$defaults = array( 'youtube_title_new' => __('Youtube Master', 'youtube_master'), 'youtube_title' => true, 'youtube_title_new' => false, 'show_youtubemaster_hangouts_basic_button' => true, 'youtubemaster_hangouts_basic_button_size_choice' => false, 'youtubemaster_hangouts_basic_lang' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	//prepare form
	if(is_multisite()){
		$youtubemaster_hangouts_basic_button_size_choice = get_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_choice');
		$youtubemaster_hangouts_basic_button_size_m = get_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_m');
		$youtubemaster_hangouts_basic_button_size_s = get_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_s');
		$youtubemaster_hangouts_basic_button_size_l = get_blog_option($blog_id, 'youtubemaster_hangouts_basic_button_size_l');
	}
	else{
		$youtubemaster_hangouts_basic_button_size_choice = get_option('youtubemaster_hangouts_basic_button_size_choice');
		$youtubemaster_hangouts_basic_button_size_m = get_option('youtubemaster_hangouts_basic_button_size_m');
		$youtubemaster_hangouts_basic_button_size_s = get_option('youtubemaster_hangouts_basic_button_size_s');
		$youtubemaster_hangouts_basic_button_size_l = get_option('youtubemaster_hangouts_basic_button_size_l');
	}
	?>
		<br>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['youtube_title'], true ); ?> id="<?php echo $this->get_field_id( 'youtube_title' ); ?>" name="<?php echo $this->get_field_name( 'youtube_title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'youtube_title' ); ?>"><b><?php _e('Display Widget Title', 'youtube_master'); ?></b></label>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'youtube_title_new' ); ?>"><?php _e('Change Title:', 'youtube_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'youtube_title_new' ); ?>" name="<?php echo $this->get_field_name( 'youtube_title_new' ); ?>" value="<?php echo $instance['youtube_title_new']; ?>" style="width:auto;" />
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_youtubemaster_hangouts_basic_button'], true ); ?> id="<?php echo $this->get_field_id( 'show_youtubemaster_hangouts_basic_button' ); ?>" name="<?php echo $this->get_field_name( 'show_youtubemaster_hangouts_basic_button' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_youtubemaster_hangouts_basic_button' ); ?>"><b><?php _e('Display Hangouts Button', 'youtube_master'); ?></b></label>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'youtubemaster_hangouts_basic_button_size_choice' ); ?>"><?php _e('select button size:', 'youtube_master'); ?></label><br>
	<select id="<?php echo $this->get_field_id( 'youtubemaster_hangouts_basic_button_size_choice' ); ?>" name="<?php echo $this->get_field_name( 'youtubemaster_hangouts_basic_button_size_choice' ); ?>">
	<option value="<?php echo $youtubemaster_hangouts_basic_button_size_m; ?>" <?php echo $youtubemaster_hangouts_basic_button_size_choice == 'medium' ? 'selected="selected"':''; ?>>Medium Size</option>
	<option value="<?php echo $youtubemaster_hangouts_basic_button_size_s; ?>" <?php echo $youtubemaster_hangouts_basic_button_size_choice == 'small' ? 'selected="selected"':''; ?>>Small Size</option>
	<option value="<?php echo $youtubemaster_hangouts_basic_button_size_l; ?>" <?php echo $youtubemaster_hangouts_basic_button_size_choice == 'large' ? 'selected="selected"':''; ?>>Large Size</option>
	</select>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'youtubemaster_hangouts_basic_lang' ); ?>"><?php _e('insert button language:', 'youtube_master'); ?></label><br>
	<input id="<?php echo $this->get_field_id( 'youtubemaster_hangouts_basic_lang' ); ?>" name="<?php echo $this->get_field_name( 'youtubemaster_hangouts_basic_lang' ); ?>" value="<?php echo $instance['youtubemaster_hangouts_basic_lang']; ?>" style="width:auto;" />
	<div class="description">Leave blank for default <strong>en_US</strong></div>
	<div class="description">You can override inserting your country language code:</div>
	<div class="description"><a href="https://developers.google.com/+/web/api/supported-languages" target="_blank">https://developers.google.com/+/web/api/supported-languages</a></div>
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<b><?php echo $plugin_master_name; ?> Website</b>
	</p>
	<p><a class="button-secondary" href="https://wordpress.techgasp.com/youtube-master/" target="_blank" title="<?php echo $plugin_master_name; ?> Info Page">Info Page</a> <a class="button-secondary" href="https://wordpress.techgasp.com/youtube-master-documentation/" target="_blank" title="<?php echo $plugin_master_name; ?> Documentation">Documentation</a> <a class="button-primary" href="https://wordpress.techgasp.com/youtube-master/" target="_blank" title="<?php echo $plugin_master_name; ?> Wordpress">Get Add-ons</a></p>
	<?php
	}
 }
?>
