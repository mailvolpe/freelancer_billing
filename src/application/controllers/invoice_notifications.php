<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_notifications extends CI_Controller {


	function __construct(){

		// Call the Model constructor

		parent::__construct();

		/* Security by admin level goes here. */

		requires_session();
		
		$this->load->model("Invoice");
		
		$this->load->model("Invoice_notification");

		$this->invoice_statuses = $this->Invoice->get_invoice_statuses();
		
		$this->load->vars(array("invoice_statuses" => $this->invoice_statuses));
		
	}


	public function index($invoice_id){

		if(!$data['invoice'] = $this->Invoice->get_item($invoice_id)){
			not_allowed();
		}
	
		$data['itens'] = $this->Invoice_notification->index($invoice_id);

		$this->load->vars(array("page" => "invoice_notifications/index"));

		$this->load->view('template/template', $data);		
	}


	public function rows($key_id=false){

		$data['itens'] = $this->Invoice_notification->index($key_id);

		$this->load->view('invoice_notifications/rows', $data);		

	}
	
	public function view($invoice_notification_id){

		$data['item'] = $item = $this->Invoice_notification->get_item($invoice_notification_id);		
		
		if(!$data['invoice'] = $invoice = $this->Invoice->get_item($item->invoice_notification_invoice_id, true)){
			not_allowed();
		}			
		
		$data['notification'] = $notification = $this->System_notification->notificate(
			$data['invoice']->account_email, 
			$this->invoice_statuses[$data['invoice']->invoice_status].'_notification', 
			$data['invoice'], 
			false
			);		

		$this->load->vars(array("page"=>"invoice_notifications/view"));		

		$this->load->view('template/template', $data);	

	}	
	
	public function create($invoice_id){

		if(!$data['invoice'] = $invoice = $this->Invoice->get_item($invoice_id, true)){
			not_allowed();
		}	
	
		$data['notification'] = $notification = $this->System_notification->notificate(
			$data['invoice']->account_email, 
			$this->invoice_statuses[$data['invoice']->invoice_status].'_notification', 
			$data['invoice'], 
			false
			);
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$_POST['invoice_notification_invoice_id'] = $data['invoice']->invoice_id;
				
				$_POST['invoice_notification_type'] = $data['invoice']->invoice_status;
				
				$_POST['invoice_notification_sent'] = db_now();
				
				
				
				$item = $this->validate();
				

				$invoice_notification_id = $this->Invoice_notification->create($item, $invoice);
				
				# GUI option: redirects
					
					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('invoices/view/'.$invoice_id, 'location');

				# API option: return $create

			} catch(Exception $e) {
			
				//echo validation_errors();
				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$this->load->vars(array("page"=>"invoice_notifications/create"));

		$this->load->view('template/template', $data);

	}


	function validate($fields = false){

		$all_fields = array(

			array ( 
					"field"=>"invoice_notification_invoice_id", 
					"label"=>"lang:invoice_notification_invoice_id", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"invoice_notification_type", 
					"label"=>"lang:invoice_notification_type", 
					"rules"=>"is_natural|trim"
				),
				
								
				array ( 
					"field"=>"invoice_notification_sent", 
					"label"=>"lang:invoice_notification_sent", 
					"rules"=>"required|trim"
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

					redirect('invoices/view/'.$item->invoice_notification_invoice_id, 'location');

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