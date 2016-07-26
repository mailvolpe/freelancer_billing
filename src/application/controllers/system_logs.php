<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_logs extends CI_Controller {
	 
	 
	function __construct(){

		// Call the Model constructor

		parent::__construct();
		
			

	}

	public function logout(){
		
		$this->session->unset_userdata('info');

		redirect('/login', 'location');
		
	}
	 
	 
	public function index(){		

		# SE TIVER LOGADO REDIRECIONA

		if($this->session->userdata('info') AND !$this->input->post()){

			redirect($this->router->default_controller, 'redirect');
			
		}
		
		
		#DADOS DE LOGIN ENVIADOS
		
		if($this->input->post()){

		
			
			$user = $this->System_log->check($this->input->post('account_email'), $this->input->post('password'));
			
			if($user){
			
				#SE AUTENTICAR GRAVA A SESSÃO E...

				$session['info'] = $user;
				
				$this->session->set_userdata($session);

				#SE TIVER COOKIE DE REDIR?

				if($this->input->cookie('attempted_url')){

					setcookie('attempted_url', null, null, "/");

					redirect(rtrim($this->input->cookie('attempted_url'), "?"), 'redirect');

				}else{
				
					# MAIN CONTROLLER

					redirect('', 'redirect');

				}
				
				
			}else{

				#SE NÃO AUTENTICAR...

				$data['alert'] = new stdClass;

				$this->session->unset_userdata('info');



				$data['account_email']=$this->input->post('account_email');

				$this->load->vars(array("message"=>$this->lang->line('try_again'), "message_class"=>"danger"));

				$this->load->view('system_logs/login', $data);

				return;

			}
			
		}else{

			$data['account_email'] = null;

		}
	
		$this->load->view('system_logs/login', $data);
		
	}
	
	function recover(){

		$data['alert'] = new stdClass;

		if($this->session->userdata('info')){

			#SE ACESSAR ESTE CONTROLLER LOGADO, DERRUBA SESSAO.

			$this->session->unset_userdata('info');		
			
			redirect('login', 'location');
			
			return;
			
		}
		
		$data['account_email'] = '';
			
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			
			$data['account_email'] = $this->input->post('account_email');
			
			$user = $this->System_log->check($this->input->post('account_email'), false, 1);
			
			if(!$user){
			
				#LANÇA EXCEÇÃO

				$this->load->vars(array("message"=>$this->lang->line('user_not_found'), "message_class"=>"danger"));
				
			}else{

				#SE EXISTIR USER

				$newpass = hash('crc32', time());

				$notification_data['account_email']=$user->account_email;

				$notification_data['newpass']=$newpass;
				
				$notification_data['link_url']=base_url().'login';

				$notificate = $this->System_notification->notificate($user->account_email, 'password_recovery', $notification_data, true);

				if($notificate!==true){

					//print_r($notificate);

					$this->load->vars(array("message"=>$this->lang->line('cant_send_email'), "message_class"=>"danger"));

				}else{

					#Só troca a senha se mandar o e-mail

					$this->db->where("account_id = '".$user->account_id."'");
					
					$this->db->set('account_password', "PASSWORD('".$newpass."')", FALSE); 

					$this->db->set('account_must_change_pass', '1'); 
					
					$query = $this->db->update('accounts');

					#exit; #BEBUG

					$this->load->vars(array("message"=>$this->lang->line('mail_sent'), "message_class"=>"success"));	

					$this->load->view('system_logs/login', $data);			

					return;

				}

			}
			
		}
		
		$this->load->view('system_logs/login', $data);

	}


	
}
