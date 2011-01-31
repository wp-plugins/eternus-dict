<?php
/*
* author : Eternus web d.o.o.
* Website : http://www.eternus-web.hr
* Copyright Eternus web all rights reserved
*/
/************************************************************************************************************/
?>
<?php
function eternus_dict_deactivate(){
	global $wpdb;

	$plugin_file = 'eternus_dict/eternus_dict.php';
	$page = 1;
?>

<div class="wrap">
	<h2 style="font-style:normal;">Are you sure you want to deactivate Eternus dict <?=eternus_dict_version?>?</h2>
	<p><a href="<?=wp_nonce_url('plugins.php?action=deactivate&amp;plugin='.$plugin_file.'&amp;plugin_status=all&amp;paged=' . $page, 'deactivate-plugin_' . $plugin_file)?>">Yes I am sure</a> | <a href="?page=eternus_dict/words.php">No, please back me to Eternus dict home page</a></p>

</div>


<?php
}

//add_action("admin_menu","mlang_config_menu"); 
?>