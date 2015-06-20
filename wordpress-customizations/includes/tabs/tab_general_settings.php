<?php


/*
 * General Settings Tab

	options set on this page

	show_plugin_menu
	show_advanced_functions
	coming_soon_mode_enabled
	coming_soon_path
	google_UA_enabled
	google_tracking_code


	
 */

	if (isset($_SESSION['message'])) {
	    echo $_SESSION['message']; //display the message
	    unset($_SESSION['message']); //free it up
	}

global $plugin_settings;
?>

<script type="text/javascript">
  	jQuery(document).ready(function() {
      jQuery('.onoff').iphoneStyle({checkedLabel: 'ON', uncheckedLabel: 'OFF'});
	 	});

</script>

<?php
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_settings'; //need this to know what tab we are on
	$active_section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : 'general'; //default the active section to general
	$current_page = "?page=" .$plugin_settings['menu_settings']['page_slug'] ."&tab=" . $active_tab .""; //here so we keep things short
?>


<?php //build the sub menu ?>
<ul id="settings-sections" class="subsubsub hide-if-no-js">
	<li><a href="<?php echo $current_page ?>&section=general" class="tab <?php echo $active_section == 'general' ? 'current' : ''; ?>">General Plugin Settings</a></li>
	<li> | <a href="<?php echo $current_page ?>&section=comingsoon" class="tab <?php echo $active_section == 'comingsoon' ? 'current' : ''; ?>">Coming Soon Mode</a></li>
</ul>

<div style="clear:both;height:20px;"></div>


<form name="general_settings_form" method="post" action="/wp-admin/admin-post.php">
	<style>
		input[type="text"]{width:500px !important;}
	</style>

<?php //this will all still post to the same thing, but will only be updating the fields that are on the current section ?>
        
<?php if($active_section == 'general'): ?>
  
  <h2>Display Options</h2>
  <em>show / hide the plugin menu and display advanced options for the user</em>
  <table class="form-table">
        <tr valign="top">
	        <th scope="row">Show Plugin in Menu</th>
	        <td>
				<input type="checkbox" class="onoff" name='<?php echo $plugin_settings['options_prefix']; ?>show_plugin_menu' <?php echo option_enabled($plugin_settings['options_prefix']."show_plugin_menu", true) ? "checked='checked'" : '' ?> />
	       	 	<em></em>
	        </td>
        </tr>       
        <tr valign="top">
	        <th scope="row">Show Advanced Options</th>
	        <td>
				<input type="checkbox" class="onoff" name='<?php echo $plugin_settings['options_prefix']; ?>show_advanced_functions' <?php echo option_enabled($plugin_settings['options_prefix']."show_advanced_functions", true) ? "checked='checked'" : '' ?> />
	       	 	<em>Please only use this if you know what you are doing, these menu items are for 561 Developers to configure this site.</em>
	        </td>
        </tr>        
    </table>
    <hr />

<?php elseif($active_section == 'comingsoon'): ?>

    <h2>Coming Soon Mode</h2>
  <table class="form-table">
        <tr valign="top">
	        <th scope="row">Coming Soon Mode</th>
	        <td>
				<input type="checkbox" class="onoff" name='<?php echo $plugin_settings['options_prefix']; ?>coming_soon_mode_enabled' <?php echo option_enabled($plugin_settings['options_prefix']."coming_soon_mode_enabled") ? "checked='checked'" : '' ?> />
	       	 	<em></em>
	        </td>
        </tr>        
        <tr valign="top"> 
	        <th scope="row">Coming Soon Directory</th>
	        <td>	
	        	<input type="text" name="<?php echo $plugin_settings['options_prefix']; ?>coming_soon_path" placeholder="/comingsoon/" value="<?php echo get_option($plugin_settings['options_prefix']."coming_soon_path"); ?>"><br />
        		<em>
        			Please input the directory of your coming soon files, if none is specific it will use /comingsoon/<br />
        			This can be either a wordpress page or a folder...
        		</em>
	        </td>        
        </tr>

    </table>
     <hr />

<?php endif; ?>






</script>
	<input type="hidden" name="action" value="update_custom_settings">
    <input type="hidden" name="command" value="update_general_settings">
    <input type="hidden" name="section" value="<?php echo $active_section; ?>"><?php //putting this here so we are not updating everything at once ?>
    <input type="hidden" name="returl" value="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">


	<?php submit_button( 'Update Settings', 'primary', 'submit' ) ?>
</form>