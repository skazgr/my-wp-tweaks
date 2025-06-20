# Box Now Order Column - Search & Email Integration

This snippet adds a custom column to the WooCommerce orders list showing Box Now parcel voucher links.  
It also injects parcel tracking info into completed order emails sent to customers and makes parcel IDs searchable in the WooCommerce orders admin.

## Usage

1. Include its contents in your theme’s `functions.php`.  
2. Alternatively, create a simple custom plugin and include this file.  
3. Make sure the Box Now API token and URL options are correctly set in your WordPress options (`boxnow_api_url` and the function `boxnow_get_access_token()` must be defined).  
4. The parcel IDs are fetched and saved when order status changes.  
5. Parcel IDs will be shown in the order list, in customer completed order emails, and are searchable in the orders admin screen.

## Notes

- Replace or define `boxnow_get_access_token()` if missing to return a valid API token.  
- This code is intended for WooCommerce stores using the Box Now Delivery plugin.  
- Tested on WooCommerce 9.9.3 and WordPress 6.8.1

## Installation

- For themes: Copy and paste the entire PHP file code into your active theme’s `functions.php`.  
- For plugins: Include the PHP file in your plugin or create a new custom plugin using this code.

---

*Developed by Marios Progoulakis*
