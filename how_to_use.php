<?php
/*
* author : Eternus web d.o.o.
* Website : http://www.eternus-web.hr
* Copyright Eternus web all rights reserved
*/
/************************************************************************************************************/
?>
<?php
function eternus_dict_how_to_use(){
?>

<div class="wrap">
	<h2>How to use Eternus dict <?=eternus_dict_version?>?</h2>
	<p style="text-decoration:underline;">1.</p>
	<p style="font-style:italic">
	put this code into <strong style="text-decoration:underline;">functions.php</strong> on the top of file which is in your theme folder (wp-content/themes/your-theme)
	
	<span style="color:#AF0000;">
	<br/><br/>
	&lt;?php<br/><br/>

	# ETERNUS DICT<br/>
	########################################################################<br/>
	if(function_exists('take_eternus_dict')){<br/>
		$ETERNUS_DICT = take_eternus_dict(ICL_LANGUAGE_CODE);<br/>
	}#end if<br/><br/>

		# here we take word we need<br/>
		############################################################<br/>
		function eternus_dict($call_key='') {<br/>
			if(empty($call_key)){<br/>
				return '';<br/>
			}else{<br/>
				GLOBAL $ETERNUS_DICT;<br/>
				return $ETERNUS_DICT[$call_key];<br/>
			}#end else<br/>
		}<br/>
		#end function<br/>
		############################################################<br/><br/>

	########################################################################<br/><br/>
	?&gt;<br/><br/>
	
	</span>
	</p>

	<p style="text-decoration:underline;">2. Hot to call in your theme files?</p>
	<p><span style="color:#AF0000;">&lt;?=eternus_dict('call_key')?&gt;</span></p>

</div>


<?php
}

//add_action("admin_menu","mlang_config_menu"); 
?>