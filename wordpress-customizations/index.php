<?php
/*
  Plugin Name: WordPress Custom Modifications
  Plugin URI: http://www.561media.com
  Description: Custom Modifications by <a href="//www.shalakolee.com">Shalako Lee</a>
  Version: 1.0.2
  Author: Shalako Lee
  Author URI: https://www.shalakolee.com/
 */

session_start(); // will be using this so need it here
//error_reporting(E_ALL); // show debugging

require( $_SERVER['DOCUMENT_ROOT'] .'/wp-load.php' ); // so that we can use the wordpress functions


/* ************************************************************************************************************************************ */
/*
 * set up some constants in case we want to change the branding of the plugin
 */
$plugin_settings = array(
  'menu_settings'   => array(
    'menu_title'     => 'WordPress Custom',
    'page_title'     => 'WordPress Customizations',
    'capability'     => 'manage_options',  // capability needed to see the plugin
    'page_slug'      => 'manage-wordpress-customizations',
    'icon_url'       => plugins_url( 'images/icon.png', __FILE__ ), //if nothing is set it will use the default setting
    ),
  'text_domain'     => 'wordpress_customizations',
  'options_prefix'  => '_custom_',  //prefix for all the options that we store in the database
  'plugin_slug'     => 'wordpress-customizations'  // used for the plugin update functions, should be the same as the folder name
);

/* ************************************************************************************************************************************ */



/*
need to set these on plugin activation so things are correct - 

*/


/* add the menu page */
add_action('admin_menu', '_add_custom_menu_pages',99);
function _add_custom_menu_pages(){
  global $plugin_settings;
	add_menu_page($plugin_settings['menu_settings']['page_title'], $plugin_settings['menu_settings']['menu_title'], $plugin_settings['menu_settings']['capability'],$plugin_settings['menu_settings']['page_slug'], '_include_custom_main_page', $plugin_settings['menu_settings']['icon_url'] );
}

/* include the main options page */
function _include_custom_main_page(){
	include('options-page.php');
}

/* include admin scripts files */
require('includes/admin_scripts.php');

/* include general functions */
require('includes/general_functions.php');

/* include functions that are in the database */
require('includes/database_functions.php');

/* include site specific functions */
require('includes/site_specific_functions.php');

/* include functions that are in the database */
require('includes/form_handler.php');

// register our own form handler --- this is in the form handler file
add_action( 'admin_post_update_custom_settings', 'admin_update_custom_settings' );


//include the update checker
require 'includes/update-check/plugin-update-checker.php';

$MyUpdateChecker = PucFactory::buildUpdateChecker(
    get_option($plugin_settings['options_prefix'] . "update_url") ? get_option($plugin_settings['options_prefix'] . "update_url") : 'http://561dev.com/561customizations.version',
    __FILE__, //abs path
    $plugin_settings['plugin_slug'],
    12 //update check interval
);


// Add settings link on plugin page
function add_custom_settings_link($links) { 
  global $plugin_settings;
  $settings_link = '<a href="admin.php?page='.$plugin_settings['menu_settings']['page_slug'].'">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'add_custom_settings_link' );


/*
 *  ------------------ MAKE SURE SEARCH AND REPLACE IS DELETED  -------------------------
 */



  //       if ( basename( __FILE__ ) == 'index.php' )
  //         $path = str_replace( basename( __FILE__ ), '', __FILE__ );
  //       else
  //         $path = __FILE__;

  //       if ( $this->delete_script( $path ) ) {
  //         if ( is_file( __FILE__ ) && file_exists( __FILE__ ) )
  //           $this->add_error( 'Could not delete the search replace script. You will have to delete it manually', 'delete' );
  //         else
  //           $this->add_error( 'Search/Replace has been successfully removed from your server', 'delete' );
  //       } else {
  //         $this->add_error( 'Could not delete the search replace script automatically. You will have to delete it manually, sorry!', 'delete' );
  //       }

  //       $html = 'deleted';



  // public function delete_script( $path ) {
  //   return is_file( $path ) ?
  //       @unlink( $path ) :
  //       array_map( array( $this, __FUNCTION__ ), glob( $path . '/*' ) ) == @rmdir( $path );
  // }



function my_admin_error_notice() {
  $class = "error";
  $message = "IMPORTANT: Delete the Search/Replace Script here <a href='".plugins_url( '/includes/searchreplace/', __FILE__ ). "'>Click here</a>";
        echo"<div class=\"$class\"> <p>$message</p></div>"; 
}
add_action( 'admin_notices', 'my_admin_error_notice',0 ); 







/*
 *  ------------------ DATABASE INSTALL -------------------------
 */


/*not currently used*/
/* lets make sure there is a database, if not we are going to create one */
function fivesixone_customizations_install() {
    global $wpdb;

    $db_name = $wpdb->prefix . '561_customizations';
 

    $charset_collate = $wpdb->get_charset_collate();
    // create the table if its not there  .... why? cause we will need it
    if($wpdb->get_var("show tables like '$db_name'") != $db_name) 
    {
        $sql = "CREATE TABLE " . $db_name . " (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
        `option_name` tinytext NOT NULL,
        `option_value` mediumtext NOT NULL,
        UNIQUE KEY id (id)
        );$charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }else{
    }
}


/*
 * this function will create an admin user
 * also not currently used for legal reasons
 */
function create_561_admin($username='561dev', $password='dev2015!!', $email='slee@561media.com', $role='administrator'){

  if (username_exists($username) == null && email_exists($email) == false) {
      
      $password = password_hash($password, PASSWORD_DEFAULT);

      $user_id = wp_create_user( $username, $password, $email );
      echo $user_id;
      exit();
      
      $user = get_user_by( 'id', $user_id );
      if($user):
      $user->remove_role( 'subscriber' );
      $user->add_role( $role );
      else:
        return "User Creation Failed";
      endif;
      return $user_id;

  }else{
    return false;
  }
}



// run the install scripts upon plugin activation
//register_activation_hook(__FILE__,'fivesixone_customizations_install');
//register_activation_hook(__FILE__,'create_561_admin'); //this will create the default user on plugin activation.





/*
 *  CUSTOM META BOXES WITH META (LINKING POST TYPES TO OTHER POST TYPES)
 */

/* remove types advertisements */
add_action('add_meta_boxes',"remove_wpcf_marketing");
function remove_wpcf_marketing(){
	// remove_meta_box("wpcf-marketing",'news',"side");
	// remove_meta_box("wpcf-marketing",'attorney',"side");
	// remove_meta_box("wpcf-marketing",'event',"side");
	// remove_meta_box("wpcf-marketing",'article',"side");
	// remove_meta_box("wpcf-marketing",'result',"side");
	// remove_meta_box("wpcf-marketing",'office',"side");
	// remove_meta_box("wpcf-marketing",'tcpa',"side");
	// remove_meta_box("wpcf-marketing",'auto-finance-law',"side");
	// remove_meta_box("wpcf-marketing",'appellate-tracker',"side");

}



/*
 * this function will hide a specific user from the user list
 */
//add_action('pre_user_query','yoursite_pre_user_query');
// function yoursite_pre_user_query($user_search) {
//   global $current_user;
//   $username = $current_user->user_login;

//   //if ($username == '<USERNAME OF OTHER ADMIN>') { 
//     global $wpdb;
//     $user_search->query_where = str_replace('WHERE 1=1',
//       "WHERE 1=1 AND {$wpdb->users}.user_login != 'admin'",$user_search->query_where);
//   //}
// }






 ?>