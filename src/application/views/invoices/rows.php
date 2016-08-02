<? foreach($itens as $item){ ?>

	<tr>
		
		<td class="">
						<a class="" href="<?=base_url()?>invoices/view/<?=$item->invoice_id;?>">
							<?=format_id($item->invoice_id)?>
						</a></td>
						
		<td class="">
			<?if($item->invoice_recurrency_id){?>
			<a class="" href="<?=base_url()?>recurrencies/view/<?=$item->invoice_recurrency_id;?>">
				<?=format_id($item->invoice_recurrency_id)?>
			</a>
			<?}?>
		</td>
						
<td class="hidden-xs"><?=character_limiter(strip_tags($item->account_title), 45)?></td>
<td class="hidden-xs"><?=format_currency($item->invoice_amount)?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->invoice_description), 45)?></td>
<td class="hidden-xs"><?=human_date($item->invoice_due_date);?></td>
<td class="hidden-xs"><?=human_date($item->invoice_paid_date);?></td>
<td class="hidden-xs"><?=human_date($item->invoice_created_date, false, false, true);?></td>
		
		
		<td width="1%" class="center" nowrap>
			
			<a class="btn btn-default btn-sm" href="<?=base_url()?>invoices/view/<?=$item->invoice_id;?>">
			
				<?=$this->lang->line('view')?>
				
			</a>
			
		</td>
		
	</tr>
	
<?php } ?>