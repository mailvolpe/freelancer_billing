<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$value
		
		$rich_mode
		
		$char_limit
	
	*/
	

	$allowed_charlimit = $char_limit;
	
	if(!$char_limit OR $char_limit==0){
	
		$char_limit = "255";
		
		$allowed_charlimit="0";
		
	}	
	
	if($char_limit > 1000){
	
		$char_limit = "1000";
	
	}
	
?>
				
<textarea 

	id="<?=$field_name?>" 
	
	name="<?=$field_name?>" 
	
	class="form-control"
	
	rows="<?=ceil($char_limit/100)+2?>"

	placeholder="<?=$this->lang->line('type_here')?>"
	
	<?if($allowed_charlimit>0){?>
	
		maxlength="<?=$allowed_charlimit?>" 
		
		onfocus="
		
			$('#<?=$field_name?>').charCount({
			
				allowed: <?=$allowed_charlimit?>,		
				
				warning: <?=ceil($allowed_charlimit/5)?>
				
				}
				
			);
			
		"
	<?}?>
	
	><?=$value?></textarea>
	
<?=form_error($field_name)?>