<?php
/*
* author : Eternus web d.o.o.
* Website : http://www.eternus-web.hr
* Copyright Eternus web all rights reserved
*/
/************************************************************************************************************/
?>
<?php

# MENU SETTINGS
add_action('admin_menu', 'eternus_dict_add_pages');

# INCLUDE
include('words.php');
include('how_to_use.php');
include('admin_functions.php');

// action function for above hook
function eternus_dict_add_pages() {

    // Add a new top-level menu (ill-advised):
    add_menu_page(__('Eternus dict','menu-test'), __('Eternus dict','menu-test'), 'manage_options', 'eternus_dict/words.php', 'eternus_dict_word' );

	// Add a submenu to the custom top-level menu:
    add_submenu_page('eternus_dict/words.php', __('How to use?','how_to_use'), __('How to use?','how_to_use'), 'manage_options', 'eternus_dict/how_to_use.php', 'mt_sublevel_page');

	// Add a submenu to the custom top-level menu:
    add_submenu_page('eternus_dict/words.php', __('Deactivate','Deactivate'), __('Deactivate','Deactivate'), 'manage_options', 'eternus_dict/deactivate.php', 'mt_sublevel_page2');

}

// mt_sublevel_page() displays the page content for the first submenu
// of the custom Test Toplevel menu
function mt_sublevel_page() {
    eternus_dict_how_to_use();
}#end function

function mt_sublevel_page2() {
	include('deactivate.php');
	eternus_dict_deactivate();
}#end function
?>