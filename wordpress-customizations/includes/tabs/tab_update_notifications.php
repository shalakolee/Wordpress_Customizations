<?php


/*
 * General Settings Tab
 */
global $plugin_settings;

	if (isset($_SESSION['message'])) {
	    echo $_SESSION['message']; //display the message
	    unset($_SESSION['message']); //free it up
	}

  ?>


	<script type="text/javascript">
	  	jQuery(document).ready(function() {
	      jQuery('.onoff').iphoneStyle({checkedLabel: 'Hidden', uncheckedLabel: 'Visible'});
  	 	});

	</script>

<form name="update_notification_form" method="post" action="/wp-admin/admin-post.php">
	<style>
		input[type="text"]{width:300px;}
	</style>
  	<table class="form-table">
        <tr valign="top">
	        <th scope="row">Core Update Notifications</th>
	        <td>
			<input type="checkbox" class="onoff" name='<?php echo $plugin_settings['options_prefix']; ?>display_core_notifications' <?php echo option_enabled($plugin_settings['options_prefix'].'display_core_notifications',false) ? "checked='checked'" : '' ?> />
	       	 <em>This setting is for the wordpress core notifications</em>
	        </td>
        </tr>
        <tr valign="top">
	        <th scope="row">Plugin Updates Notifications</th>
	        <td>
			<input type="checkbox" class="onoff" name='<?php echo $plugin_settings['options_prefix']; ?>display_plugin_notifications' <?php echo option_enabled($plugin_settings['options_prefix'].'display_plugin_notifications',false) ? "checked='checked'" : '' ?> />
	       	 <em>This is the plugin update notification, please note that this is global, if you wish to use the list, please leave this off.</em>
	        </td>
        </tr>
        <tr valign="top">
	        <th scope="row">Theme Updates Notifications</th>
	        <td>
			<input type="checkbox" class="onoff" name='<?php echo $plugin_settings['options_prefix']; ?>display_theme_notifications' <?php echo option_enabled($plugin_settings['options_prefix'].'display_theme_notifications',false) ? "checked='checked'" : '' ?> />
	       	 <em>This setting for the theme update notifications</em>
	        </td>
        </tr>
    </table>
	
    <hr />

  	<table class="form-table">

	<?php 
	// Check if get_plugins() function exists. This is required on the front end of the
	// site, since it is in a file that is normally only loaded in the admin.
	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$all_plugins = get_plugins();
	$active_plugins = get_option($plugin_settings['options_prefix']."hidden_plugin_notifications");



	// this code will check to make sure this option has already been added to the table once
	//Options that don't exist get the fact of their non-existence cached in memory when you attempt to get them. So you can check that cache to determine the difference.
	$firstload = false;
	$notoptions = wp_cache_get( 'notoptions', 'options' );
	if ( isset( $notoptions[$plugin_settings['options_prefix'].'hidden_plugin_notifications'] ) ) {
	    // option does not exist
	    $firstload = true;
	}

	?>

	<?php $pluginCounter = 0; ?>
	<?php foreach($all_plugins as $key=>$plugin): ?>
		<?php 
			if($firstload): //
			$checked = false;
			else:
				if(array_key_exists($key, $active_plugins)):
					$checked = true;
				else:
					$checked = false;
				endif; 
			endif;
		?>
        <tr valign="top">
	        <th scope="row"><?php echo $plugin["Name"]; ?></th>
	        <td>
			<input type="checkbox" class="onoff plugin" name='<?php echo $plugin_settings['options_prefix']; ?>hidden_plugin_notifications[<?php echo $key; ?>]' <?php echo $checked ? "checked='checked'" : '' ?> />
	       	 <em>Update Notifications for <?php echo $plugin["Name"]; ?></em>
	        </td>

        </tr>
        <?php $pluginCounter++; ?>
	<?php endforeach; ?>


	 </table>

	<input type="hidden" name="action" value="update_custom_settings">
    <input type="hidden" name="command" value="update_notification_settings">
    <input type="hidden" name="returl" value="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">

	<?php submit_button( 'Update Settings', 'primary', 'submit' ) ?>
</form>









<!-- 
<em>Template Usage: &lt;?php echo get_option(&quot;facebook&quot;) ? &quot;&lt;a href=&#39;&quot;.get_option(&quot;facebook&quot;) .&quot;&#39; target=&#39;_blank&#39;&gt;&lt;/a&gt;&quot; : &#39;&#39; ?&gt;</em>
<br />
<em>Available Option Values: facebook, twitter, instagram, googleplus, youtube, pinterest</em> -->


































<?php

/* this function will hide all the updates */
// function remove_core_updates(){
// global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
// }
// add_filter('pre_site_transient_update_core','remove_core_updates');
// add_filter('pre_site_transient_update_plugins','remove_core_updates');
// add_filter('pre_site_transient_update_themes','remove_core_updates');


// /* this function is used to hide installed plugins on the plugins page */
// add_filter( 'all_plugins', 'hide_plugins');
// function hide_plugins($plugins)
// {
// 	// Hide hello dolly plugin
// 	if(is_plugin_active('hello.php')) {
// 		unset( $plugins['hello.php'] );
// 	}
// 	// Hide disqus plugin
// 	if(is_plugin_active('disqus-comment-system/disqus.php')) {
// 		unset( $plugins['disqus-comment-system/disqus.php'] );
// 	}
// 	return $plugins;
// }


// /* this will disable the update notification for specific plugins*/
// function filter_plugin_updates( $value ) {
//     unset( $value->response['akismet/akismet.php'] );
//     return $value;
// }
// add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );

// /* remove woothemes updater notice */
// remove_action( 'admin_notices', 'woothemes_updater_notice' );