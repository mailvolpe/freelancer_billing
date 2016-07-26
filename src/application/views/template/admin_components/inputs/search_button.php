<?


?>

<button type="button" onclick="call_<?=$field_name?>_modal('<?=$method_path?>', '<?=$field_name?>');" class="btn  btn-default btn-block btn-sm"><?=$button_label?$button_label:$this->lang->line('search')?></button>

<div class="<?=$field_name?>_modal fade modal" id="<?=$field_name?>_modal" tabindex="-1"></div>

<script>

function call_<?=$field_name?>_modal(){

	$('.<?=$field_name?>_modal').load('<?=$method_path?>/<?=$field_name?>', function() {

		$('#<?=$field_name?>_modal').modal();
		
		$('.<?=$field_name?>_search_button').click(function(){

			call_<?=$field_name?>_rows();
			
		});
				
		$('.<?=$field_name?>_search_field').keypress(function(e) {
			if(e.which == 13) {
			
				call_<?=$field_name?>_rows();
				return false;
				
			}
		});

		$('#<?=$field_name?>_modal').on('hidden.bs.modal', function () {
		  
		  //location.reload();
		  
		})
		
				
	});

}

function call_<?=$field_name?>_rows(){

	$('#<?=$field_name?>_results_rows').load('<?=$method_path?>/<?=$field_name?>/1?keyword_search='+$('.<?=$field_name?>_search_field').val(), function(){
		
		activate_<?=$field_name?>_modal_elements();
		
	});

}

function activate_<?=$field_name?>_modal_elements(){

	$('.<?=$field_name?>_pick_button').click(function(){
		
		var url = "sales_order_items/create/<?=$item->sales_order_id?>/"+$(this).attr('product_id')+"/"+$(this).attr('product_amount');

		$.ajax({
		   type: "POST",
		   url: url,
		   data: false,
		   success: function(data)
		   {
		   
				$('.sales_order_itens').html(data);

		   }
		 });
			
		
		$(this).html('<?=$this->lang->line('added')?>');
		
		$(this).parent().parent().hide(600);
		
	});		
	
			
	$('.<?=$field_name?>_search_button').click(function(){

		call_<?=$field_name?>_rows();
		
	});				

	$('.<?=$field_name?>_amount_input').on('focus', function(){
		$(this).select();
	});
	
	$('.<?=$field_name?>_amount_input').on('input', function(){

		item_total_price = ($(this).attr('product_price')*$(this).val()) ;
	
		if(item_total_price > 0){
	
			$('.<?=$field_name?>_product_'+$(this).attr('product_id')+'_total_price').html('<?=$this->lang->line('currency_symbol')?>'+item_total_price.toFixed(2).replace(".", ","));
			
			$('.<?=$field_name?>_product_'+$(this).attr('product_id')+'_total_price').attr('product_amount', $(this).val());					
			
			$('.<?=$field_name?>_product_'+$(this).attr('product_id')+'_total_price').show();
			
		}else{
		
			$('.<?=$field_name?>_product_'+$(this).attr('product_id')+'_total_price').html('');		
		
			$('.<?=$field_name?>_product_'+$(this).attr('product_id')+'_total_price').hide();
		
		}
		
		
	});					
		
		
/*		
	$('#<?=$field_name?>_create_form').submit(function(e) {
		
		var url = "<?=$method_path?>/<?=$field_name?>/0/1"; // the script where you handle the form input.

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#<?=$field_name?>_create_form").serialize(), // serializes the form's elements.
			   success: function(data)
			   {
					$('#<?=$field_name?>_results_rows').html(data);
					activate_<?=$field_name?>_modal_elements(); //Recursiva neste ponto para ativar elementos carregados.
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
		
	});
*/

	$('.set-focus').focus();	

}

</script>

