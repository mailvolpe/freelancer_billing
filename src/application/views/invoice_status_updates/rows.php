<? foreach($itens as $item){ ?>

	<tr>
		
		<td class="">
						<a class="" href="<?=base_url()?>invoice_status_updates/view/<?=$item->invoice_status_update_id;?>">
							<?=format_id($item->invoice_status_update_id)?>
						</a></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->invoice_status_update_invoice_id), 45)?></td>
<td class="hidden-xs"><?=human_date($item->invoice_status_update_datetime);?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->invoice_status_update_gateway), 45)?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->invoice_status_update_transaction), 45)?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->invoice_status_update_status_code), 45)?></td>
		
		
		<td width="1%" class="center" nowrap>
			
			<a class="btn btn-default btn-sm" href="<?=base_url()?>invoice_status_updates/view/<?=$item->invoice_status_update_id;?>">
			
				<?=$this->lang->line('view')?>
				
			</a>
			
		</td>
		
	</tr>
	
<?php } ?>