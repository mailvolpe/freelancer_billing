<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('view').' '.$this->lang->line('invoice')?>
			
			<?=format_id($item->invoice_id)?>

			
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
					
						<a class="" href="<?=base_url()?>recurrencies/view/<?=$item->invoice_recurrency_id;?>">
							<?=format_id($item->invoice_recurrency_id)?>
						</a>
						<br><small><?=$item->recurrency_description?></small>

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
	
		<h4>
			<?=$this->lang->line('invoice_status_updates')?> (<?=count($item->status_updates)?>)
			<a class="btn btn-xs btn-default pull-right" href="invoice_status_updates/create/<?=$item->invoice_id?>"><?=$this->lang->line('create')?></a>
		</h4>
	
		<?if(count($item->status_updates)>0){?>		
									
			<?foreach($item->status_updates as $status_update){?>
			
				<p>
				
					<a href="javasvcript:void(0);" onclick="$('#status_update_info_<?=$status_update->invoice_status_update_id?>').toggle(200)"><i class="fa fa-info-circle"></i></a>
				
					<a href="invoice_status_updates/view/<?=$status_update->invoice_status_update_id?>"><?=human_date($status_update->invoice_status_update_datetime)?></a>
				
					<span class="label label-<?=$status_update->invoice_status_update_status_code==1?'success':'default'?>"><?=$statuses[$status_update->invoice_status_update_status_code]?></span>
					
					<div class="small" style="display:none;" id="status_update_info_<?=$status_update->invoice_status_update_id?>">
					
						<b><?=$this->lang->line('invoice_status_update_gateway')?>:</b> <?=$gateways[$status_update->invoice_status_update_gateway]?> 
						
						<br>
						
						<b><?=$this->lang->line('invoice_status_update_transaction')?>:</b> <?=$status_update->invoice_status_update_transaction?>
						
					</div>
					
				</p>
				
			<?}?>
									
		<?}elseif(!$item->invoice_paid_date){?>
		
			<!--<h5><?=$this->lang->line('pay_invoice')?></h5>-->
			
			<a class="btn btn-sm  btn-default" href="javascript:void(0);" onclick="$('#implement_payment').toggle(200);">	
				<i class="fa fa-money"></i> <?=$this->lang->line('PagSeguro')?>
			</a>	
					
			<a class="btn btn-sm btn-default" href="javascript:void(0);" onclick="$('#implement_payment').toggle(200);">	
				<i class="fa fa-paypal"></i> <?=$this->lang->line('PayPal')?>
			</a>									
			
			<div id="implement_payment" style="display:none;">
				<br><p>Quando o cliente clicar nesse botão de pagamento ele já deve ser redirecionado para o PagSeguro ou Paypal. Uma url de retorno dos dados e o identificador também deve ser passada para que o sistema possa enviar informações sobre a transação de volta para o sistema.</p>
			</div>
						
		<?}?>	
	
		<!--
		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>invoice_status_updates/index/<?=$item->invoice_id?> " >

			<?=$this->lang->line('invoice_status_updates')?>
		
		</a>
		-->
	
		<hr>
	
		<h4>
			<?=$this->lang->line('invoice_notifications')?> (<?=count($item->notifications)?>)
			<a class="btn btn-xs btn-default pull-right" href="invoice_notifications/create/<?=$item->invoice_id?>"><?=$this->lang->line('create')?></a>
		</h4>

		
		<?if(count($item->notifications)>0){?>		
							
				<?foreach($item->notifications as $notification){?>
				
					<p>
					
						<a href="javasvcript:void(0);" onclick="$('#notifications_info_<?=$notification->invoice_notification_id?>').toggle(200)"><i class="fa fa-info-circle"></i></a>
					
						<a href="invoice_notifications/view/<?=$notification->invoice_notification_id?>"><?=human_date($notification->invoice_notification_sent)?></a>
					
						<span class="label label-<?=$notification->invoice_notification_type==2?'danger':'default'?>"><?=$this->lang->line($notification_types[$notification->invoice_notification_type])?></span>
					
						<div class="small" style="display:none;" id="notifications_info_<?=$notification->invoice_notification_id?>">
						
							<b><?=$this->lang->line('invoice_notification_read')?>:</b> <?=human_date($notification->invoice_notification_read)?> 
							
							<?if($notification->invoice_notification_read){?>
								<br>
								<b><?=$this->lang->line('invoice_notification_read_ip')?>:</b> <?=$notification->invoice_notification_read_ip?>
							<?}?>
							
						</div>
						
					</p>
					
				<?}?>						
			
		<?}?>			
		<!--
		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>invoice_notifications/index/<?=$item->invoice_id?> " >

			<?=$this->lang->line('invoice_notifications')?>
		
		</a>			
		-->

		<hr>
		<div class="row">
			<div class="col-xs-8">
		
				<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>invoices/update/<?=$item->invoice_id?> " >

					<?=$this->lang->line('update')?>
					<?=$this->lang->line('invoice')?>
				
				</a>	
			</div>
			<div class="col-xs-4">
				<a class="btn btn-block btn-danger" href="<?=base_url()?>invoices/remove/<?=$item->invoice_id?> " >
				
					<?=$this->lang->line('remove')?>
					
				</a>		
			</div>
		</div>							
		

	</div>

</div>