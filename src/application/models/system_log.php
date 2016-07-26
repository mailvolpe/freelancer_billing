<?php

class System_log extends CI_Model {


	function is_client(){
	
		if($this->is_admin()){return true;}
		
		elseif($this->logged->account_is_client){return true;}
		
		return false;
	}

	function is_admin(){
		
			if($this->logged->account_is_admin == 1){
			
				return true;
				
			}else{
			
				return false;
			
			}

			
		}	
	
	
    function __construct()
    {
	
        // Call the Model constructor
		
        parent::__construct();	
		
		if(
			$this->logged(true)
		){
			$this->trace();
		}			
		
    }
    
    function check($account_email='', $password='', $recover=false)
    {

		if(!$account_email){$account_email="";} # Cant be empty.

		$this->db->select('account_id, account_email');

		if(!$recover){

			$this->db->where('account_password', 'PASSWORD("'.$password.'")', FALSE);
			
		}
		
		#Tem que pertencer ao mesmo domínio (cliente) ou ser account_is_admin = 1
		$this->db->where('(account_id IS NOT NULL OR account_is_admin = 1)', null, false);		
		
		$this->db->where('account_email', $account_email);
		
		$this->db->where('account_blocked_date', null);
		
		$query = $this->db->get('accounts');
		
		#echo $this->db->_error_message().$this->db->last_query(); # Debug assist
		
		$result = $query->result();

		if(count($result)>0){

			return $result[0];

		}else{

			return false;

		}
		
    }    
    
    
    function logged($force_db=false){
		
		if(!$this->session->userdata('info')){

			#RETORNA FALSO QUANDO NÃO TEM LOGADO
			return false;

		}
		

		# SE NÃO, CONSULTA O BANCO E RETORNA OS CAMPOS

		if($this->session->userdata('info')==''){
		
			return false;
			
		}
		
		$user_info = $this->session->userdata('info');
		
		$logged = $this->Account->get_item($user_info->account_id);
	
		# Extra Data
	
		$account_data = $this->Account->get_account_data($logged);
	
		$logged->account_role = $account_data->account_role;
	
		$logged->photo_path = $account_data->photo_path;
		
		# Publish
	
		$this->logged = $logged;
		
		$this->load->vars(array("logged" => $logged));
	
		return $logged;
    	    	
    }
	

	
	function trace(){

		$logged = $this->logged;
	
		$this->db->where("account_id = '".$logged->account_id."'");
		
		$this->db->set('account_last_access_date', "NOW()", FALSE); 

		$this->db->set('account_last_access_ip', $_SERVER['REMOTE_ADDR']); 
		
		$query = $this->db->update('accounts');		

		$this->check_must_change_password();
	
	}

	
	function check_must_change_password(){

		//MUST CHANGE PASSWORD
		// User must change password if reseted.

		if(
			$this->logged
			AND $this->logged->account_must_change_pass == '1'
			AND $this->router->fetch_class()!='system_logs'
			AND $this->router->fetch_method()!='password'
		){

			//Sets a message
			set_flash_message($this->lang->line('you_must_update_password'), 'danger');
			
			redirect('settings/password', 'location');
		}

	}	
	

}


/* End of file System_log.php */
/* Location: ./application/models/System_log.php */