<?php

	$lang['invoice_status_pending_overdue_notification_subject'] = "Aviso de fatura em atraso";

	$lang['invoice_status_pending_overdue_notification'] = "
	
	<p>Olá {account_title},</p>

	<p>A fatura {formatted_invoice_id} referente a <b>{invoice_description}</b> com vencimento para {formatted_invoice_due_date} encontra-se com o status de atrasada em nosso sistema de gestão.</p>

	<p>Acesse <a href='{direct_link_url}'>este link para visualizar e pagar sua fatura</a>.</p>

	<p>Acesse a área do cliente para realizar o pagamento ou desconsidere este aviso caso o mesmo já tenha sido realizado.</p>	
	
	<p>Atenciosamente,
	";

	/************************************************************************************/

	$lang['password_recovery_subject'] = "Recuperação de Senha";

	$lang['password_recovery'] = "
	<h3>Recuperação de senha</h3>

	<p>Olá,</p>

	<p>Recebemos a sua solicitação de nova senha e uma nova senha provisória foi gerada para você.</p>

	<p><b>E-mail:</b> {account_email}</p>

	<p><b>Senha:</b> {newpass}</p>

	<h4>Atenção!</h4>

	<p>Acesse <a href='{link_url}'>este link</a>, faça login com os dados acima e altere sua senha.</p>

	<p>Atenciosamente,
	";

	/***********************************************************************************/

	$lang['client_access_link_subject'] = "Link para acompanhamento de projetos";

	$lang['client_access_link'] = "
	<h3>Acompanhamento de projetos</h3>

	<p>Olá {client_name},</p>

	<p>Você pode usar o link abaixo para acompanhar os seus projetos online pelo celular ou desktop.</p>

	<p><b>Link:</b> <a href=\"{link_url}\">{link_url}</a></p>

	<p>Atenciosamente,
	";
	

	/***********************************************************************************/

	$lang['cicle_report_subject'] = "Link para acompanhamento da atividade";

	$lang['cicle_report'] = "
	<h3>Acompanhamento da atividade {cicle_title}</h3>

	<p>Olá {client_name},</p>
	
	<p>Use o link abaixo para acompanhar esta atividade pelo celular ou desktop.</p>

	<p><b>Link:</b> <a href=\"{link_url}\">{link_url}</a></p>

	<p>Atenciosamente,
	";	

/* End of file notification_templates_lang.php */