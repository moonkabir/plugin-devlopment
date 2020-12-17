<?php
/*
Plugin Name: MC Bkash
Plugin URI: https://github.com/moonkabir/plugin-devlopment/tree/master/wp-content/plugins/MC-Bkash
Description: WordPress 
Version: 1.0
Author: Moon Kabir
Author URI: https://moonkabir.xyz
License: GPLv2 or later
Text Domain: mcbkash
Domain Path: /languages/
*/
class mcbkash_Settings_Page
{
    public function __construct()
    {
        add_action('plugins_loaded', array($this, 'mcbkash_bootstrap'));
        add_action('admin_menu', array($this, 'mcbkash_create_admin_page'));
        add_action('admin_post_mcbkash_admin_page', array($this, 'mcbkash_save_form'));
    }

    public function mcbkash_create_admin_page()
    {
        $page_title = __('MC Bkash Plugin', 'mcbkash');
        $menu_title = __('MC Bkash Plugin', 'mcbkash');
        $capability = 'manage_options';
        $slug       = 'mcbkashpage';
        $callback   = array($this, 'mcbkash_page_content');
        $icon_url   = plugins_url('bkash-logo.png', __FILE__);
        add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon_url);
    }
    public function mcbkash_page_content()
    {
        require_once plugin_dir_path(__FILE__) . "/form.php";
    }
    public function mcbkash_save_form()
    {
        check_admin_referer("mcbkash");
        if (isset($_POST['mcbkash_longitude2'])) {
            update_option('mcbkash_longitude2', sanitize_text_field($_POST['mcbkash_longitude2']));
        }
        wp_redirect('admin.php?page=mcbkashpage');
    }
    public function mcbkash_bootstrap()
    {
        load_plugin_textdomain('mcbkash', false, plugin_dir_path(__FILE__) . "/languages");
    }
}

new mcbkash_Settings_Page();
