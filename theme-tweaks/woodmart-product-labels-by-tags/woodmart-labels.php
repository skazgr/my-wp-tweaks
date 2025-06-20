<?php
/**
 * Display custom product labels on shop/archive pages based on product tags.
 * Theme: Woodmart (compatible with WooCommerce)
 */

// Display labels on product loop items (shop page)
function woodmart_display_custom_product_labels() {
	global $product;

	if ( ! $product || ! is_a( $product, 'WC_Product' ) ) return;

	$tags = get_the_terms( $product->get_id(), 'product_tag' );

	if ( empty( $tags ) || is_wp_error( $tags ) ) return;

	$label_html = '';

	foreach ( $tags as $tag ) {
		switch ( $tag->slug ) {
			case 'hot':
				$label_html = '<span class="custom-label-hot">' . esc_html__( 'HOT', 'woodmart' ) . '</span>';
				break;
			case 'out-of-stock':
				$label_html = '<span class="custom-label-outofstock">' . esc_html__( 'OUT OF STOCK', 'woodmart' ) . '</span>';
				break;
			case 'featured':
				$label_html = '<span class="custom-label-featured">' . esc_html__( 'FEATURED', 'woodmart' ) . '</span>';
				break;
			default:
				// Add more tags if needed
				break;
		}
		if ( $label_html ) break;
	}

	if ( $label_html ) {
		echo '<div class="product-custom-label">' . $label_html . '</div>';
	}
}

add_action( 'woocommerce_after_shop_loop_item', 'woodmart_display_custom_product_labels', 10 );
