<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('update').' '.$this->lang->line('invoice_status_update')?>
			
		</h3>

	</div>

</div>

<!-- /page header -->

<div class="row page-subheader">

	
	
	
</div>	
	
<form method="post" action="" class="form-horizontal" autocomplete="on" role="form" enctype="multipart/form-data">

	

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_status_update_datetime')?>

		</label>

		<div class="col-sm-9">


			<?=datetime_field('invoice_status_update_datetime', set_value('invoice_status_update_datetime', $item->invoice_status_update_datetime));?>

			</div>

	</div>


	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_status_update_gateway')?>

		</label>

		<div class="col-sm-9">

			<?=select_field('invoice_status_update_gateway', $gateways, set_value('invoice_status_update_gateway', $item->invoice_status_update_gateway))?>			
			
		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_status_update_status_code')?>

		</label>

		<div class="col-sm-9">
		
			<?=select_field('invoice_status_update_status_code', $statuses, set_value('invoice_status_update_status_code', $item->invoice_status_update_status_code))?>

		</div>

	</div>
	

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_status_update_transaction')?>

		</label>

		<div class="col-sm-9">


			<?=input_field('invoice_status_update_transaction', set_value('invoice_status_update_transaction', $item->invoice_status_update_transaction));?>
			
			</div>

	</div>


	<div class="row">
		
		<div class="col-sm-9 col-sm-offset-3 col-xs-12">
		
			<div class="row">
		
				<div class="col-xs-6">
				
					<a class="btn btn-block btn-default" href="<?=base_url()?>invoice_status_updates/view/<?=$item->invoice_status_update_id?> " >

						<?=$this->lang->line('cancel')?>
						
					</a>

				</div>
				
				<div class="col-xs-6">

				
					<button type="submit" class="btn btn-primary btn-block">

						<?=$this->lang->line('update').' '.$this->lang->line('invoice_status_update')?>

					</button>		

				</div>		
			
			</div>		
			
		</div>			
		
	</div>
	
	<input type="hidden" name="referer_query_string" value="<?=get_referer_query_string()?>">

</form>   
