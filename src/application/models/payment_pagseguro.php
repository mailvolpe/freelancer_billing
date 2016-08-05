<?php

class Payment_pagseguro extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	 
		$this->load->model('Invoice');
	 
    }
	


	# Get Checkout URL #

    function get_checkout_url($invoice_id){

		$this->load->library('gateway');
	
		$invoice = $this->Invoice->get_item($invoice_id);

		# Cria o objeto Requisição de Pagamento new paymentRequest();
		# ----------------------------------------------------
		$paymentRequest = new paymentRequest();	

		# Define a moeda utilizada
	    # ----------------------------------------------------	
		$paymentRequest->setCurrency("BRL");  		

		# Definiçao do comprador - Metodo 1
		# ----------------------------------------------------
		$paymentRequest->setSenderName($invoice->account_title);  
		$paymentRequest->setSenderEmail($invoice->account_email); 

		# Adicionando Itens
		# ----------------------------------------------------
		$paymentRequest->addItem(
			$invoice->invoice_id, 
			date("d/m/Y", strtotime($invoice->invoice_due_date)).' - '.$invoice->invoice_description, 
			1, 
			number_format($invoice->invoice_amount, 2, '.', '')
		);

		# Referencia interna - ID da Venda (opcional)
		# ----------------------------------------------------
		$paymentRequest->setReference($invoice->invoice_id);
		
		# Url de notificações para esta transação (opcional)
		# ----------------------------------------------------
		$url = base_url()."pagseguro_notification_url";
		$paymentRequest->setNotificationURL($url);  	
		
		$gateway = new paymentGateway('pagseguro', $this->config->item('credentials_pagseguro'));
		
		$result = $gateway->register($paymentRequest, false);
		
		if(isset($result->checkout_url)){

			return $result->checkout_url;

		}else{
			//print_r($result);exit;
			throw new Exception($result->status.' '.$result->response);
		}
	
		
    }

}


/* End of file payment_pagseguro.php */
/* Location: ./application/models/payment_pagseguro.php */