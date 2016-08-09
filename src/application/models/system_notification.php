<?php
class System_notification extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	 
    }


    function notificate($to, $event_name, $data, $sendmail=true, $debug=false){

		$message = $this->System_settings->settings->$event_name;
		
    	$title = $this->System_settings->settings->{$event_name.'_subject'};

    	foreach($data as $key => $value){

    			$message = str_replace("{".$key."}", $value, $message);
				
				$title = str_replace("{".$key."}", $value, $title);

    	}

    	if($sendmail AND $to){

    		$send_error = $this->System_mail->send_notification_email($to, $title, $message, $debug);

			if( $send_error ){

				return $send_error;

			}else{

				return true;

			}

    	}else{
		
			$notification = new stdClass;
			
			$notification->to = $to;
			
			$notification->subject = $title;
			
			$notification->message = $message;
		
			return $notification;
		
		}

    	

    }

}


/* End of file system_notification.php */
/* Location: ./application/models/system_notification.php */