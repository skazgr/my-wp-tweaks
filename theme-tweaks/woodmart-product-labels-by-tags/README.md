# Woodmart – Show Product Labels by Tag

This snippet displays a custom label on the product image area of shop/category pages in the **Woodmart** theme, based on the WooCommerce product tags.

## Tags & Labels

| Tag Slug       | Label Text     | CSS Class                 |
|----------------|----------------|---------------------------|
| `hot`          | HOT            | `.custom-label-hot`       |
| `out-of-stock` | OUT OF STOCK   | `.custom-label-outofstock`|
| `featured`     | FEATURED       | `.custom-label-featured`  |

You can add more tags and labels by extending the `switch()` statement in the PHP file.

## Usage

You can use this snippet in one of two ways:

### Option 1: Add directly to `functions.php`
Just copy and paste the contents of `woodmart-labels.php` into your active theme’s `functions.php` file.

### Option 2: Include as external file
Place the `woodmart-labels.php` file inside your theme or child theme and include it with:
```php
include get_stylesheet_directory() . '/woodmart-labels.php';
