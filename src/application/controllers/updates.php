<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Updates extends CI_Controller {
	 
	 
	function __construct(){

		// Call the Model constructor

		parent::__construct();
		
			

	}

	public function cities(){
		
		$cities = $this->System_update->get_addr_cities($this->input->get('addr_state_id'));
		
		if(count($cities)>0){
		
			echo select_field($this->input->get('city_field_name'), make_select_options_array($cities, 'addr_city_id', 'city_name'), $this->input->get('city_field_value'));
		
		}
		
	}
	
	public function migrate(){

		/*
		$this->load->model('Member');
		$member_posts = $this->Member->get_member_posts();
		print_r($member_posts);
		
		$marital_statuses = $this->Member->get_marital_statuses();
		print_r($marital_statuses);
		*/
	
		$array = file("members.csv");
		$i = 0;

		
		foreach($array as  $key=>$member){

			#if($i > 3){ break; }
		
			$member = str_replace("\n", "", $member);
			
			$member = explode(";", $member);
			
			if($i == 0){
				$keys = $member;
			}
			
			
			else{
				
				$k = 0;
				foreach($member as $attr){
					
					$key = trim($keys[$k]);
					
					$attr = trim($attr);
					
					if($attr AND in_array($key, array('member_birthdate', 'member_baptism_date', 'member_consecration_date', 'member_reception_date'))){
					
						$attr = date("Y-m-d", strtotime($attr)); #.' = '.$attr;
					
					}
					
					if(in_array($key, array('member_addr_city_id', 'member_natural_from_city_id')) AND $attr){
					
						$explode = explode("/", $attr);
						
						$attr = trim($explode[0]);
						
						$this->db->join('addr_states', 'addr_states.addr_state_id = addr_cities.addr_state_id');
						
						if(isset($explode[1])){
							$this->db->like('acronym', trim($explode[1]));
						}
						
						$this->db->like('city_name', $attr, 'after');
						
						$query = $this->db->get('addr_cities');
						
						//echo $this->db->_error_message().$this->db->last_query(); # Debug assist
						
						
						$result = $query->result();
						
						$count = count($result);
						
						if($count==1){
							$attr = $result[0]->addr_city_id;
						}elseif($count>1){
							//$result[0]->city_name = "DOUBLEHERE: ".$result[0]->city_name;
							$attr = $result[0]->addr_city_id;
							#$attr = "FOUND: ".$count.' TO ('.$attr.')'.' - '.@$explode[1];
						}else{	
							$attr = false;
						}
					
					}				
					
					if( (!$attr OR $attr=='') AND $attr !== '0'){
						$attr = null;
					}
					
					$member_attr[$key] = $attr;
					
					
					$k++;
					
				}
				

				$members[] = $member_attr;
			}
			
			
			$i++;
			
		}
		
		foreach($members as $member){
		
			$item = (object)$member;
			
			unset($item->member_addr_state);
			
			print_r($item);
			
			#$this->db->insert('members', $item);
			
			echo $this->db->_error_message();
			
			echo " DONE \n\n";
			
		}
		
		
	
	}

	
}
