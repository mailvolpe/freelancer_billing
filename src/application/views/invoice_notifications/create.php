<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

				<a href="invoices/view/<?=$invoice->invoice_id?>">
					<?=$this->lang->line('invoice')?>
					<?=format_id($invoice->invoice_id)?>			
				</a>
		
				-		
		
			<?=$this->lang->line('send').' '.$this->lang->line('invoice_notification')?>

		</h3>

	</div>

</div>

<!-- /page header -->


<form method="post" action="" class="form-horizontal" autocomplete="on" role="form" enctype="multipart/form-data">

	

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_notification_type')?>

		</label>

		<div class="col-sm-9">

			<p class="form-control-static">
				<?=$this->lang->line($invoice_statuses[$invoice->invoice_status]);?>
			</p>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('to')?>

		</label>

		<div class="col-sm-9">

			<p class="form-control-static">
				<?=$notification->to;?>
			</p>

		</div>

	</div>		
	
	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('subject')?>

		</label>

		<div class="col-sm-9">

			<p class="form-control-static">
				<?=$notification->subject;?>
			</p>

		</div>

	</div>	
	
	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_notification_preview')?>

		</label>

		<div class="col-sm-9">

			<div class="notification_preview">
			
				<?=$notification->message;?>
				
			</div>

		</div>

	</div>
	
	<div class="row">
	
		<div class="col-sm-9 col-sm-offset-3 col-xs-12">
		
			<div class="row">	
		
				<div class="col-xs-6">
				

					<a class="btn btn-block btn-default" href="invoices/view/<?=$invoice->invoice_id?>">

						<?=$this->lang->line('cancel')?>

					</a>

				</div>

			
				<div class="col-xs-6">

					<button type="submit" class="btn btn-primary btn-block">

						<?=$this->lang->line('send').' '.$this->lang->line('invoice_notification')?>

					</button>

				</div>
				
			</div>
			
		</div>

	</div>
	

	<input type="hidden" name="referer_query_string" value="<?=get_referer_query_string()?>">

</form>
