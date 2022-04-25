<?php
/**
 * Add Buy Now button to single product page
 * 
 */
add_action( 'woocommerce_after_add_to_cart_button', 'mcb_buy_now', 5 );

function mcb_buy_now() {
    ?>
    <button id="mcb_buy_now" style="display: none;">
        <?php _e( 'Buy Now!', 'woocommerce' ); ?>
    </button>
    <?php
    // css & js
    wp_enqueue_style( 'mcb-css' );
    wp_enqueue_script( 'mcb-js' );
    wp_enqueue_script( 'bn-upsells-atc-js' );
}
