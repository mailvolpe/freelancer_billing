<input class="input-xlarge " type="text" name="recurrency_id" value="<?=$item->recurrency_id?>">					

<?=selectField(array(), "<?=$item->recurrency_account_id?>", "name='recurrency_account_id'");?>					

<input class="input-xlarge " type="text" name="recurrency_amount" value="<?=$item->recurrency_amount?>">					

<input class="input-xlarge " type="text" name="recurrency_when_day" value="<?=$item->recurrency_when_day?>">					

<input class="input-xlarge " type="text" name="recurrency_when_month" value="<?=$item->recurrency_when_month?>">					

<input class="input-xlarge " type="text" name="recurrency_description" value="<?=$item->recurrency_description?>">					

<?=selectField(array(), "<?=$item->recurrency_limit?>", "name='recurrency_limit'");?>					

<?=radioFields(array("Não"=>"0", "Sim"=>"1"), $item->recurrency_start, "name='recurrency_start'");?>					

