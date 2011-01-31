<?php
/*
* author : Eternus web d.o.o.
* Website : http://www.eternus-web.hr
* Copyright Eternus web all rights reserved
*/
/************************************************************************************************************/
?>
<?php

###########################################################################
#
#                   validName
#
############################################################################
function validName($string){
	$from_croatian = array('š', 'đ', 'ž', 'č', 'ć', 'Š', 'Đ', 'Ž', 'Č', 'Ć');
    $to_safe = array('s', 'dj', 'z', 'c', 'c', 's', 'dj', 'z', 'c', 'c');
    $string = str_replace($from_croatian,$to_safe,$string);
	$string = trim($string);
    $string = strtolower($string);
	$string = preg_replace('([^a-zA-Z0-9_])', '',$string);

	# filtriranje dvostrukih i više povlaka
	$string = preg_replace('{(_)\1+}','$1',$string);
	return $string;
}#
############################################################################


#############################################################################################################
#
#     FUNKCIJA ZA FILTRIRANJE UNOSA
#
#############################################################################################################
function filtriranje($value){
    if(get_magic_quotes_runtime()){
		// Deactive
		set_magic_quotes_runtime(false);
    }#end IF
    if(get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }else{
        $value  = $value;
    }#end ELSE
    $value = addslashes(trim($value));
    $value = stripslashes($value);
    $value = "".mysql_real_escape_string($value)."";   
 
     return $value;                       
}                                                            
#############################################################################################################

###########################################################################
#
#                   get_eternus_dict_call_key
#
############################################################################
function get_eternus_dict_call_key($call_key){
	global $wpdb;
	$call_key = validName($call_key);

	# provjera dali postoji navedeni URL uopće u tablici URL-ova
	$check = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}eternus_dict WHERE call_key = '".$call_key."' LIMIT 1");

	if(is_object($check)){
		
		# sad provjerim dali se to radi o trenutnom predmetu
			$prolaz = true;
			
			$i=2;
			while($prolaz){
				$call_key_i = $call_key.$i;
				
				$check_while = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}eternus_dict WHERE call_key = '".$word_i."' LIMIT 1");
				if(!is_object($check_while)){$call_key = $call_key_i;break;}

				if($i==100){break;}
				++$i;
			}#end while
	}#end if

	return $call_key;
}#
############################################################################


###########################################################################
#
#                   redirect
#
############################################################################
function redirect($url){  
    echo '<script type="text/javascript">window.location="'.$url.'"</script>';
    exit();    
}#
############################################################################

###########################################################################
#
#                   createEDMysqlTable
#
############################################################################
function createEDMysqlTable(){  
    global $wpdb;
	$wpdb -> query("CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}eternus_dict` (
	  `word_id` int(11) NOT NULL auto_increment,
	  `word` varchar(500) NOT NULL,
	  `call_key` varchar(50) NOT NULL,
	  `lang_id` int(11) NOT NULL,
	  PRIMARY KEY  (`word_id`),
	  KEY `lang_id` (`lang_id`),
	  KEY `call_key` (`call_key`),
	  KEY `word` (`word`(333))
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	");  
}#
############################################################################

###########################################################################
#
#                   existsWPML
#
############################################################################
function existsWPML(){  
    global $wpdb;
	$word_object = $wpdb -> get_results("show tables like '{$wpdb->prefix}icl_languages'");
	if(is_object($word_object)){
		return false;
	}else{
		return false;
	}#end else
}#
############################################################################

?>