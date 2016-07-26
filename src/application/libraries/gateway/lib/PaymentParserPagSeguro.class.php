<?php
/***
 * Class PaymentParser
 */
class PaymentParserPagSeguro
{
	private $url = null;
	private $ws_url = null;
	public function __construct($sandbox = false){
		if($sandbox):
			$this->url = 'https://sandbox.pagseguro.uol.com.br/';
			$this->ws_url = 'https://ws.sandbox.pagseguro.uol.com.br/';
		else:
			$this->url = 'https://pagseguro.uol.com.br/';
			$this->ws_url = 'https://ws.pagseguro.uol.com.br/';
		endif;
	}
	
	public function getRequestURL(){
		return $this->ws_url . 'v2/checkout';
	}
	
	public function parseCredentialsCheck($check){
		$credentials_check = new stdClass;
		$credentials_check->status = 'valid';
		$credentials_check->valid = true;
		
		if(isset($check->response) AND $check->response=="Unauthorized"){
			$credentials_check->status = 'invalid';
			$credentials_check->valid = false;		
		}
		
		return $credentials_check;
	}
	
	public function parseTransaction($http_query, $dump_all=false){
		$result = new stdClass;
		
		$result->gateway = "pagseguro";	
		$result->status = $http_query->setStatus;	
		if ($http_query->setStatus=="200"){
			$parser = new XmlParser($http_query->setResponse);	
			
			$SearchResult = $parser->getResult('transactionSearchResult');
			$transaction = $SearchResult['transactions']['transaction'];
			
			
			if(is_array($transaction)){
				rsort($transaction);
				$transaction = $transaction[0];
			}
			
			if($dump_all)
				return $transaction;
			
			
			$result->reference_id = $transaction['reference'];
			
			$result->payment = array(
				"code"=>"",
				"transaction_id"=>$transaction['code'],
				"status"=>$transaction['status'],
				"amount"=>$transaction['grossAmount'],
				"date"=>$transaction['date'],
			
			);
			
		}elseif($http_query->setStatus=="400"){
			$parser = new XmlParser($http_query->setResponse);	
			$result->errors = $parser->getResult('errors');
		
		}else{
			$result->response = $http_query->setResponse;
		}	
		
		return $result;	
	}
	
	public function getCheckData($transaction_id, $credentials){
		$data = new stdClass;
		$data->data = array();
		$data->method = 'GET';
		$data->check_url = sprintf('%sv2/transactions/?email=%s&token=%s&reference=%s',
			$this->ws_url, $credentials['email'], $credentials['token'], urlencode($transaction_id));
		//$this->ws_url . 'v2/transactions/?email='.$credentials['email'].'&token='.$credentials['token']'&reference='REF12345;
		
		return $data;
	}	
	
	public function notificationStatus($credentials)
	{
		try
		{
			$doc = new DOMDocument();
			
			$xmlurl = sprintf('%sv2/transactions/notifications/%s?email=%s&token=%s',
				$this->ws_url, $_REQUEST['notificationCode'], $credentials['email'], $credentials['token']);
			
			$xml = file_get_contents($xmlurl);
			$xml = mb_convert_encoding($xml, 'UTF-8', mb_detect_encoding($xml));
			
			$doc->loadXML($xml);
				
			$tr = $doc->getElementsByTagName( 'transaction' )->item(0);
			return $tr->getElementsByTagName( 'status' )->item(0)->textContent;
		}
		catch(Exception $e)
		{
			return null;
		}
	}
	
	
	public function parseResults($http_query, $data){
		#Sets result Object
		
		$result = new stdClass;
		$result->gateway = "pagseguro";
		$result->status = $http_query->setStatus;
		
		
		# Tratamento do retorno do Pagseguro - Convertendo para o retorno Geral
		if ($http_query->setStatus=="200"){
		
			# Se tiver sucesso na requisição
			# ------------------------------------------------	
			$parser = new XmlParser($http_query->setResponse);	
			$result->reference_id = $data['reference'];
			$result->checkout = $parser->getResult('checkout');
			$result->checkout_url = $this->url . 'v2/checkout/payment.html?code='.$result->checkout['code'];
			
		}elseif($http_query->setStatus=="400"){
			# Se retornar erro
			# ------------------------------------------------
			$parser = new XmlParser($http_query->setResponse);	
			$result->errors = $parser->getResult('errors');
		}else{
			# Se entrar em alguma exceção antes do retorno
			$result->response = $http_query->setResponse;
		}		
		
		return $result;	
	}

    /***
     * @param $payment PaymentRequest
     * @return mixed
     */
    public function getData($payment, $credentials)
    {
        $data = null;
	$data["email"] = $credentials["email"];
	
	$data["token"] = $credentials["token"];
	
        // reference
        if ($payment->getReference() != null) {
            $data["reference"] = $payment->getReference();
        }
        // sender
        if ($payment->getSender() != null) {
            if ($payment->getSender()->getName() != null) {
                $data['senderName'] = $payment->getSender()->getName();
            }
            if ($payment->getSender()->getEmail() != null) {
                $data['senderEmail'] = $payment->getSender()->getEmail();
            }
            // phone
            if ($payment->getSender()->getPhone() != null) {
                if ($payment->getSender()->getPhone()->getAreaCode() != null) {
                    $data['senderAreaCode'] = $payment->getSender()->getPhone()->getAreaCode();
                }
                if ($payment->getSender()->getPhone()->getNumber() != null) {
                    $data['senderPhone'] = $payment->getSender()->getPhone()->getNumber();
                }
            }
            // documents
            /*** @var $document Document */
            if ($payment->getSender()->getDocuments() != null) {
                $documents = $payment->getSender()->getDocuments();
                if (is_array($documents) && count($documents) == 1) {
                    foreach ($documents as $document) {
                        if (!is_null($document)) {
                            $data['senderCPF'] = $document->getValue();
                        }
                    }
                }
            }
             if ($payment->getSender()->getIP() != null) {
                $data['ip'] = $payment->getSender()->getIP();
            }
        }
        // currency
        if ($payment->getCurrency() != null) {
            $data['currency'] = $payment->getCurrency();
        }
        // items
        $items = $payment->getItems();
        if (count($items) > 0) {
            $i = 0;
            foreach ($items as $key => $value) {
                $i++;
                if ($items[$key]->getId() != null) {
                    $data["itemId$i"] = $items[$key]->getId();
                }
                if ($items[$key]->getDescription() != null) {
                    $data["itemDescription$i"] = $items[$key]->getDescription();
                }
                if ($items[$key]->getQuantity() != null) {
                    $data["itemQuantity$i"] = $items[$key]->getQuantity();
                }
                if ($items[$key]->getAmount() != null) {
                    $amount = Helper::decimalFormat($items[$key]->getAmount());
                    $data["itemAmount$i"] = $amount;
                }
                if ($items[$key]->getWeight() != null) {
                    $data["itemWeight$i"] = $items[$key]->getWeight();
                }
                if ($items[$key]->getShippingCost() != null) {
                    $data["itemShippingCost$i"] = Helper::decimalFormat($items[$key]->getShippingCost());
                }
            }
        }
        // extraAmount
        if ($payment->getExtraAmount() != null) {
            $data['extraAmount'] = Helper::decimalFormat($payment->getExtraAmount());
        }
        // shipping
        if ($payment->getShipping() != null) {
            if ($payment->getShipping()->getType() != null && $payment->getShipping()->getType()->getValue() != null) {
                $data['shippingType'] = $payment->getShipping()->getType()->getValue();
            }
            if ($payment->getShipping()->getCost() != null && $payment->getShipping()->getCost() != null) {
                $data['shippingCost'] = Helper::decimalFormat($payment->getShipping()->getCost());
            }
            // address
            if ($payment->getShipping()->getAddress() != null) {
                if ($payment->getShipping()->getAddress()->getStreet() != null) {
                    $data['shippingAddressStreet'] = $payment->getShipping()->getAddress()->getStreet();
                }
                if ($payment->getShipping()->getAddress()->getNumber() != null) {
                    $data['shippingAddressNumber'] = $payment->getShipping()->getAddress()->getNumber();
                }
                if ($payment->getShipping()->getAddress()->getComplement() != null) {
                    $data['shippingAddressComplement'] = $payment->getShipping()->getAddress()->getComplement();
                }
                if ($payment->getShipping()->getAddress()->getCity() != null) {
                    $data['shippingAddressCity'] = $payment->getShipping()->getAddress()->getCity();
                }
                if ($payment->getShipping()->getAddress()->getState() != null) {
                    $data['shippingAddressState'] = $payment->getShipping()->getAddress()->getState();
                }
                if ($payment->getShipping()->getAddress()->getDistrict() != null) {
                    $data['shippingAddressDistrict'] = $payment->getShipping()->getAddress()->getDistrict();
                }
                if ($payment->getShipping()->getAddress()->getPostalCode() != null) {
                    $data['shippingAddressPostalCode'] = $payment->getShipping()->getAddress()->getPostalCode();
                }
                if ($payment->getShipping()->getAddress()->getCountry() != null) {
                    $data['shippingAddressCountry'] = $payment->getShipping()->getAddress()->getCountry();
                }
            }
        }
        // maxAge
        if ($payment->getMaxAge() != null) {
            $data['maxAge'] = $payment->getMaxAge();
        }
        // maxUses
        if ($payment->getMaxUses() != null) {
            $data['maxUses'] = $payment->getMaxUses();
        }
        // redirectURL
        if ($payment->getRedirectURL() != null) {
            $data['redirectURL'] = $payment->getRedirectURL();
        }
        // notificationURL
        if ($payment->getNotificationURL() != null) {
            $data['notificationURL'] = $payment->getNotificationURL();
        }
        // parameter
        if (count($payment->getParameter()->getItems()) > 0) {
            foreach ($payment->getParameter()->getItems() as $item) {
                if ($item instanceof ParameterItem) {
                    if (!Helper::isEmpty($item->getKey()) && !Helper::isEmpty($item->getValue())) {
                        if (!Helper::isEmpty($item->getGroup())) {
                            $data[$item->getKey() . '' . $item->getGroup()] = $item->getValue();
                        } else {
                            $data[$item->getKey()] = $item->getValue();
                        }
                    }
                }
            }
        }
        return $data;
    }
}
