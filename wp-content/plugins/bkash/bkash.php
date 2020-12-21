<?php
/*
 * Plugin Name: WooCommerce bkash Payment Gateway moon
 * Plugin URI: https://github.com/moonkabir/bkash-plugin
 * Description: Bkash Plugin 
 * Author: Moon Kabir
 * Author URI: http://moonkabir.xyz
 * Version: 1.0.1
 * Text Domain: bkash
 */

/*
 * This action hook registers our PHP class as a WooCommerce payment gateway
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

add_filter( 'woocommerce_payment_gateways', 'bkash_add_gateway_class' );
function bkash_add_gateway_class( $gateways ) {
	$gateways[] = 'WC_Bkash_Gateway'; // your class name is here
	return $gateways;
}

/*
 * The class itself, please note that it is inside plugins_loaded action hook
 */
add_action( 'plugins_loaded', 'bkash_init_gateway_class' );
function bkash_init_gateway_class() {
 
	class WC_Bkash_Gateway extends WC_Payment_Gateway {
 
 		/**
 		 * Class constructor, more about it in Step 3
 		 */
 		public function __construct() {		
            $this->id = 'bkash'; // payment gateway plugin ID
            $this->icon = ''; // URL of the icon that will be displayed on checkout page near your gateway name
            $this->has_fields = false; // in case you need a custom credit card form
            $this->method_title = 'Bkash Gateway';
            $this->method_description = 'Description of Bkash payment gateway'; // will be displayed on the options page
        
            // gateways can support subscriptions, refunds, saved payment methods,
            // but in this tutorial we begin with simple payments
            $this->supports = array(
                'products'
            );
        
            // Method with all the options fields
            $this->init_form_fields();
        
            // Load the settings.
            $this->init_settings();
            $this->title = $this->get_option( 'title' );
            $this->description = $this->get_option( 'description' );
            $this->enabled = $this->get_option( 'enabled' );
            $this->testmode = 'yes' === $this->get_option( 'testmode' );
            $this->private_key = $this->testmode ? $this->get_option( 'test_private_key' ) : $this->get_option( 'private_key' );
            $this->publishable_key = $this->testmode ? $this->get_option( 'test_publishable_key' ) : $this->get_option( 'publishable_key' );
        
            // This action hook saves the settings
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
        
            // We need custom JavaScript to obtain a token
            add_action( 'wp_enqueue_scripts', array( $this, 'payment_scripts' ) );
        
            // You can also register a webhook here
            // add_action( 'woocommerce_api_{webhook name}', array( $this, 'webhook' ) );
 
 		}
 
		/**
 		 * Plugin options, we deal with it in Step 3 too
 		 */
          public function init_form_fields(){
 
            $this->form_fields = array(
                'enabled' => array(
                    'title'       => 'Enable/Disable',
                    'label'       => 'Enable Bkash Gateway',
                    'type'        => 'checkbox',
                    'description' => '',
                    'default'     => 'no'
                ),
                'title' => array(
                    'title'       => 'Title',
                    'type'        => 'text',
                    'description' => 'This controls the title which the user sees during checkout.',
                    'default'     => 'Bkash-Payment',
                    'desc_tip'    => true,
                ),
                'description' => array(
                    'title'       => 'Description',
                    'type'        => 'textarea',
                    'description' => 'This controls the description which the user sees during checkout.',
                    'default'     => 'Pay with your Bkash via our super-cool payment gateway.',
                ),
                'testmode' => array(
                    'title'       => 'Test mode',
                    'label'       => 'Enable Test Mode',
                    'type'        => 'checkbox',
                    'description' => 'Place the payment gateway in test mode using test API keys.',
                    'default'     => 'yes',
                    'desc_tip'    => true,
                ),
                'test_publishable_key' => array(
                    'title'       => 'Test Publishable Key',
                    'type'        => 'text'
                ),
                'test_private_key' => array(
                    'title'       => 'Test Private Key',
                    'type'        => 'password',
                ),
                'publishable_key' => array(
                    'title'       => 'Live Publishable Key',
                    'type'        => 'text'
                ),
                'private_key' => array(
                    'title'       => 'Live Private Key',
                    'type'        => 'password'
                )
            );
        }
 
		/**
		 * You will need it if you want your custom credit card form, Step 4 is about it
		 */

		public function payment_fields() {
 
            // // ok, let's display some description before the payment form
            // if ( $this->description ) {
            //     // you can instructions for test mode, I mean test card numbers etc.
            //     if ( $this->testmode ) {
            //         $this->description .= ' TEST MODE ENABLED. In test mode, you can use the card numbers listed in <a href="#" target="_blank" rel="noopener noreferrer">documentation</a>.';
            //         $this->description  = trim( $this->description );
            //     }
            //     // display the description with <p> tags etc.
            //     echo wpautop( wp_kses_post( $this->description ) );
            // }
         
            // // I will echo() the form, but you can close PHP tags and print it directly in HTML
            // echo '<fieldset id="wc-' . esc_attr( $this->id ) . '-cc-form" class="wc-credit-card-form wc-payment-form" style="background:transparent;">';
         
            // // Add this action hook if you want your custom payment gateway to support it
            // do_action( 'woocommerce_credit_card_form_start', $this->id );
            // 01765930390 musfirat90 musfirat931@gmail.com
            // // I recommend to use inique IDs, because other gateways could already use #ccNo, #expdate, #cvc
            // echo '<div class="form-row form-row-wide"><label>Card Number <span class="required">*</span></label>
            //     <input id="misha_ccNo" type="text" autocomplete="off">
            //     </div>
            //     <div class="form-row form-row-first">
            //         <label>Expiry Date <span class="required">*</span></label>
            //         <input id="misha_expdate" type="text" autocomplete="off" placeholder="MM / YY">
            //     </div>
            //     <div class="form-row form-row-last">
            //         <label>Card Code (CVC) <span class="required">*</span></label>
            //         <input id="misha_cvv" type="password" autocomplete="off" placeholder="CVC">
            //     </div>
            //     <div class="clear"></div>';
         
            // do_action( 'woocommerce_credit_card_form_end', $this->id );
         
            // echo '<div class="clear"></div></fieldset>';
         
        }
 
		/*
		 * Custom CSS and JS, in most cases required only when you decided to go with a custom credit card form
		 */
        public function payment_scripts() {}
 
		/*
 		 * Fields validation, more in Step 5
		 */
		public function validate_fields() {}
 
		/*
		 * We're processing the payments here, everything about it is in Step 5
		 */
		public function process_payment( $order_id ) {}
 
		/*
		 * In case you need a webhook, like PayPal IPN etc
		 */
        public function webhook() {}
        
 	}
}

