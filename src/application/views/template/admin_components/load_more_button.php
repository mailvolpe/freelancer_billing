<?

	#Load more button

	#$method (rows OR select_rows)
	
	#target_class (table_body)
	
	$btn_id = '_'.rand(9999, 99992);
	
	#Sets pushstate Limit
	
	if($this->input->get('limit')>0){
	
		$pushstate_limit = $this->input->get('limit');
		
	}else{
	
		$pushstate_limit = $this->config->item('index_query_limit');
	
	}
	
?>

<script>
	window.index_query_limit = <?=$this->config->item('index_query_limit')?>;
</script>

<div class="row">
	<div class="col-xs-12">
		<button class="load_more_button<?=$btn_id?> btn btn-block btn-default" type="button" offset="<?=$this->config->item('index_query_limit')?>">

			<?=$this->lang->line('load_more')?>

		</button>
	</div>
</div>

<script>

	loaded = $('.<?=$target_class?>').find('tr').length;

	if (loaded < <?=$this->config->item('index_query_limit')?>) {

		/* Hides if loads less than query limit */
	
		$(".load_more_button<?=$btn_id?>").toggle();

	}

	$(".load_more_button<?=$btn_id?>").click(function(){
	
		/* Button response */

		$(".load_more_button<?=$btn_id?>").attr('disabled', true);
		$(".load_more_button<?=$btn_id?>").html('<?=$this->lang->line('loading')?>');
		
		//$(".load_more_button<?=$btn_id?>").toggle();
		
		$('html, body').stop();
		
		/*Url to get more rows definition*/

		offset = $(".load_more_button<?=$btn_id?>").attr('offset');

		query_string = "<?=$this->input->server('QUERY_STRING')?>";

		<? $controller = $this->router->fetch_class(); ?>
		
		url = '<?=base_url()?><?=$controller?>/<?=$method?>/<?=$this->uri->segment(3)?>?'+query_string+'&offset='+offset;
		
		//console.log('CL url '+url);
		
		/* Push State to get back with full table - NOT IN SELECT_ROWS CALLS - ONLY ROWS*/
		/*******************************************/
		
		<?if($method=='rows'){?>
		
			pushstate_limit = getUrlParameter('limit');
			
			//console.log('PL before set is '+pushstate_limit);
			
			if(!pushstate_limit>0){
			
				pushstate_limit = <?=$pushstate_limit?>;
				
			}
			
			
			docLocation = document.location.href;
			
			//console.log('was '+docLocation);
			
			//console.log('config limite: '+<?=$this->config->item('index_query_limit')?>)
			
			new_limit = (pushstate_limit*1+<?=$this->config->item('index_query_limit')?>*1);
			
			if(strstr(docLocation, "limit="+pushstate_limit)){
			
				//If limit is in URL
				
				pushLocation = docLocation.replace("limit="+pushstate_limit, "limit="+new_limit);
				
			}else{

				//If limit is NOT in URL (prepend with & joiner)
				
				if(query_string){joiner = '&';}else{joiner = '?';} //Sets proper joiner
				
				pushLocation = docLocation+joiner+'limit='+new_limit;
			
			}
			
			finalStateUrl = pushLocation;
			
			//console.log('PUSH_STATE_LIMIT'+pushstate_limit);
			
			//console.log('set to'+pushLocation);
			
			finalStateUrl = pushLocation;
		
			history.pushState({id: '<?=$btn_id?>'}, '', pushLocation);
		
		<?}?>
		
		/******************************************* enf of pushstate/
		
		/*Ajax call*/

		results = $.get( url, function( data ) {
		
			if(!data){

				/*No results*/
				$(".load_more_button<?=$btn_id?>").toggle();
				
				return;

			}

			/*Row counting*/

			results_count = $(data).filter('tr').length;

			if(results_count < <?=$this->config->item('index_query_limit')?>){

				$(".load_more_button<?=$btn_id?>").toggle();

			}

			/*Appending*/
			
			$(".<?=$target_class?>").append( data );

			$(".load_more_button<?=$btn_id?>").attr('disabled', false);
			$(".load_more_button<?=$btn_id?>").html('<?=$this->lang->line('load_more')?>');
			$(".load_more_button<?=$btn_id?>").focus();
			
			<? if($method=='rows'){ ?>
			
				$('html, body').animate({scrollTop:$(document).height()}, 850);
			
			<? } ?>
			
			/* Activate elements events (tooltips, popups, etc - call application.js) */
			
			activate_element_events(); //Refer to application.js
			
		});
		
		/*Prepare next round*/

		next_offset = (offset*1)+(<?=$this->config->item('index_query_limit')?>*1)

		$(".load_more_button<?=$btn_id?>").attr('offset', next_offset);

		//$(".load_more_button<?=$btn_id?>").toggle();

		
	});

</script>