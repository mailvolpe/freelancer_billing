<h2>
	Atualizar <?=$file->file_name?>
	<div class="pull-right">
		<a href="<?=$this->input->server('HTTP_REFERER')?>" class="btn btn-default">Voltar</a>
	</div>
</h2>


<form action="" method="post" enctype="multipart/form-data">

	<input type="hidden" name="return_url" value="<?=set_value('return_url', $this->input->server('HTTP_REFERER'))?>"> 

	<div class="form-group">
		<label>Título</label>
		<?=input_field('file_title', set_value('file_title', $file->file_title));?>	
	</div>
	
	<div class="form-group">
		<label>Descrição</label>
		<?=input_field('file_description', set_value('file_description', $file->file_description));?>	
	</div>
	
	<div class="form-group">
		<label>Data de Indexação</label>
		<?=datetime_field('file_index_date', set_value('file_index_date', $file->file_index_date));?>	
	</div>

	<div class="form-group">
		<label>Hora de Indexação</label>
		<?=datetime_field('file_index_time', set_value('file_index_time', $file->file_index_time), true);?>	
	</div>	
	
	<div class="form-group">
		<label>Ordem</label>
		<?=number_field('file_index_order', set_value('file_index_order', $file->file_index_order), 0.01);?>	
	</div>	
	
	<button type="submit" class="btn btn-block btn-primary">Salvar</button>
</form>