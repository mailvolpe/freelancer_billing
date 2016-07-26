<? foreach($itens as $item){ ?>

	<tr>
		
		<td class="">
						<a class="" href="<?=base_url()?>invoice_notifications/view/<?=$item->invoice_notification_id;?>">
							<?=format_id($item->invoice_notification_id)?>
						</a></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->invoice_notification_invoice_id), 45)?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->invoice_notification_type), 45)?></td>
<td class="hidden-xs"><?=human_date($item->invoice_notification_read);?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->invoice_notification_read_ip), 45)?></td>
		
		
		<td width="1%" class="center" nowrap>
			
			<a class="btn btn-default btn-sm" href="<?=base_url()?>invoice_notifications/view/<?=$item->invoice_notification_id;?>">
			
				<?=$this->lang->line('view')?>
				
			</a>
			
		</td>
		
	</tr>
	
<?php } ?>