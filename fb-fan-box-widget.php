<?php
/*
 * Plugin Name: FB Widget
 * Version: 1.0
 * Plugin URI: http://www.dreamyourcareer.com/
 * Description: fb widget is a plugin that allows site owners to promote their facebook pages and embed page feed on their websites simply using FB Widget Plugin.
 * Author: Navnish Bhardwaj & Simmi Aggarwal
 * Author URI: http://dreamyourcareer.com/author/navnish/
 */
require_once('facebook-fanbox-settings.php');
class FbFanBox_Widget_Class extends WP_Widget
{
	
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title'=>'',
				'height'=>'292',
				'width'=>'250',
		) );
	
		$widget_title = htmlspecialchars($instance['title']);
		$width = empty($instance['width']) ? '250' : $instance['width'];
		$height = empty($instance['height']) ? '260' : $instance['height'];
		echo '<p ><label for="' . $this->get_field_name('title') . '">Title:</label><br/> <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $widget_title . '" /></p>';
		echo '<hr/><p style="text-align:left;"><b>Like Box Setting</b></p>';
		echo '<p ><label for="' . $this->get_field_name('width') . '">Width:</label><br/> <input style="width: 100px;" id="' . $this->get_field_id('width') . '" name="' . $this->get_field_name('width') . '" type="text" value="' . $width . '" /></p>';
		echo '<p ><label for="' . $this->get_field_name('height') . '">Height:</label><br/> <input style="width: 100px;" id="' . $this->get_field_id('height') . '" name="' . $this->get_field_name('height') . '" type="text" value="' . $height . '" /></p>';
		echo '<hr/>';
	}
	function widget($args, $instance){
		extract($args);
		$data=get_option('fb_like_bx_options');
		$widget_title=(empty($instance['title']) ? '' : $instance['title']);
		$widget_title = apply_filters('widget_title', $widget_title);		
		$fb_page_link = empty($data['pageURL']) ? '' : $data['pageURL'];
		$fb_pageID = empty($data['appID']) ? '' : $data['appID'];
		$width = empty($instance['width']) ? '250' : $instance['width'];
		$height = empty($instance['height']) ? '260' : $instance['height'];
		$streams = empty($data['streams']) ? 'yes' : $data['streams'];
		$fb_colorScheme = empty($data['colorScheme']) ? 'light' : $data['colorScheme'];
		$borderdisp = empty($data['borderdisp']) ? 'yes' : $data['borderdisp'];
		$showFaces = empty($data['showFaces']) ? 'yes' : $data['showFaces'];
		$header = empty($data['header']) ? 'yes' : $data['header'];			
		if ($showFaces == "yes")
			$showFaces = "true";			
		else
			$showFaces = "false";
		
		if ($streams == "yes") {
			$streams = "true";
			$height = $height + 300;
		} else
			$streams = "false";
		
		if ($header == "yes") {
			$header = "true";
			$height = $height + 32;
		} else
			$header = "false";

		echo $before_widget;

		if ( $widget_title )
			echo $before_title . $widget_title . $after_title;

		$isUsingPageURL = false;
		echo '<div id="fb-root"></div>
		<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_IN/all.js#xfbml=1&appId='.$fb_pageID.'";fjs.parentNode.insertBefore(js, fjs);}(document, \'script\', \'facebook-jssdk\'));</script>';
		$like_box_xfbml = "<fb:like-box href=\"$fb_page_link\" width=\"$width\" show_faces=\"$showFaces\" border_color=\"$borderdisp\" stream=\"$streams\" header=\"$header\" data-colorscheme=\"$fb_colorScheme\" data-show-border=\"$borderdisp\"></fb:like-box>";
		$renderedHTML = $like_box_xfbml;
		echo $renderedHTML;
		echo $after_widget;
	}
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['width'] = strip_tags(stripslashes($new_instance['width']));
		$instance['height'] = strip_tags(stripslashes($new_instance['height']));
		return $instance;
	}
	function __construct(){
		$options_widget = array('classname' => 'widget_FacebookLikeBox', 'description' =>"fb widget is a plugin that allows site owners to promote their facebook pages and embed page feed on their websites simply using FB Widget Plugin.");
		$options_control = array('width' => 300, 'height' => 300);
		$this->WP_Widget('FbFanBox_Widget_Class', 'FB Widget', $options_widget, $options_control);
	}
}
function fb_fan_settings_link( $links ) {
	$settings_page = '<a href="' . admin_url('admin.php?page=fb_box_settings' ) .'">Settings</a>';
	array_unshift( $links, $settings_page );
	return $links;
}
$plugin = plugin_basename(__FILE__);

add_filter( "plugin_action_links_$plugin", 'fb_fan_settings_link' );
	function FbFanBoxInit() {
	register_widget('FbFanBox_Widget_Class');
	}	
	add_action('widgets_init', 'FbFanBoxInit');
	register_activation_hook( __FILE__, 'fanbox_init' );
	function fanbox_init(){
		$defaults=array('appID'=>'356901847823837',
				'pageURL'=>'https://www.facebook.com/376792772336550',
				'streams'=>'yes',
				'colorScheme'=>'light',
				'borderdisp'=>'yes',
				'showFaces'=>'yes',
				'header'=>'yes');
		add_option('fb_like_bx_options',$defaults);
	}
?>