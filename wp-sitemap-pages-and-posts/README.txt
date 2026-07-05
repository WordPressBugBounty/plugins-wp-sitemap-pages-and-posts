=== WP Sitemap Pages and Posts ===
Contributors: shuvo66
Tags: sitemap, page list, post list, shortcode, html sitemap
Requires at least: 5.8
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.2.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Generate a human-readable sitemap of your pages and posts with a simple shortcode.

== Description ==

WP Sitemap Pages and Posts gives you an easy way to add a sitemap to any page on your site. Just drop the shortcode `[wpspap_sitemap]` into a page or post and it will automatically list your pages and posts, linked and ready to browse.

**Note:** this plugin does not generate an XML sitemap for search engines. It creates a human-readable list for your visitors. If you need an XML sitemap for SEO purposes, look for a dedicated SEO plugin.

= Features =

* Simple shortcode: `[wpspap_sitemap]`
* Choose which post type(s) to display, including custom post types
* Display multiple post types at once
* Control the number of items shown
* Sort by title, date, or menu order, ascending or descending
* Exclude specific pages or posts by ID
* Lightweight — no settings pages, no bloat, no external requests

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/wp-sitemap-pages-and-posts`, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Add the `[wpspap_sitemap]` shortcode to any page or post.

== Usage ==

= Basic usage =

`[wpspap_sitemap]`

Displays all published pages.

= Choose a post type =

`[wpspap_sitemap type="post"]`

`[wpspap_sitemap type="page"]`

= Display multiple post types =

`[wpspap_sitemap type="page,post"]`

Custom post types are supported too, as long as they are publicly viewable:

`[wpspap_sitemap type="page,post,product"]`

= Limit the number of items =

`[wpspap_sitemap count="10"]`

Use `-1` (default) to show all items.

= Sort the list =

`[wpspap_sitemap orderby="date" order="DESC"]`

Supported `orderby` values follow WordPress's standard `WP_Query` options (e.g. `title`, `date`, `menu_order`). `order` accepts `ASC` or `DESC`.

= Exclude specific items =

`[wpspap_sitemap exclude="12,45"]`

Exclude one or more post/page IDs, comma separated.

== Frequently Asked Questions ==

= Does this generate an XML sitemap for Google? =

No. This plugin creates a human-readable list of links for your site visitors, not an XML sitemap for search engines.

= Can I style the sitemap list? =

Yes. The output is wrapped in `<ul class="wpspap-sitemap">`, so you can target it with your own CSS.

= Can I show custom post types? =

Yes, any publicly viewable post type can be passed to the `type` attribute.

== Screenshots ==

1. Example sitemap output using the default shortcode.

== Changelog ==

= 1.2.0 =
* Added support for displaying multiple post types at once
* Added `orderby`, `order`, and `exclude` shortcode attributes
* Escaped all output for improved security
* Replaced deprecated `wp_reset_query()` with `wp_reset_postdata()`
* Sanitized and validated all shortcode attributes
* Updated compatibility to WordPress 7.0 and PHP 7.4+

= 1.1.0 =
* Earlier release.

== Upgrade Notice ==

= 1.2.0 =
Security and compatibility update. Recommended for all users. Adds support for multiple post types, sorting, and excluding items.

== Uninstall ==

To remove WP Sitemap Pages and Posts, simply deactivate and delete it from the Plugins screen. It does not create any custom database tables or options.
