# Auto Table of Contents

Injects a TOC into long-form posts (>1,000 words), targeting H2/H3 headings.

## Installation

Option A: Standalone file
1. Drop `auto-toc.php` in your child theme folder (e.g., `/wp-content/themes/your-child/auto-toc.php`).
2. In `functions.php`, add:
   ```php
   include get_stylesheet_directory() . '/auto-toc.php';
   ```

Option B: Copy-Paste
- Copy the contents of `auto-toc.php` directly into your child theme’s `functions.php`.

## Details

- **Hook**: `the_content` filter
- **Trigger**: `str_word_count(strip_tags($content)) > 1000`
- **Headings**: Finds `<h2>` and `<h3>`, injects IDs (`toc-0`, `toc-1`, …)
- **Output**: `<div class="auto-toc"><ul>…</ul></div>` prepended to content

## Customization

- Change word count threshold by editing `1000` in the code.
- Adjust regex to include `<h4>` or omit levels.
- Modify HTML/CSS to match your theme.

## Example CSS

```css
.auto-toc {
  background: #f5f5f5;
  border: 1px solid #ddd;
  padding: 1em;
  margin-bottom: 2em;
}
.auto-toc ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
.auto-toc li + li {
  margin-top: 0.5em;
}
.auto-toc a {
  color: inherit;
  text-decoration: none;
}
```

## Compatibility

Tested on:
- WordPress 6.8.1