<?php
/*
Plugin Name: Bkash Plugin
Plugin URI: https://github.com/moonkabir/bkash-plugin
Description: Woocommerece payment Gateway Bkash
Version: 1.0
Author: Moon Kabir
Author URI: https://moonkabir.xyz
License: GPLv2 or later
Text Domain: bkash-plugin
Domain Path: /languages/
*/

function bkashp_load_textdomain()
{
    load_plugin_textdomain('bkash-plugin', false, dirname(__FILE__) . "/languages");
}
add_action('plugins_loaded', 'bkashp_load_textdomain');

function bp_admin_menu()
{
    add_menu_page(
        __('Bkash Plugin title', 'bkash-plugin'),
        __('Bkash Plugin', 'bkash-plugin'),
        'manage_options',
        'bkash_plugin_page',
        'bp_settings_function',
        plugins_url('assets/images/bkash-logo.png', __FILE__)

    );
    add_submenu_page(
        'bkash_plugin_page',
        __('Bkash Plugin submenu', 'bkash-plugin'),
        __('Bkash Plugin All Entries', 'bkash-plugin'),
        'manage_options',
        'bp-all-entries',
        'bp_all_entries_function'
    );
}
add_action('admin_menu', 'bp_admin_menu');

function bp_all_entries_function()
{
    include_once('bp_all_entries_page.php');
}

function bp_settings_function()
{
    include_once('bkash_settings_page.php');
}

function bp_save_form(){
    check_admin_referer("bkash-plugin");

    $username = isset($_POST['bkashusername']);
    $password = isset($_POST['bkashpassword']);
    $appkey = isset($_POST['bkashappkey']);
    $appsecret = isset($_POST['bkashappsecret']);

    if($username && $password && $appkey && $appsecret){
        update_option('bkashusername', sanitize_text_field($_POST['bkashusername']));
        update_option('bkashpassword', sanitize_text_field($_POST['bkashpassword']));
        update_option('bkashappkey', sanitize_text_field($_POST['bkashappkey']));
        update_option('bkashappsecret', sanitize_text_field($_POST['bkashappsecret']));
    }
    wp_redirect('admin.php?page=bkash_plugin_page');
}
add_action('admin_post_bp_admin_page', 'bp_save_form');