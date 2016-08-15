<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documents extends CI_Controller {


	function __construct(){

		// Call the Model constructor

		parent::__construct();

		/* Security by admin level goes here. */
		
		
		$this->load->model("Account");

		$this->load->model("Invoice");

		$this->load->model("Invoice_status_update");
		
		$this->load->model("Invoice_notification");
		
		$this->load->vars(array("gateways"=>$this->Invoice_status_update->get_invoice_status_gateways()));
		
		$this->load->vars(array("statuses"=>$this->Invoice_status_update->get_invoice_status_update_statuses()));
		
		$this->load->vars(array("notification_types"=>$this->Invoice->get_invoice_statuses()));		

		
	}

	public function payment_pagseguro($invoice_hash){
	
		$invoice_id = base64_decode(urldecode($invoice_hash));

		$item = $this->Invoice->get_item($invoice_id); # Security check
					
		$this->load->model('Payment_pagseguro');
		
		try{

			$checkout_url = $this->Payment_pagseguro->get_checkout_url($invoice_id);

			# GUI option: redirects				

			redirect($checkout_url);

			# API option: return $create

		} catch(Exception $e) {

			set_flash_message($e->getMessage(), 'danger');

			redirect('documents/invoice/'.$invoice_hash, 'location');

		}

	}	
	
	/**
	 * Exibe as recorrencias do cliente
	 * @param  string $client_hash String que ao passar pela função unhash() retorna id do cliente 
	 * @return (void)              Não retona dados e exibe a tela para o cliente
	 */
	public function balance($account_hash){

		$account_id = base64_decode(urldecode($account_hash));

		if(!$data['item'] = $this->Account->get_item($account_id)){
			not_allowed();
		}

		if(!$data['itens'] = $this->Invoice->index($account_id)){
			not_allowed();
		}
		
		$this->load->vars(array("page_title"=>$data['item']->account_title.' - '.$this->lang->line('account_public_url').' - '.$this->System_settings->settings->system_title));		

		$this->load->vars(array("page"=>"documents/balance"));	

		$this->load->view('template/documents', $data);	

	}


	public function invoice($invoice_hash){
	
		$invoice_id = base64_decode(urldecode($invoice_hash));

		if(!$item = $this->Invoice->get_item($invoice_id)){
			not_allowed();
		}
		
		$item->status_updates = $this->Invoice_status_update->index($item->invoice_id);		
		
		$item->notifications = $this->Invoice_notification->index($item->invoice_id);
		
		$this->load->vars(array("page_title"=>$this->lang->line('invoice').' '.$item->formatted_invoice_id.' - '.$item->formatted_invoice_due_date.' - '.$this->System_settings->settings->system_title));		

		$this->load->vars(array("page"=>"documents/invoice"));		

		$this->load->view('template/documents', array('item'=>$item));	

	}	
	


}

/* End of file accounts.php */
/* Location: ./application/controllers/accounts.php */