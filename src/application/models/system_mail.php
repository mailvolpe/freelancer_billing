<?
class System_mail extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->config->load('smtp');

		$this->smtp_name =  $this->config->item('smtp_name');
		$this->smtp_email = $this->config->item('smtp_email');
		
		$this->smtp_host =  $this->config->item('smtp_host');
		$this->smtp_port =  $this->config->item('smtp_port');
		$this->smtp_user =  $this->config->item('smtp_user');
		$this->smtp_pass =  $this->config->item('smtp_pass');
		
		/*
		if($logged = logged()){
		
			$this->smtp_name =  $logged->account_title ? $logged->account_title : $this->config->item('smtp_name');
			$this->smtp_email =  $logged->account_email ? $logged->account_email : $this->config->item('smtp_email');
			
			$this->smtp_host =  $logged->account_mail_server ? $logged->account_mail_server : $this->config->item('smtp_host');
			$this->smtp_user =  $logged->account_mail_username ? $logged->account_mail_username : $this->config->item('smtp_user');
			$this->smtp_pass =  $logged->account_mail_password ? $logged->account_mail_password : $this->config->item('smtp_pass');
		
		}
		*/
		

        
    }
	

	function check_smtp_credentials($server, $username, $password){
	
		$this->smtp_host = $server;
		$this->smtp_user = $username;
		$this->smtp_pass = $password;
		
		$test_to = $this->smtp_email;
		$test_subject = $this->lang->line('smtp_test_subject');
		$test_body = $this->lang->line('smtp_test_body');
		
		$error = $this->send_notification_email($test_to, $test_subject, $test_body);
		
		if($error){
		
			throw new Exception($error);
		
		}
		
		return true;
	
	}
	
	function send_notification_email($to, $subject, $body, $debug=false, $auth=true){

		$message = "<div style='width:450px; max-width:100%;'>";
		$message .= $body;
		$message .= '<br>'.$this->smtp_name;
		$message .= '<br>'.$this->smtp_email.'</p>';
		$message .= "</div>";

		if(!$auth){
			$mail_config['protocol'] = 'mail';
		}else{
			$mail_config['protocol'] = 'smtp';		
			$mail_config['smtp_port'] = $this->smtp_port;
			$mail_config['smtp_host'] = $this->smtp_host;
			$mail_config['smtp_user'] = $this->smtp_user;
			$mail_config['smtp_pass'] = $this->smtp_pass;		
		}

		$mail_config['charset'] = 'utf-8';
		$mail_config['mailtype'] = 'html';
		
		#EMAILS START

    	$this->email->clear();
	
		$this->email->initialize($mail_config);		

		$this->email->from($this->smtp_email, $this->smtp_name);

		$this->email->to($to);

		$this->email->subject($this->smtp_name.' - '.$subject);

		$this->email->message($message);

		if(!@$this->email->send()){

			
			if($debug){
				return $this->email->print_debugger();
			}else{
				return $this->lang->line('smtp_failed');
			}

		}else{

			return false;

		}


	}

	
}