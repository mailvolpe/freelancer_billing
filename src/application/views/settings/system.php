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

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('days_after_generate_invoice_due_date')?>

		</label>

		<div class="col-sm-8">


			<?=number_field('days_after_generate_invoice_due_date', set_value('days_after_generate_invoice_due_date', $item->days_after_generate_invoice_due_date));?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('days_after_invoice_pending_overdue_notification')?>

		</label>

		<div class="col-sm-8">


			<?=number_field('days_after_invoice_pending_overdue_notification', set_value('days_after_invoice_pending_overdue_notification', $item->days_after_invoice_pending_overdue_notification));?>

		</div>

	</div>
	
	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('activate_pagseguro')?>

		</label>

		<div class="col-sm-8">


			<?=bool_field('activate_pagseguro', set_value('activate_pagseguro', $item->activate_pagseguro));?>

		</div>

	</div>	
	
	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('activate_bank_transfer')?>

		</label>

		<div class="col-sm-8">


			<?=bool_field('activate_bank_transfer', set_value('activate_bank_transfer', $item->activate_bank_transfer));?>

		</div>

	</div>		

	
	
	<legend><?=$this->lang->line('system_mail_settings')?></legend>

	<div class="form-group">

		<label class="col-sm-4 control-label">

			<?=$this->lang->line('sendmail_mode')?>

		</label>

		<div class="col-sm-8">


			<?=select_field('sendmail_mode', $this->System_settings->get_sendmail_modes(), set_value('sendmail_mode', $item->sendmail_mode));?>

		</div>

	</div>		
	
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
	
	<div class="smtp_settings" style="<?=!$item->sendmail_mode?'display:none;':null;?>">
		
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
		
	</div>	
	
	<div class="pagseguro_settings" style="<?=!$item->activate_pagseguro?'display:none;':null;?>">
	
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
		
	</div>	
	
	<div class="bank_transfer_settings" style="<?=!$item->activate_bank_transfer?'display:none;':null;?>">
	
		<legend><?=$this->lang->line('bank_transfer_instructions')?></legend>

		<div class="form-group">

			<label class="col-sm-4 control-label">

				<?=$this->lang->line('bank_transfer_instructions')?>

			</label>

			<div class="col-sm-8">

				<?=text_field('bank_transfer_instructions_template', set_value('bank_transfer_instructions_template', $item->bank_transfer_instructions_template), true, false, false, false);?>

			</div>

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
		
		<div class="col-sm-8 col-sm-offset-4 col-xs-12">
		
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

<script>
	$('#activate_pagseguro').change(function(){
		display_settings_blocks();
	});

	$('#activate_bank_transfer').change(function(){
		display_settings_blocks();
	});

	$('#sendmail_mode').change(function(){
		display_settings_blocks();
	});
	
	function display_settings_blocks(){
		
		if($('#activate_pagseguro').val()=='1'){
		
			$('.pagseguro_settings').show(200);
			
		}else{
		
			$('.pagseguro_settings').hide(200);
			
		}

		if($('#activate_bank_transfer').val()=='1'){
		
			$('.bank_transfer_settings').show(200);
			
		}else{
		
			$('.bank_transfer_settings').hide(200);
			
		}		
		
		if($('#sendmail_mode').val()=='1'){
		
			$('.smtp_settings').show(200);
			
		}else{
		
			$('.smtp_settings').hide(200);
			
		}
		
	}
</script>