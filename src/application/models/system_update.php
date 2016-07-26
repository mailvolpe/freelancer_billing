<?
class System_update extends CI_Model {



	function get_select_input_months(){
	
		return array(
		
			'01' => $this->lang->line('january'), 
			'02' => $this->lang->line('february'),
			'03' => $this->lang->line('march'),
			'04' => $this->lang->line('april'),
			'05' => $this->lang->line('may'),
			'06' => $this->lang->line('june'),
			'07' => $this->lang->line('july'),
			'08' => $this->lang->line('august'),
			'09' => $this->lang->line('september'),
			'10' => $this->lang->line('october'),
			'11' => $this->lang->line('november'),
			'12' => $this->lang->line('december'),			

		);
	
	}

	function get_city_name($addr_city_id=false, $show_state=false){
	
		$string = '';
	
		if(!$addr_city_id){$string .= $this->lang->line('undefined');}
		
	
		$this->db->join('addr_states', 'addr_cities.addr_state_id = addr_states.addr_state_id');
	
		$query = $this->db->get_where('addr_cities', array('addr_city_id' => $addr_city_id));		
		
		$result = $query->result();	
		
		if(isset($result[0])){
		
			$string .= $result[0]->city_name;

			if($show_state){
			
				$string .= ' - '.$result[0]->acronym;
				
			}
			
		}		
		

		
		return $string;
	
	}

	function get_state_value_by_city_id($addr_city_id){
	
		$this->db->select('addr_state_id');
	
		$query = $this->db->get_where('addr_cities', array('addr_city_id' => $addr_city_id));
		
		$result = $query->result();	
		
		if(isset($result[0])){
		
			return $result[0]->addr_state_id;
			
		}
		
		return false;
	
	}

	function get_addr_states(){
	
		$query = $this->db->get('addr_states');
		
		return $query->result();
	
	}

	function get_addr_cities($addr_state_id){
	
		$this->db->select('addr_city_id, city_name');
	
		$query = $this->db->get_where('addr_cities', array('addr_state_id' => $addr_state_id));
		
		return $query->result();
	
	}
	
	
    function __construct()
    {
	
        // Call the Model constructor

        parent::__construct();
		
		ob_start();
	
		# Timezone Setting
		
		date_default_timezone_set("America/Sao_Paulo");

		/*
		//LANGUAGE SET IF NO COOKIE AND DEFAULT IN DB
		if(
			logged() 
			AND !isset($_COOKIE['system_language']) 
			AND isset(logged()->default_language)
			AND $this->router->fetch_method()!='set_language'
			){

			//Sets the cookie
			setcookie('system_language', logged()->default_language, 0, "/");

			//Redirects to panel
			redirect("/", "location");

		}
		*/

		
		# Update module also has to keep all controllers updated.
		
		$this->form_validation->set_error_delimiters('', '');				
    }
	
}


/* End of file c_cron_update.php */
/* Location: ./application/models/c_cron_update.php */