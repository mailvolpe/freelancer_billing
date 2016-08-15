<?
class System_update extends CI_Model {



	function get_select_input_months(){
	
		return array(
		
			'01' => $this->lang->line('january'), 
			'02' => $this->lang->line('february'),
			'03' => $this->lang->line('march'),
			'04' => $this->lang->line('april'),
			'05' => $this->lang->line('may'),
			'06' => $this->lang->line('june'),
			'07' => $this->lang->line('july'),
			'08' => $this->lang->line('august'),
			'09' => $this->lang->line('september'),
			'10' => $this->lang->line('october'),
			'11' => $this->lang->line('november'),
			'12' => $this->lang->line('december'),			

		);
	
	}

	
	
    function __construct()
    {
	
        // Call the Model constructor

        parent::__construct();
		
		ob_start();
	
		# Timezone Setting
		
		date_default_timezone_set("America/Sao_Paulo");
		
		# Update module also has to keep all controllers updated.
		
		$this->form_validation->set_error_delimiters('', '');				
    }
	
}


/* End of file c_cron_update.php */
/* Location: ./application/models/c_cron_update.php */