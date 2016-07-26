<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$controller - Sets the foreign controller
		
		$value
		
		$display_value
		
		$option_filter  #array('field'=>'field_name', 'value'=>'parent_item_id')
	
	*/
	if($optional){$sm="9";}else{$sm="12";}

	$option_filters = "";
	
	if(count($option_filter)==2){
		
		$option_filters = ", '".$option_filter['field']."',  '".$option_filter['value']."'";
		
	}
	
?>
	
<div class="row">

	<div class="col-sm-<?=$sm?>">

		<input 
			readonly 
			class="form-control" 
			type="text" 
			id="<?=$field_name?>_display" 
			name="<?=$field_name?>_display" 
			value="<?=$display_value?>"  
			placeholder="<?=$this->lang->line('click_to_select')?>" 
			onclick="callSearchModal('<?=$controller?>', '<?=$field_name?>' <?=$option_filters?>);"
		>

		<input type="hidden" name="<?=$field_name?>" id="<?=$field_name?>" value="<?=$value?>" >

	</div>		

	<?if($optional){?>
	
	<div class="col-sm-3">

			<button type="button" class="btn btn-default btn-block" onclick="cleanSearchField('<?=$field_name?>')">

				<?=$this->lang->line('clear')?>

			</button>

	</div>
	
	<?}?>

</div>	

<?=form_error($field_name)?>