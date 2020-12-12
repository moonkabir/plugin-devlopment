<?php
/*
Plugin Name: CodeStar Demo
Plugin URI: https://github.com/moonkabir/wp-plugin
Description: Demonstration of CodeStar Framework
Version: 1.0
Author: Moon Kabir
Author URI: https://moonkabir.xyz
License: GPLv2 or later
Text Domain: codestar-demo
Domain Path: /languages/
*/
define( 'CS_ACTIVE_LIGHT_THEME', true );
require_once(plugin_dir_path(__FILE__)."libs/csf/cs-framework.php");
function csdemo_load_textdomain(){
    load_plugin_textdomain('codestar-demo',false,dirname(__FILE__)."/languages");
}
add_action('plugins_loaded','csdemo_load_textdomain');