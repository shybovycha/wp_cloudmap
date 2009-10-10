=== COSM ===
Contributors: shybovycha
Tags: osm, cloudmade, open street map
Requires at least: 2.0.2
Tested up to: 2.1
Stable tag: trunk

This plugin allows you to use Cloudmade OSM services on your blog.

== Description ==

This plugin allows you to use Cloudmade Open Street Map services on your blog.

== Installation ==

1. Upload `cosm.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to `COSM` control panel and enter your API key

== Frequently Asked Questions ==

= What is Cloudmade? =

 It is company provided their own mapping services (like Google Maps), based on OpenStreetMap. See more details on:
1. http://www.cloudmade.com/
1. http://www.openstreetmap.org/

= How to use it? =

 This plugin has just one tag for now - `[map]`.
It has a few params:
1. `name` - this param is critical. Each map on the page must have it's unique name.
1. `lat, lon, zoom` - these params are optional; they are used to show concrete tile of the map.
1. `apikey` - optional; used when you don't want to use the API key from options menu.
1. `width, height` - optional; size of the map frame on the page.
1. `style_id` - optional; map style.

== Screenshots ==

1. `/trunk/screenshot1.png`

== Changelog ==

= 0.1 =
* First version.
