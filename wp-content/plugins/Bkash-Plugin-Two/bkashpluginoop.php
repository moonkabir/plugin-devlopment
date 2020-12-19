<?php
/*
Plugin Name: Bkash Plugin With OOP
Plugin URI: https://github.com/moonkabir/bkash-plugin
Description: Woocommerece payment Gateway Bkash
Version: 1.0
Author: Moon Kabir
Author URI: https://moonkabir.xyz
License: GPLv2 or later
Text Domain: bkash_plugin_oop
Domain Path: /languages/
*/

class bkashpluginoop_setting_page{
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'bkashpluginoop_create_settings' ) );
		add_action( 'admin_init', array( $this, 'bkashpluginoop_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'bkashpluginoop_setup_fields' ) );
		add_action( 'plugins_loaded', array( $this, 'bkashpluginoop_bootstrap' ) );
		add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), array( $this, 'bkashpluginoop_settings_link' ) );
		add_action( 'admin_post_bkash_plugin_oop_admin_page', array( $this, 'bkash_plugin_oop_save_form' ) );
	}

	public function bkash_plugin_oop_save_form(){
		wp_redirect('admin.php?page=bkash_plugin_page');
	}
	public function bkashpluginoop_settings_link($links) {
	    $newlink = sprintf("<a href='%s'>%s</a>",'admin.php?page=bkash_plugin_oop',__('Settings','bkash_plugin_oop'));
	    $links[] = $newlink;
	    return $links;
	}

	public function bkashpluginoop_bootstrap() {
		load_plugin_textdomain( 'bkash_plugin_oop', false, plugin_dir_path( __FILE__ ) . "/languages" );
	}

	public function bkashpluginoop_create_settings() {
		$page_title = __( 'Bkash-OOP', 'bkash_plugin_oop' );
		$menu_title = __( 'Bkash-OOP', 'bkash_plugin_oop' );
		$capability = 'manage_options';
		$slug       = 'bkash_plugin_oop';
		$callback   = array( $this, 'bkashpluginoop_settings_content' );
		$icon		= 'dashicons-admin-multisite';
		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon );
	}
	public function bkashpluginoop_settings_content(){
		?>
        <div class="wrap">
            <h1><?php _e('Options Demo','bkash_plugin_oop' ); ?></h1>
            <form method="POST" action="options.php">
				<?php
				settings_fields( 'bkash_plugin_oop' );
				do_settings_sections( 'bkash_plugin_oop' );
				submit_button();
				?>
			</form>
			
		</div> <?php
	}

	public function bkashpluginoop_setup_sections(){
		add_settings_section( 'bkash_plugin_oop-section', __('Demonstration of plugin settings page', 'bkash_plugin_oop' ), array(), 'bkash_plugin_oop' );
	}

	public function bkashpluginoop_setup_fields() {
		// if ( !class_exists( 'woocommerce' ) ) { 
		// echo("<h1>Your Woocommerece Plugin doesn't active</h1>");
		// 	return; 
		// }
		$fields = array(
			array(
				'label'       	=> __( 'Test Mood', 'bkash_plugin_oop' ),
				'id'          	=> 'bkash_plugin_oop-mood',
				'type'        	=> 'checkbox',
				'section'     	=> 'bkash_plugin_oop-section',
				'default'     	=> 'yes',
			),
			array(
				'label'       	=> __( 'Username', 'bkash_plugin_oop' ),
				'id'          	=> 'bkash_plugin_oop-bkashusername',
				'type'        	=> 'text',
				'section'    	=> 'bkash_plugin_oop-section',
				'placeholder' 	=> __( 'Moon', 'bkash_plugin_oop' ),
				'size' 			=> "50"
			),
			array(
				'label'   		=> __( 'Password', 'bkash_plugin_oop' ),
				'id'      		=> 'bkash_plugin_oop-bkashpassword',
				'type'    		=> 'password',
				'section' 		=> 'bkash_plugin_oop-section',
				'placeholder' 	=> __( '12345', 'bkash_plugin_oop' ),
				'size' 			=> "50"
			),
			array(
				'label'   		=> __( 'APP Key', 'bkash_plugin_oop' ),
				'id'      		=> 'bkash_plugin_oop_appkey',
				'type'    		=> 'text',
				'section' 		=> 'bkash_plugin_oop-section',
				'placeholder' 	=> __( 'sgsdfg13sd', 'bkash_plugin_oop' ),
				'size' 			=> "50"
			),
			array(
				'label'   		=> __( 'APP Secret', 'bkash_plugin_oop' ),
				'id'      		=> 'bkash_plugin_oop-bkashappsecret',
				'type'    		=> 'text',
				'section' 		=> 'bkash_plugin_oop-section',
				'placeholder' 	=> __( 'sjbfkflasflsiudfhl', 'bkash_plugin_oop' ),
				'size' 			=> "50"
			),
		);
		foreach ( $fields as $field ) {
			add_settings_field( $field['id'], $field['label'], array(
				$this,
				'bkash_plugin_oop_field_callback'
			), 'bkash_plugin_oop', $field['section'], $field );
			register_setting( 'bkash_plugin_oop', $field['id'] );
		}
	}
	public function bkash_plugin_oop_field_callback( $field ) {
		$value = get_option( $field['id'] );
		switch ( $field['type'] ) {
			case 'textarea':
				printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>',
					$field['id'],
					isset( $field['placeholder'] ) ? $field['placeholder'] : '',
					$value
				);
				break;
			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" size="%5$s"/>',
					$field['id'],
					$field['type'],
					isset( $field['placeholder'] ) ? $field['placeholder'] : '',
					$value,
					$field['size'] ?? ""
				);
		}
		if ( isset( $field['desc'] ) ) {
			if ( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', $desc );
			}
		}
	}

}

new bkashpluginoop_setting_page();