<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {


	function __construct(){

		// Call the Model constructor

		parent::__construct();

		/* Security by admin level goes here. */

		requires_session();
		
		$this->load->model("Account");

	}
	
	
	public function system(){
	
		if(!$this->System_log->logged->account_is_admin){
			not_allowed();
		}
		
		$settings = $this->System_settings->settings;
			
		# UPDATE CONFIGS
		
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$fields = array(

					array ( 
						"field"=>"system_title", 
						"label"=>"lang:system_title", 
						"rules"=>"required|trim"
					),		

					array ( 
						"field"=>"system_smtp_name", 
						"label"=>"lang:system_smtp_name", 
						"rules"=>"trim"
					),			
					
					array ( 
						"field"=>"system_smtp_email", 
						"label"=>"lang:system_smtp_email", 
						"rules"=>"valid_email|trim"
					),

					array ( 
						"field"=>"system_smtp_host", 
						"label"=>"lang:system_smtp_host", 
						"rules"=>"trim"
					),			

					array ( 
						"field"=>"system_smtp_port", 
						"label"=>"lang:system_smtp_port", 
						"rules"=>"trim"
					),								

					array ( 
						"field"=>"system_smtp_user", 
						"label"=>"lang:system_smtp_user", 
						"rules"=>"trim"
					),				
					
					array ( 
						"field"=>"system_smtp_pass", 
						"label"=>"lang:system_smtp_pass", 
						"rules"=>"trim"
					),								
					
					array ( 
						"field"=>"pagseguro_credentials_email", 
						"label"=>"lang:pagseguro_credentials_email", 
						"rules"=>"valid_email|trim"
					),					

					array ( 
						"field"=>"pagseguro_credentials_token", 
						"label"=>"lang:pagseguro_credentials_token", 
						"rules"=>"trim"
					),										
					
					array ( 
						"field"=>"invoice_status_pending_notification_subject", 
						"label"=>"lang:invoice_status_pending_notification_subject", 
						"rules"=>"required"
					),
					
					array ( 
						"field"=>"invoice_status_pending_notification", 
						"label"=>"lang:invoice_status_pending_notification", 
						"rules"=>"required"
					),


					array ( 
						"field"=>"invoice_status_pending_overdue_notification_subject", 
						"label"=>"lang:invoice_status_pending_overdue_notification_subject", 
						"rules"=>"required"
					),
					
					array ( 
						"field"=>"invoice_status_pending_overdue_notification", 
						"label"=>"lang:invoice_status_pending_overdue_notification", 
						"rules"=>"required"
					),

					array ( 
						"field"=>"invoice_status_paid_notification_subject", 
						"label"=>"lang:invoice_status_paid_notification_subject", 
						"rules"=>"required"
					),			
					
					array ( 
						"field"=>"invoice_status_paid_notification", 
						"label"=>"lang:invoice_status_paid_notification", 
						"rules"=>"required"
					),					

					array ( 
						"field"=>"bank_transfer_instructions_template", 
						"label"=>"lang:bank_transfer_instructions_template", 
						"rules"=>""
					),				

					array ( 
						"field"=>"days_after_invoice_pending_overdue_notification", 
						"label"=>"lang:days_after_invoice_pending_overdue_notification", 
						"rules"=>"required|trim|is_natural_no_zero"
					),									

					array ( 
						"field"=>"days_after_generate_invoice_due_date", 
						"label"=>"lang:days_after_generate_invoice_due_date", 
						"rules"=>"required|trim|is_natural_no_zero"
					),														

					array ( 
						"field"=>"activate_pagseguro", 
						"label"=>"lang:activate_pagseguro", 
						"rules"=>""
					),		

					array ( 
						"field"=>"activate_bank_transfer", 
						"label"=>"lang:activate_bank_transfer", 
						"rules"=>""
					),		

					array ( 
						"field"=>"sendmail_mode", 
						"label"=>"lang:sendmail_mode", 
						"rules"=>""
					),		
					
			);	
					
		
			try{

				$item = $this->validate($fields);
				
				$update = $this->System_settings->update($item);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect("settings/system", 'location');

				# API option: return $update				

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$item = $this->System_settings->get_settings();	
		
		$this->load->vars(array("page"=>"settings/system"));		

		$this->load->view('template/template', array('item'=>$item));

	}	
	
	
	public function index(){

		$account_id = $this->System_log->logged->account_id;
	
		$item = $this->Account->get_item($account_id);		

		$this->load->vars(array("page"=>"settings/view"));		

		$this->load->view('template/template', array('item'=>$item));	

	}	
	
	public function password(){

		$account_id = $this->System_log->logged->account_id;
	
		$item = $this->Account->get_item($account_id); # Security check
		
		$fields = array(

				array ( 
					"field"=>"account_password", 
					"label"=>"lang:account_password", 
					"rules"=>"required|trim"
				),

		);		
		
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$item = $this->validate($fields);

				$update = $this->Account->update_password($account_id, $item);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('settings', 'location');

				# API option: return $update				

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$item = $this->Account->get_item($account_id);		

		$this->load->vars(array("page"=>"settings/password"));		

		$this->load->view('template/template', array('item'=>$item));

	}	
	
	

	public function update(){

		$account_id = $this->System_log->logged->account_id;
	
		$item = $this->Account->get_item($account_id); # Security check

		$unique = $item->account_email != $this->input->post('account_email') ? '|is_unique[accounts.account_email]' : null;
		
		$fields = array(

				array ( 
					"field"=>"account_title", 
					"label"=>"lang:account_title", 
					"rules"=>"required|trim"
				),				
		
				array ( 
					"field"=>"account_email", 
					"label"=>"lang:account_email", 
					"rules"=>"required|valid_email|trim".$unique
				)
									

		);
		
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$item = $this->validate($fields);

				$update = $this->Account->update($account_id, $item);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect($this->input->post('referer_query_string'), 'location');

				# API option: return $update				

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$item = $this->Account->get_item($account_id);		

		$this->load->vars(array("page"=>"settings/update"));		

		$this->load->view('template/template', array('item'=>$item));

	}


	function validate($fields = false){

		$all_fields = array(

				array ( 
					"field"=>"account_email", 
					"label"=>"lang:account_email", 
					"rules"=>"required|valid_email|is_unique[accounts.account_email]|trim"
				),

		);

		if(!$fields){$fields = $all_fields;}
		
		$this->form_validation->set_rules($fields);	

		#Prepares the item for database operation

		foreach($fields as $rule){

			$fieldname = $rule['field'];

			if($this->input->post($fieldname)===''){

				$item[$fieldname] = NULL;

			}else{

				$item[$fieldname] = $this->input->post($fieldname);

			}

		}

		#Perform the validation

		if( $this->form_validation ->run() == FALSE ){

			throw new Exception($this->lang->line('validation_failed'));

		}else{

			return $item;

		}

	}
	

}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */