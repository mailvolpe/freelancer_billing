<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('view').' '.$this->lang->line('invoice_notification')?>

			
		</h3>

	</div>

</div>

<!-- /page header -->


<div class="row">

	<div class="form-horizontal col-sm-8 col-xs-12">

	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_notification_invoice_id')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->invoice_notification_invoice_id?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_notification_type')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->invoice_notification_type?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_notification_read')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=human_date($item->invoice_notification_read);?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_notification_read_ip')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->invoice_notification_read_ip?>

				</p>

			</div>

		</div>
		
	</div>   


	<div class="col-sm-4 col-xs-12">

		
		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>invoice_notifications/update/<?=$item->invoice_notification_id?> " >

			<?=$this->lang->line('update')?>
		
		</a>
		
		<a class="btn btn-block btn-danger" href="<?=base_url()?>invoice_notifications/remove/<?=$item->invoice_notification_id?> " >
		
			<?=$this->lang->line('remove')?>
			
		</a>							
		

	</div>

</div>