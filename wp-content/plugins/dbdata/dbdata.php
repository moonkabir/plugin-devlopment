<?php
/*
 * Plugin Name: DB DATA
 * Plugin URI: https://github.com/moonkabir/bkash-plugin
 * Description: Create a DataBase With Plugin
 * Author: Moon Kabir
 * Author URI: http://moonkabir.xyz
 * Version: 1.0.1
 * Text Domain: dbadata
 */
function bkashdb_init(){
    global $wpdb;
    $table_name = $wpdb->prefix.'persons';
    $sql = "CREATE TABLE {$table_name}(
        id INT NOT NULL AUTO_INCREMENT,
        name varchar(250),
        email varchar(250),
        PRIMARY KEY (id)
    );";
    require_once(ABSPATH ."wp-admin/includes/upgrade.php");
    dbDelta($sql);
}
register_activation_hook(__FILE__,"bkashdb_init");