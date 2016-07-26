<input class="input-xlarge " type="text" name="invoice_status_update_id" value="<?=$item->invoice_status_update_id?>">					

<?=selectField(array(), "<?=$item->invoice_status_update_invoice_id?>", "name='invoice_status_update_invoice_id'");?>					

<input type="text" class="input-small datepicker" id="invoice_status_update_datetime_ext" name="invoice_status_update_datetime_ext" value="<?=human_date($item->invoice_status_update_datetime)?>" onchange="setDateField('invoice_status_update_datetime', this.value);" placeholder="Selecione uma data"><input type="hidden" id="invoice_status_update_datetime" name="invoice_status_update_datetime" value="<?=$item->invoice_status_update_datetime?>">					

<input class="input-xlarge " type="text" name="invoice_status_update_gateway" value="<?=$item->invoice_status_update_gateway?>">					

<input class="input-xlarge " type="text" name="invoice_status_update_transaction" value="<?=$item->invoice_status_update_transaction?>">					

<input class="input-xlarge " type="text" name="invoice_status_update_status_code" value="<?=$item->invoice_status_update_status_code?>">					

