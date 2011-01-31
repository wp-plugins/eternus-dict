<?php
/*
Plugin Name: Eternus dict
Plugin URI: http://www.eternus-dict.com/
Description: This plugin allows you to place content anywhere on the web page.
Version: 1.0
Author: Eternus web d.o.o.
Author URI: http://www.eternus-web.hr/
License: GPLv2
*/


/*  Copyright 2011 Eternus web d.o.o.  (email : info@eternus-dict.com )
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


# define
if ( ! defined( 'WPMLANG_PLUGIN_URL' ) )
	define( 'WPMLANG_FLAG_URL', '/wp-content/plugins/sitepress-multilingual-cms/res/flags/');
define( 'eternus_dict_version', '1.0');

# ETERNUS DICT FUNCTIONS
include('functions.php');

# here we check if WPML is installed
if(existsWPML()){define('ETERNUS_DICT_WPML', true);}else{define('ETERNUS_DICT_WPML', false);}



# end of define
# here we take all words for current language
############################################################
function take_eternus_dict($lang_code = '') {
	global $wpdb;
	if(ETERNUS_DICT_WPML){
		$word_object = $wpdb -> get_results("SELECT w.word, w.call_key FROM {$wpdb->prefix}icl_languages l, {$wpdb->prefix}eternus_dict w WHERE l.id = w.lang_id AND l.code = '".$lang_code."'");
	}else{
		$word_object = $wpdb -> get_results("SELECT w.word, w.call_key FROM {$wpdb->prefix}eternus_dict w WHERE w.lang_id = '0'");
	}#end else

	$words_array = objectToArray($word_object);
	if(is_array($words_array)){
		foreach($words_array AS $key=>$value){
			$dict[$value['call_key']] = $value['word'];
		}#end foreach
	}else{
		$dict = array();
	}#end if
	return $dict;
}
#end function
############################################################


# object => array
############################################################
function objectToArray($object){
        if(!is_object($object) && !is_array($object)){return $object;}
        if(is_object($object ) ){$object = get_object_vars($object);}
        return array_map('objectToArray', $object);
}
#end function
############################################################

# WP ADMIN MENU SETTINGS
include('admin_menu.php');
?>