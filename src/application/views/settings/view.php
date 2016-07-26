<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('view').' '.$this->lang->line('settings')?>

			
		</h3>

	</div>

</div>

<!-- /page header -->


<div class="row">

	<div class="form-horizontal col-sm-8 col-xs-12">

		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_title')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->account_title?>

				</p>

			</div>

		</div>			
	
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_email')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->account_email?>

				</p>

			</div>

		</div>
				
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_level')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?/*=$item->account_is_client ? $this->lang->line('account_is_client') : $this->lang->line('account_is_regular')*/?>				
				
					<?
						$account_data = $this->Account->get_account_data($item);

						$item->account_role = $account_data->account_role;
						
					?>
					
					<?=$item->account_role?>

				</p>

			</div>

		</div>				
	
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_created_date')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=human_date($item->account_created_date, true);?>

				</p>

			</div>

		</div>
	
		
	</div>   


	<div class="col-sm-4 col-xs-12">

		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>settings/update" >

			<?=$this->lang->line('update')?>
		
		</a>
			
		
				
		<a class="btn btn-block btn-danger" href="<?=base_url()?>settings/password" >
		
			<?=$this->lang->line('change_password')?>
			
		</a>							
		

	</div>

</div>