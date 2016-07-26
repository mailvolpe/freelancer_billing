<?

	$account_data = $this->Account->get_account_data($item);

	$item->account_role = $account_data->account_role;
	
?>
<!-- Page header -->

<div class="page-header">

	<div class="page-title">

		<h3>

			<?=$this->lang->line('view').' '.$this->lang->line('account')?>

			
		</h3>

	</div>

</div>

<!-- /page header -->


<div class="row">

	<div class="form-horizontal col-sm-8 col-xs-12">

		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_title')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=$item->account_title?>

				</p>

			</div>

		</div>			

	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_email')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<a href="mailto:<?=$item->account_email?>" target="_new"><?=$item->account_email?></a>

				</p>

			</div>

		</div>
		

		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_level')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?
					/*
					echo $item->account_is_client ? $this->lang->line('account_is_client') : $this->lang->line('account_is_regular')
					*/
					?>
					
					<?=$item->account_role?>

				</p>

			</div>

		</div>		
	

	
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_must_change_pass')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=display_bool_value($item->account_must_change_pass, false, false, 0, 1);?>

				</p>

			</div>

		</div>


		
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_last_access_date')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=human_date($item->account_last_access_date, true, $this->lang->line('no_record'));?>
					<?if($item->account_last_access_ip){?><div class="small"><?=$item->account_last_access_ip?></div><?}?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_blocked_date')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=display_bool_value($item->account_blocked_date, human_date($item->account_blocked_date, true), $this->lang->line('no'), null, true);?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_created_date')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=human_date($item->account_created_date, true);?>

				</p>

			</div>

		</div>
	
		<div class="form-group">

			<label class="col-sm-5 control-label">

				<?=$this->lang->line('account_updated_date')?>

			</label>

			<div class="col-sm-7">

				<p class="form-control-static">
				
					<?=human_date($item->account_updated_date, true);?>

				</p>

			</div>

		</div>
		
	</div>   


	<div class="col-sm-4 col-xs-12">

		<a class="btn btn-block btn-default view-option-link" href="<?=base_url()?>accounts/update/<?=$item->account_id?> " >

			<?=$this->lang->line('update')?>
		
		</a>
	
		
		
		<?if($item->account_blocked_date){?>
		
			<a class="btn btn-block btn-warning view-option-link" href="<?=base_url()?>accounts/block/<?=$item->account_id?> " >

				<?=$this->lang->line('unblock')?>
			
			</a>		
		
		<?}else{?>

			<a class="btn btn-block btn-danger view-option-link" href="<?=base_url()?>accounts/block/<?=$item->account_id?> " >

				<?=$this->lang->line('block')?>
			
			</a>		
		
		<?}?>
		
		<? if($this->System_log->is_admin()){ ?>
			<a class="btn btn-block btn-danger" href="<?=base_url()?>accounts/remove/<?=$item->account_id?> " >
			
				<?=$this->lang->line('remove')?>
				
			</a>							
		<?}?>
		

	</div>

</div>