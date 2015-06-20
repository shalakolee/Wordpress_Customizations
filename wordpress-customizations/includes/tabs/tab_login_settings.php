<?php 



/*
 * login settings tab
 */
global $plugin_settings;

	if (isset($_SESSION['message'])) {
	    echo $_SESSION['message']; //display the message
	    unset($_SESSION['message']); //free it up
	}
wp_enqueue_media();

?>

<form name="update_login_settings_form" method="post" action="/wp-admin/admin-post.php">
	<style>
		input[type="text"]{width:500px !important;}
	</style>
	<h2>Login Page Settings</h2>
	<table class="form-table">
        <tr valign="top">
	        <th scope="row">Customize the login?</th>
	        <td>
				<input type="checkbox" class="onoff" name='<?php echo $plugin_settings['options_prefix']; ?>customize_login' <?php echo option_enabled($plugin_settings['options_prefix']."customize_login", true) ? "checked='checked'" : '' ?> />
	       	 	<em>check if you want to use the customized login, leave unchecked to keep default</em>
	        </td>
        </tr>        

	    <tr valign="top">
	        <th scope="row">Header Image Alt Text</th>
	        <td>
				<input type="text" name='<?php echo $plugin_settings['options_prefix']; ?>login_page_alt_text' value='<?php echo get_option($plugin_settings['options_prefix']."login_page_alt_text"); ?>' /><br />
	       	 	<em>enter the alt text that you would like to display when hovering over the login page logo</em>
	        </td>
	    </tr>       
	    <tr valign="top">
	        <th scope="row">Header Image URL</th>
	        <td>
				<input type="text" name='<?php echo $plugin_settings['options_prefix']; ?>login_page_logo_url' value='<?php echo get_option($plugin_settings['options_prefix']."login_page_logo_url"); ?>' /><br />
	       	 	<em>This is the URL that you go to when clicking the header Image</em>
	        </td>
	    </tr>       
	    <tr valign="top">
	        <th scope="row">Header Image Logo</th>
	        <td>
				<input type="text" id="image_url" name='<?php echo $plugin_settings['options_prefix']; ?>login_page_logo_url' value='<?php echo get_option($plugin_settings['options_prefix']."login_page_logo_url"); ?>' />
    			<input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Select Image"><br />
	       	 	<em>Logo to display above the login </em>
	        </td>
	    </tr>       
	    <tr valign="top">
	        <th scope="row">background image</th>
	        <td>
				<input type="text" id="bg_image_url" name='<?php echo $plugin_settings['options_prefix']; ?>login_page_logo_url' value='<?php echo get_option($plugin_settings['options_prefix']."login_page_logo_url"); ?>' />
    			<input type="button" name="upload-bg-btn" id="upload-bg-btn" class="button-secondary" value="Select Image"><br />
	       	 	<em>login page background image</em>
	        </td>
	    </tr>       
	</table>


	<input type="hidden" name="action" value="update_custom_settings">
    <input type="hidden" name="command" value="update_update_settings">
    <input type="hidden" name="returl" value="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">


	<?php submit_button( 'Update Settings', 'primary', 'submit' ) ?>
</form>
<script>
	jQuery(document).ready(function(){
		jQuery.SyntaxHighlighter.init();
	});
	jQuery(document).ready(function($){
	    $('#upload-btn').click(function(e) {
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
	            $('#image_url').val(image_url);
	        });
	    });
	    $('#upload-bg-btn').click(function(e) {
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
	            $('#bg_image_url').val(image_url);
	        });
	    });	    
	});
</script>






<?php






/* this is to upload an image and get the path from it

<?php
// jQuery
wp_enqueue_script('jquery');
// This will enqueue the Media Uploader script
wp_enqueue_media();
?>
    <div>
    <label for="image_url">Image</label>
    <input type="text" name="image_url" id="image_url" class="regular-text">
    <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">

</div>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('#upload-btn').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
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
            $('#image_url').val(image_url);
        });
    });
});




*/

