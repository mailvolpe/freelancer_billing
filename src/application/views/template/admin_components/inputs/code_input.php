<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$value
	
	*/
	

?>

<?if(internet_exists()){?>

	<textarea class="hide" name="<?=$field_name?>" id="<?=$field_name?>"><?=$value?></textarea>	

	<div 
		id="ace_<?=$field_name?>" 
		class="ace_editor" 
		onkeyup="copy_paste_code();"></div>

	<script src="http://ace.c9.io/build/src/ace.js" type="text/javascript" charset="utf-8"></script>

	<script>

		var editor = ace.edit("ace_<?=$field_name?>");

		editor.setTheme("ace/theme/dawn");

		editor.getSession().setMode("ace/mode/php");

		editor.getSession().setValue($('#<?=$field_name?>').val());
		
		function copy_paste_code(){

			code = editor.getValue();

			$('#<?=$field_name?>').val(code);

		}

	</script>	

<?}else{?>

	<textarea class="form-control" rows="10" name="<?=$field_name?>" id="<?=$field_name?>"><?=$value?></textarea>	

<?}?>

<?=form_error($field_name)?>
