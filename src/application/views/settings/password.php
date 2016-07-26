<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('update').' '.$this->lang->line('password')?>
			
		</h3>

	</div>

</div>

<!-- /page header -->

<div class="row page-subheader">

	
	
	
</div>	
	
<form method="post" action="" class="form-horizontal" autocomplete="on" role="form" enctype="multipart/form-data">




	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('account_password')?>

		</label>

		<div class="col-sm-9">


			<?=input_field('account_password', set_value('account_password'), 'type="password"');?>

			</div>

	</div>


	<div class="row">
		
		<div class="col-sm-9 col-sm-offset-3 col-xs-12">
		
			<div class="row">
		
				<div class="col-xs-6">
				
					<a class="btn btn-block btn-default" <?=$logged->account_must_change_pass?'disabled':null;?> href="<?=base_url()?>settings" >

						<?=$this->lang->line('cancel')?>
						
					</a>

				</div>
				
				<div class="col-xs-6">

				
					<button type="submit" class="btn btn-danger btn-block">

						<?=$this->lang->line('update').' '.$this->lang->line('password')?>

					</button>		

				</div>		
			
			</div>		
			
		</div>			
		
	</div>
	
	<input type="hidden" name="referer_query_string" value="<?=get_referer_query_string()?>">

</form>   
