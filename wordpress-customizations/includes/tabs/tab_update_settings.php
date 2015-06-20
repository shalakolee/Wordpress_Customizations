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

<form name="update_settings_form" method="post" action="/wp-admin/admin-post.php">
	<style>
		input[type="text"]{width:500px !important;}
	</style>
	<h2>Update Settings</h2>
	<table class="form-table">
	    <tr valign="top">
	        <th scope="row">Update URL</th>
	        <td>
				<input type="text" name='<?php echo $plugin_settings['options_prefix']; ?>update_url' value='<?php echo get_option($plugin_settings['options_prefix']."update_url"); ?>' /><br />
	       	 	<em>Enter the url to check for updates (including the filename).</em><br />
	       	 	<em>if nothing is entered it will use the default connection.</em>
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
</script>

<h3>required update file to make this work</h3>
<pre class="code language-html">
{
    "name" : "561 Customizations",
    "slug" : "561-customizations",
    "download_url" : "http://561dev.com/561-customizations.zip",
    "version" : "2.0",
    "author" : "Shalako Lee",
    "sections" : {
        "description" : "plugin description",
    }
}
</pre>
<pre class="code language-html">
https://spreadsheets.google.com/pub?key=0AqP80E74YcUWdEdETXZLcXhjd2w0cHMwX2U1eDlWTHc&authkey=CK7h9toK&hl=en&single=true&gid=0&output=html
</pre>

<?php 




?>