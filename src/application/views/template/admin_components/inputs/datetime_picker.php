<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$value - Datetime value or null
		
		$time - If (true) sets to time Input
		

	*/
	
	$type = "date";

	$date = explode(" ", $value);
	
	$val = $date[0];
	
	if($time){
	
		$type = "time";
		$val = isset($date[1])?$date[1]:$date[0];
	
	}
	
	
?>


<input class="form-control" type="<?=$type?>" name="<?=$field_name?>" value="<?=$val?>">
		
<?display_error($field_name)?>

