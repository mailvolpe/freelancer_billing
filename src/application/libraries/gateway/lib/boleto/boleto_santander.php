<?php
require_once 'boleto.php';

class boleto_santander extends boleto
{
	function __construct($config = array())
	{
		if(is_array($config))
		{
			$config['code_base'] = '033'; //Antigamente era 353
			parent::__construct($config);
		
			$this->image = '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';
	
			//convenio deve possuir 7 caracteres
			$this->agreement = $this->formata_numero($this->agreement,7,0);
			
			$convFormat = substr($this->agreement,0,strlen($this->agreement)-1).'-'.substr($this->agreement,strlen($this->agreement)-1,1);
			//agencia e conta
			$this->agencyCode = $this->agency ." / ". $convFormat;
			
			// Numero fixo para a posição 05-05
			$fixo     = "9";   
			
			// IOS - somente para Seguradoras (Se 7% informar 7, limitado 9%) Demais clientes usar 0 (zero)
			$ios	  = "0";   
			
			$this->ourNumber = $this->formata_numero($this->ourNumber,7,0);
			
			$dv = $this->modulo_11($this->ourNumber,9,0);
			
			// nosso número (com dvs) são 13 digitos
			$this->ourNumber = "00000".$this->ourNumber.$dv;		
			
			$barra = "$this->codeBase$this->currencyCode$this->payFactor$this->amountNumber$fixo$this->agreement$this->ourNumber$ios$this->portifolioMode";
			
			$dv = $this->digitoVerificador_barra($barra);
			
			// 43 numeros para o calculo do digito verificador do codigo de barras
			$this->barCode = substr($barra,0,4) . $dv . substr($barra,4);		
			
			$this->barNumber = $this->monta_linha_digitavel($this->barCode);
			
			//nosso número (sem dv) é 11 digitos
			$this->ourNumber = $this->formata_numero($this->ourNumber,7,0);
			$this->ourNumber = substr($this->ourNumber,0,strlen($this->ourNumber)-1).'-'.substr($this->ourNumber,strlen($this->ourNumber)-1,1);
			
			$c = explode(' ', $this->portifolioDescription);
			$this->portifolioDescription .= ' - ';
			foreach ($c as $x)
				$this->portifolioDescription .= strtoupper($x{0});
		}		
	}
	
	function modulo_10($num) {
		$numtotal10 = 0;
		$fator = 2;
	
		// Separacao dos numeros
		for ($i = strlen($num); $i > 0; $i--) {
			// pega cada numero isoladamente
			$numeros[$i] = substr($num,$i-1,1);
			// Efetua multiplicacao do numero pelo (falor 10)
			// 2002-07-07 01:33:34 Macete para adequar ao Mod10 do Itaú
			$temp = $numeros[$i] * $fator;
			$temp0=0;
			foreach (preg_split('//',$temp,-1,PREG_SPLIT_NO_EMPTY) as $k=>$v){ $temp0+=$v; }
			$parcial10[$i] = $temp0; //$numeros[$i] * $fator;
			// monta sequencia para soma dos digitos no (modulo 10)
			$numtotal10 += $parcial10[$i];
			if ($fator == 2) {
				$fator = 1;
			} else {
				$fator = 2; // intercala fator de multiplicacao (modulo 10)
			}
		}
			
		// várias linhas removidas, vide função original
		// Calculo do modulo 10
		$resto = $numtotal10 % 10;
		$digito = 10 - $resto;
		if ($resto == 0) {
			$digito = 0;
		}
			
		return $digito;
			
	}
	
	function modulo_11($num, $base=9, $r=0)  {
		/**
		 *   Autor:
		 *           Pablo Costa <pablo@users.sourceforge.net>
		 *
		 *   Função:
		 *    Calculo do Modulo 11 para geracao do digito verificador
		 *    de boletos bancarios conforme documentos obtidos
		 *    da Febraban - www.febraban.org.br
		 *
		 *   Entrada:
		 *     $num: string numérica para a qual se deseja calcularo digito verificador;
		 *     $base: valor maximo de multiplicacao [2-$base]
		 *     $r: quando especificado um devolve somente o resto
		 *
		 *   Saída:
		 *     Retorna o Digito verificador.
		 *
		 *   Observações:
		 *     - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
		 *     - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
		 */
	
		$soma = 0;
		$fator = 2;
	
		/* Separacao dos numeros */
		for ($i = strlen($num); $i > 0; $i--) {
			// pega cada numero isoladamente
			$numeros[$i] = substr($num,$i-1,1);
			// Efetua multiplicacao do numero pelo falor
			$parcial[$i] = $numeros[$i] * $fator;
			// Soma dos digitos
			$soma += $parcial[$i];
			if ($fator == $base) {
				// restaura fator de multiplicacao para 2
				$fator = 1;
			}
			$fator++;
		}
	
		/* Calculo do modulo 11 */
		if ($r == 0) {
			$soma *= 10;
			$digito = $soma % 11;
			if ($digito == 10) {
				$digito = 0;
			}
			return $digito;
		} elseif ($r == 1){
			$resto = $soma % 11;
			return $resto;
		}
	}
	
	function modulo_11_invertido($num) {  // Calculo de Modulo 11 "Invertido" (com pesos de 9 a 2  e nÃ£o de 2 a 9)
		$ftini = 2;
		$fator = $ftfim = 9;
		$soma = 0;
	
		for ($i = strlen($num); $i > 0; $i--)
		{
			$soma += substr($num,$i-1,1) * $fator;
			if(--$fator < $ftini)
				$fator = $ftfim;
		}
	
		$digito = $soma % 11;
	
		if($digito > 9)
			$digito = 0;
	
		return $digito;
	}
	
	function monta_linha_digitavel($linha)
	{
		// Posição 	Conteúdo
		// 1 a 3    Número do banco
		// 4        Código da Moeda - 9 para Real ou 8 - outras moedas
		// 5        Fixo "9'
		// 6 a 9    PSK - codigo cliente (4 primeiros digitos)
		// 10 a 12  Restante do PSK (3 digitos)
		// 13 a 19  7 primeiros digitos do Nosso Numero
		// 20 a 25  Restante do Nosso numero (8 digitos) - total 13 (incluindo digito verificador)
		// 26 a 26  IOS
		// 27 a 29  Tipo Modalidade Carteira
		// 30 a 30  Dígito verificador do cÃ³digo de barras
		// 31 a 34  Fator de vencimento (qtdade de dias desde 07/10/1997 até a data de vencimento)
		// 35 a 44  Valor do tÃ­tulo
	
		// 1. Primeiro Grupo - composto pelo código do banco, código da moeda, Valor Fixo "9"
		// e 4 primeiros digitos do PSK (codigo do cliente) e DV (modulo10) deste campo
		$p1 = substr($linha,0,3) . substr($linha,3,1) . substr($linha,19,1) . substr($linha,20,4);
		$p1 = $p1 . $this->modulo_10($p1);
		$p1 = substr($p1, 0, 5).'.'.substr($p1, 5);	
	
	
		// 2. Segundo Grupo - composto pelas 3 Ãºltimas posiÃ§oes do PSK e 7 primeiros dígitos do Nosso Número
		// e DV (modulo10) deste campo
		$p2 = substr($linha,24,10);
		$p2 = $p2 . $this->modulo_10($p2);
		$p2 = substr($p2, 0, 5).'.'.substr($p2, 5);
	
	
		// 3. Terceiro Grupo - Composto por : Restante do Nosso Numero (6 digitos), IOS, Modalidade da Carteira
		// e DV (modulo10) deste campo
		$p3 = substr($linha,34,10);
		$p3 = $p3 . $this->modulo_10($p3);
		$p3 = substr($p3, 0, 5).'.'.substr($p3, 5);	
	
	
		// 4. Campo - digito verificador do codigo de barras
		$p4 = substr($linha, 4, 1);	
	
	
		// 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
		// indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
		// tratar de valor zerado, a representacao deve ser 0000000000 (dez zeros).
		$p5 = substr($linha, 5, 4) . substr($linha, 9, 10);
	
		return "$p1 $p2 $p3 $p4 $p5";
	}
	
	function digitoVerificador_barra($numero) {
		$resto2 = $this->modulo_11($numero, 9, 1);
		if ($resto2 == 0 || $resto2 == 1 || $resto2 == 10) {
			$dv = 1;
		} else {
			$dv = 11 - $resto2;
		}
		return $dv;
	}
}