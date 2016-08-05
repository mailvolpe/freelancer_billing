<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('invoice')?>
			
			<?=format_id($item->invoice_id)?>

			<span class="pull-right"><?=$item->account_title?></span>
			
		</h3>

	</div>

</div>

<!-- /page header -->


<div class="row">

	<div class="form-horizontal col-sm-8 col-xs-12">

		<?if($item->invoice_recurrency_id){?>
			<div class="form-group">

				<label class="col-sm-5 control-label">

					<?=$this->lang->line('invoice_recurrency_id')?>

				</label>

				<div class="col-sm-7">

					<p class="form-control-static">
					
						<?=format_id($item->invoice_recurrency_id)?>
							-
						<?=$item->recurrency_description?>

					</p>

				</div>

			</div>
		<?}?>	
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_title')?>

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

				<?=$this->lang->line('invoice_status')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<? $item_status = $this->Invoice->get_invoice_status($item);  ?>
					<?if($item->invoice_status==2){?>
						<span class="text-danger bold"><?=$this->lang->line($notification_types[2]);?></span>
					<?}elseif($item->invoice_status==1){?>
						<span class="text-success bold"><?=$this->lang->line($notification_types[1]);?></span>
					<?}elseif($item->invoice_status==0){?>		
						<span class="text-warning bold"><?=$this->lang->line($notification_types[0]);?></span>
					<?}?>		

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
					
				</div>

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
		
		
	</div>   

	
	<div class="col-sm-4 col-xs-12">
	
	
		<?if(count($item->status_updates)>0){?>		

			<h4>
				<?=$this->lang->line('invoice_status_updates')?> (<?=count($item->status_updates)?>)
			</h4>

		
			<?foreach($item->status_updates as $status_update){?>
			
				<div class="">
				
					<?=human_date($status_update->invoice_status_update_datetime)?>
				
					<span class="label label-<?=$status_update->invoice_status_update_status_code==1?'success':'default'?>"><?=$statuses[$status_update->invoice_status_update_status_code]?></span>
					
					<div class="small" id="status_update_info_<?=$status_update->invoice_status_update_id?>">
					
						<b><?=$this->lang->line('invoice_status_update_gateway')?>:</b> <?=$gateways[$status_update->invoice_status_update_gateway]?> 
						
						<br>
						
						<b><?=$this->lang->line('invoice_status_update_transaction')?>:</b> <?=$status_update->invoice_status_update_transaction?>
						
						<br><br>
					</div>
					
				</div>
				
			<?}?>
									
		<?}elseif(!$item->invoice_paid_date){?>
		
			<h4><?=$this->lang->line('pay_invoice')?></h4>
			<a href="invoices/payment/<?=$item->invoice_id?>" class="btn btn-block btn-success"/><i class="fa fa-money"></i> <?=$this->lang->line('pay_with_pagseguro')?></a>
												
		<?}?>	
	
		<!--
		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>invoice_status_updates/index/<?=$item->invoice_id?> " >

			<?=$this->lang->line('invoice_status_updates')?>
		
		</a>
		-->
	
		<hr>
	
		<h4>
			<?=$this->lang->line('invoice_notifications')?> (<?=count($item->notifications)?>)
		</h4>

		
		<?if(count($item->notifications)>0){?>		
							
				<?foreach($item->notifications as $notification){?>
				
					<div>
					
						<?=human_date($notification->invoice_notification_sent)?>
					
						<span class="label label-<?=$notification->invoice_notification_type==2?'danger':'default'?>"><?=$this->lang->line($notification_types[$notification->invoice_notification_type])?></span>
					
						<div class="small" id="notifications_info_<?=$notification->invoice_notification_id?>">
						
							<b><?=$this->lang->line('invoice_notification_read')?>:</b> <?=human_date($notification->invoice_notification_read)?> 
							
							<?if($notification->invoice_notification_read){?>
								<br>
								<b><?=$this->lang->line('invoice_notification_read_ip')?>:</b> <?=$notification->invoice_notification_read_ip?>
							<?}?>
							
						</div>
						<br><br>
					</div>
					
				<?}?>						
			
		<?}?>			
		<!--
		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>invoice_notifications/index/<?=$item->invoice_id?> " >

			<?=$this->lang->line('invoice_notifications')?>
		
		</a>			
		-->
							
		

	</div>

</div>