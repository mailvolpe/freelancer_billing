<?php

class Recurrency extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	 
    }


	# Index #
	
    function index(){

		# Security clauses goes here #
	
		# Joins #
		
		$this->db->join('accounts', 'accounts.account_id = recurrencies.recurrency_account_id');
	
		# Filters #

		if($this->input->get('recurrency_id')){

			$this->db->where('recurrency_id', $this->input->get('recurrency_id'));

		}

		if($this->input->get('recurrency_account_id_min')){

			$this->db->where('recurrency_account_id >=', $this->input->get('recurrency_account_id_min'));

		}

		if($this->input->get('recurrency_account_id_max')){

			$this->db->where('recurrency_account_id <=', $this->input->get('recurrency_account_id_max'));
		}

		if($this->input->get('recurrency_amount_min')){

			$this->db->where('recurrency_amount >=', $this->input->get('recurrency_amount_min'));

		}

		if($this->input->get('recurrency_amount_max')){

			$this->db->where('recurrency_amount <=', $this->input->get('recurrency_amount_max'));

		}

		if($this->input->get('recurrency_when_day_min')){

			$this->db->where('recurrency_when_day >=', $this->input->get('recurrency_when_day_min'));

		}

		if($this->input->get('recurrency_when_day_max')){

			$this->db->where('recurrency_when_day <=', $this->input->get('recurrency_when_day_max'));
		}

		if($this->input->get('recurrency_when_month_min')){

			$this->db->where('recurrency_when_month >=', $this->input->get('recurrency_when_month_min'));

		}

		if($this->input->get('recurrency_when_month_max')){

			$this->db->where('recurrency_when_month <=', $this->input->get('recurrency_when_month_max'));
		}

		if($this->input->get('recurrency_description')){

			$this->db->like('recurrency_description', $this->input->get('recurrency_description'));

		}

		if($this->input->get('recurrency_limit_min')){

			$this->db->where('recurrency_limit >=', $this->input->get('recurrency_limit_min'));

		}

		if($this->input->get('recurrency_limit_max')){

			$this->db->where('recurrency_limit <=', $this->input->get('recurrency_limit_max'));
		}

		if($this->input->get('recurrency_start') OR $this->input->get('recurrency_start')==='0'){

			$_GET['recurrency_start_display'] = display_bool_value($this->input->get('recurrency_start'));
		
			$this->db->where('recurrency_start', $this->input->get('recurrency_start'));

		}

		#Orderby

		if($this->input->get('order_by')){

			$this->db->order_by($this->input->get('order_by'));

		}else{
		
			$this->db->order_by('recurrency_id desc');
		
		}

		#Limit & Offset
		
		$this->db->limit(get_limit());

		$this->db->offset($this->input->get('offset'));

		#Performs query
		
		$query = $this->db->get('recurrencies');
		
		#Return
		
		# echo $this->db->_error_message().$this->db->last_query(); # Debug assist

		return $query->result();

    } 	


	# Create #

	function create($item){

		$insert = $this->db->insert('recurrencies', $item);

		if($id = $this->db->insert_id()){

			return $id;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

	}


	# Update #

	function update($recurrency_id, $item){

		$this->db->where('recurrency_id', $recurrency_id);

		$this->db->update('recurrencies', $item);

		if($this->db->affected_rows()>0){

			return $item;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

	}


	# Get item #

	function get_item($recurrency_id){

		$this->db->join('accounts', 'recurrencies.recurrency_account_id = accounts.account_id');
	
		$query = $this->db->get_where('recurrencies', array('recurrency_id' => $recurrency_id), 1);

		if($query->num_rows()>0){

			$result = $query->row_object();

			return $result;	

		}

	}

	# Remove #

    function remove($recurrency_id){

		$this->db->where('recurrency_id', $recurrency_id);

		$this->db->delete('recurrencies'); 

		if($this->db->affected_rows()>0){

			return $recurrency_id;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

    }

}


/* End of file recurrency.php */
/* Location: ./application/models/recurrency.php */