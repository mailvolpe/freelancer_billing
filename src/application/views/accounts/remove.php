<!-- Page header -->

<div class="page-header">

	<div class="page-title">
	
		<h3><?=$this->lang->line('remove').' '.$this->lang->line('account')?></h3>
		
	</div>
	
</div>

<!-- /page header -->



<form method="post" class="form-horizontal" action="" autocomplete="on" role="form">

		
		

		<div class="form-group">

			<label class="col-sm-3 control-label">

				<?=$this->lang->line('remove')?>

			</label>

			<div class="col-sm-9">

				<p class="form-control-static">
					<?=$this->lang->line('confirm_removal')?>
				</p>

			</div>
			
		</div>
		
		
		<div class="row">
		
			<div class="col-sm-9 col-sm-offset-3 col-xs-12">		
												
				<div class="row">
							
					<div class="col-xs-6">
						<a class="btn btn-default btn-block" href="<?=back_url()?>">

							<?=$this->lang->line('cancel')?>

						</a>
					</div>			
							
					<div class="col-xs-6">
						<button type="submit" class="btn btn-danger btn-block">
						
							<?=$this->lang->line('remove')?> <?=$this->lang->line('account')?>
						
						</button>
					</div>
				
				</div>
			
			</div>
			
		</div>

	<input type="hidden" name="referer_query_string" value="<?=get_referer_query_string()?>">
	
</form>