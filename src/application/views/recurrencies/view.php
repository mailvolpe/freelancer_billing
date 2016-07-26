<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('view').' '.$this->lang->line('recurrency')?>

			
		</h3>

	</div>

</div>

<!-- /page header -->


<div class="row">

	<div class="form-horizontal col-sm-8 col-xs-12">

	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('recurrency_account_id')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->recurrency_account_id?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('recurrency_amount')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->recurrency_amount?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('recurrency_when_day')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->recurrency_when_day?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('recurrency_when_month')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->recurrency_when_month?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('recurrency_description')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->recurrency_description?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('recurrency_limit')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->recurrency_limit?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('recurrency_start')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=display_bool_value($item->recurrency_start);?>

				</p>

			</div>

		</div>
		
	</div>   


	<div class="col-sm-4 col-xs-12">

		
		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>recurrencies/update/<?=$item->recurrency_id?> " >

			<?=$this->lang->line('update')?>
		
		</a>
		
		<a class="btn btn-block btn-danger" href="<?=base_url()?>recurrencies/remove/<?=$item->recurrency_id?> " >
		
			<?=$this->lang->line('remove')?>
			
		</a>							
		

	</div>

</div>