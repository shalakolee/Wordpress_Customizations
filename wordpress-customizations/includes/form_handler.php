<?php

/*
 * this is the form handler, using this so that the changes are seemingly instant
 */

function get_formatted($option_name){
	global $plugin_settings;
	if($option_name):
		return $plugin_settings['options_prefix'] . $option_name;
	else:
		return "";
	endif;
}



function admin_update_custom_settings($plugin_settings) {
	
global $plugin_settings;

	//check commands and find out which one to run

	if(isset($_REQUEST['command']) && $_REQUEST['command'] == 'update_general_settings'):
		//lets find out what section we are on
		$section = $_REQUEST['section'];

		switch($section){
			case "general":
				$_SESSION['message'] .=  update_option(get_formatted('show_plugin_menu'),isset($_POST[get_formatted('show_plugin_menu')]) ? $_POST[get_formatted('show_plugin_menu')] : '' ) ? "<div class='updated '><p><strong>Updated Menu Settings</strong></p></div>" : "";
				$_SESSION['message'] .=  update_option(get_formatted('show_advanced_functions'),isset($_POST[get_formatted('show_advanced_functions')]) ? $_POST[get_formatted('show_advanced_functions')] : '' ) ? "<div class='updated '><p><strong>Updated Advanced Options Settings</strong></p></div>" : "";
				break;
			case "comingsoon":
				$_SESSION['message'] .=  update_option(get_formatted('coming_soon_mode_enabled'),isset($_POST[get_formatted('coming_soon_mode_enabled')]) ? $_POST[get_formatted('coming_soon_mode_enabled')] : '' ) ? "<div class='updated '><p><strong>Coming Soon Mode Updated</strong></p></div>" : "";
				$_SESSION['message'] .=  update_option(get_formatted('coming_soon_path'),isset($_POST[get_formatted('coming_soon_path')]) ? $_POST[get_formatted('coming_soon_path')] : '' ) ? "<div class='updated '><p><strong>Coming Soon Path Updated</strong></p></div>" : "";
				break;
		}
		header('Location: ' . $_REQUEST['returl'], true, 301);
		die();
	endif;


	//plugin hiding tab
	if(isset($_REQUEST['command']) && $_REQUEST['command'] == 'update_plugin_hiding'):
		//lets update the general settings and redirect
		$_SESSION['message'] .=  update_option(get_formatted('hidden_plugins'),isset( $_POST[get_formatted('hidden_plugins')] ) ? $_POST[get_formatted('hidden_plugins')] : "") ? "<div class='updated '><p><strong>Updated Plugin Visibility</strong></p></div>" : "";

		header('Location: ' . $_REQUEST['returl'], true, 301);
		die();
	endif;


	//social Media
	if(isset($_REQUEST['command']) && $_REQUEST['command'] == 'update_social_media'):
		//lets update the general settings and redirect
		$section = $_REQUEST['section'];
		$updatedmessage = ''; //set the message to nothing

		switch($section){
			case "general":
				//these need to match the post values being passed in, if you add a new social media, please put it here...
				$social_fields = array('phone_number');
				break;
			case "social_media":
				//these need to match the post values being passed in, if you add a new social media, please put it here...
				$social_fields = array('facebook', 'twitter', 'instagram', 'linkedin', 'googleplus', 'youtube', 'pinterest');
				break;
			case "login_page":
				$updatedmessage .=  update_option(get_formatted('customize_login'),isset($_POST[get_formatted('customize_login')]) ? $_POST[get_formatted('customize_login')] : "" ) ? "<p><strong>Updated Login Customization Setting</strong></p>" : "";
				$updatedmessage .=  update_option(get_formatted('login_page_alt_text'),isset($_POST[get_formatted('login_page_alt_text')]) ? $_POST[get_formatted('login_page_alt_text')] : "" ) ? "<p><strong>Updated Custom Alt Text</strong></p>" : "";
				$updatedmessage .=  update_option(get_formatted('login_page_logo_url'),isset($_POST[get_formatted('login_page_logo_url')]) ? $_POST[get_formatted('login_page_logo_url')] : "" ) ? "<p><strong>Updated Custom URL</strong></p>" : "";
				$updatedmessage .=  update_option(get_formatted('login_page_logo'),isset($_POST[get_formatted('login_page_logo')]) ? $_POST[get_formatted('login_page_logo')] : "" ) ? "<p><strong>Updated Login Page Logo</strong></p>" : "";
				$updatedmessage .=  update_option(get_formatted('login_page_background'),isset($_POST[get_formatted('login_page_background')]) ? $_POST[get_formatted('login_page_background')] : "" ) ? "<p><strong>Updated Login Page Background</strong></p>" : "";

				break;
			case "google_analytics":
				//google analytics
				$updatedmessage .=  update_option(get_formatted('google_UA_enabled'),isset($_POST[get_formatted('google_UA_enabled')]) ? $_POST[get_formatted('google_UA_enabled')] : "" ) ? "<p><strong>Google Analytics Updated</strong></p>" : "";
				$updatedmessage .=  update_option(get_formatted('google_tracking_code'),isset($_POST[get_formatted('google_tracking_code')]) ? $_POST[get_formatted('google_tracking_code')] : '' ) ? "<p><strong>Google Analytics ID Updated</strong></p>" : "";
				break;
		}

		if($social_fields):
		foreach($social_fields as $social):
			$formattedsocial = get_formatted( $social ); //add the prefix
			//check if there is a post value 
			if( isset( $formattedsocial ) ):
				$updatedmessage .= update_option( $formattedsocial, $_POST[$formattedsocial] ) ? '<p>Updated ' . $social . ' URL</p>' : '';
			else:
				//lets set to nothing
				$updatedmessage .= update_option( $formattedsocial, '' ) ? '<p>Removed ' . $social . ' URL</p>' : '';
			endif;
		endforeach;
		endif;

		if( $updatedmessage != "" ):
			//lets return an update message
			$_SESSION['message'] .= "<div class='updated '>" . $updatedmessage . "</div>";
		endif;

		header('Location: ' . $_REQUEST['returl'], true, 301);
		die();
	endif;

	//notifications
	if(isset($_REQUEST['command']) && $_REQUEST['command'] == 'update_notification_settings'):
		//lets update the general settings and redirect
	  	$_SESSION['message'] .= update_option(get_formatted('display_core_notifications'),isset($_POST[get_formatted('display_core_notifications')]) ? $_POST[get_formatted('display_core_notifications')] : '') ? "<div class='updated '><p><strong>Updated Core Notification Settings</strong></p></div>" : "" ;
	  	$_SESSION['message'] .= update_option(get_formatted('display_plugin_notifications'),isset($_POST[get_formatted('display_plugin_notifications')]) ? $_POST[get_formatted('display_plugin_notifications')] : '') ? "<div class='updated '><p><strong>Updated Plugin Notification Settings</strong></p></div>" : "" ;
	  	$_SESSION['message'] .= update_option(get_formatted('display_theme_notifications'),isset($_POST[get_formatted('display_theme_notifications')]) ? $_POST[get_formatted('display_theme_notifications')] : '') ? "<div class='updated '><p><strong>Updated Theme Notifications</strong></p></div>" : "" ;
	  	$_SESSION['message'] .= update_option(get_formatted('hidden_plugin_notifications'),$_POST[get_formatted('hidden_plugin_notifications')]) ? "<div class='updated '><p><strong>Updated Individual Notifications</strong></p></div>" : "" ;
		
		header('Location: ' . $_REQUEST['returl'], true, 301);
		die();
	endif;

	//updates
	if(isset($_REQUEST['command']) && $_REQUEST['command'] == 'update_update_settings'):
		//lets update the general settings and redirect
	  	$_SESSION['message'] .= update_option(get_formatted('update_url'),isset($_POST[get_formatted('update_url')]) ? $_POST[get_formatted('update_url')] : '') ? "<div class='updated '><p><strong>Updated Update URL</strong></p></div>" : "" ;
		
		header('Location: ' . $_REQUEST['returl'], true, 301);
		die();
	endif;



}

 ?>