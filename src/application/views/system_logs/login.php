<!DOCTYPE html>
<html lang="pt-br">

	<?php $this->load->view('template/head'); ?>

    <body class="system_login_body">

		<div class="col-xs-12 col-sm-4 col-sm-offset-4" >

			<!-- Login wrapper -->
			
				<h3 class="login-header"><?=$this->lang->line('system_logs')?></h3>
				
				
				<div class="well login-well">			
				
					<div class="tab-content pill-content">
					
						<div class="tab-pane fade <?if(!$this->input->get('sm')){?>active in<?}?>" id="default-pill1">
						
							<p><big><?=$this->lang->line('login')?></big></p>
						
							<form role="form" method="post" action="<?=base_url()?>login">
							
								<div class="form-group has-feedback">
								
									<label><?=$this->lang->line('account_email')?></label>
									
									<input type="text" class="form-control" name="account_email" placeholder="<?=$this->lang->line('account_email')?>" value="<?=$account_email?>">
									
								</div>

								<div class="form-group has-feedback">
								
									<label><?=$this->lang->line('password')?></label>

									
									<input type="password" class="form-control" name="password" placeholder="<?=$this->lang->line('password')?>" >
									

							
								</div>

								<div class="row form-actions">
								

									<div class="col-xs-6">
										
										<a href="#default-pill2" data-toggle="tab" class="btn btn-default">
										
											<?=$this->lang->line('forgot_password')?>
											
										</a>			
	
										
									</div>										

									<div class="col-xs-6">
									
										<button type="submit" class="btn btn-primary pull-right">
										
											<i class="icon-enter2"></i> <?=$this->lang->line('enter')?>
											
										</button>
										
									</div>
									
								</div>
								
								<input type="hidden" name="attempted_url" value="<?=$this->input->cookie('attempted_url')?>" >

							</form>
							
						</div>
						
						<div class="tab-pane fade"  id="default-pill2">
						
							<p><big><?=$this->lang->line('forgot_password')?></big></p>

							<form role="form" method="post" action="<?=base_url()?>recover">
							
								<div class="form-group has-feedback">						
								
									<label>
									
										<?=$this->lang->line('account_email')?>
										
									</label>
									
									<input type="text" class="form-control" name="account_email" placeholder="<?=$this->lang->line('account_email')?>" value="<?=$account_email?>">
									
									<i class="icon-users form-control-feedback"></i>
									
									<small class="help-block text-inverse">
									
										<?=$this->lang->line('login_recover_instructions')?>
										
									</small>
									
								</div><!-- /form-group -->
								
								<div class="row form-actions">
								
									<div class="col-xs-6">
										
											<a href="#default-pill1" data-toggle="tab" class="btn btn-default">

												<?=$this->lang->line('login')?>

											</a>
										
									</div>

									<div class="col-xs-6">
									
										<button type="submit" class="btn btn-primary pull-right">
										
											<i class="icon-lock"></i> <?=$this->lang->line('recover')?>
										
										</button>
										
									</div>
									
								</div>

							</form>
							
						</div>

						
					</div>
					
				</div>
				

			<!-- /login wrapper -->	

			<? $this->load->view('template/messages'); ?>					

			<span class="pull-right login-sys-title"><?=$this->lang->line('sys_title')?></span>
	
		</div>	
			

	
    </body>

</html>