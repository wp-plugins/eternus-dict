<?php
/*
* author : Eternus web d.o.o.
* Website : http://www.eternus-web.hr
* Copyright Eternus web all rights reserved
*/
/************************************************************************************************************/
?>
<?php
function eternus_dict_word(){
	global $wpdb;



if($_REQUEST['action'] == 'edit'){
	
	$word_id = filtriranje($_GET['word_id']);
	$word_row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}eternus_dict WHERE word_id = '".$word_id."' LIMIT 1");

}#end if

if($_REQUEST['action'] == 'delete'){
	
	$word_id = filtriranje($_GET['word_id']);
	$word_row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}eternus_dict WHERE word_id = '".$word_id."' LIMIT 1");
	$wpdb->query("DELETE FROM {$wpdb->prefix}eternus_dict WHERE word_id = '".$word_id."' LIMIT 1");
	$poruka = '<div style="margin:15px 0 0 0;" class="updated below-h2" id="message"><p>You have successfully deleted word <strong style="text-decoration:underline;">'.$word_row->word.'</strong></p></div>';
}#end if

# UPDATE
if(isset($_POST['update'])){
	$word = filtriranje($_POST['word']);

	if(!empty($word)){

		$lang_id = filtriranje($_POST['lang_id']);
		
		$wpdb->query("UPDATE {$wpdb->prefix}eternus_dict SET word='".$word."' WHERE word_id = '".$word_id."' LIMIT 1");
	
		$poruka =  '<div style="margin:15px 0 0 0;" class="updated below-h2" id="message"><p>Word is updated from <strong style="text-decoration:underline;">'.$word_row->word.'</strong> to <strong style="text-decoration:underline;">'.$_POST['word'].'</strong></p></div>';
	
		$word_row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}eternus_dict WHERE word_id = '".$word_id."' LIMIT 1");

	}#end if

# INSERT
}elseif(isset($_POST['insert'])){
	
	$word = filtriranje($_POST['word']);
	$call_key = filtriranje($_POST['word']);
	$call_key = get_eternus_dict_call_key($call_key);

	if(!empty($word)){
			
		createEDMysqlTable();
		
		$word_object = $wpdb -> get_results("SELECT * FROM {$wpdb->prefix}icl_languages l WHERE l.active='1' ORDER BY english_name ASC");
		$words_array = objectToArray($word_object);

		if(!is_array($words_array)){$words_array = array();}
	
		if(count($words_array) > 0){
			
			foreach($words_array AS $key=>$value){
	
				$wpdb->query("INSERT INTO {$wpdb->prefix}eternus_dict SET word='".$word."', call_key='".$call_key."', lang_id='".$value['id']."'");	
	
			}#end foreach
	
		}else{
			
			$wpdb->query("INSERT INTO {$wpdb->prefix}eternus_dict SET word='".$word."', call_key='".$call_key."', lang_id='0'");	

		}#end else
			
	}#end if
	
}#end elseif


if($_GET['insert']=='1'){
	$poruka =  '<div style="margin:15px 0 0 0;" class="updated below-h2" id="message"><p>Word is updated from <strong style="text-decoration:underline;">'.$word_row->word.'</strong> to <strong style="text-decoration:underline;">'.$_POST['word'].'</strong></p></div>';
}#end if

?>











    <div class="wrap">
    <h2>WP Eternus dict <?=eternus_dict_version?></h2>
    <p>
    	<table class="widefat" style="margin-top:4px;" width="300px">
        <thead>
        	<tr>
				
				<?php if(ETERNUS_DICT_WPML){?>
					<th scope="col" width="180px">Word</th>
					<th scope="col" width="150px" style="text-align:center">Call key</th>
					<th scope="col" width="50px" style="text-align:center">Language</th>
					<th scope="col" width="50px" style="text-align:center">Flag</th>
				<?php }else{?>
					<th scope="col">Word</th>
					<th scope="col" style="text-align:center">Call key</th>
				<?php }?>

                <th scope="col" width="50px" style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody id="the-list">
		<?php

		# if is WPML INSTALLED
		if(ETERNUS_DICT_WPML){

			$word_object = $wpdb -> get_results("
			SELECT 
				w.word_id, w.call_key, f.flag, l.english_name, w.word, w.call_key 
			FROM 
				{$wpdb->prefix}eternus_dict w 
				LEFT JOIN ({$wpdb->prefix}icl_languages l, {$wpdb->prefix}icl_flags f) 
				ON (l.id = w.lang_id  AND l.code = f.lang_code)
			ORDER BY w.word ASC");
			
		# if WPML IS NOT INSTALLED
		}else{

			$word_object = $wpdb -> get_results("
			SELECT w.word_id, w.call_key, w.word, w.call_key FROM {$wpdb->prefix}eternus_dict w ORDER BY w.word ASC");

		}#end else

		$words_array = objectToArray($word_object);
		
		if(is_array($words_array)){
			
			foreach($words_array AS $key=>$value){
				//$value['word'];
			

				echo'
				<tr class="alternate">
					  <td style="text-align:left;">'.$value['word'].'</td>
					  <td style="text-align:center;">'.$value['call_key'].'</td>';
				
				if(ETERNUS_DICT_WPML){
					echo'
					  <td style="text-align:center;">'.$value['english_name'].'</td>
					  <td style="text-align:center;"><img src="'.WPMLANG_FLAG_URL.'/'.$value['flag'].'" title="Flag" /></td>
					';
				}#end if
				
				 echo'
					 <td style="text-align:center;">
					  
					  <a href="?page=eternus_dict/words.php&action=edit&word_id='.$value['word_id'].'" title="Edit">Edit</a>&nbsp;&brvbar;&nbsp;<a href="?page=eternus_dict/words.php&action=delete&word_id='.$value['word_id'].'" title="Delete">Delete</a></td>
				</tr>';	

			}#end foreach

		}#end if

			
		?>
        </tbody>
        </table>
    </p>

<?=$poruka?>

<p><?php if($_REQUEST['action'] == 'edit') _e("<span style=\"text-align:left\"><a href=\"?page=eternus_dict/words.php\" title=\"Add New word\">Add New Word</a></span>"); ?></p>

    <fieldset style="border:solid 1px #888; margin-top:20px; padding-left:10px;">
   
	<legend style="margin:-10px 5px 0 0"><h3><?php if($_REQUEST['action'] == 'edit') _e('Editing word', '' );  else _e('Insert new word', '' ); ?></h3></legend>
   
	<form style="margin-top:5px;" name="form1" method="post" action="?page=eternus_dict/words.php<?php if($_REQUEST['action'] == 'edit'){echo'&action=edit&word_id='.$_GET['word_id'];}else{echo '';}?>">
    
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="<?php if($_REQUEST['action'] == 'edit') echo"U"; else echo"Y"; ?>" />
		
		<p>
			<label title="Word"><b>Word</b></label><br />
			<input style="width:400px;" type="text" name="word" value="<?php if($_REQUEST['action'] == 'edit') echo $word_row->word; else echo""; ?>" />
		</p>
		
		
		
		<?php if($_REQUEST['action'] == 'edit'){?>

		<p>
			<label><b>Call key (Word Code)</b></label><br />
			<input style="width:400px;" type="text" maxlength="2" name="call_key"  value="<?php if($_REQUEST['action'] == 'edit') echo $word_row->call_key.'" readonly="readonly"'; else echo""; ?>" /> 
			<?php if($_REQUEST['action'] == 'edit'){echo '<span style="color:#AF0000;">&lt;?=eternus_dict(\''.$word_row->call_key.'\')?&gt;</span>';}?>
		</p>

				<?php if(ETERNUS_DICT_WPML){?>
						
					<p>
						<label><b>Language</b></label><br />
						<select name="lang_id" disabled="disabled">
						<?php
						$word_object = $wpdb -> get_results("
						SELECT 
							*
						FROM 
							
							{$wpdb->prefix}icl_languages l
						
						WHERE 
						
							l.active='1'
							
						ORDER BY english_name ASC");
						$words_array = objectToArray($word_object);
				
						if(is_array($words_array)){
							
							foreach($words_array AS $key=>$value){

								echo'<option ';

								if($word_row->lang_id == $value['id']){echo ' selected="selected" ';}
								
								echo ' value="'.$value['id'].'">'.$value['english_name'].'</option>';	

							}#end foreach

						}#end if
						?>
						</select>
					</p>
				<?php }?>

				
		<?php }?>
		
		<p class="submit">
		<input type="submit" name="<?php if($_REQUEST['action'] == 'edit') _e('update');  else _e('insert'); ?>" value="<?php if($_REQUEST['action'] == 'edit') _e('Update Word', 'mlang' );  else _e('Add Word', 'mlang' ); ?>" />
		</p>
    </form>

    </fieldset>
    <br />

</div>


<?php
}

//add_action("admin_menu","mlang_config_menu"); 
?>