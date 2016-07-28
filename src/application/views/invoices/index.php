<!-- Page header -->

<div class="page-header">
	
			
			<h3>
			
				<?=$this->lang->line('invoices')?>

				
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

								<?=$this->lang->line('invoice_account_id')?>

							</label>

							<?=input_range('number_field', 'invoice_account_id', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_amount')?>

							</label>

							<?=input_range('number_field', 'invoice_amount', 2, '.');?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_description')?>

							</label>

							<?=input_field('invoice_description', $this->input->get('invoice_description'));?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_created_date')?>

							</label>

							<?=input_range('datetime_field', 'invoice_created_date', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_due_date')?>

							</label>

							<?=input_range('datetime_field', 'invoice_due_date', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_paid_date')?>

							</label>

							<?=input_range('datetime_field', 'invoice_paid_date', 0);?>


						</div>
				
				
					<!-- Footer - Filtros -->
					
					<input type="hidden" id="offsetField" name="offset" value="0">
						
					<button type="submit" class="btn-block btn btn-default"><?=$this->lang->line('search')?></button>
					
				</form>
				
			</div>
			
		</div>		
				
	</div>
	

	<div class="col-sm-2 col-sm-offset-8 col-xs-6">

		<a href="<?=base_url().'invoices/create'?>" type="button" class="btn btn-block btn-primary ">
		
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
					
					<a href="<?=order_by_url('invoice_id')?>">
					
						<?=$this->lang->line('invoice_id')?>
						
					</a><?=order_by_reverse('invoice_id')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('account_title')?>">
					
						<?=$this->lang->line('account_title')?>
						
					</a><?=order_by_reverse('account_title')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_amount')?>">
					
						<?=$this->lang->line('invoice_amount')?>
						
					</a><?=order_by_reverse('invoice_amount')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_description')?>">
					
						<?=$this->lang->line('invoice_description')?>
						
					</a><?=order_by_reverse('invoice_description')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_due_date')?>">
					
						<?=$this->lang->line('invoice_due_date')?>
						
					</a><?=order_by_reverse('invoice_due_date')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_paid_date')?>">
					
						<?=$this->lang->line('invoice_paid_date')?>
						
					</a><?=order_by_reverse('invoice_paid_date')?>
					
				</th>
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_created_date')?>">
					
						<?=$this->lang->line('invoice_created_date')?>
						
					</a><?=order_by_reverse('invoice_created_date')?>
					
				</th>
				
								
				<th width=1%>
				
					 
					
				</th>
				
			</tr>
			
		</thead>
		
		<tbody class="table_body">
		
			<?$this->load->view("invoices/rows", array("itens"=>$itens))?>
			
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

