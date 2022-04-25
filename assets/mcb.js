/**
 * Reposition Buy Now button
 */

jQuery(document).ready(function ($) {

    // move/display buy now button
    var buy_now_button = $('button#mcb_buy_now');
    buy_now_button.insertAfter('.single_add_to_cart_button');
    buy_now_button.show();

    // insert button into modal
    var modal_btn = $('button#upsell-v2-product-bundle-buy-now');
    var bundle_mode = $('button#upsell-v2-product-bundle-add-to-cart').attr('data-bundle-mode');
    $(modal_btn).insertAfter('button#upsell-v2-product-bundle-add-to-cart').show().attr('data-bundle-mode', bundle_mode);

    // enable/disable buy now and add product data on page load
    var is_variable = $(document).find('input.variation_id');

    if (is_variable.length >= 1) {
        $('#mcb_buy_now').addClass('disabled').attr('disabled', true);
        $('#mcb_buy_now').attr('data-product-id', $('.cart').attr('data-product_id'));
        $('#mcb_buy_now').attr('data-variation-id', is_variable.val());
        $('#mcb_buy_now').attr('data-qty', $('.qty').val());
    } else {
        $('#mcb_buy_now').removeClass('disabled').attr('disabled', false);
        $('#mcb_buy_now').attr('data-product-id', $('.single_add_to_cart_button').val());
        $('#mcb_buy_now').attr('data-qty', $('.qty').val());
    }

    // woocommerce variation attributes swatch on click
    $('.wcvaswatchlabel').on('click', function () {

        setTimeout(function () {
            var variation_id = $('input.variation_id').val();
            $('#mcb_buy_now').attr('data-product-id', $('.cart').attr('data-product_id'));
            $('#mcb_buy_now').attr('data-variation-id', variation_id);
            $('#mcb_buy_now').attr('data-qty', $('.qty').val());
        }, 50);

    });

    // if variation preselected
    if ($('select#pa_color').val() !== '') {

        $('#mcb_buy_now').removeClass('disabled').attr('disabled', false);

        setTimeout(function () {
            var variation_id = $('input.variation_id').val();
            $('#mcb_buy_now').attr('data-product-id', $('.cart').attr('data-product_id'));
            $('#mcb_buy_now').attr('data-variation-id', variation_id);
            $('#mcb_buy_now').attr('data-qty', $('.qty').val());
        }, 50);

    }

    // variations select on change
    $('select#pa_color').on('change', function () {

        if ($(this).val() !== '') {
            $('#mcb_buy_now').removeClass('disabled').attr('disabled', false);
        } else {
            $('#mcb_buy_now').removeClass('disabled').attr('disabled', true);
        }

        setTimeout(function () {
            var variation_id = $('input.variation_id').val();
            $('#mcb_buy_now').attr('data-product-id', $('.cart').attr('data-product_id'));
            $('#mcb_buy_now').attr('data-variation-id', variation_id);
            $('#mcb_buy_now').attr('data-qty', $('.qty').val());
        }, 50);

    });

    // qty on change
    $('.qty').on('change', function () {
        $('#mcb_buy_now').attr('data-qty', $(this).val());
    });

});
