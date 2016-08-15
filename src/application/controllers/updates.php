<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Updates extends CI_Controller {
	 
	 
	function __construct(){

		// Call the Model constructor

		parent::__construct();
		
			

	}

	#Funçao que trata o retorno do PagSeguro e cria uma atualização de status em uma fatura.
	
	function notification_pixel($notification_id_hash){
	
		echo "IMPLEMENTAR NOTIFICAÇÃO LIDA AQUI";
	
	}	
	
	#Funçao que é acionada a partir da cron e pode ser executada a partir da rota cron.php.
	
	function cron_execution(){

		$this->load->model('Recurrency');

		$this->load->model('Invoice');
	
		$this->output->enable_profiler(TRUE);

		$this->Recurrency->generate_invoices();

		$this->Invoice->dispatch_notifications();
		
	
	}	
	
	#Funçao que trata o retorno do PagSeguro e cria uma atualização de status em uma fatura.
	
	function pagseguro_notifications(){
	
		echo "IMPLEMENTAR RETORNO AUTOMATICO DE DADOS AQUI";
	
	}

	
}
