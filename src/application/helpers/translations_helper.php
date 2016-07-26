<?php

/* ========================================================
*
* TRANSLATIONS 
*
* ======================================================== */

if ( ! function_exists('translations'))
{
	function translations($string, $translation_zone, $pk_id){
		
		$array = array(
			"string"=>$string,
			"translation_zone"=>$translation_zone,
			"pk_id"=>$pk_id
		);
		
		return load_view('translations/link', $array);
		
	}

}

/* End of file MY_form_helper.php */
/* Location: ./application/helpers/MY_form_helper.php */