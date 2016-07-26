<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$options_array
		
		$selected_value
		
		$string
	
	*/


	$check = null;
	$parameters = null;
	$checkLine = 'selected="selected"';
	
	
	
	if(is_array($params)){
		foreach($params as $key=>$value){
			$parameters .= $key.'="'.$value.'"';
		}
	}
	else
	{
		$parameters = $params;
	}
	
?>
	
<select id='<?=$field_name?>' name='<?=$field_name?>' <?=$parameters?> class="form-control">

<?
	foreach($options_array as $key=>$value)
	{

		if(($selected_value OR $selected_value==='0') AND $selected_value == $key)
		{
			$check = $checkLine;
		}else
		{
			$check = null;
		}
?>
		
		<option <?=$check?> value='<?=$key?>'><?=$value?></option>
		
<?	}	?>
	
</select>
	
<?display_error($field_name)?>

