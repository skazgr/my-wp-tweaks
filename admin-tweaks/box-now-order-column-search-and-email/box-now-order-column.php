<?php
/**
 * Box Now - Add parcel info column, email info, and order search integration.
 *
 */

// Add a new column to the orders list
add_filter('manage_edit-shop_order_columns', 'boxnow_add_column');

function boxnow_add_column($columns) {
	$new_columns = [];
	foreach ($columns as $key => $value) {
		$new_columns[$key] = $value;
		if ($key === 'order_status') {
			$new_columns['box_now'] = __('Box Now', 'woocommerce');
		}
	}
	return $new_columns;
}

// Populate the new column with the voucher link
add_action('manage_shop_order_posts_custom_column', 'boxnow_populate_column');

function boxnow_populate_column($column) {
	global $post;

	if ($column === 'box_now') {
		$order = wc_get_order($post->ID);
		$parcel_ids = $order->get_meta('_boxnow_parcel_ids', true);

		if (!empty($parcel_ids) && is_array($parcel_ids)) {
			foreach ($parcel_ids as $parcel_id) {
				echo '<a href="https://partner.boxnow.gr/parcels/' . esc_html($parcel_id) . '" class="parcel-id-link box-now-link" target="_blank">' . esc_html($parcel_id) . '</a><br>';
			}
		} else {
			echo __('No voucher', 'woocommerce');
		}
	}
}

function boxnow_get_parcel_ids($order_id) {
	$order = wc_get_order($order_id);
	$access_token = boxnow_get_access_token();
	$api_url = 'https://' . get_option('boxnow_api_url', '') . '/api/v1/delivery-requests/' . $order_id;

	$response = wp_remote_get($api_url, [
		'headers' => [
			'Authorization' => 'Bearer ' . $access_token,
			'Content-Type' => 'application/json',
		],
	]);

	if (is_wp_error($response)) {
		return [];
	} else {
		$response_body = json_decode(wp_remote_retrieve_body($response), true);
		if (isset($response_body['parcels'])) {
			$parcel_ids = [];
			foreach ($response_body['parcels'] as $parcel) {
				$parcel_ids[] = $parcel['id'];
			}
			$order->update_meta_data('_boxnow_parcel_ids', $parcel_ids);
			$order->save();
			return $parcel_ids;
		} else {
			return [];
		}
	}
}

add_action('woocommerce_order_status_changed', 'boxnow_update_parcel_ids', 10, 1);

function boxnow_update_parcel_ids($order_id) {
	boxnow_get_parcel_ids($order_id);
}

// Add Box Now parcel info to completed order email
add_action('woocommerce_email_before_order_table', 'boxnow_add_info_to_email', 10, 4);

function boxnow_add_info_to_email($order, $sent_to_admin, $plain_text, $email) {
	if ($email->id !== 'customer_completed_order') {
		return;
	}

	$parcel_ids = $order->get_meta('_boxnow_parcel_ids', true);

	if (!empty($parcel_ids) && is_array($parcel_ids)) {
		if ($plain_text) {
			echo "\nBox Now:\n";
			echo "<p>Παρακολούθηση δέματος: </p>";
			foreach ($parcel_ids as $parcel_id) {
				echo "https://boxnow.gr/?track=" . esc_html($parcel_id) . "\n";
			}
		} else {
			echo '<h2>' . __('Box Now', 'woocommerce') . '</h2>';
			echo '<p>Παρακολούθηση δέματος: </p>';
			echo '<ul>';
			foreach ($parcel_ids as $parcel_id) {
				echo '<li><a href="https://boxnow.gr/?track=' . esc_html($parcel_id) . '" target="_blank">' . esc_html($parcel_id) . '</a></li>';
			}
			echo '</ul>';
		}
	}
}

// Make parcel IDs searchable in WooCommerce orders list
add_filter('woocommerce_shop_order_search_fields', 'boxnow_searchable_order_meta_keys');

function boxnow_searchable_order_meta_keys($search_fields) {
	$search_fields[] = '_boxnow_parcel_ids';
	return $search_fields;
}

add_filter('posts_search', 'boxnow_search_order_by_parcel_id', 10, 2);

function boxnow_search_order_by_parcel_id($search, $wp_query) {
	global $wpdb;

	if (is_admin() && isset($wp_query->query_vars['s']) && !empty($wp_query->query_vars['s'])) {
		$search_term = $wp_query->query_vars['s'];
		$search = "
            AND (
                {$wpdb->posts}.ID IN (
                    SELECT post_id
                    FROM {$wpdb->postmeta}
                    WHERE meta_key = '_boxnow_parcel_ids'
                    AND meta_value LIKE '%" . esc_sql($search_term) . "%'
                )
                OR {$wpdb->posts}.post_title LIKE '%" . esc_sql($search_term) . "%'
                OR {$wpdb->posts}.post_content LIKE '%" . esc_sql($search_term) . "%'
                OR {$wpdb->posts}.post_excerpt LIKE '%" . esc_sql($search_term) . "%'
            )
        ";
	}

	return $search;
}
