<!-- Page header -->

<div class="page-header">
	
			
			<h3>
			
				<?=$this->lang->line('accounts')?>

				
			</h3>
		
		
		
		
</div>

<!-- /page header -->


<div class="row page-subheader">

		
	<div class="col-sm-2 col-xs-6">
	
		<div class="dropdown">
		
			<a href="#" class="dropdown-toggle btn btn-default btn-block" data-toggle="dropdown">
			
				 <?=$this->lang->line('search')?> <b class="caret"></b>
				
			</a>
			
			<div class="dropdown-menu">
		
				<form action="" method="GET" class="breadcrumb-search" name="filterForm" id="filterForm">

				
						<div class="form-group">

							<label>

								<?=$this->lang->line('account_title')?>

							</label>

							<?=input_field('account_title', $this->input->get('account_title'));?>


						</div>				


						<div class="form-group">

							<label>

								<?=$this->lang->line('account_email')?>

							</label>

							<?=input_field('account_email', $this->input->get('account_email'));?>


						</div>

						<h5 class="text-center">
							<a href="javascript:void(0);" onclick="$('.extra-filters').slideToggle()"><?=$this->lang->line('extra_filters')?></a>
						</h5>
						
						<div class="extra-filters" style="display:none;">												
							
							<div class="form-group">

								<label>

									<?=$this->lang->line('account_must_change_pass')?>

								</label>

								<?=bool_field('account_must_change_pass', $this->input->get('account_must_change_pass'), false, false, 1, false);?>


							</div>

							<div class="form-group">

								<label>

									<?=$this->lang->line('account_last_access_date')?>

								</label>

								<?=input_range('datetime_field', 'account_last_access_date', 0);?>


							</div>

							<div class="form-group">

								<label>

									<?=$this->lang->line('account_last_access_ip')?>

								</label>

								<?=input_field('account_last_access_ip', $this->input->get('account_last_access_ip'));?>


							</div>

							<div class="form-group">

								<label>

									<?=$this->lang->line('account_blocked_date')?>

								</label>

								<?=input_range('datetime_field', 'account_blocked_date', 0);?>


							</div>

							<div class="form-group">

								<label>

									<?=$this->lang->line('account_created_date')?>

								</label>

								<?=input_range('datetime_field', 'account_created_date', 0);?>


							</div>

							<div class="form-group">

								<label>

									<?=$this->lang->line('account_updated_date')?>

								</label>

								<?=input_range('datetime_field', 'account_updated_date', 0);?>


							</div>
							
						</div>
				
					<!-- Footer - Filtros -->
					
					<input type="hidden" id="offsetField" name="offset" value="0">
						
					<button type="submit" class="btn-block btn btn-default"><?=$this->lang->line('search')?></button>
					
				</form>
				
			</div>
			
		</div>		
				
	</div>
	

	<div class="col-sm-2 col-sm-offset-8 col-xs-6">

		<?if($this->System_log->is_admin()){?>
			<a href="<?=base_url().'accounts/create'?>" type="button" class="btn btn-block btn-primary ">
			
					<?=$this->lang->line('create')?>
				
			</a>		
		<?}?>

	</div>	

</div>

<!-- Applied Filters -->

<?=applied_filters();?>

<!-- /applied filters -->

<?php if(count($itens)>0){ ?>

<!-- BEGIN TABLE -->

<div class="table-responsive">

	<table class="table table-striped">
	
		<thead class="hidden-xs">
		
			<tr>
			
				<th nowrap>
					
					<a href="<?=order_by_url('account_title')?>">
					
						<?=$this->lang->line('account_title')?>
						
					</a><?=order_by_reverse('account_title')?>
					
				</th>			
			
							
				
				<th nowrap>
					
					<a href="<?=order_by_url('account_email')?>">
					
						<?=$this->lang->line('account_email')?>
						
					</a><?=order_by_reverse('account_email')?>
					
				</th>
				
				<th nowrap>
					
				
					<?=$this->lang->line('account_level')?>
					
					
				</th>
				
				<th nowrap>
					
					<a href="<?=order_by_url('account_last_access_date')?>">
					
						<?=$this->lang->line('account_last_access_date')?>
						
					</a><?=order_by_reverse('account_last_access_date')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('account_updated_date')?>">
					
						<?=$this->lang->line('account_updated_date')?>
						
					</a><?=order_by_reverse('account_updated_date')?>
					
				</th>
				
								
				<th width=1%>
				
					 
					
				</th>
				
			</tr>
			
		</thead>
		
		<tbody class="table_body">
		
			<?$this->load->view("accounts/rows", array("itens"=>$itens))?>
			
		</tbody>
		
	</table>	
	
</div>

<!--paginação-->

<div class="datatable-footer">

	<?=load_more_button();?>
	
</div>

<?php }else{ ?>
	
	<?=no_results_warning();?>
	
<?php } ?>

