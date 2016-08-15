<?php

class Payment_pagseguro extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	 
		$this->load->model('Invoice');
	 
    }

    function update_invoice($notification_code){

        # Consultar a notificação recebida

        $url = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/".$notification_code."?email=".$this->System_settings->settings->pagseguro_credentials_email."&token=".$this->System_settings->settings->pagseguro_credentials_token;
	
        $contents = file_get_contents($url);

        $parser = new XmlParser($contents);  

        # Transforma a notificação em um array

        $array = $parser->getResult('transaction');

        # Transforma a notificação em um Objeto para ser inserido na tabela de invoice_status_updates

        $item = new stdClass;

        $item->invoice_status_update_invoice_id = $array['reference'];

        $item->invoice_status_update_datetime = $array['lastEventDate'];

        $item->invoice_status_update_gateway = '1';

        $item->invoice_status_update_transaction = $array['code'];

        #Define o status da transacão

        if($array['status']=='1' OR $array['status']=='2'){
            
            $item->invoice_status_update_status_code = 0;

        }elseif($array['status']=='3'){

            $item->invoice_status_update_status_code = 1;

        }elseif($array['status']=='6' OR $array['status']=='7'){

            $item->invoice_status_update_status_code = 2;

        }
        
        #Salva a notificação como atualização de status da fatura

        if(isset($item->invoice_status_update_status_code)){

            $this->Invoice_status_update->create($item);

        }    	

    }
	
	function get_credentials(){
	
	
		# Credenciais PagSeguro
		# ----------------------------------------------
		$credentials = array(
			"email"=>$this->System_settings->settings->pagseguro_credentials_email,
			"token"=>$this->System_settings->settings->pagseguro_credentials_token
		);
		
		return $credentials;
		
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
			$invoice->formatted_invoice_id.' - '.date("d/m/Y", strtotime($invoice->invoice_due_date)).' - '.$invoice->invoice_description, 
			1, 
			number_format($invoice->invoice_amount, 2, '.', '')
		);

		# Referencia interna - ID da Venda (opcional)
		# ----------------------------------------------------
		$paymentRequest->setReference($invoice->invoice_id);
		
		# Url de notificações para esta transação (opcional)
		# ----------------------------------------------------
		$url = base_url()."updates/pagseguro_notifications";
		
		$paymentRequest->setNotificationURL($url);  	
				
		$gateway = new paymentGateway('pagseguro', $this->get_credentials());
		
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