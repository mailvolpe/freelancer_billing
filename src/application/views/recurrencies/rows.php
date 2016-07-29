<?php foreach($itens as $item){ ?>

	<tr>
		
		<td class="">
						<a class="" href="<?=base_url()?>recurrencies/view/<?=$item->recurrency_id;?>">
							<?=format_id($item->recurrency_id)?>
						</a></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->account_title), 45)?></td>
<td class="hidden-xs"><?=format_currency($item->recurrency_amount)?></td>
<td class="hidden-xs"><?=character_limiter(strip_tags($item->recurrency_description), 45)?></td>


<td class="hidden-xs">

	<?=explain_recurrency($item->recurrency_when_day, $item->recurrency_when_month)?>

</td>

<td class="hidden-xs"><?=get_display_value($item->recurrency_limit, $this->lang->line('unlimited_recurrency'), true, false, ' '.$this->lang->line('recurrency_iterations'));?></td>
<td class="hidden-xs"><?=display_bool_value($item->recurrency_start, false, false, true, false);?></td>
		
		
		<td width="1%" class="center" nowrap>
			
			<a class="btn btn-default btn-sm" href="<?=base_url()?>recurrencies/view/<?=$item->recurrency_id;?>">
			
				<?=$this->lang->line('view')?>
				
			</a>
			
		</td>
		
	</tr>
	
<?php } ?>
