<?php 
/*
 * site specific functions that will be used
 */







//change the shit at the bottom when the user is logged in
function remove_footer_admin () {
echo 'Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Designed by <a href="//www.561media.com" target="_blank"> 561 Media</a>';
if ( get_option("") && get_option("") ): // if the user hid the plugin and removed it from the menu, we are going to add this, so we still have a way to access our plugin
	echo ' | Custom Plugin: <a href="/wp-admin/admin.php?page=manage-561-customizations" >561 Media</a></p>';
endif;
}
add_filter('admin_footer_text', 'remove_footer_admin');







//add widget to homepage
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
//dashboard widget
wp_add_dashboard_widget('custom_help_widget', '561 Support', 'custom_dashboard_help');
}
function custom_dashboard_help() {
echo '<p>Thank you for choosing 561 Media! Need help? Contact our developers <a href="https://www.561media.com/contact-us/" target="_blank"> here</a>. </p>';
}






//SSL forcing the easy way
//if (stripos(get_option('siteurl'), 'https://') === 0) {
//    $_SERVER['HTTPS'] = 'on';

    // add JavaScript detection of page protocol, and pray!
    //add_action('wp_print_scripts', 'force_ssl_url_scheme_script');
//}
//this doesnt work all the time, for instance it doesnt work on media links
function force_ssl_url_scheme_script() {
?>
<script>
if (document.location.protocol != "https:") {
    document.location = document.URL.replace(/^http:/i, "https:");
}
</script>
<?php
}

function performance( $visible = false ) {
    $stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory',
        get_num_queries(),
        timer_stop( 0, 3 ),
        memory_get_peak_usage() / 1024 / 1024
        );
    echo $visible ? $stat : "<!-- {$stat} -->" ;
}
add_action( 'wp_footer', 'performance', 20 );





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