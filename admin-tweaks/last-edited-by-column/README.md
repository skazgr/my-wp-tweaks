# Last Edited By Column in Admin Posts List

Adds a new column "Last Edited By" to the admin list tables for Posts, Pages,  
and any specified custom post types. This column shows the username of the user  
who last edited each post or page.

## Usage

- Copy the PHP code to your theme's `functions.php` file or include it as a mini-plugin.
- By default, the snippet adds the column for Posts and Pages.
- To support custom post types, add their slugs to the `$post_types` array inside the code.

## Expected Behavior

- A new column "Last Edited By" appears in the admin list table for Posts, Pages,  
  and any additional post types you specify.
- Shows the display name of the last user who edited each post.
- If no editor is found, displays a dash (`-`).
- Useful for editorial workflows and tracking content changes.
