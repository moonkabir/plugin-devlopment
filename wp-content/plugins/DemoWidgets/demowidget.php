<?php
/*
 * Plugin Name: Demo Widget
 * Plugin URI: https://github.com/moonkabir/
 * Description: Demo Widget
 * Author: Moon Kabir
 * Author URI: http://moonkabir.xyz
 * Version: 1.0.1
 * Text Domain: demowidget
 * Domain Path: /languages/
 */

require_once plugin_dir_path(__FILE__)."widgets/class.demowidget.php";
require_once plugin_dir_path(__FILE__)."widgets/class.advertisement.php";

function demowidget_load_textdomain(){
    load_plugin_textdomain('demowidget', false, plugin_dir_path(__FILE__)."languages/");
}
add_action('plugins_loaded', 'demowidget_load_textdomain');

function demowidget_register(){
    register_widget('DemoWidget');
    register_widget('AdvertisementWidget');
}
add_action('widgets_init', 'demowidget_register');

function demowidget_admin_enqueue_scripts($screen){
    if($screen = 'widgets.php'){
        wp_enqueue_media();
        wp_enqueue_script("advertisement-widget-js", plugin_dir_url(__FILE__)."js/media-gallery.js");
    }
}
add_action('admin_enqueue_scripts', 'demowidget_admin_enqueue_scripts');