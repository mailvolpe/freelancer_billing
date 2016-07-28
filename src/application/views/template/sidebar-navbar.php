

<div class="row collapse navbar-collapse" id="navbar">

<?/*
<div class="row sidebar-user-row">

	<div class="col-xs-5 col-sm-4" style="padding-right:0px;">
		<? if($logged->photo_path){ ?>
			<a href="settings">
				<div class="logged_sidebar_photo" style="background-image:url('<?=$logged->photo_path?>')"></div>
			</a>
		<? } ?>
	</div>
	
	<div class="col-xs-7 col-sm-8">
		<a href="settings">
		
		<?=character_limiter(strip_tags($logged->account_title), 15)?>
		
		<div class="small">
			<div><?=$logged->account_role?></div>
			<?if(!$this->System_log->is_client()){?><?=$logged->client_name?><?}?>
		</div>
		
		</a>
		
	</div>
	
</div>
*/?>
	 
	<ul class="nav nav-stacked">		
		
		<li>
			<a href="accounts"><i class="fa fa-user"></i> <?=$this->lang->line('accounts')?></a>
		</li>				

		<li>
			<a href="recurrencies"><i class="fa fa-repeat"></i> <?=$this->lang->line('recurrencies')?></a>
		</li>						
		
		<li>
			<a href="invoices"><i class="fa fa-calendar-check-o"></i> <?=$this->lang->line('invoices')?></a>
		</li>						
		
	</ul>
	
</div>	