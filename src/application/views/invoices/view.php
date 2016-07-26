<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('view').' '.$this->lang->line('invoice')?>
			
			#<?=format_id($item->invoice_id)?>

			
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

				<?=$this->lang->line('invoice_amount')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=format_currency($item->invoice_amount)?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_description')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->invoice_description?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_created_date')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=human_date($item->invoice_created_date);?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_due_date')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=human_date($item->invoice_due_date);?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_paid_date')?>

			</label>

			<div class="col-sm-7">

				<div class="form-control-static">
				
					<?=human_date($item->invoice_paid_date);?>
					
					<br>
					<?foreach($item->status as $status){?>
					
						<p>
						
							<?=$status->invoice_status_update_datetime?> - 
							<?=$this->lang->line('invoice_status_update_status_code')?>
							<?=$status->invoice_status_update_status_code?>
							<br>
							<small>
								<?=$status->invoice_status_update_transaction?>
							</small>
							
						</p>
						
					<?}?>

					<a class="btn btn-xs btn-block btn-default" href="invoices/check/<?=$status->invoice_status_update_id?>">	
						<?=$this->lang->line('check_now')?>
					</a>	
					
				</div>

			</div>

		</div>
		
	</div>   


	<div class="col-sm-4 col-xs-12">
	
		<a class="btn btn-block btn-default view-option-link" target="_blank" href="<?=base_url()?>invoices/pay/<?=$item->invoice_id?> " >

			<?=$this->lang->line('pay')?>
		
		</a>	
	
		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>invoice_status_updates/index/<?=$item->invoice_id?> " >

			<?=$this->lang->line('invoice_status_updates')?>
		
		</a>
	
		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>invoice_notifications/index/<?=$item->invoice_id?> " >

			<?=$this->lang->line('invoice_notifications')?>
		
		</a>	
	
		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>invoices/update/<?=$item->invoice_id?> " >

			<?=$this->lang->line('update')?>
		
		</a>
		
		<a class="btn btn-block btn-danger" href="<?=base_url()?>invoices/remove/<?=$item->invoice_id?> " >
		
			<?=$this->lang->line('remove')?>
			
		</a>							
		

	</div>

</div>