<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>
			
			<?=$item->account_title?>
			
			<span class="pull-right"><?=$item->account_email?></span>

		</h3>

	</div>

</div>

<!-- /page header -->


<div class="row">

	<div class="form-horizontal col-xs-12">			
		
		<table class="table">

			<? foreach($itens as $item){ ?>

				<tr>
					
					<td class="">
						<a class="" href="<?=$this->Invoice->get_invoice_public_url($item->invoice_id)?>">
							<?=format_id($item->invoice_id)?>
						</a>
					</td>
									
					<td class="">
						<?=character_limiter(strip_tags($item->account_title), 45)?>
						<div class="small"><?=$item->account_email?></div>
					</td>

					<td class="hidden-xs" nowrap><?=format_currency($item->invoice_amount)?></td>

					<td class="hidden-xs"><?=character_limiter(strip_tags($item->invoice_description), 45)?></td>

					<td class="hidden-xs" nowrap>
					
						<?=human_date($item->invoice_due_date);?>
						
						<br><small><?=$this->lang->line('invoice_status_updates')?>: <b><?=$item->total_status_updates?></b></small>
						
					</td>

					<td class="" nowrap>
					
						<? $item_status = $this->Invoice->get_invoice_status($item);  ?>
						
						<?if($item_status==2){?>
						
							<div class="text-danger bold"><?=$this->lang->line('invoice_status_pending_overdue');?></div>
							
						<?}elseif($item_status==1){?>
						
							<div class="text-success bold"><?=$this->lang->line('invoice_status_paid');?></div>
							
						<?}?>		
					
						<?=human_date($item->invoice_paid_date);?>
						
						<br><small><?=$this->lang->line('invoice_notifications')?>: <b><?=$item->total_notifications?></b></small>
						
						
					</td>

					<td class="hidden-xs"><?=human_date($item->invoice_created_date, false, false, true);?></td>
					
					
					<td width="1%" class="center" nowrap>
						
						<a class="btn btn-default btn-sm" href="<?=$this->Invoice->get_invoice_public_url($item->invoice_id)?>">
						
							<?=$this->lang->line('view')?>
							
						</a>
						
					</td>
					
				</tr>
				
			<?php } ?>

		</table>

	</div>   

</div>