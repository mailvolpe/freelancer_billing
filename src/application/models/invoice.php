<?php

class Invoice extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	 
    }


	# Index #
	
    function index(){

		# Security clauses goes here #
	
		# Joins #
		
		$this->db->join('accounts', 'accounts.account_id = invoices.invoice_account_id');
	
		# Filters #

		if($this->input->get('invoice_id')){

			$this->db->where('invoice_id', $this->input->get('invoice_id'));

		}

		if($this->input->get('invoice_account_id_min')){

			$this->db->where('invoice_account_id >=', $this->input->get('invoice_account_id_min'));

		}

		if($this->input->get('invoice_account_id_max')){

			$this->db->where('invoice_account_id <=', $this->input->get('invoice_account_id_max'));
		}

		if($this->input->get('invoice_amount_min')){

			$this->db->where('invoice_amount >=', $this->input->get('invoice_amount_min'));

		}

		if($this->input->get('invoice_amount_max')){

			$this->db->where('invoice_amount <=', $this->input->get('invoice_amount_max'));

		}

		if($this->input->get('invoice_description')){

			$this->db->like('invoice_description', $this->input->get('invoice_description'));

		}

		if($this->input->get('invoice_created_date_min')>0){

			$this->db->where('invoice_created_date >=', $this->input->get('invoice_created_date_min'));

		}

		if($this->input->get('invoice_created_date_max')>0){

			$this->db->where('invoice_created_date <=', $this->input->get('invoice_created_date_max'));

		}

		if($this->input->get('invoice_due_date_min')>0){

			$this->db->where('invoice_due_date >=', $this->input->get('invoice_due_date_min'));

		}

		if($this->input->get('invoice_due_date_max')>0){

			$this->db->where('invoice_due_date <=', $this->input->get('invoice_due_date_max'));

		}

		if($this->input->get('invoice_paid_date_min')>0){

			$this->db->where('invoice_paid_date >=', $this->input->get('invoice_paid_date_min'));

		}

		if($this->input->get('invoice_paid_date_max')>0){

			$this->db->where('invoice_paid_date <=', $this->input->get('invoice_paid_date_max'));

		}

		#Orderby

		if($this->input->get('order_by')){

			$this->db->order_by($this->input->get('order_by'));

		}else{
		
			$this->db->order_by('invoice_id desc');
		
		}

		#Limit & Offset
		
		$this->db->limit(get_limit());

		$this->db->offset($this->input->get('offset'));

		#Performs query
		
		$query = $this->db->get('invoices');
		
		#Return
		
		# echo $this->db->_error_message().$this->db->last_query(); # Debug assist

		return $query->result();

    } 	


	# Create #

	function create($item){

		$item['invoice_created_date'] = db_now();
	
		$insert = $this->db->insert('invoices', $item);

		if($id = $this->db->insert_id()){

			return $id;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

	}


	# Update #

	function update($invoice_id, $item){

		$this->db->where('invoice_id', $invoice_id);

		$this->db->update('invoices', $item);

		if($this->db->affected_rows()>0){

			return $item;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

	}


	# Get item #

	function get_item($invoice_id){
	
		$this->db->join('accounts', 'accounts.account_id = invoices.invoice_account_id');

		$query = $this->db->get_where('invoices', array('invoice_id' => $invoice_id), 1);

		if($query->num_rows()>0){

			$result = $query->row_object();

			return $result;	

		}

	}

	# Remove #

    function remove($invoice_id){

		$this->db->where('invoice_id', $invoice_id);

		$this->db->delete('invoices'); 

		if($this->db->affected_rows()>0){

			return $invoice_id;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

    }

}


/* End of file invoice.php */
/* Location: ./application/models/invoice.php */