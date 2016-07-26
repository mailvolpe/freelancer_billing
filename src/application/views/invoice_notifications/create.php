<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('create').' '.$this->lang->line('invoice_notification')?>

		</h3>

	</div>

</div>

<!-- /page header -->


<form method="post" action="" class="form-horizontal" autocomplete="on" role="form" enctype="multipart/form-data">

	
	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_notification_invoice_id')?>

		</label>

		<div class="col-sm-9">

			<?=number_field('invoice_notification_invoice_id', set_value('invoice_notification_invoice_id'));?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_notification_type')?>

		</label>

		<div class="col-sm-9">

			<?=input_field('invoice_notification_type', set_value('invoice_notification_type'));?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_notification_read')?>

		</label>

		<div class="col-sm-9">

			<?=datetime_field('invoice_notification_read', set_value('invoice_notification_read'));?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_notification_read_ip')?>

		</label>

		<div class="col-sm-9">

			<?=input_field('invoice_notification_read_ip', set_value('invoice_notification_read_ip'));?>

		</div>

	</div>
	
	<div class="row">
	
		<div class="col-sm-9 col-sm-offset-3 col-xs-12">
		
			<div class="row">	
		
				<div class="col-xs-6">
				

					<a class="btn btn-block btn-default" href="<?=back_url()?>">

						<?=$this->lang->line('cancel')?>

					</a>

				</div>

			
				<div class="col-xs-6">

					<button type="submit" class="btn btn-primary btn-block">

						<?=$this->lang->line('create').' '.$this->lang->line('invoice_notification')?>

					</button>

				</div>
				
			</div>
			
		</div>

	</div>
	

	<input type="hidden" name="referer_query_string" value="<?=get_referer_query_string()?>">

</form>
