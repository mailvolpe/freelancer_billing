<!-- Modal -->

<div class="modal-dialog">

	<div class="modal-content">
	
		<div class="modal-header">
		
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			
			<h4 class="modal-title"><?=$this->lang->line('select_an_option')?></h4>
			
		</div>

		<div class="modal-body with-padding">
		
			<form action="javascript:void(0);" onsubmit="makeSearch();">
			
				<div class="row">
				
					<div class="col-sm-9">
					
						<div class="form-group">
						
							<input  class="form-control" type="text" id="modal_locate" value="<?=$this->input->get('modal_locate')?>"  placeholder="<?=$this->lang->line('type_and_hit_enter_key')?>">

							<input  type="hidden" id="modal_filter_field" value="<?=$this->input->get('modal_filter_field')?>">
							
							<input  type="hidden" id="modal_filter_value" value="<?=$this->input->get('modal_filter_value')?>">							
							
						</div>
						
					</div>
					
					<div class="col-sm-3">
					
						<div class="form-group">
						
							<input type="submit" class="btn-block btn btn-success" value="<?=$this->lang->line('search')?>">
							
						</div>
						
					</div>
					
				</div>
				
			</form>
			
			<?$this->load->view($this->uri->segment(1)."/results", array("itens"=>$itens))?>

		</div>

	</div>
	
</div>
	
<!-- Modal -->