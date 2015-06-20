<?php 

/*
 * main five six one options page
 */

global $plugin_settings;

 ?>



 <div class="wrap">
    <?php  echo "<h2>" . __( $plugin_settings['menu_settings']['page_title'], $plugin_settings['text_domain'] ) . "</h2>"; ?>

        <?php
            $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_settings';
            $current_page = "?page=" .$plugin_settings['menu_settings']['page_slug'] ; //here so we keep things short

        ?>
         
        <h2 class="nav-tab-wrapper">
            <a href="<?php echo $current_page; ?>&tab=general_settings" class="nav-tab <?php echo $active_tab == 'general_settings' ? 'nav-tab-active' : ''; ?>">General Settings</a>
            <a href="<?php echo $current_page; ?>&tab=social_media" class="nav-tab <?php echo $active_tab == 'social_media' ? 'nav-tab-active' : ''; ?>">Theme Options</a>
            
            <?php if( option_enabled($plugin_settings['options_prefix'] . "show_advanced_functions", true) ): //default to true if not set in database ?>

            <a href="<?php echo $current_page; ?>&tab=update_notifications" class="nav-tab <?php echo $active_tab == 'update_notifications' ? 'nav-tab-active' : ''; ?>">Update Notifications</a>
            <a href="<?php echo $current_page; ?>&tab=plugin_hiding" class="nav-tab <?php echo $active_tab == 'plugin_hiding' ? 'nav-tab-active' : ''; ?>">Plugin Hiding</a>
<!--             <a href="<?php echo $current_page; ?>&tab=dev_user_setting" class="nav-tab <?php echo $active_tab == 'dev_user_setting' ? 'nav-tab-active' : ''; ?>">Dev User Settings</a>
 -->            <a href="<?php echo $current_page; ?>&tab=update_settings" class="nav-tab <?php echo $active_tab == 'update_settings' ? 'nav-tab-active' : ''; ?>">Update Settings</a>

            <a href="<?php echo $current_page; ?>&tab=documentation" class="nav-tab <?php echo $active_tab == 'documentation' ? 'nav-tab-active' : ''; ?>">Documentation</a>
            <?php endif; ?>

            <!-- <a href="<?php echo $current_page; ?>&tab=searchreplace" class="nav-tab <?php echo $active_tab == 'searchreplace' ? 'nav-tab-active' : ''; ?>">SEARCH REPLACE</a> -->
        </h2>



        <?php  if($active_tab == 'general_settings'){ ?>
            <?php include( plugin_dir_path( __FILE__ ) . '/includes/tabs/tab_general_settings.php'); ?>
        <?php }elseif($active_tab == 'social_media'){ ?>
            <?php include( plugin_dir_path( __FILE__ ) . '/includes/tabs/tab_social_media.php'); ?>
        <?php }elseif($active_tab == 'update_notifications'){ ?>
            <?php include( plugin_dir_path( __FILE__ ) . '/includes/tabs/tab_update_notifications.php'); ?>
        <?php }elseif($active_tab == 'plugin_hiding'){ ?>
            <?php include( plugin_dir_path( __FILE__ ) . '/includes/tabs/tab_plugin_hiding.php'); ?>
        <?php }elseif($active_tab == 'update_settings'){ ?>
            <?php include( plugin_dir_path( __FILE__ ) . '/includes/tabs/tab_update_settings.php'); ?>
        <?php }elseif($active_tab == 'documentation'){ ?>
            <?php include( plugin_dir_path( __FILE__ ) . '/includes/tabs/tab_documentation.php');  ?>

        <?php /*if(file_exists(plugins_url( __FILE__ ) . '/includes/tabs/tab_{$active_tab}.php')) {
            include( plugins_url( __ FILE__ ) . '/includes/tabs/tab_{$active_tab}.php');
        } */?>

        <?php //this is not ready yet ?>
        <?php //}elseif($active_tab == 'searchreplace'){ ?>
        
            <?php //include( plugin_dir_path( __FILE__ ) . '/includes/searchreplace/index.php'); ?>

        <?php //} ?>




</div>