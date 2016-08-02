

<? foreach($itens as $item){ ?>

	<?
	
	$account_data = $this->Account->get_account_data($item);

	$item->account_role = $account_data->account_role;

	$item->photo_path = $account_data->photo_path;
	
	$change_pass = display_bool_value($item->account_must_change_pass, $this->lang->line('account_must_change_pass'), null, null, true);
	
	$acc_info = display_bool_value($item->account_blocked_date, $this->lang->line('account_blocked_date'), $change_pass, null, true);
	
	?>	

	<tr>
	

		<td class="visible-xs">
		
			<?=$item->account_is_admin?'<i class="fa fa-star"></i>':false?>
			
			<a class="" href="<?=base_url()?>accounts/view/<?=$item->account_id;?>">
				<?=character_limiter(strip_tags($item->account_title), 45)?>
			</a>

			
			<div class="small">
				<?=character_limiter(strip_tags($item->account_email), 45)?>
			</div>
			
			<?if($acc_info){?><div class="small"><?=$acc_info?></div><?}?>
		</td>					
	
		<td class="hidden-xs">
			<?=$item->account_is_admin?'<i class="fa fa-star"></i>':false?>
			<?=character_limiter(strip_tags($item->account_title), 45)?>
			<?if($acc_info){?><div class="small"><?=$acc_info?></div><?}?>
		</td>	

		<td class="hidden-xs">
			<a href="mailto:<?=$item->account_email?>" target="_blank"><?=character_limiter(strip_tags($item->account_email), 45)?></a>
		</td>		
		
		
		<td class="">
			<a href="recurrencies/index/<?=$item->account_id?>"><?=$this->Account->count_active_recurrencies($item->account_id)?></div>
		</td>		

		<td class="">
			<a href="invoices/index/<?=$item->account_id?>"><?=$this->Account->count_unpaid_invoices($item->account_id)?></div>
		</td>		
		

		<td class="hidden-xs">
			<?=human_date($item->account_last_access_date, true, $this->lang->line('no_record'));?>
			<?if($item->account_last_access_ip){?><div class="small"><?=character_limiter(strip_tags($item->account_last_access_ip), 45)?></div><?}?>
		</td>

		<td class="hidden-xs">
			<?=human_date($item->account_updated_date, true);?>
		</td>
				
		
		<td width="1%" class="center hidden-xs" nowrap>
			
			<a class="btn btn-default btn-sm" href="<?=base_url()?>accounts/view/<?=$item->account_id;?>">
			
				<?=$this->lang->line('view')?>
				
			</a>
			
		</td>
		
	</tr>
	
<?php } ?>