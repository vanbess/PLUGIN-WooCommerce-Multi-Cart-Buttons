jQuery( document ).ready( function ( $ ) {

    // *************************************************
    // add upsells to cart on add to cart button click
    // *************************************************
    $( 'button#mcb_buy_now' ).on( 'click', function ( e ) {

        e.preventDefault();

        // retrieve main product data
        var product_id = $( this ).attr( 'data-product-id' );
        var variation_id = $( this ).attr( 'data-variation-id' );
        var qty = $( this ).attr( 'data-qty' );

        // check which items are checked and build appropriate product data array
        var variable_prods = [ ], simple_prods = [ ];

        // simple prods
        $( 'input.upsell-v2-product-upsell-simple-prod-cb' ).each( function () {
            if ( $( this ).is( ':checked' ) ) {
                simple_prods.push( { 'product_id': $( this ).data( 'product-id' ), 'qty': $( this ).data( 'qty' ) } );
            }
        } );

        // variable prods
        $( 'input.upsell-v2-product-upsell-variable-prod-cb' ).each( function () {
            if ( $( this ).is( ':checked' ) ) {
                variable_prods.push( { 'parent_id': $( this ).data( 'parent-id' ), 'variation_id': $( this ).data( 'variation-id' ), 'qty': $( this ).data( 'qty' ) } );
            }
        } );

        var data = {
            'action': 'ps_buy_now_btn_atc',
            '_ajax_nonce': bn_upsells_atc_js.nonce,
            'simple_prods': simple_prods,
            'variable_prods': variable_prods,
            'product_id': product_id,
            'variation_id': variation_id,
            'qty': qty
        }

        $.post( bn_upsells_atc_js.url, data, function ( response ) {
            location.replace( '/checkout/' );
        } );

    } );

} );