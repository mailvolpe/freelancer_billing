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
				
					<?=$item->account_title?>
					<div class="small"><?=$item->account_email?></div>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('recurrency_amount')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=format_currency($item->recurrency_amount)?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('recurrency')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=explain_recurrency($item->recurrency_when_day, $item->recurrency_when_month)?>

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
				
					<?=get_display_value($item->recurrency_limit, $this->lang->line('unlimited_recurrency'), true, false, ' '.$this->lang->line('recurrency_iterations'));?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('recurrency_start')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=display_bool_value($item->recurrency_start, false, false, true, false);?>

				</p>

			</div>

		</div>
		
	</div>   


	<div class="col-sm-4 col-xs-12">

		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>invoices/index/?invoice_recurrency_id=<?=$item->recurrency_id?> " >

			<?=$this->lang->line('recurrency_generated_invoices')?> (<?=$this->Recurrency->count_generated_invoices($item->recurrency_id);?>)
		
		</a>	
		
		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>recurrencies/update/<?=$item->recurrency_id?> " >

			<?=$this->lang->line('update')?>
		
		</a>
		
		<a class="btn btn-block btn-danger" href="<?=base_url()?>recurrencies/remove/<?=$item->recurrency_id?> " >
		
			<?=$this->lang->line('remove')?>
			
		</a>							
		

	</div>

</div>