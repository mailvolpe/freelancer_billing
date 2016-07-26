<?php

/* ========================================================
*
* Fonts Helper 
*
* ======================================================== */
/* ========================================================
	getGoogleFonts
/* ======================================================== */

if ( ! function_exists('getGoogleFonts')){

	function getGoogleFonts($primary=false, $secondary=false){
	
	
		if($secondary){
			return array(
				"Roboto"=>"Roboto",
				"ABeeZee"=>"ABeeZee",
				"Ruda"=>"Ruda",
				"Coda"=>"Coda",
				"Palanquin Dark"=>"Palanquin Dark",
				"Arya"=>"Arya"
			);
		}elseif($primary){
			return array(
				"Ubuntu"=>"Ubuntu",
				"Raleway"=>"Raleway",
				"Pontano Sans"=>"Pontano Sans",
				"Orienta"=>"Orienta",
				"Mallana"=>"Mallana",
				"Mandali"=>"Mandali",
				"Biryani"=>"Biryani",
			);
		}	
	
	
		#https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDSPsWD2p0eD0WdesswzdijuCbXzQ_yd1E @ Aqui se obter as fontes do Google Fonts
	
		$CI =& get_instance();
	
		$fonts_list = $CI->load->file('application/third_party/google_fonts/fonts_list.json', true);
		
		$fonts = json_decode($fonts_list)->items;
		
		$fonts_array[] = "Padrão";
		
		foreach($fonts as $font){
			$family = $font->family;
			$fonts_array[$family] = $family;
		}	
		
		return $fonts_array;
		
	}
	
}


?>