# Reading Progress Bar

Slim progress bar at the top of single posts, filling as the user scrolls.
Accounts for the WordPress admin bar to avoid overlap.

## Installation

### Option A: Include as separate files
1. Copy the entire `reading-progress-bar` folder into your child theme root (e.g., `/wp-content/themes/your-child/reading-progress-bar/`).
2. In your child theme’s `functions.php`, add:

   ```php
   include get_stylesheet_directory() . '/reading-progress-bar/progress-bar.php';
   ```

3. Ensure the folder contains:
   - `progress-bar.php`
   - `progress-bar.css`
   - `progress-bar.js`

The CSS and JS will be auto-enqueued on single post views.

### Option B: Copy-Paste Snippets
- **PHP**: Copy the code from `progress-bar.php` into your child theme’s `functions.php`.
- **CSS**: Copy the contents of `progress-bar.css` into your theme’s stylesheet or custom CSS.
- **JS**: Copy the contents of `progress-bar.js` into your theme’s JS file or via a snippet plugin.

## Customization

- **Bar Color**: Change `background: #08a4a7;` in CSS.
- **Height**: Adjust `height: 4px;` in CSS.
- **Admin Bar Offset**: Modify `top: 32px;` if your admin bar height differs.
- **Transition**: Tweak timing in CSS `transition` property.

## Compatibility

Tested on WordPress 6.8.1.
