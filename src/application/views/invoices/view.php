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

					</p>

				</div>

			</div>
		<?}?>
	
			
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
						<span class="text-danger bold"><?=$this->lang->line('invoice_status_pending_overdue');?></span>
					<?}elseif($item->invoice_status==1){?>
						<span class="text-success bold"><?=$this->lang->line('invoice_status_paid');?></span>
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
		
		<?if(count($item->status)>0){?>		
		
			<div class="form-group">

				<label class="col-sm-5 control-label">

					<?=$this->lang->line('invoice_status_updates')?>
					
				</label>

				<div class="col-sm-7">

					<div class="form-control-static">
										
						<?foreach($item->status as $status){?>
						
							<p>
							
								<span class="label label-primary"><?=$statuses[$status->invoice_status_update_status_code]?></span>
								<?=human_date($status->invoice_status_update_datetime, true)?>
								
								<a href="javasvcript:void(0);" onclick="$('#status_update_info_<?=$status->invoice_status_update_id?>').toggle(200)"><i class="fa fa-info-circle"></i></a>
								
								<div class="small" style="display:none;" id="status_update_info_<?=$status->invoice_status_update_id?>">
								
								<b><?=$this->lang->line('invoice_status_update_gateway')?>:</b> <?=$gateways[$status->invoice_status_update_gateway]?> 
								
								<br>
								
								<b><?=$this->lang->line('invoice_status_update_transaction')?>:</b> <?=$status->invoice_status_update_transaction?>
								</div>
								
							</p>
							
						<?}?>
											
					</div>

				</div>

			</div>
			
		<?}elseif(!$item->invoice_paid_date){?>
		
			<div class="form-group">

				<label class="col-sm-5 control-label">

					<?=$this->lang->line('pay_invoice')?>
					
				</label>

				<div class="col-sm-7">

					<div class="form-control-static">
						
						<a class="btn btn-sm  btn-default" href="javascript:void(0);" onclick="$('#implement_payment').toggle(200);">	
							<i class="fa fa-money"></i> <?=$this->lang->line('PagSeguro')?>
						</a>	
								
						<a class="btn btn-sm btn-default" href="javascript:void(0);" onclick="$('#implement_payment').toggle(200);">	
							<i class="fa fa-paypal"></i> <?=$this->lang->line('PayPal')?>
						</a>									
						
						<div id="implement_payment" style="display:none;">
							<br><p>Quando o cliente clicar nesse botão de pagamento ele já deve ser redirecionado para o PagSeguro ou Paypal. Uma url de retorno dos dados e o identificador também deve ser passada para que o sistema possa enviar informações sobre a transação de volta para o sistema.</p>
						</div>
						
					</div>

				</div>

			</div>		
		
		<?}?>
		
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