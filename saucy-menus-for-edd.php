<?php
/*
Plugin Name: Saucy Menus for EDD
Plugin URI: https://mydigitalsauce.com
Description: This plugin extends the IF Menu plugin (https://wordpress.org/plugins/if-menu/) for Easy Digital Downloads. Allows conditional logic to be added to WordPress Menus that revolve around Easy Digital Downloads. For example you can toggle whether a menu item should be shown if the user has items in their cart or not.
Version: 0.5
Author: Justin Estrada
Author URI: https://mydigitalsauce.com/author/justin
*/

if( ! defined('SMFEDD_DIR') ) {
	define('SMFEDD_DIR', dirname( __FILE__ ) );
}
if( ! defined('SMFEDD_URL') ) {
	define('SMFEDD_URL', plugin_dir_url( __FILE__ ) );
}

/* Internationalization */
function smfedd_textdomain() {
	load_plugin_textdomain( 'smfedd', false, dirname( plugin_basename( __FILE__ ) ) . 'languages' );
}
add_action( 'init', 'smfedd_textdomain' );

function smfedd_menu_conditions( $conditions ) {
  $conditions[] = array(
    'name'    =>  'If User has Cart Items', // name of the condition
    'condition' =>  function($item) {          // callback - must return TRUE or FALSE	
        if ( function_exists( 'edd_get_cart_contents' ) ) {
            $cart_contents = edd_get_cart_contents();
            if ( ! empty( $cart_contents ) ) {
                return true;
            } else {
                return false;
            }
        }	
    }
  );
  return $conditions;
}
add_filter( 'if_menu_conditions', 'smfedd_menu_conditions' );

if ( is_admin() ) {
    include_once( SMFEDD_DIR . '/includes/admin-notices.php' );
}