<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices extends CI_Controller {


	function __construct(){

		// Call the Model constructor

		parent::__construct();

		/* Security by admin level goes here. */

		requires_session();
		
		$this->load->model("Invoice");
		
		$this->load->model("Invoice_status_update");
		
		$this->load->model("Invoice_notification");
		
		$this->load->vars(array("gateways"=>$this->Invoice_status_update->get_invoice_status_gateways()));
		
		$this->load->vars(array("statuses"=>$this->Invoice_status_update->get_invoice_status_update_statuses()));
		
		$this->load->vars(array("notification_types"=>$this->Invoice->get_invoice_statuses()));
		
		
	}

	public function payment($invoice_id, $method='pagseguro'){
	
		$item = $this->Invoice->get_item($invoice_id); # Security check
		
		if($method=='pagseguro'){
			
			$this->load->model('Payment_pagseguro');
			
			
			
			try{

				$checkout_url = $this->Payment_pagseguro->get_checkout_url($invoice_id);

				# GUI option: redirects				

				redirect($checkout_url);

				# API option: return $create

			} catch(Exception $e) {

				set_flash_message($e->getMessage(), 'danger');

				redirect('invoices/view/'.$invoice_id, 'location');

			}


		}
	
	}
	
	public function dispatch_notifications(){
	
		$generated = $this->Invoice->dispatch_notifications();
		
		$info_string = '<br>'.$this->lang->line('generated_notifications').': '.$generated->created;
		
		if($generated->last_error){
			$info_string .= '<br>'.$this->lang->line('error_message').': '.$generated->last_error;
		}
		
		set_flash_message($this->lang->line('operation_success').$info_string, 'success');

		redirect('invoices/index', 'location');				
	
	}

	public function index($invoice_account_id=false){

		$data['itens'] = $this->Invoice->index($invoice_account_id);

		if($invoice_account_id AND $account = $this->Account->get_item($invoice_account_id)){
			
			$this->load->vars(array("override_title" => $this->lang->line('invoices')." ".$this->lang->line('of')." ".$account->account_title));
				
		}		
		
		$this->load->vars(array("page" => "invoices/index"));

		$this->load->view('template/template', $data);		
	}


	public function rows($key_id=false){

		$data['itens'] = $this->Invoice->index($key_id);

		$this->load->view('invoices/rows', $data);		

	}
	
	public function view($invoice_id){

		$item = $this->Invoice->get_item($invoice_id);		
		
		$item->status_updates = $this->Invoice_status_update->index($item->invoice_id);		
		
		$item->notifications = $this->Invoice_notification->index($item->invoice_id);

		$this->load->vars(array("page"=>"invoices/view"));		

		$this->load->view('template/template', array('item'=>$item));	

	}	
	
	public function create(){

		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$item = $this->validate();

				$invoice_id = $this->Invoice->create($item);

				# GUI option: redirects
					
					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('invoices/view/'.$invoice_id, 'location');

				# API option: return $create

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$this->load->vars(array("active_clients"=>$this->Account->index_active_clients()));
		
		$this->load->vars(array("page"=>"invoices/create"));

		$this->load->view('template/template');

	}


	public function update($invoice_id){

		$item = $this->Invoice->get_item($invoice_id); # Security check
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$_POST['invoice_account_id'] = $item->invoice_account_id;
		
			try{

				$item = $this->validate();

				$update = $this->Invoice->update($invoice_id, $item);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('invoices/view/'.$invoice_id, 'location');

				# API option: return $update				

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$item = $this->Invoice->get_item($invoice_id);		

		$this->load->vars(array("active_clients"=>$this->Account->index_active_clients()));
		
		$this->load->vars(array("page"=>"invoices/update"));		

		$this->load->view('template/template', array('item'=>$item));

	}


	function validate($fields = false){

		$all_fields = array(

			array ( 
					"field"=>"invoice_account_id", 
					"label"=>"lang:invoice_account_id", 
					"rules"=>"is_natural_no_zero|trim"
				),
				
								
				array ( 
					"field"=>"invoice_amount", 
					"label"=>"lang:invoice_amount", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"invoice_description", 
					"label"=>"lang:invoice_description", 
					"rules"=>"trim"
				),
								
				array ( 
					"field"=>"invoice_due_date", 
					"label"=>"lang:invoice_due_date", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"invoice_paid_date", 
					"label"=>"lang:invoice_paid_date", 
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
	
	
	public function remove($invoice_id){

		$item = $this->Invoice->get_item($invoice_id); # Security check
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$remove = $this->Invoice->remove($invoice_id);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('invoices/index', 'location');

				# API option: return $remove

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$this->lang->line('operation_fail'), "message_class"=>"danger"));

				# $this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger")); # SHOW ERROR

			}

		}

		$item = $this->Invoice->get_item($invoice_id);		

		$this->load->vars(array("page"=>"invoices/remove"));		

		$this->load->view('template/template', array('item'=>$item));

	}


}

/* End of file invoices.php */
/* Location: ./application/controllers/invoices.php */