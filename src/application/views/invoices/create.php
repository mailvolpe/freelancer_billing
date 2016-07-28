<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('create').' '.$this->lang->line('invoice')?>

		</h3>

	</div>

</div>

<!-- /page header -->


<form method="post" action="" class="form-horizontal" autocomplete="on" role="form" enctype="multipart/form-data">

	
	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_account_id')?>

		</label>

		<div class="col-sm-9">

			<?#=number_field('invoice_account_id', set_value('invoice_account_id'));?>
			
			<?=select_field('invoice_account_id', make_select_options_array($active_clients, 'account_id', 'account_title', $this->lang->line('select_value')), set_value('invoice_account_id'));?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_amount')?>

		</label>

		<div class="col-sm-9">

			<?=number_field('invoice_amount', set_value('invoice_amount'), 0.01);?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_description')?>

		</label>

		<div class="col-sm-9">

			<?=input_field('invoice_description', set_value('invoice_description'));?>

		</div>

	</div>

	<?/*
	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_created_date')?>

		</label>

		<div class="col-sm-9">

			<?=datetime_field('invoice_created_date', set_value('invoice_created_date'), 0);?>

		</div>

	</div>
	*/?>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_due_date')?>

		</label>

		<div class="col-sm-9">

			<?=datetime_field('invoice_due_date', set_value('invoice_due_date'), 0);?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('invoice_paid_date')?>

		</label>

		<div class="col-sm-9">

			<?=datetime_field('invoice_paid_date', set_value('invoice_paid_date'), 0);?>

		</div>

	</div>
	
	<div class="row">
	
		<div class="col-sm-9 col-sm-offset-3 col-xs-12">
		
			<div class="row">	
		
				<div class="col-xs-6">
				

					<a class="btn btn-block btn-default" href="<?=back_url()?>">

						<?=$this->lang->line('cancel')?>

					</a>

				</div>

			
				<div class="col-xs-6">

					<button type="submit" class="btn btn-primary btn-block">

						<?=$this->lang->line('create').' '.$this->lang->line('invoice')?>

					</button>

				</div>
				
			</div>
			
		</div>

	</div>
	

	<input type="hidden" name="referer_query_string" value="<?=get_referer_query_string()?>">

</form>
