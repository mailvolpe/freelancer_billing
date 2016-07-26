<?php

/* ========================================================
*
* Form Helper 
*
* ======================================================== */



if ( ! function_exists('zipcode_field_script'))
{
	function zipcode_field_script($field_prefix)
	{
		#Prepare & load view
	
		$field_settings = array(
		
			'field_prefix'=>$field_prefix
			
		);	
	
		return load_view('inputs/zipcode_script', $field_settings);
	}
}


if ( ! function_exists('search_button'))
{
	function search_button($field_name, $method_path, $button_label=null)
	{
		#Prepare & load view
	
		$field_settings = array(
		
			'field_name'=>$field_name,
			
			'method_path'=>$method_path, //Busca as opções
		
			'button_label'=>$button_label, //Busca as opções
			
		);	
	
		return load_view('inputs/search_button', $field_settings);
	}
}

if ( ! function_exists('city_field'))
{
	function city_field($city_field_name, $city_field_value=false, $state_field_value=false)
	{
		#Prepare & load view
	
		$field_settings = array(
		
			'city_field_name'=>$city_field_name,
			
			'city_field_value'=>$city_field_value,
			
			'state_field_value'=>$state_field_value
			
		);	
	
		return load_view('inputs/city_input', $field_settings);
	}
}


if ( ! function_exists('file_zone_field'))
{
	function file_zone_field($file_zone_name, $pk_id=false, $limit, $add_class=false)
	{
		#Prepare & load view
	
		$field_settings = array(
		
			'file_zone_name'=>$file_zone_name,
			
			'pk_id'=>$pk_id,
			
			'limit'=>$limit,
			
			'add_class'=>$add_class
			
		);	
	
		return load_view('file_zone', $field_settings);
	}
}


/* ========================================================
	datetime_field	
	Returns the date(time) picker inputs kit.
	
	$field_name - determines name
	$value - Datetime value or null
/* ======================================================== */


if ( ! function_exists('datetime_field')){

	function datetime_field($field_name, $value = false, $time=false){
	
		#Prepare & load view
	
		$field_settings = array(
		
			'field_name'=>$field_name,
			
			'value'=>$value,
			
			'time'=>$time
			
		);
		
		return load_view('inputs/datetime_picker', $field_settings);
	
	}

}


/* ========================================================
	bool_field	
	Returns the bool input.
	
	$field_name - determines name
	$value - Datetime value or null
	$on_label
	$off_label
/* ======================================================== */

if ( ! function_exists('bool_field')){

	function bool_field($field_name, $value=false, $on_label=false, $off_label=false, $filter_field = false, $both_label = false, $params = false){
	
		#Prepare & load view
	
		$field_settings = array(
		
			'field_name'=>$field_name,
			
			'value'=>$value,
			
			'on_label'=>$on_label,
			
			'off_label'=>$off_label,
			
			'filter_field'=>$filter_field,
			
			'both_label'=>$both_label,
			
			'params'=>$params
			
		);

		if($filter_field){
		
			return load_view('inputs/bool_filter_field', $field_settings);
		
		}else{
		
			return load_view('inputs/bool_switch', $field_settings);
		
		}
		
		
	
	}

}

/* ========================================================
	text_field	
	Returns the text editor input.
	
	$field_name - determines name
	$value - Datetime value or null
	$type 
		0 - Default textarea
		1 - Rich text editor plugin
	$char_limit - Max number of chars
/* ======================================================== */

if ( ! function_exists('text_field'))
{
	function text_field($field_name, $value, $rich_mode=false, $char_limit=false, $readonly=false, $less_toolbar=true){

		#Prepare & load view
	
		$field_settings = array(
		
			'field_name'=>$field_name,
			
			'value'=>$value,
			
			'rich_mode'=>$rich_mode,
			
			'char_limit'=>$char_limit,
			
			'readonly'=>$readonly,
			
			'less_toolbar'=>$less_toolbar
			
		);	
	
		$CI =& get_instance();
	
		if($rich_mode AND !$CI->input->get('text_mode_editor')){
		
			return load_view('inputs/rich_text_input', $field_settings);
			
		}else{
		
			return load_view('inputs/textarea_input', $field_settings);
		
		}
	
	}

}


/* ========================================================
	code_field	
	Returns the code editor input.
	
	$field_name - determines name
	$value - Datetime value or null
	
/* ======================================================== */

if ( ! function_exists('code_field'))
{
	function code_field($field_name, $value){

		#Prepare & load view
	
		$field_settings = array(
		
			'field_name'=>$field_name,
			
			'value'=>$value
			
		);	
	
		
		return load_view('inputs/code_input', $field_settings);
			
	}

}

/* ========================================================
	number_field	
	Returns the number input with formatting.
	
	$field_name - determines name
	$value - Datetime value 
	$decimals - number of decimal digits
	$separator - Separator char
/* ======================================================== */

if ( ! function_exists('number_field')){

	function number_field($field_name, $value=0, $step="any", $min=0, $max=false){
		
		#Prepare & load view
	
		$field_settings = array(
		
			'field_name'=>$field_name,
			
			'value'=>$value,
			
			'step'=>$step,
			
			'min'=>$min,
			
			'max'=>$max
			
		);

		return load_view('inputs/number_input', $field_settings);		
	
	}

}


/* ========================================================
	input_field	
	Returns the input field.
	
	$field_name - determines name
	$value - Datetime value 
/* ======================================================== */

if ( ! function_exists('input_field')){

	function input_field($field_name, $value, $parameters = false, $add_classes = ''){

		#Prepare & load view

		$field_settings = array(
		
			'field_name'=>$field_name,
			
			'value'=>$value,
			
			'parameters'=>$parameters,
			
			'add_classes'=>$add_classes
			
		);

		return load_view('inputs/string_input', $field_settings);		
		
	}
	
}

/* ========================================================
	color_field	
	Returns the input color field.
	
	$field_name - determines name
	$value - Datetime value 
/* ======================================================== */

if ( ! function_exists('color_field')){

	function color_field($field_name, $value, $parameters = false){

		#Prepare & load view

		$field_settings = array(
		
			'field_name'=>$field_name,
			
			'value'=>$value,
			
			'parameters'=>$parameters
			
		);

		return load_view('inputs/color_input', $field_settings);		
		
	}
	
}

/* ========================================================
	fk_field	
	Returns the fk selector input.
	
	$field_name - determines name
	$controller - determines controller to perform search
	$value - Datetime value 
	$display_value - Displayed value (correct fk label field is set in fk controller)
	$optional - Removes the clear button
/* ======================================================== */

if( ! function_exists('fk_field')){

	function fk_field($field_name, $controller, $value=false, $display_value=false, $optional=true, $option_filter = false){
	
		#Prepare & load view
	
		$field_settings = array(
		
			'field_name'=>$field_name,		
		
			'controller'=>$controller,
			
			'value'=>$value,
			
			'display_value'=>$display_value,
			
			'optional'=>$optional,
			
			'option_filter'=>$option_filter #array('field'=>'field_name', 'value'=>'parent_item_id')
			
		);

		return load_view('inputs/fk_input', $field_settings);
	
	}

}

/* ========================================================
	get_range_input
	Returns an input pair with _min and _max appended to its names.
	
	$field_name - determines name
	$value - Datetime value 
/* ======================================================== */

if ( ! function_exists('input_range')){

	function input_range($function, $field_name, $param_3=null, $param_4=null){

		$CI =& get_instance();

		$field_min = $function($field_name.'_min', $CI->input->get($field_name.'_min'), $param_3, $param_4);
		
		$field_max = $function($field_name.'_max', $CI->input->get($field_name.'_max'), $param_3, $param_4);
		
		return $CI->lang->line('range_min').$field_min.$CI->lang->line('range_max').$field_max;
		
	}
	
}


/* ========================================================
	select_test
	Returns the selection markup into the option if value matches selected
/* ======================================================== */

if ( ! function_exists('select_test')){

	function select_test($selected, $this_value){
	
		if($this_value == $selected){
		
			return 'selected="true"';
		
		}
		
	}

}


/* ========================================================
	get_referer_query_string
	Returns the query string from the referal URL - Can break apart any url tough.
/* ======================================================== */

if ( ! function_exists('get_referer_query_string')){

	function get_referer_query_string($url = false){
	
		if(!$url){
		
			$CI =& get_instance();
		
			if($CI->input->post('referer_query_string')){
			
				$url = $CI->input->post('referer_query_string');
			
			}else{
		
				$url = $CI->agent->referrer();
				
			}
			
		}
	
		#Se a url de retorno for a mesma, seta de volta para a raiz do módulo
		
		$compare = rtrim(base_url(), "/").$_SERVER['REDIRECT_QUERY_STRING'];
	
		if($url == $compare){
		
			$url = base_url();
		
		}		
	
		/*
		
		$query_string = '';
	
		$string = explode("?", $url);
		
		if(isset($string[1])){
		
			$query_string = '?'.$string[1];
		
		}
		
		return $query_string;
		
		*/
		
		return $url;
		
	}

}


/* ========================================================
	back_url
	Returns the URL of referral and if its the same, returns module index URL
/* ======================================================== */

if ( ! function_exists('back_url')){

	function back_url($index=false){

		$CI =& get_instance();
	
		$default = $CI->agent->referrer();
	
		$compare = rtrim(base_url(), "/").$_SERVER['REDIRECT_QUERY_STRING'];
	
		if($default == $compare OR !$default OR $index){
		
			return base_url().$CI->uri->segment(1);
		
		}else{
		
			return $default;
		
		}
	
		
		
	}

}


/* ========================================================
	rate_field	
	Returns the stars to rate or readonly.
	
	$field_name - determines name
	$value - Datetime value or null
	$readonly

/* ======================================================== */

if ( ! function_exists('rate_field'))
{
	function rate_field($field_name, $value, $readonly=true){

		#Prepare & load view
	
		$field_settings = array(
		
			'field_name'=>$field_name,
			
			'value'=>$value,
			
			'readonly'=>$readonly
			
		);	
	
		
		return load_view('inputs/rate_input', $field_settings);
	
	
	}

}


/* ========================================================
	select_field	
	Return a select field.
	
	$field_name - determines name
	$value - Datetime value or null
	$params - String containing parameters

/* ======================================================== */

if ( ! function_exists('select_field'))
{
	function select_field($field_name, $options_array, $selected_value=null, $params=false){

		#Prepare & load view
	
		$field_settings = array(
		
			'field_name'=>$field_name,
			
			'options_array'=>$options_array,
			
			'selected_value'=>$selected_value,
			
			'params'=>$params
			
		);	
	
		
		return load_view('inputs/select_input', $field_settings);
	
	
	}

}


if ( ! function_exists('make_select_options_array'))
{
	function make_select_options_array($object, $value_field, $display_field, $all = false)
	{
		$array = "";
	
		if($all){
			$array["0"] = $all;
		}
	
		foreach($object as $option){
			
			$array[$option->$value_field] = $option->$display_field;
		}
		
		return $array;
	}
}

if ( ! function_exists('map_picker_field'))
{
	function map_picker_field($lat_field_name, $lon_field_name, $lat_field_value, $lon_field_value)
	{
		#Prepare & load view
	
		$field_settings = array(
		
			'lat_field_name'=>$lat_field_name,
			
			'lon_field_name'=>$lon_field_name,
			
			'lat_field_value'=>$lat_field_value,
			
			'lon_field_value'=>$lon_field_value
			
		);	
	
		return load_view('inputs/map_picker_input', $field_settings);
	}
}

/* End of file MY_form_helper.php */
/* Location: ./application/helpers/MY_form_helper.php */