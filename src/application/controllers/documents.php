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
	
	/**
	 * Exibe as recorrencias do cliente
	 * @param  string $client_hash String que ao passar pela função unhash() retorna id do cliente 
	 * @return (void)              Não retona dados e exibe a tela para o cliente
	 */
	public function recurrencies($client_hash){

	}


	public function invoice($invoice_hash){
	
		$invoice_id = base64_decode(urldecode($invoice_hash));

		$item = $this->Invoice->get_item($invoice_id);		
		
		$item->status_updates = $this->Invoice_status_update->index($item->invoice_id);		
		
		$item->notifications = $this->Invoice_notification->index($item->invoice_id);
		
		$this->load->vars(array("page_title"=>$this->lang->line('invoice').' '.$item->formatted_invoice_id.' - '.$item->formatted_invoice_due_date.' - '.$this->System_settings->settings->system_title));		

		$this->load->vars(array("page"=>"documents/invoice"));		

		$this->load->view('template/documents', array('item'=>$item));	

	}	
	


}

/* End of file accounts.php */
/* Location: ./application/controllers/accounts.php */