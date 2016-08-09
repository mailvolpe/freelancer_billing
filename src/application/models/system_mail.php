<?
class System_mail extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        //$this->config->load('smtp');

		$this->smtp_name =  $this->System_settings->settings->system_smtp_name; 
		$this->smtp_email = $this->System_settings->settings->system_smtp_email;
		
		$this->smtp_host =  $this->System_settings->settings->system_smtp_host;
		$this->smtp_port =  $this->System_settings->settings->system_smtp_port;
		$this->smtp_user =  $this->System_settings->settings->system_smtp_user;
		$this->smtp_pass =  $this->System_settings->settings->system_smtp_pass;
	
        
    }
	

	function check_smtp_credentials($server, $username, $password){
	
		$this->smtp_host = $server;
		$this->smtp_user = $username;
		$this->smtp_pass = $password;
		
		$test_to = $this->smtp_email;
		$test_subject = $this->lang->line('smtp_credentials_test');
		$test_body = $this->lang->line('operation_success');
		
		$error = $this->send_notification_email($test_to, $test_subject, $test_body);
		
		if($error){
		
			throw new Exception($error);
		
		}
		
		return true;
	
	}
	
	function send_notification_email($to, $subject, $body, $debug=false){

		$message = "<div style='width:650px; max-width:100%;'>";
		$message .= $body;
		$message .= '<br>'.$this->smtp_name;
		$message .= '<br>'.$this->smtp_email.'</p>';
		$message .= "</div>";

		if($this->System_settings->settings->sendmail_mode == '1'){
			$mail_config['protocol'] = 'smtp';		
		}else{
			$mail_config['protocol'] = 'mail';
		}
		
		$mail_config['smtp_port'] = $this->smtp_port;
		$mail_config['smtp_host'] = $this->smtp_host;
		$mail_config['smtp_user'] = $this->smtp_user;
		$mail_config['smtp_pass'] = $this->smtp_pass;				

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
				return $this->lang->line($mail_config['protocol'].'_failed');
			}

		}else{

			return false;

		}


	}

	
}