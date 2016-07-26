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

	if(!$both_label){
	
		$both_label = $this->lang->line('both');
	
	}
	
	$check_string = '';

	if($value>0){
	
		$value = '1';
		
	}elseif($value==='0'){
	
		$value = '0';
		
	}else{
	
		$value = null;
		
	}

?>
	

	<select class="form-control" name="<?=$field_name?>" <?=$params?>>
	
		<option value="" <?=select_test(false, $value)?>><?=$both_label?></option>
		
		<option value="1" <?=select_test('1', $value)?>><?=$on_label?></option>
		
		<option value="0" <?=select_test('0', $value)?>><?=$off_label?></option>
		
	
	</select>

<?=form_error($field_name)?>
