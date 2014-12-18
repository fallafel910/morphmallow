=== Plugin Name ===
Contributors: dwieeb
Donate link: http://www.danielimhoff.com/donations/
Tags: css, js, javascript, stylesheet, page, post, custom post type, specific, dwieeb
Requires at least: 3.0.0
Tested up to: 3.9.1
Stable tag: 1.3.3

This plugin allows you to include CSS or JS files in specific posts and pages. 

== Description ==

With this plugin, you will be able to include certain CSS or JS files in only selected posts, pages, or other post types, instead of including them everywhere. You can also edit inline CSS & JS and include CSS & JS files from anywhere on specific posts and pages. 

It places meta boxes in the WordPress post editor so it's easy to select which files you want to include with the post you're currently editing. This plugin works well for all websites, large and small, and it works well with WordPress multi-site (WordPress MU). Tested up to 3.1 beta 2.

See this plugin's [page](http://www.danielimhoff.com/wordpress-plugins/specific-files/) on my website for information/comments/questions. I am open to the idea of suggestions and patches to this plugin! If you enjoyed this plugin, please [donate](http://www.danielimhoff.com/donations/) or [say thanks](http://www.danielimhoff.com/donations/).

Todo:

* Add a "remove references" button on the options page so people can remove file references without having to delete the file.

== Installation ==

1. Upload `/specific-files-for-posts-and-pages/` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the *Plugins* menu in WordPress.
1. Upload your CSS files to `/wp-content/specific-files/css/` directory.
1. Upload your JS files to `/wp-content/specific-files/js/` directory.
1. Use the meta boxes in the Wordpress post editor to select the CSS and JS files that you wish to include.

== Frequently Asked Questions ==

= Will updating remove my CSS and JS files? =

No. Only plugin core files will be overwritten.

= I deleted a file with my FTP client. Now I'm getting 404 errors in my server logs. What's going on? =

When you delete one of your CSS or JS files with your FTP client, the plugin won't automatically remove all references to that file (in case you were simply deleting to reupload it again or some other case. It tries to preserve the calls to your files. In order to remove these calls, use the plugin's options page. Using the delete button on the plugin's options page will remove the file and all references to that file in your posts and pages.

== Screenshots ==

1. This is the plugin options page for Specific Files. It is used for uploading new files (you can also upload via FTP), viewing files, and deleting files. 
1. The two meta boxes appear on the right side near the bottom. They use a multiple-selectable `<select>` element for easy selecting.
1. Advanced options include inserting inline CSS & JS into the header of your page or post.
1. Advanced options also include the ability to include your CSS & JS files from anywhere.

== Changelog ==

= 1.3.3 =
* Adding es_ES translations

= 1.3.2 =
* Checking support for WordPress 3.5. All is well.

= 1.3.1 =
* Squashed bug: http://wordpress.org/support/topic/plugin-specific-files-using-quick-edit-deselects-all-specified-files-in-post?replies=1
* Squashed bug: When CSS or JS meta boxes are hidden, they cleared out the files that were included in the post. 

= 1.3 =
* Added support for custom post types.
* Added option to enable support for custom post types.
* Added a few isset()'s to get rid of potential PHP notices.
* Updated screenshot-1.jpg to show the updated options page.

= 1.2.1 =
* Relocated CSS & JS file directory to `/wp-content/specific-files/` for more stability.
* Added option to hide CSS and/or JS meta box.

= 1.2 =
* Added ability to include inline CSS & JS and CSS & JS files from anywhere on the internet.
* Added ability to hide the new advanced options.
* Improved security with a nonce and a few more current_user_can()'s.
* Improved filename scrubber.
* Updated screenshots.

= 1.1.3 =
* Plugin works 100%
* Removing crappy versions.

= 1.1.2 =
* Attempting to add some backwards compatibility.

= 1.1.1 =
* Added capability to preserve CSS & JS files on update.
* Added function: copyr() for copying directories recursively.
* Improved AJAX delete file reliability on options page.
* Added settings page link on WordPress plugins admin page.
* Added donate box on plugin options page.

= 1.1 =
* Added support for JavaScript files.
* Added meta box for JavaScript files.
* Rearranged plugin options page/optomized user interface.

= 1.0 =
* Original release. (Not public).
