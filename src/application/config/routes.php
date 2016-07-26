<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/* ========================================================
	ROUTES FILE ACTUALLY BEGINS HERE
/* ======================================================== */
	
$route['default_controller'] = "invoices";

//Login Routes
$route['login'] = "system_logs/index";
$route['logout'] = "system_logs/logout";
$route['recover'] = "system_logs/recover";



/* End of file routes.php */
/* Location: ./application/config/routes.php */