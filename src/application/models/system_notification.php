<?php
class System_notification extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	 
    }


    function notificate($to, $event_name, $data, $sendmail=true){

    	$this->load->language('notification_templates');

    	$message = $this->lang->line($event_name);

    	$title = $this->lang->line($event_name.'_subject');

    	foreach($data as $key => $value){

    			$message = str_replace("{".$key."}", $value, $message);

    	}

    	if($sendmail){

    		$send_error = $this->System_mail->send_notification_email($to, $title, $message);

			if( $send_error ){

				return $send_error;

			}else{

				return true;

			}

    	}

    	

    }

}


/* End of file system_notification.php */
/* Location: ./application/models/system_notification.php */