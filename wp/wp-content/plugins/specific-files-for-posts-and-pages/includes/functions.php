<?php
/**
 * Helper functions for Specific Files plugin.
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

// This function is called by Specific Files when people are deleting references of the CSS and JS files in the posts.
if( !function_exists( 'remove_element' ) ) {
   /**
    * This function removes an element from an array.
    *
    * @author Daniel Imhoff
    * @param $array The array to remove the element from.
    * @param $element The element to remove from the array.
    * @since 1.1
    */
   function remove_element( $array, $element ) {
      for( $i = 0; $i < sizeof($array); ++$i ) {
         if( $array[$i] == $element ) {
            unset( $array[$i] );
         }
      }

      return $array;
   }
}

// This function may be called by Specific Files if file permissions aren't quite right for some reason.
if( !function_exists( 'chmodr' ) ) {
   /**
    * This function is for recursively chmod'ing a directory. 
    *
    * @author Daniel Imhoff
    * @param $path string Path to the file. Any format that chmod would accept.
    * @param $filemode int The mode to chmod the file and subfiles.
    * @param $mode string The mode of the function. Pass certain letters to change functionality:
    *          'f' chmod all files
    *          'd' chmod all directories
    * @since 1.0
    */
   function chmodr( $path, $filemode, $mode = 'fd' ) {
      if( !is_dir( $path ) && false === strpos( $mode, 'f' ) ) { // It's a file, but we're not supposed to chmod files. Kick out.
         return false; 
      } elseif( !is_dir( $path ) ) { // It's a file and we're supposed to chmod files. Do it. We're done. Kick out.
         return chmod( $path, $filemode );
      } else { // It's a directory, we need to go inside.
         $dh = opendir($path);
            if( false !== strpos( $mode, 'd' ) && !chmod( $path, $filemode ) ) { // It's a directory, and we're supposed to chmod directories. Do it. We're done. Kick out.
               return false;
            }
            while( false !== ( $file = readdir( $dh ) ) ) {
            if( $file != '.' && $file != '..' ) {
               $fullpath = $path . '/' . $file;
               if( !is_dir( $fullpath ) && false !== strpos( $mode, 'f' ) && !chmod( $fullpath, $filemode ) ) { // It's a file and we're supposed to chmod files. Do it. Move on, unless chmod failed.
                  return false;
               } elseif( !chmodr( $fullpath, $filemode, $mode ) ) { // It's a directory, start recursion. Move on, unless chmodr failed.
                  return false;
               } // All other cases are ignored, and the loop continues.
            }
         }
         closedir($dh);
         return true; // If we got to this line, everything went smoothly. We're done. Kick out.
      }
   }
}

