<?php

function internet_exists()
{

	if(ENVIRONMENT=='production'){

		return true;

	}

	#TESTS

    $connected = @fsockopen("facebook.com", 80, $errno, $errstr, 1);  
	//website, port  (try 80 or 443)

    if ($connected){

        $is_conn = true; //action when connected

        fclose($connected);

    }else{

        $is_conn = false; //action in connection failure

    }

    return $is_conn;

}

function has_error($field_name){

	if(form_error($field_name)){

		return 'has-error';

	}

	return false;

}

function display_error($field_name){

	if(form_error($field_name)){

	echo '<p class="help-block">';

	 	echo form_error($field_name);
	 	
	echo '</p>';

	}

}


function validar_cnpj($cnpj){

	$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	// Valida tamanho
	if (strlen($cnpj) != 14)
		return false;
	// Valida primeiro dígito verificador
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	{
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
		return false;
	// Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	{
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
	
}

/* End of file validation_helper.php */
/* Location: ./application/helpers/validation_helper.php */
?>