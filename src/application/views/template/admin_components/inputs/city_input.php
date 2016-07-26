<?

//echo $state_field_value.'<<<>>>'.$city_field_value;

if($city_field_value AND !$state_field_value){

	$state_field_value = $this->System_update->get_state_value_by_city_id($city_field_value);
	
}

$states = $this->System_update->get_addr_states();

$cities = array();

?>


<div class="row">

	<div class="col-sm-4">
	
		

		<select id='<?=$city_field_name.'_state'?>' class="form-control">
		
		<option value="" acronym=""><?=$this->lang->line('select_state')?></option>
		
		
		<? foreach($states as $state){  ?>
		
			<? $selected = false; if($state->addr_state_id == $state_field_value){$selected = 'selected';} ?>
			
			<option <?=$selected?> value="<?=$state->addr_state_id?>" acronym="<?=$state->acronym?>">
			
				<?=$state->state_name?>
				
			</option>
			
		<?}?>
		
		</select>
		
	</div>


	<div class="col-sm-8">
		
		
		<div id="<?=$city_field_name?>_div"></div>
		
		
	</div>

	
	
</div>  
<div><?display_error($city_field_name)?></div>


<script>

	$(function(){

		$('#<?=$city_field_name.'_state'?>').change(function(){
		
			if( $(this).val() ) {
			
				$('#<?=$city_field_name?>_div').html('<p class="form-control-static"><?=$this->lang->line('loading')?></p>');
				
				$.get('updates/cities',{
					addr_state_id: $(this).val(),
					city_field_name: '<?=$city_field_name?>',
					city_field_value: '<?=$city_field_value?>',
					ajax: 'true'
				}, function(j){
					
					$('#<?=$city_field_name?>_div').html(j);
					
					$('#<?=$city_field_name?>_div').trigger( "cities_loaded" );
					
					
				});
				
			}
			
		});
		
	});

	<?if($state_field_value){?>

		$(document).ready(function(){
			$('#<?=$city_field_name.'_state'?>').trigger("change");
		});
		
	<?}?>

</script>