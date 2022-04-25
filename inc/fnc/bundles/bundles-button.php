<?php
/**
 * Renders single add to cart button (outside upsell modal/lightbox)
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */
add_action( 'woocommerce_after_add_to_cart_button', 'mcb_modal_buy_now_button' );

function mcb_modal_buy_now_button() {
    ?>
    <button id="upsell-v2-product-bundle-buy-now" data-bundle-mode="" style="display: none"><?php _e( 'Buy Now!', 'woocommerce' ); ?></button>
    <?php
    wp_enqueue_script( 'bn-bundle-atc-js' );
}
