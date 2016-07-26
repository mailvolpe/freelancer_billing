<?

	#Applied filters

	
?>

<div id="applied_filters" class="row">		

	<div class="tagsinput col-xs-12">
	
		<?foreach($_GET as $key=>$value){
		
			$add_string = "";
		
			$url_key = $key; ## Inalterada
		
			#SET TIVER UM _DISPLAY EXIBE O _DISPLAY
			
			if(isset($_GET[$key.'_display']) AND $value !== ''){
			
				$value = $_GET[$key.'_display'];
			
			}
			
			#SE FOR BOOLEANO
			if(strstr($key, "is_") AND $value !== ''){
			
				$value = display_bool_value($value);
			
			}			
			
			#SE FOR MIN
			if(strstr($key, "_min") AND $value !== ''){
			
				$key = str_replace("_min", "", $key);
				
				$add_string = ' '.$this->lang->line('range_min');
			
			}					
		
			#SE FOR MAX
			if(strstr($key, "_max") AND $value !== ''){
			
				$key = str_replace("_max", "", $key);
				
				$add_string = ' '.$this->lang->line('range_max');
			
			}							
		
			$value = format_value($value);
			
			$key = format_key($key);
		
			if($value===false OR $key===false){
			
				continue;
				
			}else{
			
				$filtered = true;			
			
			}
			
		?>
	
			<a href="<?=update_query_string($url_key, '', true)?>" class="btn btn-default tag">
			
				<span class="pull-right tag-remove"><b>x</b></span>
			
				<span><b><?=$this->lang->line($key).$add_string?>:</b> <?=$value?></span>
				
			</a>
		
		<?}?>
		
		<?if(!isset($filtered)){?>
		
			<script>
			
				$('#applied_filters').hide();
				
			</script>							
		
		<?}?>
		
		
	</div>

</div>