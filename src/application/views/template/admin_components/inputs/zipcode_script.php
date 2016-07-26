<?
	
	#Handle variables initialization
	/*
	
		$field_prefix
	
	*/
	

	
?>

<script>

	// http://www.republicavirtual.com.br/cep/

	$('#<?=$field_prefix?>_zipcode').change( function(){
	
		if($(this).val().length>8){
		
			$('.<?=$field_prefix?>_loading').remove();	
		
			$('#<?=$field_prefix?>_zipcode').after('<div class="<?=$field_prefix?>_loading"><?=$this->lang->line('loading')?></div>');
			
			$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$(this).val(), function(){
							
				if(!resultadoCEP.uf){
					
					$('.<?=$field_prefix?>_loading').html('<?=$this->lang->line('zipcode_not_found')?>');
					
					return false;
					
				}
				
				$('#<?=$field_prefix?>_city_id_state').find('option[acronym="'+resultadoCEP.uf+'"]').attr('selected', 'selected');
				
				$('#<?=$field_prefix?>_city_id_state').trigger('change');
				
				converted_city_name = unescape(resultadoCEP.cidade).toUpperCase().trim();
				
				
				
				$("#<?=$field_prefix?>_city_id_div").on("cities_loaded", function(){
				
					$('#<?=$field_prefix?>_city_id option').filter(function () { return $(this).html() == converted_city_name; }).attr('selected', 'selected');
						
				});
				
				$('#<?=$field_prefix?>_area').val(unescape(resultadoCEP.bairro));
				
				$('#<?=$field_prefix?>_street').val(unescape(resultadoCEP.logradouro));
				
				$('#<?=$field_prefix?>_number').focus();
				
				if(resultadoCEP.bairro.length > 0){
					
					$('#<?=$field_prefix?>_number').focus();
					
				}else{
				
					$('#<?=$field_prefix?>_area').focus();
				
				}
				
				
				$('.<?=$field_prefix?>_loading').remove();	
				
			});
			
					
		
		}
		

	});

	
</script>
