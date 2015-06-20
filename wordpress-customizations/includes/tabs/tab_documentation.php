<?php


/*
 * Help Tab
 */

  if(isset($_POST['documentation_form_posted']) &&  $_POST['documentation_form_posted'] == 'Y') {
  	
  	
  }

?>

<script>
	jQuery(document).ready(function(){
		jQuery.SyntaxHighlighter.init();
	});
</script>

<h1>Documentation</h1>
<form name="documentation_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<style>
		input[type="text"]{width:300px;}
	</style>

	<h2>Here you will find the functions that this plugins adds, as well as code samples for each function</h2>

	<h3>stripHTML()</h3>
	<pre class="code language-html">
		&lt;?php
		/*
		 * This function will take any content and strip the HTML from it, returning just the content.
		 */
		$content = the_content();
		$strippedcontent = stripHTML($content);
		echo $strippedcontent;
		?&gt;
	</pre>


	<h3>sub()</h3>
	<pre class="code language-html">
		&lt;?php
		/*
		 * This function will shorten a string to a set amount of characters and add an ellipsis of your choice.
		 * Parameters:
		 * 		$content (string)- the content that you want to shorten *required
		 * 		$count (int) - the amount of characters that you want to display *required
		 *		$ellipsis (string) - the delimiter you want to use after the cutoff content (defaults to "...") *optional
		 */
		
		$smallcontent = sub($content, $count, $ellipsis );
		echo $smallcontent;
		?&gt;
	</pre>

	<h3>get_image_id_from_url()</h3>
	<pre class="code language-html">
		&lt;?php
		/*
		 * This function will return the attachment id of an image from its URL
		 * Parameters:
		 * 		$url (string)- the url of the image you want the id for
		 */
		
		$imageURL = get_image_id_from_url($url);
		echo $imageURL;
		?&gt;
	</pre>





	  <table class="form-table">
	        <tr valign="top">
		        <th scope="row"></th>
		        <td>

		       	 	<em></em>
		        </td>
	        </tr>
	    </table>
	

	<input type="hidden" name="documentation_form_posted" value="Y">

	<?php //submit_button( 'Update Settings', 'primary', 'submit' ) ?>
</form>





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

// add_filter( 'all_plugins', 'hide_plugins');
// function hide_plugins($plugins)
// {
// 		// Hide WordPress SEO by Yoast Plugin
// 		if(is_plugin_active('wordpress-seo/wp-seo.php')) {
// 				unset( $plugins['wordpress-seo/wp-seo.php'] );
// 		}
// 		// Hide Akismet Plugin
// 		if(is_plugin_active('akismet/akismet.php')) {
// 				unset( $plugins['akismet/akismet.php'] );
// 		}
// 		return $plugins;
// }




// /* remove woothemes updater notice */
// remove_action( 'admin_notices', 'woothemes_updater_notice' );