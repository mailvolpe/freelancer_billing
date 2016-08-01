<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('create').' '.$this->lang->line('recurrency')?>

		</h3>

	</div>

</div>

<!-- /page header -->


<form method="post" action="" class="form-horizontal" autocomplete="on" role="form" enctype="multipart/form-data">

	
	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('recurrency_account_id')?>

		</label>

		<div class="col-sm-9">

			<?#=number_field('recurrency_account_id', set_value('recurrency_account_id'));?>

			<?=select_field('recurrency_account_id', make_select_options_array($active_clients, 'account_id', 'account_title', $this->lang->line('select_value')), set_value('recurrency_account_id'));?>			
			
		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('recurrency_amount')?>

		</label>

		<div class="col-sm-9">

			<?=number_field('recurrency_amount', set_value('recurrency_amount'), 0.01);?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('recurrency_when_day')?>

		</label>

		<div class="col-sm-9">

			<?=number_field('recurrency_when_day', set_value('recurrency_when_day'));?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('recurrency_when_month')?>

		</label>

		<div class="col-sm-9">

			<?=number_field('recurrency_when_month', set_value('recurrency_when_month'));?>
			<p class="help-block"><?=$this->lang->line('yearly_recurrency_help')?></p>
		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('recurrency_description')?>

		</label>

		<div class="col-sm-9">

			<?=input_field('recurrency_description', set_value('recurrency_description'));?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('recurrency_limit')?>

		</label>

		<div class="col-sm-9">

			<?=number_field('recurrency_limit', set_value('recurrency_limit'));?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('recurrency_start')?>

		</label>

		<div class="col-sm-9">

			<?=bool_field('recurrency_start', set_value('recurrency_start'));?>

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

						<?=$this->lang->line('create').' '.$this->lang->line('recurrency')?>

					</button>

				</div>
				
			</div>
			
		</div>

	</div>
	

	<input type="hidden" name="referer_query_string" value="<?=get_referer_query_string()?>">

</form>
