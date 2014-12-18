<?php
/**
 * Specific Files plugin options page. Included by SpecificFiles::options_page()
 *
 * @author Daniel Imhoff
 * @package WordPress
 * @subpackage SpecificFiles
 * @since 1.0

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
?>
<style type="text/css">
#poststuff {
   min-width: inherit;
}
#poststuff h3 {
   cursor:default;
}
#poststuff h2 {
   margin:20px 0 0;
}
#specific-files .file_list {
   list-style:none;
}
#specific-files .file_list li {
   background:#f1f1f1;
   margin:0 0 5px;
   padding:1px 5px 3px;
}
#specific-files .file_list li a.filename {
   display:block;
   background:url("<?php print SF_PLUGIN_URL; ?>/img/page_white_code.png") center left no-repeat;
   padding:5px 20px;
}
#specific-files .file_list li .rightlinks {
   float:right;
}
#specific-files .file_list li .rightlinks a {
   text-decoration:none;
}
#specific-files .file_list li .delete {
   color:#f00;
}
.postbox#donate {
   border:2px solid #080;
}
.postbox#donate h3 {
   color:#080;
}
</style>
<script type="text/javascript">
function jq(myid) { 
   return '#' + myid.replace(/(:|\.)/g,'\\$1');
}
function get_file_ext(filename) {
   var ext = /^.+\.([^.]+)$/.exec(filename);
   return ext == null ? "" : ext[1];
}
jQuery(document).ready(function($) {
   $(".file_list .delete").click(function() {
      var filename = $(this).closest('li').attr('id');
      $(jq(filename)).css('background', '#df8c8c');
      $(jq(filename) + " .rightlinks").html("<span>deleting...</span>");
      var data = {
         action: 'specific_delete_' + get_file_ext(filename) + '_file',
         file: filename
      };
      $.post(ajaxurl, data, function(response) {
         response = $.trim(response);
         if(response == filename) {
            $(jq(filename)).hide();
         } else {
            alert("<?php _e( 'Could not delete file.  Response was', 'specific-files' ); ?>: " + response);
            $(jq(filename) + " .rightlinks").html("<span>error</span>");
         }
      });
   });
   $(".file_list .view").colorbox({opacity:0.5, width:"80%", height:"90%", iframe:true});
});
</script>
<div id="specific-files" class="wrap">
<?php screen_icon('options-general'); ?>
<h2><?php _e( 'Specific Files', 'specific-files' ); ?></h2>
<br class="clear" />
<?php if( !$is_dir || !$is_writable ) : ?>
<div id="message" class="error fade"><p><?php printf( __( 'The file directory is either missing or has incorrect permissions and I can\'t fix it! Please chmod all folders to 755 and all files to 644 in %s for this plugin to work correctly.', 'specific-files' ), '<code>' . SF_PLUGIN_DIR . '</code>' ); ?></p></div>
<?php endif; ?>
<?php if( $css_file_error ) : ?>
<div id="message" class="error fade"><p><?php _e('There was an error while uploading your CSS file. Remember, only files with extension .css are allowed. Please try again.', 'specific-files' ); ?></p></div>
<?php endif; ?>
<?php if( $js_file_error ) : ?>
<div id="message" class="error fade"><p><?php _e('There was an error while uploading your JS file. Remember, only files with extension .js are allowed. Please try again.', 'specific-files' ); ?></p></div>
<?php endif; ?>
<?php $nonce = wp_create_nonce( 'specific-files' ); ?>
<form method="post" id="specific-files_options" name="specific-files_options" action="<?php print SF_OPTIONS_URL . '&amp;_wpnonce=' . $nonce; ?>" enctype="multipart/form-data">
<div class="postbox-container" style="width:69%;">
<div id="poststuff">
<div class="postbox">
<h3>Settings</h3>
<div class="inside">
<table class="form-table">
<tr>
<th scope="row"><?php _e( 'Show CSS meta box?', 'specific-files' ); ?></th>
<td>
<label><input type="radio" <?php if(!isset($this->options['show_css_meta_box']) || $this->options['show_css_meta_box']) print 'checked="checked" '; ?>value="1" name="show_css_meta_box" /> <?php _e( 'Yes', 'specific-files' ); ?></label>
<label><input type="radio" <?php if(isset($this->options['show_css_meta_box']) && !$this->options['show_css_meta_box']) print 'checked="checked" '; ?>value="0" name="show_css_meta_box" /><?php _e( 'No', 'specific-files' ); ?></label>
<p><?php _e( 'If checked, Specific Files will display the CSS meta box on all post editors.', 'specific-files' ); ?></p>
</td>
</tr><tr>
<th scope="row"><?php _e( 'Show JS meta box?', 'specific-files' ); ?></th>
<td>
<label><input type="radio" <?php if(!isset($this->options['show_js_meta_box']) || $this->options['show_js_meta_box']) print 'checked="checked" '; ?>value="1" name="show_js_meta_box" /> <?php _e( 'Yes', 'specific-files' ); ?></label>
<label><input type="radio" <?php if(isset($this->options['show_js_meta_box']) && !$this->options['show_js_meta_box']) print 'checked="checked" '; ?>value="0" name="show_js_meta_box" /> <?php _e( 'No', 'specific-files' ); ?></label>
<p><?php _e( 'If checked, Specific Files will display the JS meta box on all post editors.', 'specific-files' ); ?></p>
</td>
</tr><tr>
<th scope="row"><?php _e( 'Show advanced options?', 'specific-files' ); ?></th>
<td>
<label><input type="radio" <?php if(!isset($this->options['show_advanced_options']) || $this->options['show_advanced_options']) print 'checked="checked" '; ?>value="1" name="show_advanced_options" /> <?php _e( 'Yes', 'specific-files' ); ?></label>
<label><input type="radio" <?php if(isset($this->options['show_advanced_options']) && !$this->options['show_advanced_options']) print 'checked="checked" '; ?>value="0" name="show_advanced_options" /> <?php _e( 'No', 'specific-files' ); ?></label>
<p><?php _e( 'If checked, Specific Files will display the advanced options (editing inline code and including files from any location) on all meta boxes.', 'specific-files' ); ?></p>
</td>
</tr><tr>
<th scope="row"><?php _e( 'Apply to all post types?', 'specific-files' ); ?></th>
<td>
<label><input type="radio" <?php if(!isset($this->options['apply_to_all_post_types']) || $this->options['apply_to_all_post_types']) print 'checked="checked" '; ?>value="1" name="apply_to_all_post_types" /> <?php _e( 'Yes', 'specific-files' ); ?></label>
<label><input type="radio" <?php if(isset($this->options['apply_to_all_post_types']) && !$this->options['apply_to_all_post_types']) print 'checked="checked" '; ?>value="0" name="apply_to_all_post_types" /> <?php _e( 'No', 'specific-files' ); ?></label>
<?php
$list_of_post_types = '';
foreach( $post_types as $post_type ) {
   $list_of_post_types .= $post_type . ', ';
}
?>
<p><?php printf( __( 'If checked, Specific Files will attempt to apply the Specific Files meta boxes to all public post types (%s), including custom post types. If left unchecked, Specific Files will only apply the meta boxes to posts and pages.', 'specific-files' ), rtrim( $list_of_post_types, ', ' ) ); ?></p>
</td>
</tr>
</table>
<input type="submit" class="button-primary" value="<?php _e('Update Options', 'specific-files' ); ?>" name="submit" />
</div>
</div>
</div>
<div id="poststuff">
<div class="postbox">
<h3><?php _e('List of CSS files', 'specific-files'); ?></h3>
<div class="inside">
<ul id="css_file_list" class="file_list">
<?php
if( empty( $css_file_array ) ) {
   print "<li style=\"background-color:#fff\"><i>" . __( 'No CSS files to list', 'specific-files' ) . "</i></li>\n";
} else {
   foreach( $css_file_array as $file ) {
      print "<li id=\"" . $file . "\"><span class=\"rightlinks\"><a class=\"view\" href=\"" . SF_FILES_CSS_URL . '/' . $file . "\" title=\"" . $file . "\">view</a> <a class=\"delete\" href=\"javascript:void();\">delete</a></span><a class=\"filename view\" href=\"" . SF_FILES_CSS_URL . '/' . $file . "\" title=\"" . $file . "\">" . $file . "</a></li>";
   }
}
?>
</ul>
<h2><?php _e( 'Upload a CSS file', 'specific-files' ); ?></h2>
<table cellspacing="2" cellpadding="0" border="0">
<tr>
<td>
<input type="file" id="css_file_upload" name="css_file_upload" />
</td>
<td>
<input type="submit" class="button" value="<?php _e('Upload file', 'specific-files' ); ?>" name="submit" />
</td>
</tr>
</table>
</div>
</div>
</div>
<div id="poststuff">
<div class="postbox">
<h3><?php _e( 'List of JS files', 'specific-files' ); ?></h3>
<div class="inside">
<ul id="js_file_list" class="file_list">
<?php
if( empty( $js_file_array ) ) {
   print "<li style=\"background-color:#fff\"><i>" . __( 'No JS files to list', 'specific-files' ) . "</i></li>\n";
} else {
   foreach( $js_file_array as $file ) {
      print "<li id=\"" . $file . "\"><span class=\"rightlinks\"><a class=\"view\" href=\"" . SF_FILES_JS_URL . '/' . $file . "\" title=\"" . $file . "\">view</a> <a class=\"delete\" href=\"javascript:void();\">delete</a></span><a class=\"filename view\" href=\"" . SF_FILES_JS_URL . '/' . $file . "\" title=\"" . $file . "\">" . $file . "</a></li>";
   }
}
?>
</ul>
<h2><?php _e( 'Upload a JS file', 'specific-files' ); ?></h2>
<table cellspacing="2" cellpadding="0" border="0">
<tr>
<td>
<input type="file" id="js_file_upload" name="js_file_upload" />
</td>
<td>
<input type="submit" class="button" value="<?php _e('Upload file', 'specific-files' ); ?>" name="submit" />
</td>
</tr>
</table>
</div>
</div>
</div>
</div>
<div class="postbox-container" style="width:25%;margin-left:20px;">
<div id="poststuff">
<div class="postbox">
<h3><?php _e( 'Information', 'specific-files' ); ?></h3>
<div class="inside">
<p><?php printf( __( 'If you prefer to upload via FTP, upload your CSS files to %s and your JS files to %s.', 'specific-files' ), '<code>' . SF_FILES_CSS_DIR . '</code>', '<code>' . SF_FILES_JS_DIR . '</code>' ); ?></p>
<p><?php _e( 'However, deleting these files with your FTP client will <strong>not</strong> remove the references to them on the pages that call them. Use the delete buttons on this page to remove all references of a file.', 'specific-files' ); ?></p>
</div>
</div>
</div>
<div id="poststuff">
<div id="donate" class="postbox">
<h3><?php _e( 'Donate', 'specific-files' ); ?></h3>
<div class="inside">
<p><?php _e( 'If you find this plugin useful and want to say thanks, please consider making a donation through Paypal. You can do this by visiting my <a href="http://www.danielimhoff.com/donations/">donation page</a>.', 'specific-files' ); ?></p>
</div>
</div>
</div>
</div>
</form>
<div class="clear">
<p><?php _e( 'Specific Files Wordpress Plugin', 'specific-files' ); echo ' ' . SF_VERSION; ?> &copy; 2014 - <a href="http://www.danielimhoff.com/">Daniel Imhoff</a></p>
</div>
