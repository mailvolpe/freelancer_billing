<!-- Page header -->

<div class="page-header">
	
			
			<h3>
			
				<?=isset($override_title)?$override_title:$this->lang->line('recurrencies');?>

				
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

								<?=$this->lang->line('recurrency_account_id')?>

							</label>

							<?=input_range('number_field', 'recurrency_account_id', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('recurrency_amount')?>

							</label>

							<?=input_range('number_field', 'recurrency_amount', 2, '.');?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('recurrency_when_day')?>

							</label>

							<?=input_range('number_field', 'recurrency_when_day', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('recurrency_when_month')?>

							</label>

							<?=input_range('number_field', 'recurrency_when_month', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('recurrency_description')?>

							</label>

							<?=input_field('recurrency_description', $this->input->get('recurrency_description'));?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('recurrency_limit')?>

							</label>

							<?=input_range('number_field', 'recurrency_limit', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('recurrency_start')?>

							</label>

							<?=bool_field('recurrency_start', $this->input->get('recurrency_start'), false, false, 1, false, 'onchange="form.submit();"');?>


						</div>
				
				
					<!-- Footer - Filtros -->
					
					<input type="hidden" id="offsetField" name="offset" value="0">
						
					<button type="submit" class="btn-block btn btn-default"><?=$this->lang->line('search')?></button>
					
				</form>
				
			</div>
			
		</div>		
				
	</div>
	

	<div class="col-sm-2 col-sm-offset-8 col-xs-6">

		<a href="<?=base_url().'recurrencies/create'?>" type="button" class="btn btn-block btn-primary ">
		
				<?=$this->lang->line('create')?>
			
		</a>		

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
					
					<a href="<?=order_by_url('recurrency_id')?>">
					
						<?=$this->lang->line('recurrency_id')?>
						
					</a><?=order_by_reverse('recurrency_id')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('account_title')?>">
					
						<?=$this->lang->line('account_title')?>
						
					</a><?=order_by_reverse('account_title')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('recurrency_amount')?>">
					
						<?=$this->lang->line('recurrency_amount')?>
						
					</a><?=order_by_reverse('recurrency_amount')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('recurrency_description')?>">
					
						<?=$this->lang->line('recurrency_description')?>
						
					</a><?=order_by_reverse('recurrency_description')?>
					
				</th>

				<th nowrap>

					<?=$this->lang->line('recurrency')?>
					
				</th>
						
				
				<th nowrap>
					
					<a href="<?=order_by_url('recurrency_limit')?>">
					
						<?=$this->lang->line('recurrency_limit')?>
						
					</a><?=order_by_reverse('recurrency_limit')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('recurrency_start')?>">
					
						<?=$this->lang->line('recurrency_start')?>
						
					</a><?=order_by_reverse('recurrency_start')?>
					
				</th>
				
								
				<th width=1%>
				
					 
					
				</th>
				
			</tr>
			
		</thead>
		
		<tbody class="table_body">
		
			<?$this->load->view("recurrencies/rows", array("itens"=>$itens))?>
			
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

