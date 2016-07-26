<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recurrencies extends CI_Controller {


	function __construct(){

		// Call the Model constructor

		parent::__construct();

		/* Security by admin level goes here. */

		requires_session();
		
		$this->load->model("Recurrency");

	}


	public function index(){

		$data['itens'] = $this->Recurrency->index();

		$this->load->vars(array("page" => "recurrencies/index"));

		$this->load->view('template/template', $data);		
	}


	public function rows($key_id=false){

		$data['itens'] = $this->Recurrency->index($key_id);

		$this->load->view('recurrencies/rows', $data);		

	}
	
	public function view($recurrency_id){

		$item = $this->Recurrency->get_item($recurrency_id);		

		$this->load->vars(array("page"=>"recurrencies/view"));		

		$this->load->view('template/template', array('item'=>$item));	

	}	
	
	public function create(){

		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$item = $this->validate();

				$recurrency_id = $this->Recurrency->create($item);

				# GUI option: redirects
					
					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('recurrencies/view/'.$recurrency_id, 'location');

				# API option: return $create

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$this->load->vars(array("page"=>"recurrencies/create"));

		$this->load->view('template/template');

	}


	public function update($recurrency_id){

		$item = $this->Recurrency->get_item($recurrency_id); # Security check
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$item = $this->validate();

				$update = $this->Recurrency->update($recurrency_id, $item);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('recurrencies/view/'.$recurrency_id, 'location');

				# API option: return $update				

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$item = $this->Recurrency->get_item($recurrency_id);		

		$this->load->vars(array("page"=>"recurrencies/update"));		

		$this->load->view('template/template', array('item'=>$item));

	}


	function validate($fields = false){

		$all_fields = array(

			array ( 
					"field"=>"recurrency_account_id", 
					"label"=>"lang:recurrency_account_id", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"recurrency_amount", 
					"label"=>"lang:recurrency_amount", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"recurrency_when_day", 
					"label"=>"lang:recurrency_when_day", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"recurrency_when_month", 
					"label"=>"lang:recurrency_when_month", 
					"rules"=>"trim"
				),
				
								
				array ( 
					"field"=>"recurrency_description", 
					"label"=>"lang:recurrency_description", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"recurrency_limit", 
					"label"=>"lang:recurrency_limit", 
					"rules"=>"required|trim"
				),
				
								
				array ( 
					"field"=>"recurrency_start", 
					"label"=>"lang:recurrency_start", 
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
	
	
	public function remove($recurrency_id){

		$item = $this->Recurrency->get_item($recurrency_id); # Security check
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$remove = $this->Recurrency->remove($recurrency_id);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('recurrencies/index', 'location');

				# API option: return $remove

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$this->lang->line('operation_fail'), "message_class"=>"danger"));

				# $this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger")); # SHOW ERROR

			}

		}

		$item = $this->Recurrency->get_item($recurrency_id);		

		$this->load->vars(array("page"=>"recurrencies/remove"));		

		$this->load->view('template/template', array('item'=>$item));

	}


}

/* End of file recurrencies.php */
/* Location: ./application/controllers/recurrencies.php */