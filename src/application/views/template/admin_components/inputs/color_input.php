<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$value
	
	*/
	
	if(!$parameters){$parameters = 'type="text"';}
	
	$bg_value = $value;
	
	if($value == ''){
	
		$bg_value = '#ffffff';
	
	}
	
?>


<input type="color"  name="<?=$field_name?>" class="form-control" value="<?=$value?>" <?=$parameters?>>
	
<?=form_error($field_name)?>
