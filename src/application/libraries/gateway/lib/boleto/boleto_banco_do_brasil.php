<?php
require_once 'boleto.php';

class boleto_banco_do_brasil extends boleto
{
	function __construct($config = array())
	{
		if(is_array($config))
		{
			$config['code_base'] = '001';
			parent::__construct($config);
			
			$this->image = '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';
			
			//agencia é sempre 4 digitos
			$this->agency = $this->formata_numero(explode('-', $this->agency)[0],4,0);
			 
			 //conta é sempre 8 digitos
			$this->account = $this->formata_numero(explode('-', $this->account)[0],8,0); 
			
			//agencia e conta
			$this->agencyCode = $this->agency."-". $this->modulo_11($this->agency) ." / ". $this->account ."-". $this->modulo_11($this->account);
			
			$this->portifolioDescription = $this->portifolioMode;
			
			$this->acceptance = 'N';
			
			$this->kindDocument = 'DS';
			
			//Zeros: usado quando Convênio de 7 digitos
			$fixo = '000000';
						
			// Carteira 18 com Convênio de 8 dígitos
			if ($this->agreementFormat == "8") {
			 	$agreement = $this->formata_numero($this->agreement,8,0,"agreement");
				 // Nosso número de até 9 dígitos
			 	$this->ourNumber = $this->formata_numero($this->ourNumber,9,0);
			 	$dv = $this->modulo_11("$this->codeBase$this->currencyCode$this->payFactor$this->amountNumber$fixo$agreement$this->ourNumber$this->portifolioMode");
			 	$this->barCode = "$this->codeBase$this->currencyCode$dv$this->payFactor$this->amountNumber$fixo$agreement$this->ourNumber$this->portifolioMode";
				 //montando o nosso numero que aparecerá no boleto
			 	$this->ourNumber = $agreement . $this->ourNumber ."-". $this->modulo_11($agreement.$this->ourNumber);
			}
			
			// Carteira 18 com Convênio de 7 dígitos
			if ($this->agreementFormat == "7") {
			 	$agreement = $this->formata_numero($this->agreement,7,0,"agreement");
			 	if(((int) $agreement) > 1000000)
			 	{
			 		// Nosso número de até 10 dígitos
				 	$this->ourNumber = $this->formata_numero($this->ourNumber,10,0);
				 	$dv = $this->modulo_11("$this->codeBase$this->currencyCode$$this->payFactor$this->amountNumber$fixo$agreement$this->ourNumber$this->portifolioMode");
				 	$this->barCode = "$this->codeBase$this->currencyCode$dv$this->payFactor$this->amountNumber$fixo$agreement$this->ourNumber$this->portifolioMode";
				 	$this->ourNumber = $agreement.$this->ourNumber;
				 	//Não existe DV na composição do nosso número para Convênio de sete posições		
				 }	 	
			}
			
			
			// Carteira 18 com Convênio de 6 dígitos
			if ($this->agreementFormat == "6") {
			 	$agreement = $this->formata_numero($this->agreement,6,0,"agreement");
			 				
			 	$agreementLenght = strlen($agreement);
			 	// REGRA: Usado apenas p/ Convênio c/ 6 dígitos: informe 1 se for Nosso Número de até 5 dígitos ou 3 para opção de até 17 dígitos
			 	$ourNumberFormat = $agreementLenght < 6 ? '1' : ($agreementLenght < 7 ? '2' : ($agreementLenght < 18 ? '3' : '4'));
			 	
			 	if ($ourNumberFormat == "1") {
			 	
				 	// Nosso número de até 5 dígitos
			 		$this->ourNumber = $this->formata_numero($this->ourNumber,5,0);
			 		$dv = $this->modulo_11("$this->codeBase$this->currencyCode$this->payFactor$this->amountNumber$agreement$this->ourNumber$this->agency$this->account$this->portifolioMode");
			 		$this->barCode = "$this->codeBase$this->currencyCode$dv$this->payFactor$this->amountNumber$agreement$this->ourNumber$this->agency$this->account$this->portifolioMode";
			 		//montando o nosso numero que aparecerá no boleto
					$this->ourNumber = $agreement . $this->ourNumber ."-". $this->modulo_11($agreement.$this->ourNumber);
			 	}
			 	
			 	if ($ourNumberFormat == "2") {
			 			
			 		if($this->portifolioMode == '17') {
				 		// Nosso número de até 5 dígitos
				 		$this->ourNumber = $this->formata_numero($this->ourNumber,5,0);
				 		$dv = $this->modulo_11("$this->codeBase$this->currencyCode$this->payFactor$this->amountNumber$agreement$this->ourNumber$this->agency$this->account$this->portifolioMode");
				 		$this->barCode = "$this->codeBase$this->currencyCode$dv$this->payFactor$this->amountNumber$agreement$this->ourNumber$this->agency$this->account$this->portifolioMode";
				 		//montando o nosso numero que aparecerá no boleto
				 		$this->ourNumber = $agreement . $this->ourNumber ."-". $this->modulo_11($agreement.$this->ourNumber);
			 		}
			 	}
			
			 	
			 	if ($ourNumberFormat == "3") {
			 	
			 		if($this->portifolioMode == '16' || $this->portifolioMode == '18')
			 		{
				 		// Nosso número de até 17 dígitos
				 		$nservico = "21";
				 		$this->ourNumber = $this->formata_numero($this->ourNumber,17,0);
				 		$dv = $this->modulo_11("$this->codeBase$this->currencyCode$this->payFactor$this->amountNumber$agreement$this->ourNumber$nservico");
				 		$this->barCode = "$this->codeBase$this->currencyCode$dv$this->payFactor$this->amountNumber$agreement$this->ourNumber$nservico";
				 	}
				 }
		 	}
			
			$this->barNumber = $this->monta_linha_digitavel($this->barCode);			 
		}
	}
	
	function modulo_10($num) {
		$numtotal10 = 0;
		$fator = 2;

		for ($i = strlen($num); $i > 0; $i--) {
			$numeros[$i] = substr($num,$i-1,1);
			$parcial10[$i] = $numeros[$i] * $fator;
			$numtotal10 .= $parcial10[$i];
			if ($fator == 2) {
				$fator = 1;
			}
			else {
				$fator = 2;
			}
		}

		$soma = 0;
		for ($i = strlen($numtotal10); $i > 0; $i--) {
			$numeros[$i] = substr($numtotal10,$i-1,1);
			$soma += $numeros[$i];
		}
		$resto = $soma % 10;
		$digito = 10 - $resto;
		if ($resto == 0) {
			$digito = 0;
		}

		return $digito;
	}

	/*
	 #################################################
	 FUNÇÃO DO M�DULO 11 RETIRADA DO PHPBOLETO

	 ESTA FUNÇÃO PEGA O D�GITO VERIFICADOR:

	 NOSSONUMERO
	 AGENCIA
	 CONTA
	 CAMPO 4 DA LINHA DIGITÁVEL
	 #################################################
	 */

	function modulo_11($num, $base=9, $r=0) {
		$soma = 0;
		$fator = 2;
		for ($i = strlen($num); $i > 0; $i--) {
			$numeros[$i] = substr($num,$i-1,1);
			$parcial[$i] = $numeros[$i] * $fator;
			$soma += $parcial[$i];
			if ($fator == $base) {
				$fator = 1;
			}
			$fator++;
		}
		if ($r == 0) {
			$soma *= 10;
			$digito = $soma % 11;

			//corrigido
			if ($digito == 10) {
				$digito = "X";
			}

			/*
			 O módulo 11 só gera os digitos verificadores do nossonumero,
			 agencia, conta e digito verificador com codigo de barras

			 No BB, os dígitos verificadores podem ser X ou 0 (zero) para agencia, conta e nosso numero,
			 mas nunca pode ser X ou 0 (zero) para a linha digitável, justamente por ser totalmente num�rica.

			 Quando passamos os dados para a função, fica assim:

			 Agencia = sempre 4 digitos
			 Conta = até 8 dígitos
			 Nosso número = de 1 a 17 digitos

			 A unica variável que passa 17 digitos é a da linha digitada, justamente por ter 43 caracteres

			 Entao se (strlen($num) == 43) { não deixar dar digito X ou 0 }
			 */

			if (strlen($num) == "43") {
				//então estamos checando a linha digitável
				if ($digito == "0" or $digito == "X" or $digito > 9) {
					$digito = 1;
				}
			}
			return $digito;
		}
		elseif ($r == 1){
			$resto = $soma % 11;
			return $resto;
		}
	}
	
	function monta_linha_digitavel($linha) {
		// Posição 	Conteúdo
		// 1 a 3    Número do banco
		// 4        Código da Moeda - 9 para Real
		// 5        Digito verificador do Código de Barras
		// 6 a 9	Fator Vencimento
		// 10 a 19   Valor (8 inteiros e 2 decimais)
		// 20 a 44  Campo Livre definido por cada banco
	
		// AAABC.CCCCX DDDDD.DDDDDY EEEEE.EEEEEZ K UUUUVVVVVVVVVV 
		// 1. Campo - composto pelo código do banco, código da moeda, as cinco primeiras posições
		// do campo livre e DV (modulo10) deste campo
		
		$p1 = substr($linha, 0, 4);
		$p2 = substr($linha, 19, 5);
		$p3 = $this->modulo_10("$p1$p2");
		$p4 = "$p1$p2$p3";
		$p5 = substr($p4, 0, 5);
		$p6 = substr($p4, 5);
		$campo1 = "$p5.$p6";
	
		// 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
		// e livre e DV (modulo10) deste campo
		$p1 = substr($linha, 24, 10);
		$p2 = $this->modulo_10($p1);
		$p3 = "$p1$p2";
		$p4 = substr($p3, 0, 5);
		$p5 = substr($p3, 5);
		$campo2 = "$p4.$p5";
	
		// 3. Campo composto pelas posicoes 16 a 25 do campo livre
		// e livre e DV (modulo10) deste campo
		$p1 = substr($linha, 34, 10);
		$p2 = $this->modulo_10($p1);
		$p3 = "$p1$p2";
		$p4 = substr($p3, 0, 5);
		$p5 = substr($p3, 5);
		$campo3 = "$p4.$p5";
	
		// 4. Campo - digito verificador do codigo de barras
		$campo4 = substr($linha, 4, 1);
	
		// 5. Campo composto pelo valor nominal pelo valor nominal do documento, sem
		// indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
		// tratar de valor zerado, a representacao deve ser 000 (tres zeros).
		$campo5 = substr($linha, 5, 14);
	
		return "$campo1 $campo2 $campo3 $campo4 $campo5";
	}
}