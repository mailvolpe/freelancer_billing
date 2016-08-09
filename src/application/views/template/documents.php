<!DOCTYPE html>
<html lang="pt-br">

	<?php $this->load->view('template/head'); ?>
	
    <body class="">
	
		<div class="container">
			
			<div class="row main-admin-row-header dont-print">
						
				<div class="row-height">
					
					<div class="client_name_container">
						<h4><?=$this->System_settings->settings->system_title?></h4>
					</div>
					
			
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="main-admin-row row-height">
					

					
					<div class="col-xs-12 col-sm-height main-admin-content">
					
						<div class="page-content documents-template">

						<? $this->load->view('template/messages'); ?>
					
						<? $this->load->view($page); ?>
						
						</div>
						
					</div>							
					
				</div>
				
			</div>

			<div class="row footer-row dont-print">	
			
				<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">			
						
						
				</div>
			
				<div class="col-xs-12 col-sm-10 col-md-11 col-lg-11 footer center-xs right">
			
					<span class=""><?=$this->System_settings->settings->system_title;?></span>
					
				</div>
			</div>
			
		</div>
	
    </body>

	<?if(isset($load_scripts) AND count($load_scripts)>0){?>
	<!-- LOADED SCRIPTS -->
	<? foreach($load_scripts as $script){?>
		<script src="<?=$script?>"></script>
	<?}}?>
	
</html>