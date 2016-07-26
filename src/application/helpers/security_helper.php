<?php

/* ========================================================
*
* Sec Helper 
*

/* ========================================================
	logged()
	Return logged user object as in db not as in session
/* ======================================================== */
/*
if( ! function_exists('logged')){

	function logged($force_db = false){

		$CI =& get_instance();
	
		#This shall never returns exception for now.
	
		return $CI->System_log->logged($force_db);
	
	}
	
}
*/
/* ========================================================
	requires_session()
	Check if its safe for user to access
/* ======================================================== */

if( ! function_exists('requires_session')){

	function requires_session(){
	
		$CI =& get_instance();
		
		$user = $CI->System_log->logged(1);
		
		if(!$user){

			# SETS A COOKIE FOR ATTEMPTED URL

			$attempted_url = current_url().'?'.$CI->input->server('QUERY_STRING');

			setcookie('attempted_url', $attempted_url, 0, "/");			

			redirect('/login', 'location');

		}
		
		if($user->account_blocked_date){
		
			redirect('/logout', 'location');
		
		}		
		
	
	}

}


/* ========================================================
	not_allowed()
	Redirect user with a flash message 
/* ======================================================== */

if( ! function_exists('not_allowed')){

	function not_allowed($string=false){
	
		$CI =& get_instance();

		if(!$string){
			
			$string = $CI->lang->line('not_allowed');
			
		}
		
		# SETS A FLASH MESSAGE

		set_flash_message($string, 'danger');

		# REDIRECT
		if(isset($_SERVER["HTTP_REFERER"])){
	
			redirect($_SERVER["HTTP_REFERER"], 'location');	
			
		}else{
		
			redirect('/', 'location');	
			
		}
	
	}
	
}

/* ========================================================
	set_flash_message()
	Sets a flash message with a class
/* ======================================================== */

if( ! function_exists('set_flash_message')){

	function set_flash_message($string, $class='info'){
	
		$CI =& get_instance();
	
		$message['message'] = $string;

		$message['message_class'] = $class;

		$CI->session->set_flashdata($message);
	
	}
	
}

/* ========================================================
	is_admin()
	Sets a flash message with a class
/* ======================================================== */
/*
if( ! function_exists('is_admin')){

	function is_admin(){
	
		if(logged()->account_is_admin == 1){
		
			return true;
			
		}else{
		
			return false;
		
		}

		
	}
	
}
*/

/* ========================================================
	must_be_admin()
	Sets a flash message with a class
/* ======================================================== */
/*
if( ! function_exists('must_be_admin')){

	function must_be_admin(){
	
		if(!is_admin()){
		
			not_allowed("Acesso restrito.");
			
		}

		
	}
	
}
*/
