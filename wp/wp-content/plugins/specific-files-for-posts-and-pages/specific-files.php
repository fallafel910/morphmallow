<?php
/*
Plugin Name: Specific Files
Plugin URI: http://www.danielimhoff.com/wordpress-plugins/specific-files/
Description: By placing easy-select meta boxes in the Wordpress page/post editor, this plugin allows you to include CSS or JS files in specific posts and pages. 
Version: 1.3.2
Author: Daniel Imhoff
Author URI: http://www.danielimhoff.com/
License: GPL2
Tags: css, js, javascript, stylesheet, page, post, specific, dwieeb

   Copyright 2010  Daniel Imhoff  (email : dwieeb@gmail.com)

   This file is part of Specific Files

   Specific Files is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   Specific Files is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Specific Files. If not, see <http://www.gnu.org/licenses/>.
*/

if( !function_exists( 'add_action' ) ) {
   die( __( 'You are not allowed to access this file outside of WordPress.', 'specific-files' ) );
}

if ( !defined( 'WP_CONTENT_URL' ) ) {
   define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
}

if ( !defined( 'WP_CONTENT_DIR' ) ) {
   define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
}

if ( !defined( 'WP_PLUGIN_URL' ) ) {
   define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
}

if ( !defined( 'WP_PLUGIN_DIR' ) ) {
   define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
}

define( 'SF_VERSION', '1.3.3' );

// Did some nub rename the folder? 
define( 'SF_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'SF_PLUGIN_DIRNAME', dirname( SF_PLUGIN_BASENAME ) );

// Define some absolute paths to certain plugin directories
define( 'SF_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . SF_PLUGIN_DIRNAME );
define( 'SF_FILES_DIR', WP_CONTENT_DIR . '/specific-files' );
define( 'SF_FILES_CSS_DIR', SF_FILES_DIR . '/css' );
define( 'SF_FILES_JS_DIR', SF_FILES_DIR . '/js' );

// Define some URLs to certain plugin directories
define( 'SF_PLUGIN_URL', WP_PLUGIN_URL . '/' . SF_PLUGIN_DIRNAME );
define( 'SF_FILES_URL', WP_CONTENT_URL . '/specific-files' );
define( 'SF_FILES_CSS_URL', SF_FILES_URL . '/css' );
define( 'SF_FILES_JS_URL', SF_FILES_URL . '/js' );

// Where's the options page?
define( 'SF_OPTIONS_URL', get_bloginfo( 'wpurl' ) . '/wp-admin/options-general.php?page=' . SF_PLUGIN_BASENAME );

include 'includes/functions.php';

// If the class does not exist already somehow, lay it out.
if( !class_exists( 'SpecificFiles' ) ) {

   /**
    * Specific Files class.
    *
    * This class is the container for the Specific Files plugin. 
    *
    * @author Daniel Imhoff
    * @package Wordpress
    * @subpackage SpecificFiles
    * @since 1.0
    */
   class SpecificFiles {

      /**
       * Array of Specific Files Options.
       *
       * @since 1.2
       */
      public $options = array();

      /**
       * Constructor.
       *
       * @since 1.0
       * @return SpecificFiles
       */
      public function __construct()
      {
         // Update version number if necessary.
         if( version_compare( get_option( 'specific-files_version' ), SF_VERSION, '<' ) ) {
            update_option( 'specific-files_version', SF_VERSION );
         }

         // Add default options if SF options do not exist in the database
         if( !$this->options = get_option( 'specific-files_options' ) ) {
            add_option( 'specific-files_options', $this->options = array(
               'show_css_meta_box' => 1,
               'show_js_meta_box' => 1,
               'show_advanced_options' => 1,
               'apply_to_all_post_types' => 0
            ) );
         }

         // Hook into Wordpress
         $this->add_hooks();
      }

      /**
       * Destructor.
       *
       * @since 1.0
       */
      public function __destruct()
      {}

      /**
       * Hook into Wordpress.
       *
       * @since 1.0
       */
      private function add_hooks()
      {
         if( is_admin() ) {
            wp_enqueue_style( 'colorbox', SF_PLUGIN_URL . '/css/colorbox.css' );
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'colorbox', SF_PLUGIN_URL . '/js/jquery.colorbox-min.js', array('jquery'), '1.3.15' );
         }

         add_action( 'init', array( &$this, 'init' ) );
         add_action( 'add_meta_boxes', array( &$this, 'add_meta_boxes' ) );
         add_action( 'save_post', array( &$this, 'save_post' ) );
         add_action( 'wp_head', array( &$this, 'wp_head' ) );
         add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
         add_action( 'wp_ajax_specific_delete_css_file', array( &$this, 'wp_ajax_specific_delete_css_file' ) );
         add_action( 'wp_ajax_specific_delete_js_file', array( &$this, 'wp_ajax_specific_delete_js_file' ) );
         //add_filter( 'upgrader_pre_install', array( &$this, 'upgrader_pre_install' ), 10, 2 );
         //add_filter( 'upgrader_post_install', array( &$this, 'upgrader_post_install' ), 10, 2 );
      }

      /**
       * This function is hooked into Wordpress via the 'init' hook.
       *
       * @since 1.3.3
       */
      public function init()
      {
         // Load the textdomain of this plugin
         load_plugin_textdomain( 'specific-files', false, SF_PLUGIN_DIRNAME . '/languages/' );
      }

      /**
       * This function is hooked into Wordpress via the 'upgrader_pre_install' filter.
       *
       * @since 1.1.1
       */
      public function upgrader_pre_install()
      {}

      /**
       * This function is hooked into Wordpress via the 'upgrader_post_install' filter.
       *
       * @since 1.1.1
       */
      public function upgrader_post_install()
      {}

      /**
       * Add meta box to the Wordpress page & post editor admin page. The call back is SpecificFiles::print_meta_boxes
       *
       * @since 1.0
       */
      public function add_meta_boxes()
      {
         if( isset( $this->options['apply_to_all_post_types'] ) && $this->options['apply_to_all_post_types'] ) {
            $post_types = get_post_types( array(
               'public' => true
            ) );
         } else {
            $post_types = array(
               'post',
               'page'
            );
         }

         if( !isset( $this->options['show_css_meta_box'] ) || $this->options['show_css_meta_box'] ) {
            foreach( $post_types as $post_type ) {
               add_meta_box( 'specific-files_css_meta_box', __( 'Specific CSS Files', 'specific-files' ), array( &$this, 'print_css_meta_box' ), $post_type, 'side', 'low' );
            }
         }

         if( !isset( $this->options['show_js_meta_box'] ) || $this->options['show_js_meta_box'] ) {
            foreach( $post_types as $post_type ) {
               add_meta_box( 'specific-files_js_meta_box', __( 'Specific JS Files', 'specific-files' ), array( &$this, 'print_js_meta_box' ), $post_type, 'side', 'low' );
            }
         }
      }

      /**
       * This function is hooked into Wordpress via the 'save_post' hook. It saves the data from the meta box while Wordpress saves the rest of the post.
       *
       * @since 1.0
       * @return $post_id
       */
      public function save_post( $post_id )
      {
         // Verify if this is an auto save routine. If it is, our form has not been submitted, so we don't want to do anything.
         if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post_id;
         }

         // Check permissions
         if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ) ) {
               return $post_id;
            }
         } else {
            if ( !current_user_can( 'edit_post', $post_id ) ) {
               return $post_id;
            }
         }

         // Get the data from the form
         $css_files = str_replace(' ', '', isset( $_POST['specific-files_css_files'] ) ? $_POST['specific-files_css_files'] : '' );
         $css_inline = isset( $_POST['specific-files_css_inline_css'] ) ? $_POST['specific-files_css_inline_css'] : '';
         $css_root = isset( $_POST['specific-files_css_root_css'] ) ? $_POST['specific-files_css_root_css'] : '';

         $js_files = str_replace(' ', '', isset( $_POST['specific-files_js_files'] ) ? $_POST['specific-files_js_files'] : '' );
         $js_inline = isset( $_POST['specific-files_js_inline_js'] ) ? $_POST['specific-files_js_inline_js'] : '';
         $js_root = isset( $_POST['specific-files_js_root_js'] ) ? $_POST['specific-files_js_root_js'] : '';

         if( $_POST['specific-files_hidden_css'] !== 'true' && $_POST['specific-files_hidden_js'] !== 'true' ) {
            return $post_id;
         }

         // Update the plugin's meta information for this particular page or post

         if( $_POST['specific-files_hidden_css'] === 'true' ) {
            if( isset( $css_files ) ) {
               delete_post_meta( $post_id, '_specific-files_css_files' );
               add_post_meta( $post_id, '_specific-files_css_files', $css_files );
            }

            if( isset( $css_inline ) ) {
               delete_post_meta( $post_id, '_specific-files_css_files_inline' );
               add_post_meta( $post_id, '_specific-files_css_files_inline', $css_inline );
            }

            if( isset( $css_root ) ) {
               delete_post_meta( $post_id, '_specific-files_css_files_root' );
               add_post_meta( $post_id, '_specific-files_css_files_root', $css_root );
            }
         }

         if( $_POST['specific-files_hidden_js'] === 'true' ) {
            if( isset( $js_files ) ) {
               delete_post_meta( $post_id, '_specific-files_js_files' );
               add_post_meta( $post_id, '_specific-files_js_files', $js_files );
            }

            if( isset( $js_inline ) ) {
               delete_post_meta( $post_id, '_specific-files_js_files_inline' );
               add_post_meta( $post_id, '_specific-files_js_files_inline', $js_inline );
            }

            if( isset( $js_root ) ) {
               delete_post_meta( $post_id, '_specific-files_js_files_root' );
               add_post_meta( $post_id, '_specific-files_js_files_root', $js_root );
            }
         }

         return $post_id;
      }

      /**
       * This function is hooked into Wordpress via the 'wp_head' hook. Just before the content starts, it prints the <link> that includes the CSS files.
       *
       * @since 1.0
       */
      public function wp_head()
      {
         global $post;

         // Get the plugin's meta information for this particular post or page
         if( isset( $post->ID ) ) {
            $css_files = get_post_meta( $post->ID, '_specific-files_css_files', true );
            $css_inline = get_post_meta( $post->ID, '_specific-files_css_files_inline', true );
            $css_root = get_post_meta( $post->ID, '_specific-files_css_files_root', true );
            $js_files  = get_post_meta( $post->ID, '_specific-files_js_files', true );
            $js_inline = get_post_meta( $post->ID, '_specific-files_js_files_inline', true );
            $js_root = get_post_meta( $post->ID, '_specific-files_js_files_root', true );
         }

         if( '' != $css_files . $css_inline . $css_root . $js_files . $js_inline . $js_root ) {
            print "<!-- \n" . sprintf( __( "These files are specific to %s #%d thanks to Specific Files plugin by Daniel Imhoff:\nhttp://wordpress.org/extend/plugins/specific-files-for-posts-and-pages/" ), $post->post_type, $post->ID ) . "\n -->\n";

            // Print the stylesheet includes
            foreach( array_filter( explode( ',', str_replace( ' ', '', $css_files ) ) ) as $file ) {
               print "<link rel=\"stylesheet\" id=\"specific-files_" . $file . "\" type=\"text/css\" href=\"" . SF_FILES_CSS_URL . '/' . $file . "\" media=\"screen\" />\n";
            }

            foreach( array_filter( explode( "\n", str_replace( "\r", "\n", $css_root ) ) ) as $file ) {
               print "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $file . "\" media=\"screen\" />\n";
            }

            if( $css_inline ) {
               print "<style type=\"text/css\">\n" . $css_inline . "\n</style>\n";
            }

            // Print the javascript includes
            foreach( array_filter( explode( ',', str_replace( ' ', '', $js_files ) ) ) as $file ) {
               print "<script type=\"text/javascript\" src=\"" . SF_FILES_JS_URL . '/' . $file . "\"></script>\n";
            }

            foreach( array_filter( explode( "\n", str_replace( "\r", "\n", $js_root ) ) ) as $file ) {
               print "<script type=\"text/javascript\" src=\"" . $file . "\"></script>\n";
            }

            if( $js_inline ) {
               print "<script type=\"text/javascript\">\n" . $js_inline . "\n</script>\n";
            }

            print "<!-- end Specific Files plugin -->\n";
         }
      }

      /**
       * This function is hooked into Wordpress via the 'admin_menu' hook.
       *
       * @since 1.0
       */
      public function admin_menu()
      {
         if( current_user_can( 'manage_options' ) ) {
            add_filter( 'plugin_action_links_' . SF_PLUGIN_BASENAME, array( &$this, 'plugin_action_links' ) );
            add_options_page( 'Specific Files', 'Specific Files', 'manage_options', SF_PLUGIN_BASENAME, array( &$this, 'options_page' ) );
         }
      }

      /**
       * This function is hooked into Wordpress via the 'plugin_action_links' filter.
       *
       * @since 1.1.1
       */
      function plugin_action_links( $action_links )
      {
         array_unshift( $action_links, "<a href=\"" . SF_OPTIONS_URL . "\">" . __( 'Settings', 'specific-files' ) . "</a>" );

         return $action_links;
      }

      /**
       * This function is hooked into Wordpress via the 'wp_ajax' hook.
       *
       * @since 1.0
       */
      public function wp_ajax_specific_delete_css_file()
      {
         $file = $_POST['file'];
         $post_array = get_posts( 'numberposts=-1&post_type=any&post_status=any' );

         foreach( $post_array as $post) {
            $css_files = implode( ',', remove_element( explode( ',', get_post_meta( $post->ID, '_specific-files_css_files', true ) ), $file ) );

            delete_post_meta( $post->ID, '_specific-files_css_files' );
            add_post_meta( $post->ID, '_specific-files_css_files', $css_files );
         }

         if( unlink( SF_FILES_CSS_DIR . '/' . $file ) ) {
            print $file;
         }

         die();
      }

      /**
       * This function is hooked into Wordpress via the 'wp_ajax' hook.
       *
       * @since 1.1
       */
      public function wp_ajax_specific_delete_js_file()
      {
         $file = $_POST['file'];
         $post_array = get_posts( 'numberposts=-1&post_type=any&post_status=any' );

         foreach( $post_array as $post) {
            $js_files = implode( ',', remove_element( explode( ',', get_post_meta( $post->ID, '_specific-files_js_files', true ) ), $file ) );

            delete_post_meta( $post->ID, '_specific-files_js_files' );
            add_post_meta( $post->ID, '_specific-files_js_files', $js_files );
         }

         if( unlink( SF_FILES_JS_DIR . '/' . $file ) ) {
            print $file;
         }

         die();
      }

      /**
       * This function is a callback of the two add_meta_box functions that are hooked into Wordpress via the 'add_meta_boxes' hook. It outputs the HTML of the meta box on the Wordpress editor admin page.
       *
       * @since 1.0
       */
      public function print_css_meta_box()
      {
         global $post;

         // Get the plugin's meta information for this particular post or page
         if( isset( $post->ID ) ) {
            $css_files = get_post_meta( $post->ID, '_specific-files_css_files', true );
            $css_inline = get_post_meta( $post->ID, '_specific-files_css_files_inline', true );
            $css_root = get_post_meta( $post->ID, '_specific-files_css_files_root', true );
         } else {
            $css_files = "";
            $css_inline = "";
            $css_root = "";
         }

         $css_array = array();

         // This reads the plugin's CSS directory and compiles an array of CSS files.
         if( $handle = opendir( SF_FILES_CSS_DIR ) ) {
            while( false !== ( $file = readdir( $handle ) ) ) {
               if( 'css' == end( explode( '.', $file ) ) ) {
                  $css_array[] = $file;
               }
            }
         }

         closedir( $handle );

         // Sorted by filename for convenience
         sort( $css_array );

         // Since the value of a multiple <select> element is almost never right, we have jQuery calculate them and store them in a hidden input field as comma separated values.
         print <<<END
<input type="hidden" name="specific-files_hidden_css" id="specific-files_hidden_css" value="true" />
<style type="text/css">
.specific-files-header {
   font:normal 24px Georgia, "Times New Roman", Times, serif;
   margin:0;
}
.specific-files-message {
   background:#f9f9f9;
   border:1px solid #d9d9d9;
   -webkit-border-radius:3px;
   -moz-border-radius:3px;
   border-radius:3px;
   padding:3px 4px;
}
</style>
<script type="text/javascript">
jQuery(document).ready(function($) {
   $("#specific-files_css_selectall").click(function() {
      $("#specific-files_css_files_list option").each(function(i) {
         $(this).attr("selected", "selected");
         specific_files_css_update_list();
      });
   });
   $("#specific-files_css_selectnone").click(function() {
      $("#specific-files_css_files_list option").each(function(i) {
         $(this).removeAttr("selected");
         specific_files_css_update_list();
      });
   });
   $("#specific-files_css_files_list").change(specific_files_css_update_list);
   function specific_files_css_update_list() {
      $("#specific-files_css_files").val($("#specific-files_css_files_list").val());
   }
   $("#specific-files_css_show_inline").colorbox({width:"90%", height:"90%", inline:true, href:"#specific-files_css_inline"});
   $("#specific-files_css_show_root").colorbox({width:"60%", height:"60%", inline:true, href:"#specific-files_css_root"});
});
</script>
END;

         // Print the first part of the meta box, the howto line and the handy selection options and the start of the <select> element.
         print "<p class=\"howto\">" . __( 'Select the CSS files to include with this post.', 'specific-files' ) . "</p>\n";

         if( sizeof( $css_array ) ) {
            print "<p>Select: <a href=\"javascript:void();\" id=\"specific-files_css_selectall\">" . __( 'all', 'specific-files' ) . "</a> &middot; <a href=\"javascript:void;\" id=\"specific-files_css_selectnone\">" . __( 'none', 'specific-files' ) . "</a></p>\n"
                 ."<input type=\"hidden\" value=\"" . $css_files . "\" id=\"specific-files_css_files\" name=\"specific-files_css_files\" />\n"
                 ."<select id=\"specific-files_css_files_list\" multiple=\"multiple\" style=\"width:100%;height:10em;\">\n";

            // Print an <option> for each CSS file in the $css_array. If the file is already selected, make it apparent.
            foreach( $css_array as $file ) {
               print "<option" . ( false !== strpos( $css_files, $file ) ? " selected=\"selected\"" : '' ) . " value=\"" . $file . "\">" . $file . "</option>\n";
            }

            print "</select>\n";
         } else {
            print "<p class=\"specific-files-message\">" . __( 'No files to list!', 'specific-files' ) . " <a href=\"" . SF_OPTIONS_URL . "\">" . __( 'Upload some CSS files!', 'specific-files' ) . "</a></p>";
         }

         if( !isset( $this->options['show_advanced_options'] ) || $this->options['show_advanced_options'] ) {
            print "<p><strong>" . __( 'Specific CSS Advanced Options', 'specific-files' ) . ":</strong><br />"
                 ." &middot; <a class=\"colorbox-inline\" title=\"Specific CSS Advanced Options\" href=\"javascript:void();\" id=\"specific-files_css_show_inline\">" . __( 'Edit inline CSS', 'specific-files' ) . "</a><br />"
                 ." &middot; <a class=\"colorbox-inline\" title=\"" . __( 'Specific CSS Advanced Options', 'specific-files' ) . "\" href=\"javascript:void();\" id=\"specific-files_css_show_root\">" . __( 'Include CSS files from anywhere', 'specific-files' ) . "</a></p>"
                 ."<div style=\"display:none;\">\n"
                 ."<div id=\"specific-files_css_inline\" style=\"padding:10px 15px;\">\n"
                 ."<h3 class=\"specific-files-header\">" . __( 'Insert Inline CSS', 'specific-files' ) . "</h3>\n"
                 ."<p>" . __( 'You can enter inline CSS in the textbox below and it will be applied to wherever this post or page is viewed in your theme. When you\'re finished, simply close this window. Your settings will be saved the next time you save your post or page.', 'specific-files' ) . "</p>\n"
                 ."<textarea name=\"specific-files_css_inline_css\" id=\"specific-files_css_inline_css\" style=\"width:97%;height:400px;\">" . $css_inline . "</textarea>\n"
                 ."</div>\n"
                 ."<div id=\"specific-files_css_root\" style=\"padding:10px 15px;\">\n"
                 ."<h3 class=\"specific-files-header\">" . __( 'Include CSS Files From Anywhere', 'specific-files' ) . "</h3>\n"
                 ."<p>" . __( 'To include CSS files from a separate location entirely, enter one CSS file per line into the textbox below. Specific Files will put whatever is entered per line directly into the &lt;link href=""&gt; attribute. Examples: http://www.example.com/some-css-file.css, /css/style.css', 'specific-files' ) . "</p>\n"
                 ."<p>" . __( 'When you\'re finished, simply close this window. Your settings will be saved the next time you save your post or page.', 'specific-files' ) . "</p>\n"
                 ."<textarea name=\"specific-files_css_root_css\" id=\"specific-files_css_root_css\" style=\"width:97%;height:200px;\">" . $css_root . "</textarea>\n"
                 ."</div>\n"
                 ."</div>\n";
         }
      }

      /**
       * This function is a callback of the two add_meta_box functions that are hooked into Wordpress via the 'add_meta_boxes' hook. It outputs the HTML of the meta box on the Wordpress editor admin page.
       *
       * @since 1.0
       */
      public function print_js_meta_box()
      {
         global $post;

         // Get the plugin's meta information for this particular post or page
         if( isset( $post->ID ) ) {
            $js_files = get_post_meta( $post->ID, '_specific-files_js_files', true );
            $js_inline = get_post_meta( $post->ID, '_specific-files_js_files_inline', true );
            $js_root = get_post_meta( $post->ID, '_specific-files_js_files_root', true );
         } else {
            $js_files = "";
            $js_inline = "";
            $js_root = "";
         }

         $js_array = array();

         // This reads the plugin's JS directory and compiles an array of JS files.
         if( $handle = opendir( SF_FILES_JS_DIR ) ) {
            while( false !== ( $file = readdir( $handle ) ) ) {
               if( 'js' == end( explode( '.', $file ) ) ) {
                  $js_array[] = $file;
               }
            }
         }

         closedir( $handle );

         // Sorted by filename for convenience
         sort( $js_array );

         // Since the value of a multiple <select> element is almost never right, we have jQuery calculate them and store them in a hidden input field as comma separated values.
         print <<<END
<input type="hidden" name="specific-files_hidden_js" id="specific-files_hidden_js" value="true" />
<style type="text/css">
.specific-files-header {
   font:normal 24px Georgia, "Times New Roman", Times, serif;
   margin:0;
}
.specific-files-message {
   background:#f9f9f9;
   border:1px solid #d9d9d9;
   -webkit-border-radius:3px;
   -moz-border-radius:3px;
   border-radius:3px;
   padding:3px 4px;
}
</style>
<script type="text/javascript">
jQuery(document).ready(function($) {
   $("#specific-files_js_selectall").click(function() {
      $("#specific-files_js_files_list option").each(function(i) {
         $(this).attr("selected", "selected");
         specific_files_js_update_list();
      });
   });
   $("#specific-files_js_selectnone").click(function() {
      $("#specific-files_js_files_list option").each(function(i) {
         $(this).removeAttr("selected");
         specific_files_js_update_list();
      });
   });
   $("#specific-files_js_files_list").change(specific_files_js_update_list);
   function specific_files_js_update_list() {
      $("#specific-files_js_files").val($("#specific-files_js_files_list").val());
   }
   $("#specific-files_js_show_inline").colorbox({width:"90%", height:"90%", inline:true, href:"#specific-files_js_inline"});
   $("#specific-files_js_show_root").colorbox({width:"60%", height:"60%", inline:true, href:"#specific-files_js_root"});
});
</script>
END;

         // Print the first part of the meta box, the howto line and the handy selection options and the start of the <select> element.
         print "<p class=\"howto\">" . __( 'Select the JS files to include with this post.', 'specific-files' ) . "</p>\n";

         if( sizeof( $js_array ) ) {
            print "<p>Select: <a href=\"javascript:void();\" id=\"specific-files_js_selectall\">" . __( 'all', 'specific-files' ) . "</a> &middot; <a href=\"javascript:void;\" id=\"specific-files_js_selectnone\">" . __( 'none', 'specific-files' ) . "</a></p>\n"
                 ."<input type=\"hidden\" value=\"" . $js_files . "\" id=\"specific-files_js_files\" name=\"specific-files_js_files\" />\n"
                 ."<select id=\"specific-files_js_files_list\" multiple=\"multiple\" style=\"width:100%;height:10em;\">\n";

            // Print an <option> for each JS file in the $js_array. If the file is already selected, make it apparent.
            foreach( $js_array as $file ) {
               print "<option" . ( false !== strpos( $js_files, $file ) ? " selected=\"selected\"" : '' ) . " value=\"" . $file . "\">" . $file . "</option>\n";
            }

            print "</select>\n";
         } else {
            print "<p class=\"specific-files-message\">" . __( 'No files to list!', 'specific-files' ) . " <a href=\"" . SF_OPTIONS_URL . "\">" . __( 'Upload some JS files!', 'specific-files' ) . "</a></p>";
         }

         if( !isset( $this->options['show_advanced_options'] ) || $this->options['show_advanced_options'] ) {
            print "<p><strong>" . __( 'Specific JS Advanced Options', 'specific-files' ) . ":</strong><br />"
                 ." &middot; <a class=\"colorbox-inline\" title=\"Specific JS Advanced Options\" href=\"javascript:void();\" id=\"specific-files_js_show_inline\">" . __( 'Edit inline JS', 'specific-files' ) . "</a><br />"
                 ." &middot; <a class=\"colorbox-inline\" title=\"" . __( 'Specific JS Advanced Options', 'specific-files' ) . "\" href=\"javascript:void();\" id=\"specific-files_js_show_root\">" . __( 'Include JS files from anywhere', 'specific-files' ) . "</a></p>"
                 ."<div style=\"display:none;\">\n"
                 ."<div id=\"specific-files_js_inline\" style=\"padding:10px 15px;\">\n"
                 ."<h3 class=\"specific-files-header\">" . __( 'Insert Inline JS', 'specific-files' ) . "</h3>\n"
                 ."<p>" . __( 'You can enter inline JS in the textbox below and it will be applied to wherever this post or page is viewed in your theme. When you\'re finished, simply close this window. Your settings will be saved the next time you save your post or page.', 'specific-files' ) . "</p>\n"
                 ."<textarea name=\"specific-files_js_inline_js\" id=\"specific-files_js_inline_js\" style=\"width:97%;height:400px;\">" . $js_inline . "</textarea>\n"
                 ."</div>\n"
                 ."<div id=\"specific-files_js_root\" style=\"padding:10px 15px;\">\n"
                 ."<h3 class=\"specific-files-header\">" . __( 'Include JS Files From Anywhere', 'specific-files' ) . "</h3>\n"
                 ."<p>" . __( 'To include JS files from a separate location entirely, enter one JS file per line into the textbox below. Specific Files will put whatever is entered per line directly into the &lt;script src=""&gt; attribute. Examples: http://www.example.com/javascript-file.js, /js/cool-jquery-plugin.js', 'specific-files' ) . "</p>\n"
                 ."<p>" . __( 'When you\'re finished, simply close this window. Your settings will be saved the next time you save your post or page.', 'specific-files' ) . "</p>\n"
                 ."<textarea name=\"specific-files_js_root_js\" id=\"specific-files_js_root_js\" style=\"width:97%;height:200px;\">" . $js_root . "</textarea>\n"
                 ."</div>\n"
                 ."</div>\n";
         }
      }

      /**
       * This function is a callback of the add_options_page function. It outputs the HTML of the settings page in the Wordpress Administration Panel.
       *
       * @since 1.0
       */
      public function options_page()
      {
         if ( !current_user_can( 'manage_options' ) ) {
            wp_die( __( 'You do not have sufficient permissions to access this page.', 'specific-files' ) );
         }

         if( !is_dir( SF_FILES_DIR ) ) {
            mkdir( SF_FILES_DIR, 0755 );
         }

         if( !is_dir( SF_FILES_CSS_DIR ) ) {
            mkdir( SF_FILES_CSS_DIR, 0755 );
         }

         if( !is_dir( SF_FILES_JS_DIR ) ) {
            mkdir( SF_FILES_JS_DIR, 0755 );
         }

         if( !is_writable( SF_FILES_CSS_DIR ) || !is_writable( SF_FILES_JS_DIR ) ) {
            chmodr( SF_FILES_DIR, 0755, 'd' ); // chmod SF_FILES_DIR and all subdirectories to 755
            chmodr( SF_FILES_DIR, 0644, 'f' ); // chmod all files in SF_FILES_DIR to 644
         }

         $is_dir = is_dir( SF_FILES_DIR );
         $is_writable = is_dir( SF_FILES_DIR );
         $css_files_is_dir = is_dir( SF_FILES_CSS_DIR );
         $css_files_is_writable = is_writable( SF_FILES_CSS_DIR );
         $js_files_is_dir = is_dir( SF_FILES_CSS_DIR );
         $js_files_is_writable = is_writable( SF_FILES_CSS_DIR );

         $css_file_error = 0;

         if( !empty( $_FILES['css_file_upload']['name'] ) ) { // Did they try to upload a CSS file?
            $file_name = preg_replace( "/[^\w\.-]/", '', strtolower( $_FILES['css_file_upload']['name'] ) );

            if( $css_files_is_dir && $css_files_is_writable ) {
               $file_path = SF_FILES_CSS_DIR . '/' . $file_name;
               $css_file_error = $_FILES['css_file_upload']['error'];
               $allowed_file_types = array( 'text/css' );

               if ( !in_array( $_FILES['css_file_upload']['type'], $allowed_file_types ) ) {
                  $css_file_error = 1;
               }

               if( $css_file_error == 0 && $file_name != "" ) {
                  if( $css_file_error = !move_uploaded_file( $_FILES['css_file_upload']['tmp_name'], $file_path ) ) {
                     @chmod( $file_path, 0644 );
                  }
               }
            }
         }

         $js_file_error = 0;

         if( !empty( $_FILES['js_file_upload']['name'] ) ) { // Did they try to upload a JS file?
            $file_name = preg_replace( "/[^\w\.-]/", '', strtolower( $_FILES['js_file_upload']['name'] ) );

            if( $js_files_is_dir && $js_files_is_writable ) {
               $file_path = SF_FILES_JS_DIR . '/' . $file_name;
               $js_file_error = $_FILES['js_file_upload']['error'];
               $allowed_file_types = array( 'text/javascript', 'application/x-javascript', 'application/javascript' );

               if ( !in_array( $_FILES['js_file_upload']['type'], $allowed_file_types ) ) {
                  $js_file_error = 1;
               }

               if( $js_file_error == 0 && $file_name != "" ) {
                  if( $js_file_error = !move_uploaded_file( $_FILES['js_file_upload']['tmp_name'], $file_path ) ) {
                     @chmod( $file_path, 0644 );
                  }
               }
            }
         }

         $css_file_array = array();
         $js_file_array = array();

         if( $css_files_is_dir && $handle = opendir( SF_FILES_CSS_DIR ) ) {
            while( false !== ( $file = readdir( $handle ) ) ) {
               if( 'css' == end( explode( '.', $file ) ) ) {
                  $css_file_array[] = $file;
               }
            }
         }

         closedir( $handle );

         if( $js_files_is_dir && $handle = opendir( SF_FILES_JS_DIR ) ) {
            while( false !== ( $file = readdir( $handle ) ) ) {
               if( 'js' == end( explode( '.', $file ) ) ) {
                  $js_file_array[] = $file;
               }
            }
         }

         closedir( $handle );

         if( isset( $_POST['submit'] ) ) {
            if( !wp_verify_nonce( isset( $_REQUEST['_wpnonce'] ) ? $_REQUEST['_wpnonce'] : '', 'specific-files' ) ) {
               die('Security check');
            }

            $options = array(
               'show_css_meta_box' => ( intval( $_POST['show_css_meta_box'] ) < 0 ) ? 0 : intval( $_POST['show_css_meta_box'] ),
               'show_js_meta_box' => ( intval( $_POST['show_js_meta_box'] ) < 0 ) ? 0 : intval( $_POST['show_js_meta_box'] ),
               'show_advanced_options' => ( intval( $_POST['show_advanced_options'] ) < 0 ) ? 0 : intval( $_POST['show_advanced_options'] ),
               'apply_to_all_post_types' => ( intval( $_POST['apply_to_all_post_types'] ) < 0 ) ? 0 : intval( $_POST['apply_to_all_post_types'] )
            );

            update_option( 'specific-files_options', $options );
            $this->options = get_option( 'specific-files_options' );
         }

         // Sorted by filename for convenience
         sort( $css_file_array );
         sort( $js_file_array );

         $post_types = get_post_types( array(
            'public' => true
         ) );

         include 'includes/settings-page.php';
      }
   }
}

// Start me up, Jagger!
$SpecificFiles = new SpecificFiles();
