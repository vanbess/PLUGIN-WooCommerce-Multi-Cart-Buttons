<?php

/**
 * Ajax to add product to cart for product upsells/product main
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */
add_action( 'wp_ajax_ps_buy_now_btn_atc', 'ps_buy_now_btn_atc' );
add_action( 'wp_ajax_nopriv_ps_buy_now_btn_atc', 'ps_buy_now_btn_atc' );

function ps_buy_now_btn_atc() {

    check_ajax_referer( 'buy now upsells add to cart' );

    // cart key array
    $cart_keys = [];

    // main product to cart
    if ( isset( $_POST[ 'variation_id' ] ) ):
        $main_key = wc()->cart->add_to_cart( $_POST[ 'product_id' ], $_POST[ 'qty' ], $_POST[ 'variation_id' ] );
        array_push( $cart_keys, $main_key );
    else:
        $main_key = wc()->cart->add_to_cart( $_POST[ 'product_id' ], $_POST[ 'qty' ] );
        array_push( $cart_keys, $main_key );
    endif;

    // simple upsells to cart
    $simple_prods = $_POST[ 'simple_prods' ];

    foreach ( $simple_prods as $simple_prod ):
        $simple_key = wc()->cart->add_to_cart( $simple_prod[ 'product_id' ], $simple_prod[ 'qty' ] );
        array_push( $cart_keys, $simple_key );
    endforeach;

    // variable upsells to cart
    $variable_prods = $_POST[ 'variable_prods' ];

    foreach ( $variable_prods as $variable_prod ):
        $variable_key = wc()->cart->add_to_cart( $variable_prod[ 'parent_id' ], $variable_prod[ 'qty' ], $variable_prod[ 'variation_id' ] );
        array_push( $cart_keys, $variable_key );
    endforeach;

    // send response
    if ( !empty( $cart_keys ) ):
        wp_send_json( $cart_keys );
    endif;

    wp_die();
}
