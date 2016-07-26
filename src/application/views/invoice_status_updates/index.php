<!-- Page header -->

<div class="page-header">
	
			
			<h3>
			
				<?=$this->lang->line('invoice_status_updates')?>

				
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

								<?=$this->lang->line('invoice_status_update_invoice_id')?>

							</label>

							<?=input_range('number_field', 'invoice_status_update_invoice_id', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_status_update_datetime')?>

							</label>

							<?=input_range('datetime_field', 'invoice_status_update_datetime', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_status_update_gateway')?>

							</label>

							<?=input_field('invoice_status_update_gateway', $this->input->get('invoice_status_update_gateway'));?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_status_update_transaction')?>

							</label>

							<?=input_field('invoice_status_update_transaction', $this->input->get('invoice_status_update_transaction'));?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_status_update_status_code')?>

							</label>

							<?=input_field('invoice_status_update_status_code', $this->input->get('invoice_status_update_status_code'));?>


						</div>
				
				
					<!-- Footer - Filtros -->
					
					<input type="hidden" id="offsetField" name="offset" value="0">
						
					<button type="submit" class="btn-block btn btn-default"><?=$this->lang->line('search')?></button>
					
				</form>
				
			</div>
			
		</div>		
				
	</div>
	

	<div class="col-sm-2 col-sm-offset-8 col-xs-6">

		<a href="<?=base_url().'invoice_status_updates/create'?>" type="button" class="btn btn-block btn-primary ">
		
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
					
					<a href="<?=order_by_url('invoice_status_update_id')?>">
					
						<?=$this->lang->line('invoice_status_update_id')?>
						
					</a><?=order_by_reverse('invoice_status_update_id')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_status_update_invoice_id')?>">
					
						<?=$this->lang->line('invoice_status_update_invoice_id')?>
						
					</a><?=order_by_reverse('invoice_status_update_invoice_id')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_status_update_datetime')?>">
					
						<?=$this->lang->line('invoice_status_update_datetime')?>
						
					</a><?=order_by_reverse('invoice_status_update_datetime')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_status_update_gateway')?>">
					
						<?=$this->lang->line('invoice_status_update_gateway')?>
						
					</a><?=order_by_reverse('invoice_status_update_gateway')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_status_update_transaction')?>">
					
						<?=$this->lang->line('invoice_status_update_transaction')?>
						
					</a><?=order_by_reverse('invoice_status_update_transaction')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_status_update_status_code')?>">
					
						<?=$this->lang->line('invoice_status_update_status_code')?>
						
					</a><?=order_by_reverse('invoice_status_update_status_code')?>
					
				</th>
				
								
				<th width=1%>
				
					 
					
				</th>
				
			</tr>
			
		</thead>
		
		<tbody class="table_body">
		
			<?$this->load->view("invoice_status_updates/rows", array("itens"=>$itens))?>
			
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

