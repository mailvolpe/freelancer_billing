<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$value
		
		$rich_mode
		
		$char_limit - NO USE IN THIS EDITOR
	
	*/
	
	$readonly = $readonly ? ', readOnly : true' : false;
	
	$less_toolbar = $less_toolbar ? ", toolbar : [ [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] ]" : false;
	
?>

<script src="//cdn.ckeditor.com/4.4.6/standard/ckeditor.js"></script>

<textarea name="<?=$field_name?>"><?=$value?></textarea>
<script>
    CKEDITOR.replace( '<?=$field_name?>', {enterMode	: Number(2), allowedContent : true <?=$readonly?> <?=$less_toolbar?>} );
</script>
	
<?=form_error($field_name)?>

<?/*	
<textarea class="editor" placeholder="<?=$this->lang->line('type_here')?>" name="<?=$field_name?>" id="<?=$field_name?>"><?=$value?></textarea>

<?=form_error($field_name)?>

<script>

	$("#<?=$field_name?>").wysihtml5({
	
		"useLineBreaks": true,

		parserRules: wysihtml5ParserRules
		
	});
	
</script>		

*/?>



