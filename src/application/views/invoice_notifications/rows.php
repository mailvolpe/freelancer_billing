<? foreach($itens as $item){ ?>

	<tr>
	
		<td class="">
			<a class="" href="<?=base_url()?>invoice_notifications/view/<?=$item->invoice_notification_id;?>">
				<?=human_date($item->invoice_notification_sent)?>
			</a>
		</td>
	
		<td>
			<?=$this->lang->line($invoice_statuses[$item->invoice_notification_type])?>
		</td>		
	

		<td class="hidden-xs">
			<?=human_date($item->invoice_notification_read);?>
			<?=character_limiter(strip_tags($item->invoice_notification_read_ip), 45)?>
		</td>

		
		<td width="1%" class="center" nowrap>
			
			<a class="btn btn-default btn-sm" href="<?=base_url()?>invoice_notifications/view/<?=$item->invoice_notification_id;?>">
			
				<?=$this->lang->line('view')?>
				
			</a>
			
		</td>
		
	</tr>
	
<?php } ?>