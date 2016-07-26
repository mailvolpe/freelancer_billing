<?php

/* ========================================================
*
* Pagination Helper 
*
* ======================================================== */


/* ========================================================
	load_more_button
	Returns the button with script to load more results into table
	
	$field_name - determines name
	$value - Datetime value or null
	$timepicker - display timepicker
	$force_date  - Must set a valid date rather than empty or 0 - no clear button.
/* ======================================================== */

if ( ! function_exists('load_more_button')){

	function load_more_button($method = 'rows', $target_class = 'table_body'){
	
		$field_settings = array(
		
			'method'=>$method,
			
			'target_class'=>$target_class
			
		);	
	
		return load_view('load_more_button', $field_settings);
	
	}
	
}

/* ========================================================
	order_by_url
	Returns the proper (alternate desc) url to order an index page.
	
	$field - determines field you want the link to
/* ======================================================== */

if ( ! function_exists('order_by_url')){

	function order_by_url($field){
	
		$query_string = '';
	
		$CI =& get_instance();
	
		if($_SERVER['QUERY_STRING']===''){
		
			$query_string = 'order_by='.$field;
			
		}else{
		
			if(is_ordered_field($field)){
		
				if(strstr($CI->input->get('order_by'), ' desc')){
				
					$query_string = update_query_string('order_by', $field);
				
				}else{
				
					$query_string = update_query_string('order_by', $field.' desc');
				
				}
				
			}else{
			
				$query_string = update_query_string('order_by', $field);
				
			}
			
		}
		
		
		# return base_url().$CI->uri->segment(1).'/?'.$query_string;
		
		return base_url().ltrim(@$_SERVER['REDIRECT_QUERY_STRING'], "/").'?'.$query_string;
		
		
	
	}
	
}


/* ========================================================
	order_by_url
	Returns the caret to an ordered column header.
	
	$field - determines field you want the caret to
/* ======================================================== */

if ( ! function_exists('order_by_reverse')){

	function order_by_reverse($field){
	
		$CI =& get_instance();
	
		if(is_ordered_field($field)){
		
			if(!strstr($CI->input->get('order_by'), ' desc')){
			
				return '<i class="fa fa-caret-up"></i>';
			
			}else{
			
				return '<i class="fa fa-caret-down"></i>';
			
			}
		
		}else{
		
			return false;
		
		}
	
	}
	
}


/* ========================================================
	update_query_string
	Returns the actual query_string after updating one single parameter.
	
	$field - determines field you want to update
	$value - determines the new value for the field
	$return_link - Wether if returns a full url (true) or just the query_string (false)
/* ======================================================== */
if ( ! function_exists('update_query_string')){

	function update_query_string($field, $value, $return_link = false){
	
		$query_string = '';
	
		$CI =& get_instance();
	
		parse_str($_SERVER['QUERY_STRING'], $query_array);
		
		$query_array[$field] = $value;
		
		if($value==''){
		
			$query_array[$field.'_display'] = $value;
			
		}
	
		if($return_link){
		
			# $CI->uri->segment(1)
		
			return base_url().ltrim($_SERVER['REDIRECT_QUERY_STRING'], "/").'?'.http_build_query($query_array);
		
		}else{
	
			return http_build_query($query_array);
		
		}
	
	}
	
}

/* ========================================================
	is_ordered_field
	Check if this is the ordered field
	
	$field - determines field you want to check against get array
/* ======================================================== */
if ( ! function_exists('is_ordered_field')){

	function is_ordered_field($field){
		
		$CI =& get_instance();
		
		if(	strstr($CI->input->get('order_by'), 'desc')	){
		
			$string = explode(" ", $CI->input->get('order_by'));
		
			$ordered_by = $string[0];
			
		}else{
		
			$ordered_by = $CI->input->get('order_by');
		
		}
		
		#echo "$ordered_by == $field";
		
		if($ordered_by == $field){
		
			return true;
		
		}else{
		
			return false;
		
		}
	
	}
	
}


/* ========================================================
	get_limit
	Detertermines correct limit value by checking get array
	
/* ======================================================== */
if ( ! function_exists('get_limit')){

	function get_limit(){
		
		$CI =& get_instance();
		
		if($CI->input->get('limit') > 0){
		
			$limit = $CI->input->get('limit');
			
			$CI->config->set_item('index_query_limit', $limit);
		
		}else{
		
			$limit = $CI->config->item('index_query_limit');
		
		}	
		
		return $limit;
	
	}
	
}

/* ========================================================
	no_results_warning
	Shows the no-results warning using uri - no parameter is passed
	
/* ======================================================== */
if ( ! function_exists('no_results_warning')){

	function no_results_warning($title_line=false, $print=false){
	
		#Prepare & load view
	
		$field_settings = array(
			
			'title_line' =>  $title_line,
			'print' =>  $print
			
		);
		
		return load_view('no_results_warning', $field_settings);
	
	}
	
}


/* ========================================================
	get_breadcrumbs
	Renders the breadcrumbs string from uri and lang (no params passed)
	
/* ======================================================== */
if ( ! function_exists('get_breadcrumbs')){

	function get_breadcrumbs($active_label_string=false, $custom_url=false){
	
		#Prepare & load view
	
		$field_settings = array(
		
			'active_label_string' => $active_label_string,
			
			'custom_url' => $custom_url
			
		);
		
		return load_view('breadcrumbs', $field_settings);
	
	}
	
}


/* ========================================================
	applied_filters
	Renders the applied_filters from get array (no params passed)
	
/* ======================================================== */
if ( ! function_exists('applied_filters')){

	function applied_filters(){
	
		#Prepare & load view
	
		$field_settings = array();
		
		return load_view('applied_filters', $field_settings);
	
	}
	
}

/* End of file pagination_helper.php */
/* Location: ./application/helpers/pagination_helper.php */
?>