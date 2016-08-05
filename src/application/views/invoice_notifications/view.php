<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>
		
			<a href="invoices/view/<?=$invoice->invoice_id?>">
				<?=$this->lang->line('invoice')?>
				<?=format_id($invoice->invoice_id)?>			
			</a>
	
				-		
				
			<?=$this->lang->line('view').' '.$this->lang->line('invoice_notification')?>

			
		</h3>

	</div>

</div>

<!-- /page header -->


<div class="row">

	<div class="form-horizontal col-sm-8 col-xs-12">

	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_notification_sent')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=human_date($item->invoice_notification_sent)?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_notification_type')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$this->lang->line($invoice_statuses[$item->invoice_notification_type]);?>

				</p>

			</div>

		</div>
	
	<div class="form-group">

		<label class="col-sm-5 control-label">

			<?=$this->lang->line('to')?>

		</label>

		<div class="col-sm-7">

			<p class="form-control-static">
				<?=$notification->to;?>
			</p>

		</div>

	</div>		
	
	<div class="form-group">

		<label class="col-sm-5 control-label">

			<?=$this->lang->line('subject')?>

		</label>

		<div class="col-sm-7">

			<p class="form-control-static">
				<?=$notification->subject;?>
			</p>

		</div>

	</div>	
	
	<div class="form-group">

		<label class="col-sm-5 control-label">

			<?=$this->lang->line('invoice_notification_preview')?>

		</label>

		<div class="col-sm-7">

			<div class="notification_preview">
			
				<?=$notification->message;?>
				
			</div>

		</div>

	</div>
		
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('invoice_notification_read')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=human_date($item->invoice_notification_read);?>
					<?if($item->invoice_notification_read){?>
						<br>
						<b><?=$this->lang->line('invoice_notification_read_ip')?>:</b> <?=$notification->invoice_notification_read_ip?>
					<?}?>					

				</p>

			</div>

		</div>
		
	</div>   


	<div class="col-sm-4 col-xs-12">

		<a class="btn btn-block btn-default view-option-link" href="invoices/view/<?=$item->invoice_notification_invoice_id?>">
			<?=$this->lang->line('back')?>
		</a>			

		
		<a class="btn btn-block btn-danger" href="<?=base_url()?>invoice_notifications/remove/<?=$item->invoice_notification_id?> " >
		
			<?=$this->lang->line('remove')?>
			
		</a>							
		

	</div>

</div>