<?php

/***
 * Class PaymentParser
 */
class PaymentParserBoleto
{


	private function translateStatus($status){
	
	}

	public function parseTransaction($http_query, $dump_all=false){

		
	}

	public function getCheckData($token, $credentials){

	}	


	public function parseResults($http_query, $data){

		return $data;	
	
	}


	
    /***
     * @param $payment PaymentRequest
     * @return mixed
     */
    public function getData($payment, $credentials)
    {
    	$keys = array(
    			'identificacao',
    			'cpf_cnpj',
    			'endereco',
    			'cidade_uf',
    			'cedente',
    			'codigo_cliente', // Código do Cliente (PSK) (Somente 7 digitos)
    			'agencia', // Agencia
    			'carteira', // Cobrança Simples - SEM Registro
    			'carteira_descricao', // Descrição da Carteira
    			'instrucoes',
    			'logo_empresa',
    			'logo_empresa_url',
    			'quantidade',
    			'valor_unitario',
    			'aceite',
    			'especie',
    			'especie_doc',
    			'nosso_numero', // Nosso numero sem o DV - REGRA: Máximo de 7 caracteres!
    			'data_vencimento' // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
    	);
    	
		foreach ($credentials as $key => $value)
			$dadosboleto[$key] = $value;
    	
		$valor_cobrado = 0;

		$dadosboleto["logo_empresa"] = $dadosboleto["logo_empresa_url"] = false;		
		
		// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE

		$dadosboleto["quantidade"] = "";
		$dadosboleto["valor_unitario"] = "";
		$dadosboleto["aceite"] = "";	
		$dadosboleto["especie"] = "R$";
		$dadosboleto["especie_doc"] = "";	
		$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto		
		$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
				
        // reference
        if ($payment->getReference() != null) {
			$dadosboleto["numero_documento"] = $payment->getReference();	// Num do pedido ou nosso numero
        }

        // sender
        if ($payment->getSender() != null) {
			
            if ($payment->getSender()->getName() != null) {
				$dadosboleto["sacado"] = $payment->getSender()->getName();
            }
			
			
            if ($payment->getSender()->getEmail() != null) {
                $dadosboleto["sacado_email"] = $payment->getSender()->getEmail();
            }

            // phone
            if ($payment->getSender()->getPhone() != null) {
				
				$dadosboleto["sacado_fone"] = "";
				
                if ($payment->getSender()->getPhone()->getAreaCode() != null) {
                    $dadosboleto["sacado_fone"] .= $payment->getSender()->getPhone()->getAreaCode();
                }
                if ($payment->getSender()->getPhone()->getNumber() != null) {
                    $dadosboleto["sacado_fone"] .= $payment->getSender()->getPhone()->getNumber();
                }
            }
			
        }
		
        // items
        $items = $payment->getItems();
		
        if (count($items) > 0) {

			$dadosboleto["demonstrativo"] = "";
			
            $i = 0;

            foreach ($items as $key => $value) {                

				if ($items[$key]->getDescription() != null) {
					$dadosboleto["demonstrativo"] .= $items[$key]->getDescription().'<br>';
                }
                				
				$valor_cobrado = $valor_cobrado+( $items[$key]->getQuantity() * $items[$key]->getAmount());
				
				$i++;
            }
        }

        // extraAmount
        if ($payment->getExtraAmount() != null) {

			if($payment->getExtraAmount()<0){
				$dadosboleto["demonstrativo"] .= "Extra: ".Helper::decimalFormat($payment->getExtraAmount()).'<br>';				
				$valor_cobrado = $valor_cobrado + $payment->getExtraAmount();
			}

        }

        // shipping
        if ($payment->getShipping() != null) {
					
            if ($payment->getShipping()->getType() != null && $payment->getShipping()->getType()->getValue() != null) {
                
				$shiping_type = new shippingType();
				
				$shipping_type_value = $payment->getShipping()->getType()->getValue();
				
				$dadosboleto["demonstrativo"] .= $shiping_type->getTypeFromValue($shipping_type_value);				
				$dadosboleto["demonstrativo"] .= ": ".Helper::decimalFormat($payment->getShipping()->getCost()).'<br>';
				
				$valor_cobrado = $valor_cobrado + $payment->getShipping()->getCost();
				
            }
			
            // address
            if ($payment->getShipping()->getAddress() != null) {
			
				$dadosboleto["endereco1"] = $dadosboleto["endereco2"] =  "";
			
                if ($payment->getShipping()->getAddress()->getStreet() != null) {
                    $dadosboleto["endereco1"] .= $payment->getShipping()->getAddress()->getStreet();
                }
                if ($payment->getShipping()->getAddress()->getNumber() != null) {
                    $dadosboleto["endereco1"] .= ", ".$payment->getShipping()->getAddress()->getNumber();
                }
                if ($payment->getShipping()->getAddress()->getComplement() != null) {
                    $dadosboleto["endereco1"] .= " - ".$payment->getShipping()->getAddress()->getComplement();
                }
                if ($payment->getShipping()->getAddress()->getDistrict() != null) {
					$dadosboleto["endereco2"] .= $payment->getShipping()->getAddress()->getDistrict();
                }				
                if ($payment->getShipping()->getAddress()->getCity() != null) {
                    $dadosboleto["endereco2"] .= " - ".$payment->getShipping()->getAddress()->getCity();
                }
                if ($payment->getShipping()->getAddress()->getState() != null) {
                    $dadosboleto["endereco2"] .= " - ".$payment->getShipping()->getAddress()->getState();
                }
                if ($payment->getShipping()->getAddress()->getPostalCode() != null) {
                    $dadosboleto["endereco2"] .= " - ".$payment->getShipping()->getAddress()->getPostalCode();
                }

            }
        }
		
        // parameter
        if (count($payment->getParameter()->getItems()) > 0) {
            foreach ($payment->getParameter()->getItems() as $item) {
                if ($item instanceof ParameterItem) {
                    if (!Helper::isEmpty($item->getKey()) && !Helper::isEmpty($item->getValue())) {
                        if (!Helper::isEmpty($item->getGroup())) {
                            $dadosboleto[$item->getKey() . '' . $item->getGroup()] = $item->getValue();
                        } else {
                            $dadosboleto[$item->getKey()] = $item->getValue();
                        }
                    }
                }
            }
        }		
		
		$dadosboleto["valor_boleto"] = number_format($valor_cobrado, 2, ',', ''); 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula
		
		require_once 'boleto/funcoes_santander_banespa.php';
		
		$fn = new funcoes_santander_banespa($dadosboleto);
		
		ob_start();		
		
		include 'boleto/layout_santander_banespa.php';
		
		$html_boleto = ob_get_clean();
			
        $result = array(
			"data" => $dadosboleto,
			"checkout_html" => $html_boleto
		);
		
		return $result;
		
    }


}
