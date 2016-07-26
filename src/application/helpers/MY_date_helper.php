<?php
 
 /* ========================================================
	db_now
	returns date in database format
/* ======================================================== */
 
if ( ! function_exists('db_now'))
{
	function db_now()
	{

		return date("Y-m-d H:i:s");
		
	}
} 
 

 /* ========================================================
	human_time
	returns time in human
/* ======================================================== */

if ( ! function_exists('human_time'))
{
	function human_time($time_string)
	{
		
		if(!$time_string){
		
			return false;
		
		}
		
		return date("H:i", strtotime($time_string));
	}
}
 
 
 /* ========================================================
	human_date
	returns date and time in human date - as per lang definition.
/* ======================================================== */

if ( ! function_exists('human_date'))
{
	function human_date($date_string, $datetime = false, $noDate = false, $birthday=false, $calc_years=false, $only_diff = false)
	{

		$CI =& get_instance();
	
		if(!$noDate){
			$noDate = $CI->lang->line('pending_date');
		}
		
		$date = $noDate;
		

		
		if($datetime AND strstr($date_string, " ")){
		
			$format = "d/m/y H:i";
		
		}else{
		
			if(!$birthday){
				$format = "l, d/M/Y";
			}else{
				$format = "d/m/Y";
			}
		
		}
		
		if(isset($date_string) AND !strstr($date_string, "0000-00-00") ){
		
			$date_object = date_create($date_string);
		
			$date = date_format($date_object, $format);
			
		}

		$separator = false;
		
		if($date_string AND ($calc_years OR $only_diff)){
		

		
			$years = date_diff(date_create($date_string), date_create('today'))->y.' '.$CI->lang->line('years');
			
			if($only_diff){
				$date = $years;
			}else{
				$date.= ' - '.$years;
			}
		}
		
		return translate_date($date);
	}
}


 /* ========================================================
	translate_date
	returns translated date
/* ======================================================== */

if ( ! function_exists('translate_date'))
{
	function translate_date($date_string)
	{
		
		$CI =& get_instance();
		
		$nmeng = array(
			'Jan', 
			'Feb',
			'Mar',
			'Apr',
			'May',
			'Jun',
			'Jul',
			'Aug',
			'Sep',
			'Oct',
			'Nov',
			'Dec',
			'Monday',
			'Tuesday',
			'Wednesday',
			'Thursday',
			'Friday',
			'Saturday',
			'Sunday'
		);
		$nmtur = array(
			$CI->lang->line('jan'), 
			$CI->lang->line('feb'),
			$CI->lang->line('mar'),
			$CI->lang->line('apr'),
			$CI->lang->line('may'),
			$CI->lang->line('jun'),
			$CI->lang->line('jul'),
			$CI->lang->line('aug'),
			$CI->lang->line('sep'),
			$CI->lang->line('oct'),
			$CI->lang->line('nov'),
			$CI->lang->line('dec'),
			$CI->lang->line('monday'),
			$CI->lang->line('tuesday'),
			$CI->lang->line('wednesday'),
			$CI->lang->line('thursday'),
			$CI->lang->line('friday'),
			$CI->lang->line('saturday'),
			$CI->lang->line('sunday')
		);
	
		
		$dt = str_ireplace($nmeng, $nmtur, $date_string);

		return $dt;
	}
}


 /* ========================================================
	days_in_interval
	returns number of days between two dates
/* ======================================================== */

if ( ! function_exists('days_in_interval'))
{
	function days_in_interval($min_date, $max_date)
	{
		
		 $min_time = strtotime($min_date);
		 $max_time = strtotime($max_date);

		 $datediff = $max_time - $min_time;
		 
		 return floor($datediff/(60*60*24));
		
	}
}

// ------------------------------------------------------------------------

/* End of file MY_html_date.php */
/* Location: ./application/helpers/MY_html_date.php */