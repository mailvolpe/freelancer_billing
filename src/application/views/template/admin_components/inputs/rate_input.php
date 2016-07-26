<?
	
	#Handle variables initialization
	/*
	
		$field_name - determines names and label using lang->line()
		
		$value
		
		$readonly
	
	*/

	if($readonly){

		$readonly_value = 'true';

	}else{

		$readonly_value = 'false';

	}
	
?>	

<input type="hidden" name="<?=$field_name?>" id="<?=$field_name?>_field" value="<?=$value?>">

<div id="<?=$field_name?>" data-score="<?=$value?>"class="rate"></div>

<script>
	
	$('div#<?=$field_name?>').raty({

	  score: function() {

	    return $(this).attr('data-score');

	  },

	  readOnly : <?=$readonly_value?>,

	  path  : 'assets/js/plugins/forms/raty',

	click: function(score, evt) {

		//alert('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);

		$("#<?=$field_name?>_field").val(score);

	}	  

	});

</script>