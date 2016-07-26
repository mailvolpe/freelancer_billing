<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {


	function __construct(){

		// Call the Model constructor

		parent::__construct();

		/* Security by admin level goes here. */

		requires_session();
		
		$this->load->model("Account");

	}
	
	/*
	public function smtp($unset=false){
	
		$account_id = $this->System_log->logged->account_id;
	
		$item = $this->Account->get_item($account_id); # Security check
		
		# UNSET SMTP

		if($unset){
		
			try{

				$empty = array();
				$empty['account_mail_server'] = null;
				$empty['account_mail_username'] = null;
				$empty['account_mail_password'] = null;
			
				$update = $this->Account->update($account_id, $empty);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect("settings", 'location');

				# API option: return $update				

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}		
		
		}
		
		# UPDATE SMTP
		
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$fields = array(

					array ( 
						"field"=>"account_mail_server", 
						"label"=>"lang:account_mail_server", 
						"rules"=>"required|trim"
					),		
			
					array ( 
						"field"=>"account_mail_username", 
						"label"=>"lang:account_mail_username", 
						"rules"=>"required|trim"
					),

					array ( 
						"field"=>"account_mail_password", 
						"label"=>"lang:account_mail_password", 
						"rules"=>"required|trim"
					),
					
			);	
					
		
			try{

				$item = $this->validate($fields);

				$check = $this->System_mail->check_smtp_credentials(
					$item['account_mail_server'], 
					$item['account_mail_username'], 
					$item['account_mail_password']
				);
				
				$update = $this->Account->update($account_id, $item);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect("settings", 'location');

				# API option: return $update				

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$item = $this->Account->get_item($account_id);		

		$this->load->vars(array("page"=>"settings/smtp"));		

		$this->load->view('template/template', array('item'=>$item));

	}	
	*/
	
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