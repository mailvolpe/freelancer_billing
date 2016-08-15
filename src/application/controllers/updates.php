<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Updates extends CI_Controller {
	 
	 
	function __construct(){

		// Call the Model constructor

		parent::__construct();
		
			 

	}

	#Funçao que trata o retorno do PagSeguro e cria uma atualização de status em uma fatura.
	
	function notification_pixel($invoice_notification_uniqid){
	
		$this->load->model('Invoice_notification');

		$this->Invoice_notification->mark_as_read($invoice_notification_uniqid);
	
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

        $this->load->model('Invoice_status_update');

        $this->load->model('Payment_pagseguro');

        $this->load->library('gateway');
	
        if($this->input->post('notificationType')!='transaction'){

            return;

        }

        $this->Payment_pagseguro->update_invoice($this->input->post('notificationCode'));

	}

	
}
