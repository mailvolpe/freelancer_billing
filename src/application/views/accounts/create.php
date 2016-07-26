<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('create').' '.$this->lang->line('account')?>
			
			<?if(isset($member)){?>
				<?=$this->lang->line('of')?> <?=$member->member_name?>
			<?}?>

		</h3>

	</div>

</div>

<!-- /page header -->


<form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('account_title')?>

		</label>

		<div class="col-sm-9">

			<?=input_field('account_title', set_value('account_title'));?>

		</div>

	</div>
	

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('account_password')?>

		</label>

		<div class="col-sm-9">

			<?=input_field('account_password', set_value('account_password'), 'type="password"');?>

		</div>

	</div>

	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('account_email')?>

		</label>

		<div class="col-sm-9">

			<?=input_field('account_email', set_value('account_email'));?>

		</div>

	</div>
	
	<div class="form-group">

		<label class="col-sm-3 control-label">

			<?=$this->lang->line('account_must_change_pass')?>

		</label>

		<div class="col-sm-9">

			<?=bool_field('account_must_change_pass', set_value('account_must_change_pass'));?>

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

						<?=$this->lang->line('create').' '.$this->lang->line('account')?>

					</button>

				</div>
				
			</div>
			
		</div>

	</div>
	

	<input type="hidden" name="referer_query_string" value="<?=get_referer_query_string()?>">

</form>
