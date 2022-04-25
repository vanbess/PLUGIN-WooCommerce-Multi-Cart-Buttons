<?php

/**
 * Plugin Name: SBWC Buy Now Button V1.2
 * Description: Add Buy Now buttons to WC product single and Upsell v2 Bundle Sell modal.
 * Version: 1.2
 * Author: WC Bessinger
 */

// no direct access/bail if Upsell v2 not active
defined( 'ABSPATH' ) || defined( 'UPSELL_V2_PATH' ) ?: exit();

// init
add_action( 'plugins_loaded', 'mcb_init' );

function mcb_init() {

    // define file path and file url constants
    defined( 'MCB_PATH' ) ?: define( 'MCB_PATH', plugin_dir_path( __FILE__ ) );
    defined( 'MCB_URL' ) ?: define( 'MCB_URL', plugin_dir_url( __FILE__ ) );

    // enqueue scrpts
    add_action( 'wp_enqueue_scripts', 'mcb_scripts' );

    function mcb_scripts() {

        // css front
        wp_register_style( 'mcb-css', MCB_URL . 'assets/mcb.css', [], '1.0.0' );

        // general js
        wp_register_script( 'mcb-js', MCB_URL . 'assets/mcb.js', [ 'jquery' ], '1.0.0', true );
        
        // product bundle atc ajax js
        wp_register_script( 'bn-bundle-atc-js', MCB_URL . 'assets/bundles/bundle-atc.js', [ 'jquery' ], '1.0.0', true );

        wp_localize_script( 'bn-bundle-atc-js', 'bn_bundle_atc_js', [
            'url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'buy now bundles add to cart' )
        ] );

        // product upsell atc ajax js
        wp_register_script( 'bn-upsells-atc-js', MCB_URL . 'assets/upsells/upsell-atc.js', [ 'jquery' ], '1.0.0', true );
        
        wp_localize_script( 'bn-upsells-atc-js', 'bn_upsells_atc_js', [
            'url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'buy now upsells add to cart' )
        ] );
    }

    // include product bundle functions
    include MCB_PATH . 'inc/fnc/bundles/bundles-button.php';
    include MCB_PATH . 'inc/fnc/bundles/ajax/bundle-atc.php';
    
    // include product upsells functions
    include MCB_PATH . 'inc/fnc/upsells/upsells-button.php';
    include MCB_PATH . 'inc/fnc/upsells/ajax/upsells-atc.php';

}
