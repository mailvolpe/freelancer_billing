<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_status_updates extends CI_Controller {


	function __construct(){

		// Call the Model constructor

		parent::__construct();

		/* Security by admin level goes here. */

		requires_session();
		
		$this->load->model("Invoice");
		
		$this->load->model("Invoice_status_update");
		
		$this->load->vars(array("gateways"=>$this->Invoice_status_update->get_invoice_status_gateways()));
		
		$this->load->vars(array("statuses"=>$this->Invoice_status_update->get_invoice_status_update_statuses()));		

	}

	public function check($invoice_status_update_id){
	
		$this->load->library('gateway');
		
		$invoice_status_update = $this->Invoice_status_update->get_item($invoice_status_update_id);
	
		$gateway = new paymentGateway('pagseguro', $this->config->item('credentials_pagseguro'));
		
		$result = $gateway->check(format_id($invoice_status_update->invoice_status_update_invoice_id));

		print_r($invoice_status_update);
		
		print_r($result);		
		
		$item = new stdClass;
		
		$item->invoice_status_update_invoice_id = $invoice_status_update->invoice_status_update_invoice_id;
		
		$item->invoice_status_update_datetime = db_now();
		
		$item->invoice_status_update_gateway = $invoice_status_update->invoice_status_update_gateway;
		
		$item->invoice_status_update_transaction = $result->payment['transaction_id'];
		
		$item->invoice_status_update_status_code = $result->payment['status'];
	
		print_r($item);	
	
		$update = $this->Invoice_status_update->create($item);
		
		redirect('invoices/view/'.$invoice_status_update->invoice_status_update_invoice_id, 'location');
	
	}

	public function index($invoice_id){

		if(!$data['item']=$this->Invoice->get_item($invoice_id)){
			not_allowed();
		}
	
		$data['itens'] = $this->Invoice_status_update->index($invoice_id);

		$this->load->vars(array("page" => "invoice_status_updates/index"));

		$this->load->view('template/template', $data);		
	}


	public function rows($key_id=false){

		$data['itens'] = $this->Invoice_status_update->index($key_id);

		$this->load->view('invoice_status_updates/rows', $data);		

	}
	
	public function view($invoice_status_update_id){

		$item = $this->Invoice_status_update->get_item($invoice_status_update_id);		

		$this->load->vars(array("page"=>"invoice_status_updates/view"));		

		$this->load->view('template/template', array('item'=>$item));	

	}	
	
	public function create($invoice_id){

		if(!$invoice = $this->Invoice->get_item($invoice_id)){
			not_allowed();
		}
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$_POST['invoice_status_update_invoice_id'] = $invoice->invoice_id;
		
			try{

				$item = $this->validate();

				$invoice_status_update_id = $this->Invoice_status_update->create($item);

				# GUI option: redirects
					
					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('invoices/view/'.$invoice->invoice_id, 'location');

				# API option: return $create

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$this->load->vars(array("page"=>"invoice_status_updates/create"));

		$this->load->view('template/template');

	}

	/*
	public function update($invoice_status_update_id){

		$item = $this->Invoice_status_update->get_item($invoice_status_update_id); # Security check
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$item = $this->validate();

				$update = $this->Invoice_status_update->update($invoice_status_update_id, $item);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('invoice_status_updates/view/'.$invoice_status_update_id, 'location');

				# API option: return $update				

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$item = $this->Invoice_status_update->get_item($invoice_status_update_id);		

		$this->load->vars(array("page"=>"invoice_status_updates/update"));		

		$this->load->view('template/template', array('item'=>$item));

	}*/


	function validate($fields = false){

		$all_fields = array(

			array ( 
					"field"=>"invoice_status_update_invoice_id", 
					"label"=>"lang:invoice_status_update_invoice_id", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"invoice_status_update_datetime", 
					"label"=>"lang:invoice_status_update_datetime", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"invoice_status_update_gateway", 
					"label"=>"lang:invoice_status_update_gateway", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"invoice_status_update_transaction", 
					"label"=>"lang:invoice_status_update_transaction", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"invoice_status_update_status_code", 
					"label"=>"lang:invoice_status_update_status_code", 
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
	
	
	public function remove($invoice_status_update_id){

		$item = $this->Invoice_status_update->get_item($invoice_status_update_id); # Security check
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$remove = $this->Invoice_status_update->remove($invoice_status_update_id);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('invoices/view/'.$item->invoice_status_update_invoice_id, 'location');

				# API option: return $remove

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$this->lang->line('operation_fail'), "message_class"=>"danger"));

				# $this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger")); # SHOW ERROR

			}

		}

		$item = $this->Invoice_status_update->get_item($invoice_status_update_id);		

		$this->load->vars(array("page"=>"invoice_status_updates/remove"));		

		$this->load->view('template/template', array('item'=>$item));

	}


}

/* End of file invoice_status_updates.php */
/* Location: ./application/controllers/invoice_status_updates.php */