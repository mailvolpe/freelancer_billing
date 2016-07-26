<?php 


	if( $this->session->flashdata( 'message' ) ){ $message = $this->session->flashdata('message'); } 

	if( $this->session->flashdata( 'message_class' ) ){ $message_class = $this->session->flashdata('message_class'); } 
	
	if(!isset($message_class)){$message_class = "info";}
	
?>

<?if(isset($message)){ ?>	

	<!-- Alert -->
	<div class="messages alert alert-<?=$message_class?> alert-dismissable fade in dont-print" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Fechar">&times;</button>
		<?=$message?>
	</div>
	<!-- /Alert -->
			
<?}?>