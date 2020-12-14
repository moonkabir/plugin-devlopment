<?php
/*
Plugin Name: BanglaPhonetic
Plugin URI: https://github.com/moonkabir/plugin-devlopment/tree/master/wp-content/plugins/BanglaPhonetic-master
Description: Enable Phonetic Bangla Writing in WordPress
Version: 1.0
Author: Moon Kabir
Author URI: https://moonkabir.xyz
License: GPLv2 or later
Text Domain: banglaphonetic
Domain Path: /languages/
*/

define('BNPHVERSION', '1.0.1');
function bnph_admin_assets($screen)
{
	if ('post-new.php' == $screen || 'post.php' == $screen) {
		wp_enqueue_script('bnph-phonetic-driver-js', plugin_dir_url(__FILE__) . "assets/js/phonetic.driver.js", null, BNPHVERSION, true);
		wp_enqueue_script('bnph-phonetic-engine-js', plugin_dir_url(__FILE__) . "assets/js/engine.js", array('jquery'), BNPHVERSION, true);
		wp_enqueue_script('bnph-phonetic-qt-js', plugin_dir_url(__FILE__) . "assets/js/qt.js", array('jquery', 'quicktags'), BNPHVERSION, true);
	}
}
add_action('admin_enqueue_scripts', 'bnph_admin_assets');
