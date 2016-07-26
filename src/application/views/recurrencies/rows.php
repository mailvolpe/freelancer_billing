<? foreach($itens as $item){ ?>

	<tr>
		
		<td class="">
						<a class="" href="<?=base_url()?>recurrencies/view/<?=$item->recurrency_id;?>">
							<?=format_id($item->recurrency_id)?>
						</a></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->recurrency_account_id), 45)?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->recurrency_amount), 45)?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->recurrency_when_day), 45)?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->recurrency_when_month), 45)?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->recurrency_description), 45)?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->recurrency_limit), 45)?></td>
<td class="hidden-xs"><?=display_bool_value($item->recurrency_start);?></td>
		
		
		<td width="1%" class="center" nowrap>
			
			<a class="btn btn-default btn-sm" href="<?=base_url()?>recurrencies/view/<?=$item->recurrency_id;?>">
			
				<?=$this->lang->line('view')?>
				
			</a>
			
		</td>
		
	</tr>
	
<?php } ?>