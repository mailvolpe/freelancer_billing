<!-- Page header -->

<div class="page-header">
	
			
			<h3>

				<a href="invoices/view/<?=$invoice->invoice_id?>">
					<?=$this->lang->line('invoice')?>
					<?=format_id($invoice->invoice_id)?>			
				</a>
		
				-	
			
				<?=$this->lang->line('invoice_notifications')?>

				
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

								<?=$this->lang->line('invoice_notification_invoice_id')?>

							</label>

							<?=input_range('number_field', 'invoice_notification_invoice_id', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_notification_type')?>

							</label>

							<?=input_field('invoice_notification_type', $this->input->get('invoice_notification_type'));?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_notification_read')?>

							</label>

							<?=input_range('datetime_field', 'invoice_notification_read', 0);?>


						</div>

						<div class="form-group">

							<label>

								<?=$this->lang->line('invoice_notification_read_ip')?>

							</label>

							<?=input_field('invoice_notification_read_ip', $this->input->get('invoice_notification_read_ip'));?>


						</div>
				
				
					<!-- Footer - Filtros -->
					
					<input type="hidden" id="offsetField" name="offset" value="0">
						
					<button type="submit" class="btn-block btn btn-default"><?=$this->lang->line('search')?></button>
					
				</form>
				
			</div>
			
		</div>		
				
	</div>
	

	<div class="col-sm-2 col-sm-offset-8 col-xs-6">

		<a href="<?=base_url().'invoice_notifications/create/'.$invoice->invoice_id?>" type="button" class="btn btn-block btn-primary ">
		
				<?=$this->lang->line('send')?>
			
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
					
					<a href="<?=order_by_url('invoice_notification_sent')?>">
					
						<?=$this->lang->line('invoice_notification_sent')?>
						
					</a><?=order_by_reverse('invoice_notification_sent')?>
					
				</th>
							
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_notification_type')?>">
					
						<?=$this->lang->line('invoice_notification_type')?>
						
					</a><?=order_by_reverse('invoice_notification_type')?>
					
				</th>
				
				
				<th nowrap>
					
					<a href="<?=order_by_url('invoice_notification_read')?>">
					
						<?=$this->lang->line('invoice_notification_read')?>
						
					</a><?=order_by_reverse('invoice_notification_read')?>
					
				</th>
				
				
				<th width=1%>
				
					 
					
				</th>
				
			</tr>
			
		</thead>
		
		<tbody class="table_body">
		
			<?$this->load->view("invoice_notifications/rows", array("itens"=>$itens))?>
			
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

