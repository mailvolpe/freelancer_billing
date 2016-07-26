<?php

/***
 * Class PaymentParser
 */
class PaymentParserCielo
{


	public function parseCredentialsCheck($check){
	
		$credentials_check = new stdClass;
		
		$credentials_check->status = 'valid';
		$credentials_check->valid = true;

		
		if(
			isset($check->payment['transaction_id']) 
				AND (
					$check->payment['transaction_id']=="Credenciais inválidas." 
					OR strstr($check->payment['transaction_id'],"DadosEc") 
				)
		){
			$credentials_check->status = 'invalid';
			$credentials_check->valid = false;		
		}
		
		
		return $credentials_check;
	
	}

	private function translateStatus($status){
	

		$statuses = array(
		
			"5"=>"1",
			"9"=>"1",
			"4"=>"3",
			"6"=>"3"
		
		);
		
		if(isset($statuses[$status])){
			return $statuses[$status];
		}
		
		return "Indefinido: ".$status;	
	
	}

	public function parseTransaction($http_query, $dump_all=false){
		
		$xml = simplexml_load_string($http_query->setResponse, "SimpleXMLElement", LIBXML_NOCDATA);
		
		$json = json_encode($xml);
		
		$array = json_decode($json,TRUE);	

		# print_r($array);

		
		$result = new stdClass;
		
		$result->gateway = "cielo";
		
		$result->status = $http_query->setStatus;
		
		$result->reference_id = "";

		if(!isset($array['tid'])){
		
			$result->payment = array(
			
				"code"=>"",
				"transaction_id"=>$array['mensagem'],
				"status"=>$array['codigo'],
				"amount"=>"",
				"date"=>""
			
			);
			
			return $result;
		}
		
		$result->payment = array(
		
			"code"=>"",
			"transaction_id"=>$array['tid'],
			"status"=>self::translateStatus($array['autorizacao']['codigo']),
			"amount"=>$array['dados-pedido']['valor']/100,
			"date"=>$array['dados-pedido']['data-hora']
		
		);		
		
		
		return $result;
		
	}

	public function getCheckData($tid, $credentials, $settings){
	
		$data = new stdClass;
	
		$data->method = "POST";
		
		$data->check_url = $settings['check_url'];
	
		$data->data = array("mensagem" => '<?xml version="1.0" encoding="ISO-8859-1"?>
			<requisicao-consulta id="5" versao="1.2.1">
				<tid>'.$tid.'</tid>
				<dados-ec>
					<numero>'.$credentials['ec_id'].'</numero>
					<chave>'.$credentials['webservice_key'].'</chave>
				</dados-ec>
			</requisicao-consulta>	
		');	
	
		return $data;
	
	}	


	public function parseResults($http_query, $data){
		
		$response = json_decode($http_query->setResponse);
				
		#Sets result Object
		
		$result = new stdClass;
		
		$result->gateway = "cielo";
		
		$result->status = $http_query->setStatus;
		
		
		# Tratamento do retorno do PayPal - Convertendo para o retorno Geral

		if ($http_query->setStatus=="201"){

			
			# Se tiver sucesso na requisição de checkout
			# ------------------------------------------------	
			
			$result->reference_id = $response->orderNumber;
			
			$result->checkout = array(
				"code"=>end(explode("/", $response->settings->checkoutUrl)),
				"date"=>date('c')
			);
			
			$result->checkout_url = $response->settings->checkoutUrl;
			

		}else{

		
			# Exibe mensagem de erro se retornar erro
			# ------------------------------------------------	
			if(isset($response->message)){
				
				$result->errors = array();

				foreach($response->modelState as $error){

					$result->errors[] = array(
						"code"=>$error[0],
						"message"=>$error[1]
					);
					
				}	
				
			}else{
		
				# Se entrar em alguma exceção antes do retorno
				# ------------------------------------------------
				
				$result = $http_query->setResponse;
				
			}
			
		}		
		
		return $result;	
	
	
	}


	public function getHeaders($credentials){
	
		return array(
			'MerchantId: '.$credentials['merchant_id'],
			'Content-Type: application/json'		
		);
	
	}
	
    /***
     * @param $payment PaymentRequest
     * @return mixed
     */
    public function getData($payment, $credentials)
    {
		

		$order = new stdClass();
		
		$order->SoftDescriptor = "ECOMMERCE";
		
        // reference
        if ($payment->getReference() != null) {
            $order->OrderNumber = $payment->getReference();
        }

        // sender
        if ($payment->getSender() != null) {

			$order->Customer = new stdClass();
			
            if ($payment->getSender()->getName() != null) {
                $order->Customer->FullName = $payment->getSender()->getName();
            }
			
			
            if ($payment->getSender()->getEmail() != null) {
                $order->Customer->Email = $payment->getSender()->getEmail();
            }

            // phone
            if ($payment->getSender()->getPhone() != null) {
				
				$order->Customer->Phone = "";
				
                if ($payment->getSender()->getPhone()->getAreaCode() != null) {
                    $order->Customer->Phone .= $payment->getSender()->getPhone()->getAreaCode();
                }
                if ($payment->getSender()->getPhone()->getNumber() != null) {
                    $order->Customer->Phone .= $payment->getSender()->getPhone()->getNumber();
                }
            }
			
        }

		$order->Cart = new stdClass();
		
        // items
        $items = $payment->getItems();
		
        if (count($items) > 0) {

			$order->Cart->Items = array();
			
            $i = 0;

            foreach ($items as $key => $value) {
                
				$order->Cart->Items[$i] = new stdClass();
				
				$order->Cart->Items[$i]->Type = "Payment";
				
                if ($items[$key]->getId() != null) {
					$order->Cart->Items[$i]->Sku = $items[$key]->getId();
                }
                if ($items[$key]->getDescription() != null) {
					$order->Cart->Items[$i]->Name = $items[$key]->getDescription();
					$order->Cart->Items[$i]->Description = $items[$key]->getDescription();
                }
                if ($items[$key]->getQuantity() != null) {
                    $order->Cart->Items[$i]->Quantity = $items[$key]->getQuantity();
                }
                if ($items[$key]->getAmount() != null) {
					$order->Cart->Items[$i]->UnitPrice = Helper::intFormat($items[$key]->getAmount());

                }
                if ($items[$key]->getWeight() != null) {
                    $order->Cart->Items[$i]->Weight = $items[$key]->getWeight();
                }
				
				$i++;
            }
        }

        // extraAmount
        if ($payment->getExtraAmount() != null) {

			if($payment->getExtraAmount()<0){
			
				$order->Cart->Discount = new stdClass();
				$order->Cart->Discount->Type = 'Amount';
				$order->Cart->Discount->Value = Helper::intFormat($payment->getExtraAmount()*-1);
		
			}

        }

        // shipping
        if ($payment->getShipping() != null) {

			$order->Shipping = new stdClass();
			
			$order->Shipping->Type = 'FixedAmount';
					
            if ($payment->getShipping()->getType() != null && $payment->getShipping()->getType()->getValue() != null) {
                
				$shiping_type = new shippingType();
				$shipping_type_value = $payment->getShipping()->getType()->getValue();
				
				$order->Shipping->Services = array();
				$order->Shipping->Services[0] = new stdClass();
				$order->Shipping->Services[0]->Name = $shiping_type->getTypeFromValue($shipping_type_value);
				$order->Shipping->Services[0]->Price = Helper::intFormat($payment->getShipping()->getCost());
				$order->Shipping->Services[0]->DeadLine = 15;						
				
            }
			
            // address
            if ($payment->getShipping()->getAddress() != null) {
			
				$order->Shipping->Address = new stdClass();
			
                if ($payment->getShipping()->getAddress()->getStreet() != null) {
                    $order->Shipping->Address->Street = $payment->getShipping()->getAddress()->getStreet();
                }
                if ($payment->getShipping()->getAddress()->getNumber() != null) {
                    $order->Shipping->Address->Number = $payment->getShipping()->getAddress()->getNumber();
                }
                if ($payment->getShipping()->getAddress()->getComplement() != null) {
                    $order->Shipping->Address->Complement = $payment->getShipping()->getAddress()->getComplement();
                }
                if ($payment->getShipping()->getAddress()->getCity() != null) {
                    $order->Shipping->Address->City = $payment->getShipping()->getAddress()->getCity();
                }
                if ($payment->getShipping()->getAddress()->getState() != null) {
                    $order->Shipping->Address->State = $payment->getShipping()->getAddress()->getState();
                }
                if ($payment->getShipping()->getAddress()->getDistrict() != null) {
					$order->Shipping->Address->District = $payment->getShipping()->getAddress()->getDistrict();
                }
                if ($payment->getShipping()->getAddress()->getPostalCode() != null) {
                    $order->Shipping->TargetZipCode = $payment->getShipping()->getAddress()->getPostalCode();
                }

            }
        }
		
		$order->Options = new stdClass();
		$order->Options->AntifraudEnabled = false;

        return json_encode($order);
    }


}
