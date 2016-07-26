<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$value - Datetime value or 0
		
		$on_label - - determines label using lang->line()
		
		$off_label  - determines label using lang->line()
	
	*/
	
	if(!$on_label){
	
		$on_label = $this->lang->line('yes');
	
	}

	if(!$off_label){
	
		$off_label = $this->lang->line('no');
	
	}
	
	$check_string = 'checked="checked"';
	$check_on = $check_off = false;
	
	if($value>0){
	
		$value = '1';
		$check_on = $check_string;
		
		
	}else{
	
		$value = '0';
		$check_off = $check_string;
		
	}

?>
	
<?=select_field($field_name, array("0"=>$off_label, "1"=>$on_label), $value)?>


<?=form_error($field_name)?>

