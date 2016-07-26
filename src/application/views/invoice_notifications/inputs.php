<input class="input-xlarge " type="text" name="invoice_notification_id" value="<?=$item->invoice_notification_id?>">					

<?=selectField(array(), "<?=$item->invoice_notification_invoice_id?>", "name='invoice_notification_invoice_id'");?>					

<input class="input-xlarge " type="text" name="invoice_notification_type" value="<?=$item->invoice_notification_type?>">					

<input type="text" class="input-small datepicker" id="invoice_notification_read_ext" name="invoice_notification_read_ext" value="<?=human_date($item->invoice_notification_read)?>" onchange="setDateField('invoice_notification_read', this.value);" placeholder="Selecione uma data"><input type="hidden" id="invoice_notification_read" name="invoice_notification_read" value="<?=$item->invoice_notification_read?>">					

<input class="input-xlarge " type="text" name="invoice_notification_read_ip" value="<?=$item->invoice_notification_read_ip?>">					

