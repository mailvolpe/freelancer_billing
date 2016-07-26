<?php
abstract class boleto {
	
	private $config = array();
	
	protected $image = null; # logo do boleto
	protected $acceptance = null; # Aceite
	protected $account = null; # Conta Corrente
	protected $agency = null; # Agência
	protected $agencyCode = null; # Agencia  / Código
	protected $agreement = null; # Convênio
	protected $agreementFormat = '7'; # Dígitos do convênvio
	protected $amount = '0,00';
	protected $amountNumber = '0';
	protected $barCode = null; # numero do codigo de barras
	public $barNumber = null; # linha digitável
	protected $codeBase = null; # codigo do banco
	protected $codeBaseDV = null; # Digito verificador do banco
	protected $currencyCode = '9'; # quantidade de carateres para moeda
	protected $currencySymbol = 'R$'; # Simbolo monetário
	protected $demonstrative = array(); #  Lista do demonstrativo
	protected $documentDate = null; # Data do documento
	protected $documentNumber = null; # Número do Documento
	protected $expirationDate = null; # Data de expiração
	protected $identification = null; # Identificação
	protected $instructions = array(); # Lista de instruções
	protected $kindDocument = null; # Tipo de Documento
	public $ourNumber = null; # Nosso Número
	protected $payFactor = null; # fator de vencimento
	protected $portifolioMode = null; # Modalidade Carteira
	protected $portifolioDescription = null; # Descrição da Carteira
	protected $processDate = null; # Data do processamento
	protected $quantity = null;	# Quantidade
	protected $unitaryValue = null;	# Valor unitário
	
	# Dados do Cedente
	protected $assignorImage = null; # Filename or Url
	protected $assignorImageType = null; # F = File, U = Url
	protected $assignorName = null;
	protected $assignorDocument = null;
	protected $assignorDocumentType = null;
	protected $assignorAddress = null;
	protected $assignorAddressNumber = null;
	protected $assignorDistrict = null;
	protected $assignorCity = null;
	protected $assignorState = null;
	protected $assignorZipcode = null;
	
	# Dados do Sacado
	protected $payerName = null;
	protected $payerDocument = null;
	protected $payerDocumentType = null;	
	protected $payerAddress = null;
	protected $payerAddressNumber = null;
	protected $payerDistrict = null;
	protected $payerCity = null;
	protected $payerState = null;
	protected $payerZipcode = null;		
	
	function __construct($config = array())
	{
		if(is_array($config))
			$this->config = $config;		
		
		$keySets = array(
				'acceptance',
				'account',
				'agency',
				'agreement',		
				'agreement_format',
				'amount', 
				'code_base',
				'currency_symbol',
				'demonstrative',
				'document_date',
				'document_number',
				'expiration_date',
				'identification', 
				'instructions',
				'kind_document', 
				'our_number',
				'portifolio_mode',
				'portifolio_description',
				'quantity', 
				'unitary_value'							
		);
		
		foreach ($this->config as $key => $value) {
			if(substr($key, 0, 6) == 'payer_' || substr($key, 0, 9) == 'assignor_' || in_array($key, $keySets)) {
				$p = explode('_', $key);
				$i = 0;
				$var = $p[0];
				
				while(count($p) > ($i++) ? isset($p[$i]) : false)
					$var .= strtoupper($p[$i]{0}).substr($p[$i], 1);
				
				$this->{$var} = $value;
			}
		}
		
		$this->codeBaseDV = $this->geraCodigoBanco($this->codeBase);
		$this->payFactor = $this->fator_vencimento($this->expirationDate); # Calcula Fator de Vencimento
		$this->amountNumber = $this->formata_numero($this->amount,10,0); # valor tem 10 digitos, sem virgula
		$this->processDate = date('d/m/Y');
		$this->agreement = ((int)$this->agreement).'';
		
		if(!is_array($this->demonstrative))
			$this->demonstrative = array($this->demonstrative);
		
		if(!is_array($this->instructions))
			$this->instructions = array($this->instructions);
	}
	
	/**
	 * 
	 * @param string $image
	 * @param string $type U = url, F = File
	 * @return string
	 */
	function getImage($image, $type = null) {
		
		$ext = 'png';
		$src = false;
		
		if($type != null)
		{
			if(strtoupper($type{0}) == 'F')
			{
				$ext = pathinfo($image, PATHINFO_EXTENSION);
				if($ext == 'jpeg')
					$ext = 'jpg';
				
				$imgbinary = fread(fopen($image, "r"), filesize($image));
				$src = base64_encode($imgbinary);
				
				
			}
			elseif(strtoupper($type{0}) == 'U')
			{
				$data = file_get_contents($image);
				$src = base64_encode($data);				
			}
		}
		
		if(!$src && $type == null) {
			$p = "iVBORw0KGgoAAAANSUhEUgAAAAoAAABQAQMAAAAa6XZvAAAAA1BMVEUAAACnej3aAAAADElEQVR42mNgGFkAAADwAAE4aVpRAAAAAElFTkSuQmCC";
			
			$b = "iVBORw0KGgoAAAANSUhEUgAAAAoAAABQAQMAAAAa6XZvAAAAA1BMVEX///+nxBvIAAAADElEQVR42mNgGFkAAADwAAE4aVpRAAAAAElFTkSuQmCC";
			
			$n6 = "iVBORw0KGgoAAAANSUhEUgAAApkAAAACAQAAAAA76vpWAAAAGUlEQVR42mNgbDiQYCDBw8ZMPUYDAy0MBQCvGyXfT4/GUQAAAABJRU5ErkJggg==";
			
			$n3 = "iVBORw0KGgoAAAANSUhEUgAAAAIAAAATAQMAAACA8k5ZAAAAA1BMVEUAAACnej3aAAAADElEQVR42mNgIAYAAAAmAAEy2MJFAAAAAElFTkSuQmCC";
			
			$n2 = "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAACklEQVR42mNgAAAAAgAB5Sfe/AAAAABJRU5ErkJggg==";
			
			$n1 = "iVBORw0KGgoAAAANSUhEUgAAAAEAAAATAQMAAABrxfVaAAAAA1BMVEUAAACnej3aAAAADElEQVR42mNgIAYAAAAmAAEy2MJFAAAAAElFTkSuQmCC";

			$src = $$image;
		}
		
		return "data:image/$ext;base64,$src";
	}
	
	function formata_numero($numero,$loop,$insert,$tipo = "default") {
		if ($tipo == "default") {
			$numero = str_replace(",","",$numero);
			while(strlen($numero)<$loop){
				$numero = $insert . $numero;
			}
		}
		
		if ($tipo == "agreement") {
			while(strlen($numero)<$loop){
				$numero = $numero . $insert;
			}
		}
		return $numero;
	}
	
	
	function fbarcode($valor){
	
		$fino = 1 ;
		$largo = 3 ;
		$altura = 50 ;
	
	  	$barcodes[0] = "00110" ;
	 	$barcodes[1] = "10001" ;
	  	$barcodes[2] = "01001" ;
	  	$barcodes[3] = "11000" ;
	  	$barcodes[4] = "00101" ;
	  	$barcodes[5] = "10100" ;
	  	$barcodes[6] = "01100" ;
	  	$barcodes[7] = "00011" ;
	  	$barcodes[8] = "10010" ;
	  	$barcodes[9] = "01010" ;
	  	for($f1=9;$f1>=0;$f1--){ 
	    	for($f2=9;$f2>=0;$f2--){  
	      		$f = ($f1 * 10) + $f2 ;
	      		$texto = "" ;
	      		for($i=1;$i<6;$i++){ 
	        		$texto .=  substr($barcodes[$f1],($i-1),1) . substr($barcodes[$f2],($i-1),1);
	      		}
	      		$barcodes[$f] = $texto;
	    	}
	  	}
	
	
		//Desenho da barra
	
		//Guarda inicial
	?><img src="<?=$this->getImage("p")?>" width=<?php echo $fino?> height=<?php echo $altura?> border=0><img 
	src="<?=$this->getImage("b")?>" width=<?php echo $fino?> height=<?php echo $altura?> border=0><img 
	src="<?=$this->getImage("p")?>" width=<?php echo $fino?> height=<?php echo $altura?> border=0><img 
	src="<?=$this->getImage("b")?>" width=<?php echo $fino?> height=<?php echo $altura?> border=0><img 
	<?php
		$texto = $valor ;
		if((strlen($texto) % 2) <> 0){
			$texto = "0" . $texto;
		}
	
		// Draw dos dados
		while (strlen($texto) > 0) {
	  		$i = round($this->esquerda($texto,2));
	  		$texto = $this->direita($texto,strlen($texto)-2);
	  		$f = $barcodes[$i];
	  		for($i=1;$i<11;$i+=2){
	    		if (substr($f,($i-1),1) == "0") {
	      			$f1 = $fino ;
	    		}else{
	      			$f1 = $largo ;
	    		}
	?>
	    src="<?=$this->getImage("p")?>" width=<?php echo $f1?> height=<?php echo $altura?> border=0><img 
	<?php
	    		if (substr($f,$i,1) == "0") {
	      			$f2 = $fino ;
	    		}else{
	      			$f2 = $largo ;
	    		}
	?>
	    src="<?=$this->getImage("b")?>" width=<?php echo $f2?> height=<?php echo $altura?> border=0><img 
	<?php
	  		}
		}
	
	// Draw guarda final
	?>
	src="<?=$this->getImage("p")?>" width=<?php echo $largo?> height=<?php echo $altura?> border=0><img 
	src="<?=$this->getImage("b")?>" width=<?php echo $fino?> height=<?php echo $altura?> border=0><img 
	src="<?=$this->getImage("p")?>" width=<?php echo 1?> height=<?php echo $altura?> border=0> 
	  <?php
	}//Fim da função
		
	function esquerda($entra,$comp){
		return substr($entra,0,$comp);
	}
	
	function direita($entra,$comp){
		return substr($entra,strlen($entra)-$comp,$comp);
	}
	
	function fator_vencimento($data) {
		$data = explode("/",$data);
		$ano = $data[2];
		$mes = $data[1];
		$dia = $data[0];
	    return(abs(($this->_dateToDays("1997","10","07")) - ($this->_dateToDays($ano, $mes, $dia))));
	}
	
	function _dateToDays($year,$month,$day) {
	    $century = substr($year, 0, 2);
	    $year = substr($year, 2, 2);
	    if ($month > 2) {
	        $month -= 3;
	    } else {
	        $month += 9;
	        if ($year) {
	            $year--;
	        } else {
	            $year = 99;
	            $century --;
	        }
	    }
	    return ( floor((  146097 * $century)    /  4 ) +
	            floor(( 1461 * $year)        /  4 ) +
	            floor(( 153 * $month +  2) /  5 ) +
	                $day +  1721119);
	}
	
	function geraCodigoBanco($numero) {
		$parte1 = substr($numero, 0, 3);
		$parte2 = $this->modulo_11($parte1);
		return $parte1 . "-" . $parte2;
	}
	
	function render() {
		$required = array(
				'assignor_name',
				'assignor_document',
				'assignor_document_type',
				'assignor_address',
				'assignor_address_number',
				'assignor_district',
				'assignor_city',
				'assignor_state',
				'assignor_zipcode',
				
				'payer_name',
				'payer_document',
				'payer_document_type',
				'payer_address',
				'payer_address_number',
				'payer_district',
				'payer_city',
				'payer_state',
				'payer_zipcode',
				
				'account',
				'agency',
				'agreement',			
				'amount', 
				'document_date',
				'expiration_date',
				'identification',
				'our_number',
				'portifolio_mode',
				'portifolio_description'					
		);
		
		$valid = true;
		
		foreach ($required as $k) {
			if(!array_key_exists($k, $this->config)) {
				$valid = false;
				break;
			}
		}
		
		if(!$valid) {
			return array('error' => sprintf('O parâmetro "%s" não foi informado.', $k));
		}
				
		ob_start();
		include 'layout.php';
		$html_boleto = ob_get_clean();
		
		return array('content' => $html_boleto, 'data' => $this->config);
	}
}