<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$value
		
		$step
		
		$min 
		
		$max
	
	*/
	
	
?>

<input class="form-control" name="<?=$field_name?>" type="number" step="<?=$step?>" value="<?=$value?>" min="<?=$min?>" max="<?=$max?>">

<?display_error($field_name)?>