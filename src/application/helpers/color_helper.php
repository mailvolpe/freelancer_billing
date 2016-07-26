<?php

/* ========================================================
*
* Color Helper 
*
* ======================================================== */

/* ========================================================
	hex_to_rgb
/* ======================================================== */

if ( ! function_exists('hex_to_rgb')){

	function hex_to_rgb($hex){
	
		$hex = str_replace("#", "", $hex);
		
		$color = array();
 
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
 
		return $color['r'].', '.$color['g'].', '.$color['b'];
	
	
	}
	
}

/* ========================================================
	rgb_to_hex
/* ======================================================== */

if ( ! function_exists('rgb_to_hex')){

	function rgb_to_hex($rgb_color){

		$rgb_color = explode(",", $rgb_color);
		
		$r = trim($rgb_color[0]);
		$g = trim($rgb_color[1]);
		$b = trim($rgb_color[2]);	
	
		$hex = "#";
		$hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
		$hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
		$hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
 
		return $hex;	
	
	
	}
	
}

/* ========================================================
	define_rgb_colors
/* ======================================================== */

if ( ! function_exists('define_rgb_colors')){

	function define_rgb_colors($rgb_color, $light_contrast_factor = 2.9){
		
		$rgb_color = explode(",", $rgb_color);
		
		$r = trim($rgb_color[0]);
		$g = trim($rgb_color[1]);
		$b = trim($rgb_color[2]);
		
		$color['default_color'] = $r.", ".$g.", ".$b;
		
		$test_color = (($r*299)+($g*587)+($b*114))/1000;
		
		if($test_color >= 128){
			
			$r = round($r/$light_contrast_factor);
			$g = round($g/$light_contrast_factor);
			$b = round($b/$light_contrast_factor);

			$color['dark_color'] = "$r, $g, $b";
			$color['light_color'] = "$r, $g, $b";
			
		}else{
		
			$color['dark_color'] = "$r, $g, $b";
			$color['light_color'] = "255, 255, 255";
			
		}		
		
		return $color;
	
	}
	
}


/* End of file color_helper.php */
/* Location: ./application/helpers/color_helper.php */
?>