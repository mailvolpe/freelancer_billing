<?php

final class paymentGateway
{

    private $credentials;
    private $gateway_code;
    private $parser;
    private $sandbox;

	public function check_credentials(){
	
		$parser = $this->parser;
		if(isset($this->settings['transaction_format'])){
			$format = $this->settings['transaction_format'];
		}else{
			$format = false;
		}
	
		$check_credentials = $this->get_transaction($format);

		return $parser->parseCredentialsCheck($check_credentials);
		
	}
	
	public function check($transaction, $dump=false){
		
		if(is_array($transaction)){
			$return = array();
			foreach($transaction as $transaction){
				if($this->gateway_code=="paypal") {
					$return[$transaction] = $this->confirm($transaction, $dump);
				}
				$return[$transaction] = $this->get_transaction($transaction, $dump);			
			}

			return $return;
		}

		# Para transações individuais
		
		if($this->gateway_code=="paypal")
			return $this->confirm($transaction, $dump);
		
		
		return $this->get_transaction($transaction, $dump);
			
	}
	
	public function notificationStatus() {
		return $this->parser->notificationStatus($this->credentials);
	}
	
	
	/*
		A funçao confirm tem aplicação específica para paypal.
		Através dela o pagamento é confirmado e seu status se torna aprovado.
	
	*/
	public function confirm($token, $dump=false){
	
	
		# Obtem a transação completa ($dump = true)
		$transaction = $this->get_transaction($token, true);
		
		if(!isset($transaction['CHECKOUTSTATUS']) OR $transaction['CHECKOUTSTATUS']!="PaymentActionCompleted"){
			#Instancia novo payment request
			$paymentRequest = new paymentRequest();	
			# Seleciona o médtodo de confirmação
			$paymentRequest-> addParameter('METHOD', 'DoExpressCheckoutPayment');	
			# Monta a requisição para confirmação da transação
			$paymentRequest->addParametersArray($transaction);
			$register = $this->register($paymentRequest);
		}
		return $this->get_transaction($token, $dump);
	}
	
	
	public function get_transaction($transaction_id, $dump_all=false){

	
		#Inicializa a classe parser do gateway selecionado
		# ----------------------------------------------------	
		$parser = $this->parser;
		
		# Creates data array with credentials and transaction id
		# ----------------------------------------------------		
		$data = $parser->getCheckData($transaction_id, $this->credentials, $this->settings);
		
		#Create request Object
		# ----------------------------------------------------		
		$request = new HTTPRequest();
		
		# Envia os dados
		# ----------------------------------------------------		
		$http_query = $request->curlConnection($data->method, $data->check_url, 30, "UTF-8", $data->data);		
		
		# Retorna os resultados após passar pelo parse do gateway especificado
		# ----------------------------------------------------			
		return $parser->parseTransaction($http_query, $dump_all);

	
	}
	
    public function register(paymentRequest $paymentRequest, $dump_data = false)
    {
		
		
		#Inicializa a classe parser do gateway selecionado
		# ----------------------------------------------------	
		$parser = $this->parser;

		
		# Creates data array with credentials
		# ----------------------------------------------------		
		$data = $parser->getData($paymentRequest, $this->credentials);
		
		
		# Sets headers array
		# ----------------------------------------------------				
		$headers = false;
		if(isset($this->settings['overrideHeaders'])){
			$headers = $parser->getHeaders($this->credentials);
		}
		
		
		# Dumps data if required
		# ----------------------------------------------------				
		if($dump_data){ print_r($data);}
		
		
		if(isset($this->settings['request_url'])){

		
			#Create request Object
			# ----------------------------------------------------		
			$request = new HTTPRequest();
			
						
			# Envia os dados
			# ----------------------------------------------------		
			$http_query = $request->curlConnection("POST", $this->settings['request_url'], 30, "UTF-8", $data, $headers);

			
		}else{
		
			$http_query = false;
		
		}
		
		
		# Retorna os resultados após passar pelo parse do gateway especificado
		# ----------------------------------------------------			
		return $parser->parseResults($http_query, $data);
		
		
    }
	
	public function gatewaySettings(){
		$parsers = array(
			'pagseguro'=>'PaymentParserPagSeguro',
			'paypal'=>'PaymentParserPayPal',
			'cielo'=>'PaymentParserCielo',
			'boleto'=>'PaymentParserBoleto'
		
		);
		if(!isset($parsers[$this->gateway_code])){
			throw new Exception('invalid_gateway_code');
		}
		$this->parser = new  $parsers[$this->gateway_code]($this->sandbox);
		$settings = array();
		switch($this->gateway_code) {
			case 'pagseguro':
				$settings['request_url'] = $this->parser->getRequestURL();
				break;
			case 'paypal':
                                $settings['request_url'] = 'https://api-3t'.($this->sandbox ? '.sandbox' : '').'.paypal.com/nvp';
                                break;
			case 'cielo':
				$settings['request_url'] ='https://cieloecommerce.cielo.com.br/api/public/v1/orders';
				$settings['check_url'] = 'https://ecommerce.cielo.com.br/servicos/ecommwsec.do';
				$settings['overrideHeaders'] = true;
				$settings['transaction_format'] = '00000000000000000000';
			case 'boleto':
				break;
		}
		
		return $settings;		
	}
	
	public function __construct($gateway_code, array $credentials, $sandbox = false){
		$this->gateway_code = $gateway_code;
		$this->credentials = $credentials;
		$this->sandbox = $sandbox;
		$this->settings = $this->gatewaySettings();
	
	}
	
}
