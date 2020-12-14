<?php
/*
Plugin Name: Quick Tags 
Plugin URI: https://github.com/moonkabir/plugin-devlopment/tree/master/wp-content/plugins/QuickTags-Demo
Description: WordPress Quick Tags
Version: 1.0
Author: Moon Kabir
Author URI: https://moonkabir.xyz
License: GPLv2 or later
Text Domain: tax-meta
Domain Path: /languages/
*/

function qtsd_assets($screen)
{
    if ('post.php' == $screen) {
        wp_enqueue_script('qtsd-min-js', plugin_dir_url(__FILE__) . "/assets/js/qt.js", array('quicktags', 'thickbox'));
        wp_localize_script('qtsd-main-js', 'qtsd', array('preview' => plugin_dir_url(__FILE__) . "/fap.php"));
    }
}
add_action('admin_enqueue_scripts', 'qtsd_assets');

// function taxm_load_textdomain()
// {
//     load_plugin_textdomain('tax-meta', false, dirname(__FILE__) . "/languages");
// }
// add_action('plugins_loaded', 'taxm_load_textdomain');
