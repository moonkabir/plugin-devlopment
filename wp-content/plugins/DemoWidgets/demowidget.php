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

function demowidget_load_textdomain(){
    load_plugin_textdomain('demowidget', false, plugin_dir_path(__FILE__)."languages/");
}
add_action('plugins_loaded', 'demowidget_load_textdomain');

function demowidget_register(){
    register_widget('DemoWidget');
}
add_action('widgets_init', 'demowidget_register');