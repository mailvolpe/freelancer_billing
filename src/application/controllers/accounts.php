<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {


	function __construct(){

		// Call the Model constructor

		parent::__construct();

		/* Security by admin level goes here. */
		
		if(!$this->System_log->is_admin()){
		
			not_allowed();
			
		}		
		
		$this->load->model("Account");

		
	}
	
	public function block($account_id){

		$item = $this->Account->get_item($account_id); # Security check
		
		try{

			$block = $this->Account->block($account_id, $item->account_blocked_date);

			# GUI option: redirects
				
				set_flash_message($this->lang->line('operation_success'), 'success');

				redirect(back_url(), 'location');

			# API option: return $create

		} catch(Exception $e) {

			$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

		}		

	}	
	
	public function index(){
	
		$data['itens'] = $this->Account->index();

		$this->load->vars(array("page" => "accounts/index"));

		$this->load->view('template/template', $data);		
	}


	public function rows($key_id=false){
	
		$this->load->model('Member');
	
		$data['member_posts'] = $this->Member->get_member_posts();

		$data['itens'] = $this->Account->index($key_id);

		$this->load->view('accounts/rows', $data);		

	}
	
	public function view($account_id){
	
		$item = $this->Account->get_item($account_id);		

		if(!$item){redirect('accounts');}
		
		$this->load->vars(array("page"=>"accounts/view"));		

		$this->load->view('template/template', array('item'=>$item));	

	}	
	
	public function create(){
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$item = $this->validate();
								
				$create = $this->Account->create($item);

				# GUI option: redirects
					
					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('accounts/index', 'location');

				# API option: return $create

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger"));

			}

		}

		$this->load->vars(array("page"=>"accounts/create"));

		$this->load->view('template/template');

	}


	public function update($account_id){

	
		$item = $this->Account->get_item($account_id); # Security check
				
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$fields = array(

					array ( 
						"field"=>"account_title", 
						"label"=>"lang:account_title", 
						"rules"=>"required|trim"
					),		
			
					array ( 
						"field"=>"account_email", 
						"label"=>"lang:account_email", 
						"rules"=>"required|valid_email|trim"
					),

					array ( 
						"field"=>"account_must_change_pass", 
						"label"=>"lang:account_must_change_pass", 
						"rules"=>"required|trim"
					)
					
					
			);			
		
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

		$this->load->vars(array("page"=>"accounts/update"));		

		$this->load->view('template/template', array('item'=>$item));

	}


	function validate($fields = false){

		$all_fields = array(

				array ( 
					"field"=>"account_title", 
					"label"=>"lang:account_title", 
					"rules"=>"required|trim"
				),				

				array ( 
					"field"=>"account_password", 
					"label"=>"lang:account_password", 
					"rules"=>"required|trim"
				),

				array ( 
					"field"=>"account_email", 
					"label"=>"lang:account_email", 
					"rules"=>"required|valid_email|trim"
				),

				array ( 
					"field"=>"account_must_change_pass", 
					"label"=>"lang:account_must_change_pass", 
					"rules"=>"required|trim"
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
	
	
	public function remove($account_id){

		if(!$this->System_log->is_admin()){
			not_allowed();
		}	
	
		$item = $this->Account->get_item($account_id); # Security check
	
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			try{

				$remove = $this->Account->remove($account_id);

				# GUI option: redirects

					set_flash_message($this->lang->line('operation_success'), 'success');

					redirect('accounts', 'location');

				# API option: return $remove

			} catch(Exception $e) {

				$this->load->vars(array("message"=>$this->lang->line('operation_fail'), "message_class"=>"danger"));

				# $this->load->vars(array("message"=>$e->getMessage(), "message_class"=>"danger")); # SHOW ERROR

			}

		}

		$item = $this->Account->get_item($account_id);		

		$this->load->vars(array("page"=>"accounts/remove"));		

		$this->load->view('template/template', array('item'=>$item));

	}


}

/* End of file accounts.php */
/* Location: ./application/controllers/accounts.php */