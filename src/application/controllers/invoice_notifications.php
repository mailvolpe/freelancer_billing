<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_notifications extends CI_Controller {


	function __construct(){

		// Call the Model constructor

		parent::__construct();

		/* Security by admin level goes here. */

		requires_session();
		
		$this->load->model("Invoice_notification");

	}


	public function index(){

		$data['itens'] = $this->Invoice_notification->index();

		$this->load->vars(array("page" => "invoice_notifications/index"));

		$this->load->view('template/template', $data);		
	}


	public function rows($key_id=false){

		$data['itens'] = $this->Invoice_notification->index($key_id);

		$this->load->view('invoice_notifications/rows', $data);		

	}
	
	public function view($invoice_notification_id){

		$item = $this->Invoice_notification->get_item($invoice_notification_id);		

		$this->load->vars(array("page"=>"invoice_notifications/view"));		

		$this->load->view('template/template', array('item'=>$item));	

	}	
	
	public function create(){

		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$item = $this->validate();

				$invoice_notification_id = $this->Invoice_notification->create($item);

				# GUI option: redirects
					
					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('invoice_notifications/view/'.$invoice_notification_id, 'location');

				# API option: return $create

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$this->load->vars(array("page"=>"invoice_notifications/create"));

		$this->load->view('template/template');

	}


	public function update($invoice_notification_id){

		$item = $this->Invoice_notification->get_item($invoice_notification_id); # Security check
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$item = $this->validate();

				$update = $this->Invoice_notification->update($invoice_notification_id, $item);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('invoice_notifications/view/'.$invoice_notification_id, 'location');

				# API option: return $update				

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$item = $this->Invoice_notification->get_item($invoice_notification_id);		

		$this->load->vars(array("page"=>"invoice_notifications/update"));		

		$this->load->view('template/template', array('item'=>$item));

	}


	function validate($fields = false){

		$all_fields = array(

			array ( 
					"field"=>"invoice_notification_invoice_id", 
					"label"=>"lang:invoice_notification_invoice_id", 
					"rules"=>"trim"
				),
				
								
				array ( 
					"field"=>"invoice_notification_type", 
					"label"=>"lang:invoice_notification_type", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"invoice_notification_read", 
					"label"=>"lang:invoice_notification_read", 
					"rules"=>"trim"
				),
				
								
				array ( 
					"field"=>"invoice_notification_read_ip", 
					"label"=>"lang:invoice_notification_read_ip", 
					"rules"=>"trim"
				)
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
	
	
	public function remove($invoice_notification_id){

		$item = $this->Invoice_notification->get_item($invoice_notification_id); # Security check
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$remove = $this->Invoice_notification->remove($invoice_notification_id);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('invoice_notifications/index', 'location');

				# API option: return $remove

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$this->lang->line('operation_fail'), "message_class"=>"danger"));

				# $this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger")); # SHOW ERROR

			}

		}

		$item = $this->Invoice_notification->get_item($invoice_notification_id);		

		$this->load->vars(array("page"=>"invoice_notifications/remove"));		

		$this->load->view('template/template', array('item'=>$item));

	}


}

/* End of file invoice_notifications.php */
/* Location: ./application/controllers/invoice_notifications.php */