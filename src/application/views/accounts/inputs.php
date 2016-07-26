<input class="input-xlarge " type="text" name="account_id" value="<?=$item->account_id?>">					

<input class="input-xlarge " type="text" name="account_username" value="<?=$item->account_username?>">					

<input class="input-xlarge " type="text" name="account_password" value="<?=$item->account_password?>">					

<input class="input-xlarge " type="text" name="account_email" value="<?=$item->account_email?>">					

<?=radioFields(array("Não"=>"0", "Sim"=>"1"), $item->account_must_change_pass, "name='account_must_change_pass'");?>					

<input type="text" class="input-small datepicker" id="account_last_access_date_ext" name="account_last_access_date_ext" value="<?=human_date($item->account_last_access_date)?>" onchange="setDateField('account_last_access_date', this.value);" placeholder="Selecione uma data"><input type="hidden" id="account_last_access_date" name="account_last_access_date" value="<?=$item->account_last_access_date?>">					

<input class="input-xlarge " type="text" name="account_last_access_ip" value="<?=$item->account_last_access_ip?>">					

<input type="text" class="input-small datepicker" id="account_blocked_date_ext" name="account_blocked_date_ext" value="<?=human_date($item->account_blocked_date)?>" onchange="setDateField('account_blocked_date', this.value);" placeholder="Selecione uma data"><input type="hidden" id="account_blocked_date" name="account_blocked_date" value="<?=$item->account_blocked_date?>">					

<input type="text" class="input-small datepicker" id="account_created_date_ext" name="account_created_date_ext" value="<?=human_date($item->account_created_date)?>" onchange="setDateField('account_created_date', this.value);" placeholder="Selecione uma data"><input type="hidden" id="account_created_date" name="account_created_date" value="<?=$item->account_created_date?>">					

<input type="text" class="input-small datepicker" id="account_updated_date_ext" name="account_updated_date_ext" value="<?=human_date($item->account_updated_date)?>" onchange="setDateField('account_updated_date', this.value);" placeholder="Selecione uma data"><input type="hidden" id="account_updated_date" name="account_updated_date" value="<?=$item->account_updated_date?>">					

