<?php 
/*
 * switchable functions that will be set from the database
 */

global $plugin_settings;



/* 
 * this will check if an option is enabled or not, also it accounts for when options are non-existant 
 */
function option_enabled( $option, $default=false ){
	global $plugin_settings;

	$option = get_option( $option );
    if( $option === false): //see if this is the first time loading, if it is, the option is not on - return false
    	if( $default == true):// want this on by default
    		return true;
		else:
	        return false;
    	endif;
    else:
        if( $option != "" ): // option is not blank, return true
            return true;
        else: // the option has no value, return false
            return false;
        endif;
     endif;
}



/*
 * This function will hide all the update notifications (Global)
 */
function remove_core_updates(){
	global $wp_version;

	return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}

if(option_enabled($plugin_settings['options_prefix'] ."display_core_notifications",false) && is_admin() ):
	add_filter('pre_site_transient_update_core','remove_core_updates',999);
endif;
if(option_enabled($plugin_settings['options_prefix'] ."display_plugin_notifications",false) && is_admin() ):
	add_filter('pre_site_transient_update_plugins','remove_core_updates',999);
endif;
if(option_enabled($plugin_settings['options_prefix'] ."display_theme_notifications",false) && is_admin() ):
	add_filter('pre_site_transient_update_themes','remove_core_updates',999);
endif;




// /* this will disable the update notification for specific plugins*/



// TODO : make it so of the option is not set for a new plugin it does not automatically hide it
function filter_plugin_updates( $value ) {
	global $plugin_settings;

	$all_plugins = get_plugins();

	//getting the list of plugins to hide updates for
	$plugins_to_hide = get_option($plugin_settings['options_prefix'] ."hidden_plugin_notifications",""); // will be encoded i think

	if($plugins_to_hide):
		foreach($plugins_to_hide as $key=>$plugin):
			//loop through all the plugins and remove the ones in this list
			unset($value->response["{$key}"]);
		endforeach; 

		// foreach($all_plugins as $key=>$plugin):
		// 	//loop through all the plugins and remove the ones in this list
		// 	//echo "<br /><br /><br /><br />"."<br />".$key;

		// 	unset( $value->response["{$key}"] );
		// endforeach;
	endif;

    //unset( $value->response['wordpress-seo/wp-seo.php'] );
    return $value;
}

if( is_admin() ):
	add_filter( 'site_transient_update_plugins', 'filter_plugin_updates',999 );
endif;



function hide_plugins($plugins)
{
	global $plugin_settings;

	//getting the list of plugins to hide updates for
	// need to reverse this list so that the ones here are the ones to hide

	$plugins_to_hide = get_option($plugin_settings['options_prefix'] ."hidden_plugins",""); // will be encoded i think


	if($plugins_to_hide):

		foreach($plugins_to_hide as $key=>$plugin):
			//loop through all the plugins and remove the ones in this list
			unset($plugins[$key]);
		endforeach; 
	endif;


	return $plugins;
}
if( is_admin() ):
	add_filter( 'all_plugins', 'hide_plugins',999);
endif;



function remove_561_menu(){
	global $plugin_settings;

	if( !option_enabled($plugin_settings['options_prefix']."show_plugin_menu", true) ):
		remove_menu_page('manage-561-customizations');
	endif;
}


if(is_admin()):
	add_action('admin_menu', 'remove_561_menu',999);
endif;



/*
 * Coming soon folder redirect
 */

function coming_soon_mode(){ 

	global $plugin_settings;

	if ( is_user_logged_in() == false ){ 
		if( get_option($plugin_settings['options_prefix'] ."coming_soon_path") ): //only if set to on
			wp_redirect( get_option($plugin_settings['options_prefix'] ."coming_soon_path"), 503 ); 
		else:
			wp_redirect( '/comingsoon/', 503 ); 
		endif;		
	} 
} 
if( get_option($plugin_settings['options_prefix'] ."coming_soon_mode_enabled") ): //only if set to on
	add_action('init', 'coming_soon_mode', 1); 
endif;


function google_analytics_in_head() {
	global $plugin_settings;

	$account = get_option($plugin_settings['options_prefix'] ."google_tracking_code"); // your account id should look something like this.
	$code = "	 
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', '".$account."', 'auto');
			  ga('send', 'pageview');

			</script>
	 		"; 
	
	echo $code;
}


if( get_option($plugin_settings['options_prefix'] ."google_UA_enabled") ): //only if set to on
	add_action('wp_head', 'google_analytics_in_head');
endif;




// ----------------------------------------------------------------------------

if(get_option($plugin_settings['options_prefix'] ."customize_login")):
//only run any of these functions if the entier thing is on
//now lets check the sub options to see which ones to enable	

	if(get_option($plugin_settings['options_prefix'] ."login_page_alt_text")):
		add_filter( 'login_headertitle', 'namespace_login_headertitle' );
	endif;
	if(get_option($plugin_settings['options_prefix'] ."login_page_logo_url")):
		add_filter( 'login_headerurl', 'namespace_login_headerurl' );
	endif;
	if(get_option($plugin_settings['options_prefix'] ."login_page_logo")):
		add_action( 'login_head', 'custom_replace_login_logo' );
	endif;
	if(get_option($plugin_settings['options_prefix'] ."login_page_background")):
		 add_action( 'login_head', 'custom_replace_login_background' );
	endif;


endif;
function custom_replace_login_logo() {
	global $plugin_settings;
	$url = get_option($plugin_settings['options_prefix'] ."login_page_logo");
    echo '<style>.login h1 a { background-image: url( ' . $url . ') !important; }</style>';
}
function custom_replace_login_background() {
	global $plugin_settings;
	$url = get_option($plugin_settings['options_prefix'] ."login_page_background");
    echo '<style>body.login { background-size: 100%;background-attachment: fixed;background-image: url("'. $url . '") !important; }</style>';
}
function namespace_login_headertitle() {
	global $plugin_settings;
	$title = get_option($plugin_settings['options_prefix'] ."login_page_alt_text");
    return $title;
}
function namespace_login_headerurl( ) {
	global $plugin_settings;
    $url = get_option($plugin_settings['options_prefix'] ."login_page_logo_url");
    return $url;
}
