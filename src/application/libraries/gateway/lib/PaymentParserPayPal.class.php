<?php

/***
 * Class PaymentParser
 */
class PaymentParserPayPal
{

	public static function parseCredentialsCheck($check){
	
		$credentials_check = new stdClass;
		
		$credentials_check->status = 'valid';
		$credentials_check->valid = true;
		
		if(isset($check['L_ERRORCODE0']) AND $check['L_ERRORCODE0']=="10002"){
			$credentials_check->status = 'invalid';
			$credentials_check->valid = false;		
		}
		
		
		return $credentials_check;
	
	}


	private static function translateStatus($status){
	
		$statuses = array(
		
			"PaymentActionNotInitiated"=>"1",
			"PaymentActionCompleted"=>"3"
		
		);
		
		if(isset($statuses[$status])){
			return $statuses[$status];
		}
		
		return "Indefinido: ".$status;
	
	}

	public static function parseTransaction($http_query, $dump_all=false){
		
		parse_str($http_query->setResponse, $response);
		
		if(!isset($response['TOKEN'])){
			return $response;
		}
		
		if($dump_all){
			return $response;
		}
		
		$result = new stdClass;
		
		$result->gateway = "paypal";
	
		$result->status = $http_query->setStatus;			
		
		$result->reference_id = $response['INVNUM'];	
		
		if(isset($response['PAYMENTREQUEST_0_TRANSACTIONID'])){
			$transaction_id = $response['PAYMENTREQUEST_0_TRANSACTIONID'];
		}else{
			$transaction_id = false;
		}
		
		$result->payment = array(
		
			"code"=>$response['TOKEN'],
			"transaction_id"=>$transaction_id,
			"status"=>self::translateStatus($response['CHECKOUTSTATUS']),
			"amount"=>$response['AMT'],
			"date"=>$response['TIMESTAMP']
		
		);
		
		return $result;
		
	}

	public static function getCheckData($token, $credentials, $settings){
	
		$data = new stdClass;
		
		$data->data = array(
			"TOKEN" => $token,
			"METHOD" => "GetExpressCheckoutDetails",
			"VERSION" => "114.0",
			"USER" => $credentials["email"],
			"PWD" => $credentials["token"],
			"SIGNATURE" => $credentials["signature"]
		);
		
		$data->method = 'POST';
	
		$data->check_url = $settings['request_url'];
		
		return $data;
	
	}	


	public static function parseResults($http_query, $data){
	
		# O retorno do paypal é uma string
		parse_str($http_query->setResponse, $response);
		
		#Sets result Object
		
		$result = new stdClass;
		
		$result->gateway = "paypal";
		
		$result->status = $http_query->setStatus;
		
		
		# Tratamento do retorno do PayPal - Convertendo para o retorno Geral

		if ($http_query->setStatus=="200"){

			# Exibe mensagem de erro se retornar erro
			# ------------------------------------------------	
			
			if($response['ACK']=="Failure"){
				
				$result->errors = array();

				for($i=0; $i>=0; $i++){

					$code = 'L_ERRORCODE'.$i;
					
					if(isset($response[$code])){
				
						$message = 'L_LONGMESSAGE'.$i;
				
						$result->errors['error'] = array(
							"code"=>$response[$code],
							"message"=>$response[$message]
						);
					
					}else{
					
						break;
					
					}
					
				}	
				
			}else{
				
				
				if(isset($response['PAYMENTINFO_0_PAYMENTSTATUS'])){
				
					# Se tiver PAYMENTINFO_0_PAYMENTSTATUS é DoExpressCheckoutPayment
					
					$result->reference_id = $data['PAYMENTREQUEST_0_INVNUM'];
					
					$result->payment = array(
						"code"=>$response['TOKEN'],
						"transaction_id"=>$response['PAYMENTINFO_0_TRANSACTIONID'],
						"status"=>$response['PAYMENTINFO_0_PAYMENTSTATUS'],
						"amount"=>$response['PAYMENTINFO_0_AMT'],
						"date"=>date('c')
					);

					return $result;
				
				}
				
			
				# Se tiver sucesso na requisição de checkout
				# ------------------------------------------------	
				
				$result->reference_id = $data['PAYMENTREQUEST_0_INVNUM'];
				
				$result->checkout = array(
					"code"=>$response['TOKEN'],
					"date"=>date('c')
				);
				
				$result->checkout_url = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=".$response['TOKEN'];
				
			}
			

		}else{
			
			# Se entrar em alguma exceção antes do retorno
			# ------------------------------------------------
			
			$result = $http_query->setResponse;
			
			
		}		
		
		return $result;	
	
	
	}


    /***
     * @param $payment PaymentRequest
     * @return mixed
     */
    public static function getData($payment, $credentials)
    {

        $data = null;
		$total_amount = $shipping_amount = 0;
		
		$data["METHOD"] = "SetExpressCheckout";
		
		$data["VERSION"] = "114.0";
		
		
		$data["USER"] = $credentials["email"];
		$data["PWD"] = $credentials["token"];
		$data["SIGNATURE"] = $credentials["signature"];
		
        // reference
        if ($payment->getReference() != null) {
            $data["PAYMENTREQUEST_0_INVNUM"] = $payment->getReference();
        }

        // sender
        if ($payment->getSender() != null) {

			
            if ($payment->getSender()->getName() != null) {
                $data['PAYMENTREQUEST_0_SHIPTONAME'] = $payment->getSender()->getName();
            }
			
			
            if ($payment->getSender()->getEmail() != null) {
                $data['EMAIL'] = $payment->getSender()->getEmail();
            }

            // phone
            if ($payment->getSender()->getPhone() != null) {
				
				$data['PAYMENTREQUEST_0_SHIPTOPHONENUM'] = "";
				
                if ($payment->getSender()->getPhone()->getAreaCode() != null) {
                    $data['PAYMENTREQUEST_0_SHIPTOPHONENUM'] .= $payment->getSender()->getPhone()->getAreaCode();
                }
                if ($payment->getSender()->getPhone()->getNumber() != null) {
                    $data['PAYMENTREQUEST_0_SHIPTOPHONENUM'] .= $payment->getSender()->getPhone()->getNumber();
                }
            }
			
        }

        // currency
        if ($payment->getCurrency() != null) {
            $data['PAYMENTREQUEST_0_CURRENCYCODE'] = $payment->getCurrency();
        }

        // items
        $items = $payment->getItems();
        if (count($items) > 0) {

            $i = 0;

            foreach ($items as $key => $value) {
                
                if ($items[$key]->getId() != null) {
                    $data["L_PAYMENTREQUEST_0_NUMBER0$i"] = $items[$key]->getId();
                }
                if ($items[$key]->getDescription() != null) {
                    $data["L_PAYMENTREQUEST_0_NAME$i"] = $items[$key]->getDescription();
                }
                if ($items[$key]->getQuantity() != null) {
                    $data["L_PAYMENTREQUEST_0_QTY$i"] = $items[$key]->getQuantity();
                }
                if ($items[$key]->getAmount() != null) {
                    $amount = Helper::decimalFormat($items[$key]->getAmount());
                    $data["L_PAYMENTREQUEST_0_AMT$i"] = $amount;
					$total_amount = $total_amount + $amount * $items[$key]->getQuantity();
                }
                if ($items[$key]->getWeight() != null) {
                    $data["L_PAYMENTREQUEST_0_ITEMWEIGHTVALUE$i"] = $items[$key]->getWeight();
                }
				
				$i++;
            }
        }

        // extraAmount
        if ($payment->getExtraAmount() != null) {
			$i++;
			$data["L_PAYMENTREQUEST_0_AMT$i"] = Helper::decimalFormat($payment->getExtraAmount());
			$total_amount = $total_amount + Helper::decimalFormat($payment->getExtraAmount());
        }

        // shipping
        if ($payment->getShipping() != null) {

			
			$data['ADDROVERRIDE'] = "1";
			
			
            if ($payment->getShipping()->getCost() != null && $payment->getShipping()->getCost() != null) {
                $data['PAYMENTREQUEST_0_SHIPPINGAMT'] = Helper::decimalFormat($payment->getShipping()->getCost());
				$shipping_amount = $data['PAYMENTREQUEST_0_SHIPPINGAMT'];
            }
				
				
            if ($payment->getShipping()->getType() != null && $payment->getShipping()->getType()->getValue() != null) {
                
				$shiping_type = new shippingType();
				$shipping_type_value = $payment->getShipping()->getType()->getValue();
				
				$data['L_SHIPPINGOPTIONISDEFAULT0'] = true;
				$data['L_SHIPPINGOPTIONNAME0'] = $shiping_type->getTypeFromValue($shipping_type_value);
				$data['L_SHIPPINGOPTIONAMOUNT0'] = Helper::decimalFormat($payment->getShipping()->getCost());
				
            }
			
			
            // address
            if ($payment->getShipping()->getAddress() != null) {
			
				$data['PAYMENTREQUEST_0_SHIPTOSTREET'] = "";
			
                if ($payment->getShipping()->getAddress()->getStreet() != null) {
                    $data['PAYMENTREQUEST_0_SHIPTOSTREET'] .= $payment->getShipping()->getAddress()->getStreet();
                }
                if ($payment->getShipping()->getAddress()->getNumber() != null) {
                    $data['PAYMENTREQUEST_0_SHIPTOSTREET'] .= ", ".$payment->getShipping()->getAddress()->getNumber();
                }
                if ($payment->getShipping()->getAddress()->getComplement() != null) {
                    $data['PAYMENTREQUEST_0_SHIPTOSTREET'] .= " - ".$payment->getShipping()->getAddress()->getComplement();
                }
                if ($payment->getShipping()->getAddress()->getCity() != null) {
                    $data['PAYMENTREQUEST_0_SHIPTOCITY'] = $payment->getShipping()->getAddress()->getCity();
                }
                if ($payment->getShipping()->getAddress()->getState() != null) {
                    $data['PAYMENTREQUEST_0_SHIPTOSTATE'] = $payment->getShipping()->getAddress()->getState();
                }
                if ($payment->getShipping()->getAddress()->getDistrict() != null) {
					$data['PAYMENTREQUEST_0_SHIPTOSTREET2'] = $payment->getShipping()->getAddress()->getDistrict();
                }
                if ($payment->getShipping()->getAddress()->getPostalCode() != null) {
                    $data['PAYMENTREQUEST_0_SHIPTOZIP'] = $payment->getShipping()->getAddress()->getPostalCode();
                }
                if ($payment->getShipping()->getAddress()->getCountry() != null) {
                    $data['PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE'] = substr($payment->getShipping()->getAddress()->getCountry(), 0, 2);
                }
            }
        }
		

        // redirectURL
        if ($payment->getRedirectURL() != null) {
            $data['RETURNURL'] = $payment->getRedirectURL();
        }

        // notificationURL
        if ($payment->getNotificationURL() != null) {
            $data['PAYMENTREQUEST_0_NOTIFYURL'] = $payment->getNotificationURL();
        }

        // cancellationURL
        if ($payment->getCancellationURL() != null) {
            $data['CANCELURL'] = $payment->getCancellationURL();
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
				
		if($total_amount>0){
			$data["PAYMENTREQUEST_0_ITEMAMT"] = $total_amount;
		}
		
		if($total_amount>0 OR $shipping_amount>0){
			$data["MAXAMT"] = $data["PAYMENTREQUEST_0_AMT"] = $total_amount + $shipping_amount;
		}
		
		
		
        return $data;
    }


}
