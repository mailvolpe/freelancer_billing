<?

	#Breadcrumbs
	if($this->uri->segment(3)){
	
		$active_label = $this->lang->line($this->uri->segment(3));
		
		if($active_label_string){$active_label = $active_label_string;}
		
	}elseif($this->uri->segment(2)){
	
		$active_label = $this->lang->line($this->uri->segment(2));
	
	}else{
		$active_label = false;
	}
	
	if($custom_url){
	
		$url = $custom_url;
	
	}else{
	
		$url = $this->uri->segment(2);
	
	}

?>

<ul class="breadcrumb">

	<li>

		<a href="<?=base_url()?>">

		<?=$this->lang->line('home')?>

		</a>

	</li>

	<? if($this->uri->segment(3)){ ?>
	
		<li>

			<a href="<?=$url?>">

				<?=$this->lang->line($this->uri->segment(2))?>

			</a>

		</li>
		
	<? } ?>
	
	<?if($active_label){?>
		<li class="active">

			<?=$active_label?>

		</li>
	<?}?>

</ul>