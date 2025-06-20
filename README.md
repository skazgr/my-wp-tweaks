# My WP Tweaks

A collection of WordPress snippets focused on admin tweaks, theme customizations, WooCommerce enhancements, and general performance/security improvements.

## Structure

- `admin-tweaks/` — Customizations for WordPress admin area, login page, and dashboard  
- `theme-tweaks/` — Theme-specific enhancements
- `woocommerce-tweaks/` — Functional WooCommerce-related snippets (orders, emails, meta)  
<!-- - `performance/` — Snippets to improve site speed and resource loading -->  
<!-- - `security/` — Small tweaks to harden WordPress security -->

Each subfolder includes:  
- One or more clean PHP snippets (`*.php`)  
- A `README.md` explaining usage and expected output  

## Usage

For each snippet:

- **Option 1:** Copy the code directly into your theme’s `functions.php` file.  
- **Option 2:** Include the `.php` file from your theme or child theme using:  
  ```php
  include get_stylesheet_directory() . '/path/to/snippet.php';
