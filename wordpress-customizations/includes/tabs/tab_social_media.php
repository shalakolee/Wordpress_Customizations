<?php


/*
 * social media settings

	options set on this page 

		facebook
		twitter
		instagram
		linkedin
		googleplus
		youtube
		pinterest
		phone_number



 */
global $plugin_settings;
?>
<?php 
	if (isset($_SESSION['message'])) {
	    echo $_SESSION['message']; //display the message
	    unset($_SESSION['message']); //free it up
	}

 ?>

<?php //main form 

	/*
	 * please note if you a social media setting please add it into the form handler...
	 */
wp_enqueue_media();
?>
<?php
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'social_media'; //need this to know what tab we are on
	$active_section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : 'general'; //default the active section to general
	$current_page = "?page=" .$plugin_settings['menu_settings']['page_slug'] ."&tab=" . $active_tab .""; //here so we keep things short
?>
<script type="text/javascript">
  	jQuery(document).ready(function() {

      	jQuery('.onoff').iphoneStyle({checkedLabel: 'ON', uncheckedLabel: 'OFF'});
	    
	    jQuery('#upload-btn').click(function(e) {
	        e.preventDefault();
	        var image = wp.media({ 
	            title: 'Select Image',
	            // mutiple: true if you want to upload multiple files at once
	            multiple: false
	        }).open()
	        .on('select', function(e){
	            // This will return the selected image from the Media Uploader, the result is an object
	            var uploaded_image = image.state().get('selection').first();
	            // We convert uploaded_image to a JSON object to make accessing it easier
	            // Output to the console uploaded_image
	            console.log(uploaded_image);
	            var image_url = uploaded_image.toJSON().url;
	            // Let's assign the url value to the input field
	            jQuery('#image_url').val(image_url);
	        });
	    });
	    jQuery('#upload-bg-btn').click(function(e) {
	        e.preventDefault();
	        var image = wp.media({ 
	            title: 'Select Image',
	            // mutiple: true if you want to upload multiple files at once
	            multiple: false
	        }).open()
	        .on('select', function(e){
	            // This will return the selected image from the Media Uploader, the result is an object
	            var uploaded_image = image.state().get('selection').first();
	            // We convert uploaded_image to a JSON object to make accessing it easier
	            // Output to the console uploaded_image
	            console.log(uploaded_image);
	            var image_url = uploaded_image.toJSON().url;
	            // Let's assign the url value to the input field
	            jQuery('#bg_image_url').val(image_url);
	        });


	 	});

	});

</script>
<?php //build the sub menu ?>
<ul id="settings-sections" class="subsubsub hide-if-no-js">
	<li><a href="<?php echo $current_page ?>&section=general" class="tab <?php echo $active_section == 'general' ? 'current' : ''; ?>">General</a></li>
	<li> | <a href="<?php echo $current_page ?>&section=social_media" class="tab <?php echo $active_section == 'social_media' ? 'current' : ''; ?>">Social Media</a></li>
	<li> | <a href="<?php echo $current_page ?>&section=login_page" class="tab <?php echo $active_section == 'login_page' ? 'current' : ''; ?>">Login Page</a></li>
	<li> | <a href="<?php echo $current_page ?>&section=google_analytics" class="tab <?php echo $active_section == 'google_analytics' ? 'current' : ''; ?>">Google Analytics</a></li>
</ul>





<div style="clear:both;height:20px;"></div>


<form name="social_media_form" method="post" action="/wp-admin/admin-post.php">
	<style>
		input[type="text"]{width:300px;}
	</style>

<?php //this will all still post to the same thing, but will only be updating the fields that are on the current section ?>
        
<?php if($active_section == 'general'): ?>

  <table class="form-table">

         <tr valign="top">
	        <th scope="row">Phone Number</th>
	        <td>
	       	 <input type="text" name="<?php echo $plugin_settings['options_prefix']; ?>phone_number" value="<?php echo esc_attr( get_option($plugin_settings['options_prefix'].'phone_number') ); ?>" /><br />
	       	 <em>Please Enter the main phone number</em>
	        </td>
        </tr>
         
        
    </table>
	<h3>Template Usage:</h3>
	<pre class="code language-php">
	&lt;?php echo get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>phone_number&quot;) ? &quot;&lt;a href=&#39;tel:&quot;.get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>phone_number&quot;) .&quot;&#39; target=&#39;_blank&#39;&gt;&lt;/a&gt;&quot; : &#39;&#39; ?&gt;
	</pre>

<?php elseif($active_section == 'social_media'): ?>

  <table class="form-table">
        <tr valign="top">
	        <th scope="row">Facebook</th>
	        <td>
	       	 <input type="text" name="<?php echo $plugin_settings['options_prefix']; ?>facebook" value="<?php echo esc_attr( get_option($plugin_settings['options_prefix'].'facebook') ); ?>" /><br />
	       	 <em>Please Enter the full facebook url</em>
	        </td>
        </tr>
        <tr valign="top">
	        <th scope="row">Twitter</th>
	        <td>
	       	 <input type="text" name="<?php echo $plugin_settings['options_prefix']; ?>twitter" value="<?php echo esc_attr( get_option($plugin_settings['options_prefix'].'twitter') ); ?>" /><br />
	       	 <em>Please Enter the full twitter url</em>
	        </td>
        </tr>
        <tr valign="top">
	        <th scope="row">Instagram</th>
	        <td>
	       	 <input type="text" name="<?php echo $plugin_settings['options_prefix']; ?>instagram" value="<?php echo esc_attr( get_option($plugin_settings['options_prefix'].'instagram') ); ?>" /><br />
	       	 <em>Please Enter the full instagram url</em>
	        </td>
        </tr>
        <tr valign="top">
	        <th scope="row">LinkedIn</th>
	        <td>
	       	 <input type="text" name="<?php echo $plugin_settings['options_prefix']; ?>linkedin" value="<?php echo esc_attr( get_option($plugin_settings['options_prefix'].'linkedin') ); ?>" /><br />
	       	 <em>Please Enter the full linkedin url</em>
	        </td>
        </tr>
        <tr valign="top">
	        <th scope="row">Google +</th>
	        <td>
	       	 <input type="text" name="<?php echo $plugin_settings['options_prefix']; ?>googleplus" value="<?php echo esc_attr( get_option($plugin_settings['options_prefix'].'googleplus') ); ?>" /><br />
	       	 <em>Please Enter the full googleplus url</em>
	        </td>
        </tr>
        <tr valign="top">
	        <th scope="row">YouTube</th>
	        <td>
	       	 <input type="text" name="<?php echo $plugin_settings['options_prefix']; ?>youtube" value="<?php echo esc_attr( get_option($plugin_settings['options_prefix'].'youtube') ); ?>" /><br />
	       	 <em>Please Enter the full youtube url</em>
	        </td>
        </tr>
        <tr valign="top">
	        <th scope="row">Pinterest</th>
	        <td>
	       	 <input type="text" name="<?php echo $plugin_settings['options_prefix']; ?>pinterest" value="<?php echo esc_attr( get_option($plugin_settings['options_prefix'].'pinterest') ); ?>" /><br />
	       	 <em>Please Enter the full pinterest url</em>
	        </td>
        </tr>       
</table>
	<h3>Template Usage:</h3>
	<pre class="code language-php">
	&lt;?php echo get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>facebook&quot;) ? &quot;&lt;a href=&#39;&quot;.get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>facebook&quot;) .&quot;&#39; target=&#39;_blank&#39;&gt;&lt;/a&gt;&quot; : &#39;&#39; ?&gt;
	&lt;?php echo get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>twitter&quot;) ? &quot;&lt;a href=&#39;&quot;.get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>twitter&quot;) .&quot;&#39; target=&#39;_blank&#39;&gt;&lt;/a&gt;&quot; : &#39;&#39; ?&gt;
	&lt;?php echo get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>instagram&quot;) ? &quot;&lt;a href=&#39;&quot;.get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>instagram&quot;) .&quot;&#39; target=&#39;_blank&#39;&gt;&lt;/a&gt;&quot; : &#39;&#39; ?&gt;
	&lt;?php echo get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>linkedin&quot;) ? &quot;&lt;a href=&#39;&quot;.get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>linkedin&quot;) .&quot;&#39; target=&#39;_blank&#39;&gt;&lt;/a&gt;&quot; : &#39;&#39; ?&gt;
	&lt;?php echo get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>googleplus&quot;) ? &quot;&lt;a href=&#39;&quot;.get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>googleplus&quot;) .&quot;&#39; target=&#39;_blank&#39;&gt;&lt;/a&gt;&quot; : &#39;&#39; ?&gt;
	&lt;?php echo get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>youtube&quot;) ? &quot;&lt;a href=&#39;&quot;.get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>youtube&quot;) .&quot;&#39; target=&#39;_blank&#39;&gt;&lt;/a&gt;&quot; : &#39;&#39; ?&gt;
	&lt;?php echo get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>pinterest&quot;) ? &quot;&lt;a href=&#39;&quot;.get_option(&quot;<?php echo $plugin_settings['options_prefix']; ?>pinterest&quot;) .&quot;&#39; target=&#39;_blank&#39;&gt;&lt;/a&gt;&quot; : &#39;&#39; ?&gt;
	</pre>

<?php elseif($active_section == 'login_page'): ?>


<h2>Login Page Settings</h2>
	<table class="form-table">
        <tr valign="top">
	        <th scope="row">Customize the login?</th>
	        <td>
				<input type="checkbox" class="onoff" name='<?php echo $plugin_settings['options_prefix']; ?>customize_login' <?php echo option_enabled($plugin_settings['options_prefix']."customize_login", false) ? "checked='checked'" : '' ?> />
	       	 	<em>Turn this on if you wish to customize the wordpress admin login screen</em>
	        </td>
        </tr>        

	    <tr valign="top">
	        <th scope="row">Custom Alt Text</th>
	        <td>
				<input type="text" name='<?php echo $plugin_settings['options_prefix']; ?>login_page_alt_text' value='<?php echo get_option($plugin_settings['options_prefix']."login_page_alt_text"); ?>' /><br />
	       	 	<em>Enter the alt text that you would like to display when hovering over the login page logo</em>
	        </td>
	    </tr>       
	    <tr valign="top">
	        <th scope="row">Custom Link</th>
	        <td>
				<input type="text" name='<?php echo $plugin_settings['options_prefix']; ?>login_page_logo_url' value='<?php echo get_option($plugin_settings['options_prefix']."login_page_logo_url"); ?>' /><br />
	       	 	<em>This is the URL that you go to when clicking the header Image</em>
	        </td>
	    </tr>       
	    <tr valign="top">
	        <th scope="row">Custom Logo</th>
	        <td>
				<input type="text" id="image_url" name='<?php echo $plugin_settings['options_prefix']; ?>login_page_logo' value='<?php echo get_option($plugin_settings['options_prefix']."login_page_logo"); ?>' />
    			<input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Select Image"><br />
	       	 	<em></em>
	        </td>
	    </tr>       
	    <tr valign="top">
	        <th scope="row">Custom Background image</th>
	        <td>
				<input type="text" id="bg_image_url" name='<?php echo $plugin_settings['options_prefix']; ?>login_page_background' value='<?php echo get_option($plugin_settings['options_prefix']."login_page_background"); ?>' />
    			<input type="button" name="upload-bg-btn" id="upload-bg-btn" class="button-secondary" value="Select Image"><br />
	       	 	<em></em>
	        </td>
	    </tr>       
	</table>



<?php elseif($active_section == 'google_analytics'): ?>

    <h3>Google Analytics</h3>
    <em>NOTE: when enabled, google analytics will appear in the header</em>
	<table class="form-table">
	    <tr valign="top">
	        <th scope="row">Enable Google Analytics</th>
	        <td>
				<input type="checkbox" class="onoff" name='<?php echo $plugin_settings['options_prefix']; ?>google_UA_enabled' <?php echo option_enabled($plugin_settings['options_prefix']."google_UA_enabled") ? "checked='checked'" : '' ?> />
	       	 	<em></em>
	        </td>
	    </tr>        
	    <tr valign="top"> 
	        <th scope="row">Tracking ID</th>
	        <td>	
	        	<input type="text" name="<?php echo $plugin_settings['options_prefix']; ?>google_tracking_code" placeholder="UA-XXXXXXXX-X" value="<?php echo get_option($plugin_settings['options_prefix']."google_tracking_code"); ?>"><br />
	    		<em>
	    			
	    		</em>
	        </td>        
	    </tr>

	</table>




<?php endif; ?>


	

	<input type="hidden" name="action" value="update_custom_settings">
    <input type="hidden" name="command" value="update_social_media">
    <input type="hidden" name="section" value="<?php echo $active_section; ?>"><?php //putting this here so we are not updating everything at once ?>
    <input type="hidden" name="returl" value="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">



	<?php submit_button( 'Update Settings', 'primary', 'submit' ) ?>
</form>


<script>
	jQuery(document).ready(function(){
		jQuery.SyntaxHighlighter.init();
	});
</script>


