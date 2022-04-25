<?php

/**
 * Ajax to add bundle sell and bundle sell upsells to cart
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */

add_action( 'wp_ajax_lb_buy_now_btn_atc', 'lb_buy_now_btn_atc' );
add_action( 'wp_ajax_nopriv_lb_buy_now_btn_atc', 'lb_buy_now_btn_atc' );

function lb_buy_now_btn_atc() {

    check_ajax_referer( 'ajax_nonce_here' );


    wp_die();
}
 
