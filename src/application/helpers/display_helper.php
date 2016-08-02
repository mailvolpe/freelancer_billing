<?php

/* ========================================================
*
* Display Helper 
*
* ======================================================== */

if( ! function_exists('explain_recurrency')){

	function explain_recurrency($day, $month=false)
	{

		$explanation = '';
	
		$CI =& get_instance();
		
		if($month){
		
			$explanation = $CI->lang->line('yearly').' ';
			#$explanation .= $CI->lang->line('on_day').' ';
			$explanation .= $day.'/'.$CI->lang->line('month_'.$month);
			
		}else{
		
			$explanation = $CI->lang->line('monthly').' ';
			$explanation .= $CI->lang->line('on_day').' ';
			$explanation .= $day;
		}
		
		
		return $explanation;
	
		
	}
	
}


if( ! function_exists('format_id')){

	function format_id($int, $prepend='#')
	{

		if(strlen($int)<4){
		
			return $prepend.str_pad($int, 4, 0, STR_PAD_LEFT);
			
		}
		
		return $prepend.$int;
	
		
	}
	
}

if( ! function_exists('ucwords_accent')){

	function ucwords_accent($string)
	{
		if (mb_detect_encoding($string) != 'UTF-8') {
			$string = mb_convert_case(utf8_encode($string), MB_CASE_TITLE, 'UTF-8');
		} else {
			$string = mb_convert_case($string, MB_CASE_TITLE, 'UTF-8');
		}
		return $string;
	}
	
}


/* ========================================================
	currency
	Display formatted currency
/* ======================================================== */

if( ! function_exists('format_currency')){

	function format_currency($value){
	
		$CI =& get_instance();
			
		$decimal_separator = strlen($CI->lang->line('decimal_separator'))==1 ? $CI->lang->line('decimal_separator') : ',';
		
		$thousand_separator = strlen($CI->lang->line('thousand_separator'))==1 ? $CI->lang->line('thousand_separator') : '.';
		
		$currency_symbol = strlen($CI->lang->line('currency_symbol'))<=4 ? $CI->lang->line('currency_symbol') : 'R$ ';
		
		return '<span class="small">'.$currency_symbol.'</span>'.number_format($value, 2, $decimal_separator, $thousand_separator);			
	
	}

}

/* ========================================================
	load_view
	Loads the view and passes parameters
/* ======================================================== */

if( ! function_exists('load_view')){

	function load_view($view_name, $settings){
	
		#Load view into view
		
		$CI =& get_instance();
		
		$field = $CI->load->view('template/admin_components/'.$view_name, $settings, true);
		
		return $field;			
	
	}

}



/* ========================================================
	format_value
	Format a value field for filter description tags
	
	$value - value string to be checked and modified against function rules
/* ======================================================== */
if ( ! function_exists('format_value')){

	function format_value($value){
	
		#Empty rule
		
		if($value === ''){
		
			$value = false;
			
		}
	
		#Date values check if it has time

		if(preg_match('/\d{4}-\d{2}-\d{2}/', $value)){
		
			$value = human_date($value);
		
		}
		
		#Returns
		
		return $value;
	
	}
	
}


/* ========================================================
	Format_key
	Format a key field for filter description tags
	
	$key - key name to be checked and modified against function rules
/* ======================================================== */
if ( ! function_exists('format_key')){

	function format_key($key){
		
		#Hide _display and offset filtering
		
		if((strstr($key, "_display") AND !strstr($key, "_display_")) OR $key === 'offset' OR $key === 'order_by' OR $key === 'limit' ){
		
			$key = false;
		
		}
		
		return $key;
	
	}
	
}


/* ========================================================
	Display_bool_value
	Shows values (yes or no) for bool
	
	$key - key name to be checked and modified against function rules
/* ======================================================== */
if ( ! function_exists('display_bool_value')){

	function display_bool_value($value, $yes_line = false, $no_line = false, $success_value = null, $danger_value = null){
		
		$CI =& get_instance();
		
		if($value>0){
		
			if(!$yes_line){
			
				$return = $CI->lang->line('yes');
				
			}else{
			
				$return = $yes_line;
				
			}
			
		}else{
		
		
			if($no_line){
			
				$return = $no_line;
				
			}elseif(!$yes_line){

				$return = $CI->lang->line('no');

			}else{

				$return = false;
				
			}		
			
		
		}

		if($success_value == $value){

			$return ="<strong class='text-success'>".$return."</strong>";

		}

		if($danger_value == $value){

			$return ="<strong class='text-danger'>".$return."</strong>";

		}



		return $return;
	
	}
	
}



/* ========================================================
	display_label
	Shows values inside bootstrap label
	
	$value - text to show inside label
	$class - bootstrap label class
/* ======================================================== */
if ( ! function_exists('display_label')){

	function display_label($value, $label_class = 'label-default', $spacer = ' '){
		
		return '<label class=\'label '.$label_class.'\'>'.$value.'</label>'.$spacer;
	
	}
	
}


/* ========================================================
	icon_popover
	Shows icon_popover
	
	$icon_class - Londinium icon class
	$value - HTML value
/* ======================================================== */
if ( ! function_exists('icon_popover')){

	function icon_popover($content = '', $title = '', $icon_class='icon-search2'){
		
		return '
		
			<a class="btn  btn-default btn-icon" data-container="body" data-toggle="popover" data-placement="top" data-content="'.$content.'" data-html="true" title="'.$title.'">
		
				<i class="'.$icon_class.'"></i>
				
			</a>
			
		';
	
	}
	
}


/* ========================================================
	icon_tooltip
	Shows icon_tooltip
	
	$icon_class - Londinium icon class
	$value - HTML value
/* ======================================================== */
if ( ! function_exists('icon_tooltip')){

	function icon_tooltip($content = '', $icon_class='icon-search2', $href='javascript:void(0);'){
		
		return '

			<a href="'.$href.'" class="btn btn-link btn-icon tip" data-placement="top" title="" data-original-title="'.$content.'">
			
				<i class="'.$icon_class.'"></i>
				
			</a>
			
		';
	
	}
	
}

/* ========================================================
	format_address
	Formats Address

/* ======================================================== */
if ( ! function_exists('format_address')){

	function format_address($street, $number, $complement, $area, $city, $state, $zip_code, $exception=''){
		
		$string = $street;
		
		if($number){$string .= ', '.$number;}
		
		if($complement){$string .= ' ('.$complement.')';}
		
		if($area){$string .= ' - '.$area;}
		
		if($city){$string .= '<br>'.$city;}
		
		if($state){$string .= ' - '.$state;}
		
		if($zip_code){$string .= '<br>'.$zip_code;}
	
		if(!$string){$string = $exception;}
	
		return $string;
	
	}
	
}


/* ========================================================
	format_address
	Formats Address

/* ======================================================== */
if ( ! function_exists('truncate_string')){

	function truncate_string($string,$length=140,$append="&hellip;") {

		return ellipsize(trim(strip_tags($string)), $length, 1);
	}

}

/* ========================================================
	get_display_value
	Return a value if (true or 0) or return a passed display value. Clever?

/* ======================================================== */
if ( ! function_exists('get_display_value')){

	function get_display_value($var=false,$default_value=false,$show_default_if_zero=false,$prepend=false,$append=false) {
			
		if($show_default_if_zero AND $var === '0'){
		
			return $default_value;
		
		}
			
		if( (!$var OR trim($var)=="") AND $var !== '0') {
		
			return $default_value;
			
		}else{
		
			return $prepend.$var.$append;
		
		}

		
	}

}

/* ========================================================
	make_breadcrumbs
	Renders the breadcrumbs string from array
	
/* ======================================================== */
if ( ! function_exists('make_breadcrumbs')){

	function make_breadcrumbs($breadcrumbs){
	
		#Prepare & load view
	
		$field_settings = array(
		
			'breadcrumbs' => $breadcrumbs
			
		);
		
		return load_view('breadcrumbs_list', $field_settings);
	
	}
	
}


/* ========================================================
	urlprep
	Transofrm into URL
	
/* ======================================================== */
if ( ! function_exists('urlprep')){

	function urlprep($input){

		$input = str_replace( array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'), array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'), $input);

		$input = str_replace(array("'", "_"), "-", $input); //remove single quote and dash
		
		$input = mb_convert_case($input, MB_CASE_LOWER, "UTF-8"); //convert to lowercase
		
		$input = preg_replace("#[^a-zA-Z0-9]+#", "-", $input); //replace everything non an with dashes
		
		$input = preg_replace("#(-){2,}#", "$1", $input); //replace multiple dashes with one
		
		$input = trim($input, "-"); //trim dashes from beginning and end of string if any

		return $input;	
	}	

}


/* ========================================================
	slugify
	Transofrm into slug
	
/* ======================================================== */
if ( ! function_exists('slugify')){

	function slugify($text){

		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		// trim
		$text = trim($text, '-');

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// lowercase
		$text = strtolower($text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		if (empty($text))
		{
		return 'n-a';
		}

		return $text;

	}
}

/* End of file display_helper.php */
/* Location: ./application/helpers/display_helper.php */
?>