<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$value
	
	*/
	
	if(!$parameters){$parameters = 'type="text"';}
	
?>

<input class="form-control <?=$add_classes?>" value="<?=$value?>" name="<?=$field_name?>" id="<?=$field_name?>" <?=$parameters?>>

<?display_error($field_name)?>

