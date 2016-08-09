<?php

class Invoice_notification extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	 
		$this->load->model('Invoice');
	 
		$this->invoice_statuses = $this->Invoice->get_invoice_statuses();
	 
    }


	# Index #
	
    function index($invoice_id){

		# Security clauses goes here #
	
		# Joins #
	
		# Filters #

		
		$this->db->where('invoice_notification_invoice_id', $invoice_id);
		
		if($this->input->get('invoice_notification_id')){

			$this->db->where('invoice_notification_id', $this->input->get('invoice_notification_id'));

		}

		if($this->input->get('invoice_notification_invoice_id_min')){

			$this->db->where('invoice_notification_invoice_id >=', $this->input->get('invoice_notification_invoice_id_min'));

		}

		if($this->input->get('invoice_notification_invoice_id_max')){

			$this->db->where('invoice_notification_invoice_id <=', $this->input->get('invoice_notification_invoice_id_max'));
		}

		if($this->input->get('invoice_notification_type')){

			$this->db->like('invoice_notification_type', $this->input->get('invoice_notification_type'));

		}

		if($this->input->get('invoice_notification_read_min')>0){

			$this->db->where('invoice_notification_read >=', $this->input->get('invoice_notification_read_min'));

		}

		if($this->input->get('invoice_notification_read_max')>0){

			$this->db->where('invoice_notification_read <=', $this->input->get('invoice_notification_read_max'));

		}

		if($this->input->get('invoice_notification_read_ip')){

			$this->db->like('invoice_notification_read_ip', $this->input->get('invoice_notification_read_ip'));

		}

		#Orderby

		if($this->input->get('order_by')){

			$this->db->order_by($this->input->get('order_by'));

		}else{
		
			$this->db->order_by('invoice_notification_id desc');
		
		}

		#Limit & Offset
		
		//$this->db->limit(get_limit());

		$this->db->offset($this->input->get('offset'));

		#Performs query
		
		$query = $this->db->get('invoice_notifications');
		
		#Return
		
		# echo $this->db->_error_message().$this->db->last_query(); # Debug assist

		return $query->result();

    } 	


	# Create #

	function create($item, $invoice){

		$notification = $this->System_notification->notificate(
			$invoice->account_email, 
			$this->invoice_statuses[$invoice->invoice_status].'_notification', 
			$invoice
			);
			
		if($notification !== true){
		
			throw new Exception($notification);
		
		}

		$insert = $this->db->insert('invoice_notifications', $item);

		if($id = $this->db->insert_id()){

			return $id;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

	}


	# Update #

	function update($invoice_notification_id, $item){

		$this->db->where('invoice_notification_id', $invoice_notification_id);

		$this->db->update('invoice_notifications', $item);

		if($this->db->affected_rows()>0){

			return $item;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

	}


	# Get item #

	function get_item($invoice_notification_id){

		$query = $this->db->get_where('invoice_notifications', array('invoice_notification_id' => $invoice_notification_id), 1);

		if($query->num_rows()>0){

			$result = $query->row_object();

			return $result;	

		}

	}

	# Remove #

    function remove($invoice_notification_id){

		$this->db->where('invoice_notification_id', $invoice_notification_id);

		$this->db->delete('invoice_notifications'); 

		if($this->db->affected_rows()>0){

			return $invoice_notification_id;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

    }

}


/* End of file invoice_notification.php */
/* Location: ./application/models/invoice_notification.php */