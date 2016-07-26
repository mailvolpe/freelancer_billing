<?

	#No results warning

	if($title_line){
		$title = $title_line;
	}else{
		$title=$this->lang->line('no_results');
	}


?>

<div class="alert alert-warning alert-dismissable fade in">

	<big>
	
		<?=$title?>
		
	</big>
	
	<p>
	
		<?if($this->input->server('QUERY_STRING')){?>
	
			<?=$this->lang->line('no_results_retry')?> 
			
			<?if(!$print){?>
			
				<a href="<?=rtrim(base_url(), "/").$_SERVER['REDIRECT_QUERY_STRING']?>" >
				
					<?=$this->lang->line('clear_filters')?>
					
				</a>
				
			<?}?>
		
		<?}else{?>
		
			<?=$this->lang->line('no_results_at_all')?> 
		
		<?}?>
		
	</p>
	
</div>					