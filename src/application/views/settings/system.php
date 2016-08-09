<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('system_settings')?>
			
		</h3>

	</div>

</div>

<!-- /page header -->

<div class="row page-subheader">

	
	
	
</div>	
	
<form method="post" action="" class="form-horizontal" autocomplete="on" role="form" enctype="multipart/form-data">



	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('system_title')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('system_title', set_value('system_title', $item->system_title));?>

		</div>

	</div>
	
	<legend><?=$this->lang->line('system_smtp')?></legend>

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('system_smtp_name')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('system_smtp_name', set_value('system_smtp_name', $item->system_smtp_name));?>

			</div>

	</div>

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('system_smtp_email')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('system_smtp_email', set_value('system_smtp_email', $item->system_smtp_email));?>

			</div>

	</div>
	
	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('system_smtp_host')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('system_smtp_host', set_value('system_smtp_host', $item->system_smtp_host));?>

			</div>

	</div>

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('system_smtp_port')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('system_smtp_port', set_value('system_smtp_port', $item->system_smtp_port));?>

			</div>

	</div>

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('system_smtp_user')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('system_smtp_user', set_value('system_smtp_user', $item->system_smtp_user));?>

			</div>

	</div>

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('system_smtp_pass')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('system_smtp_pass', set_value('system_smtp_pass', $item->system_smtp_pass));?>

			</div>

	</div>	
	
	<legend><?=$this->lang->line('pagseguro_credentials')?></legend>
		
	
	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('pagseguro_credentials_email')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('pagseguro_credentials_email', set_value('pagseguro_credentials_email', $item->pagseguro_credentials_email));?>

			</div>

	</div>

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('pagseguro_credentials_token')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('pagseguro_credentials_token', set_value('pagseguro_credentials_token', $item->pagseguro_credentials_token));?>

			</div>

	</div>	
	
	<legend><?=$this->lang->line('invoice_notifications_template')?></legend>

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('invoice_notification_helper_title')?>

		</label>

		<div class="col-sm-8">

			<?=$this->lang->line('invoice_notification_helper')?>

		</div>

	</div>
	
	
	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('invoice_status_pending_notification_subject')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('invoice_status_pending_notification_subject', set_value('invoice_status_pending_notification_subject', $item->invoice_status_pending_notification_subject));?>

			</div>

	</div>
	
	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('invoice_status_pending_notification')?>

		</label>

		<div class="col-sm-8">


			<?=text_field('invoice_status_pending_notification', set_value('invoice_status_pending_notification', $item->invoice_status_pending_notification), true, false, false, false);?>

			</div>

	</div>

	
	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('invoice_status_pending_overdue_notification_subject')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('invoice_status_pending_overdue_notification_subject', set_value('invoice_status_pending_overdue_notification_subject', $item->invoice_status_pending_overdue_notification_subject));?>

			</div>

	</div>		
	
	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('invoice_status_pending_overdue_notification')?>

		</label>

		<div class="col-sm-8">


			<?=text_field('invoice_status_pending_overdue_notification', set_value('invoice_status_pending_overdue_notification', $item->invoice_status_pending_overdue_notification), true, false, false, false);?>

			</div>

	</div>	

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('invoice_status_paid_notification_subject')?>

		</label>

		<div class="col-sm-8">


			<?=input_field('invoice_status_paid_notification_subject', set_value('invoice_status_paid_notification_subject', $item->invoice_status_paid_notification_subject));?>

			</div>

	</div>	
	
	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('invoice_status_paid_notification')?>

		</label>

		<div class="col-sm-8">


			<?=text_field('invoice_status_paid_notification', set_value('invoice_status_paid_notification', $item->invoice_status_paid_notification), true, false, false, false);?>

			</div>

	</div>	

	<div class="row">
		
		<div class="col-sm-9 col-sm-offset-3 col-xs-12">
		
			<div class="row">
		
				<div class="col-xs-6">
				
					<a class="btn btn-block btn-default" href="<?=base_url()?>settings" >

						<?=$this->lang->line('cancel')?>
						
					</a>

				</div>
				
				<div class="col-xs-6">

				
					<button type="submit" class="btn btn-primary btn-block">

						<?=$this->lang->line('update')?>

					</button>		

				</div>		
			
			</div>		
			
		</div>			
		
	</div>
	
	<input type="hidden" name="referer_query_string" value="<?=get_referer_query_string()?>">

</form>   
