<?php

class Account extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	 
    }
	
	function count_active_recurrencies($account_id){
	
		$this->db->select("count(*) as active_recurrencies");
		
		$this->db->where('recurrency_account_id', $account_id);
		
		$this->db->where('recurrency_start', 1);

		//Gerou menos que o limite de faturas geradas pela recorrencias
		$this->db->where(' ( recurrency_limit=0 OR (SELECT count(*) FROM invoices WHERE invoice_recurrency_id = recurrencies.recurrency_id) < recurrencies.recurrency_limit )', null, false);				
		
		$query = $this->db->get('recurrencies');
		
		if($query->num_rows()>0){

			$result = $query->row_object();

			return $result->active_recurrencies;	

		}		
	
	
	}
	
	function count_unpaid_invoices($account_id){
	
		$this->db->select("count(*) as unpaid_invoices");
		
		$this->db->where('invoice_account_id', $account_id);

		$this->db->where('invoice_paid_date', null);
		
		$query = $this->db->get('invoices');
		
		if($query->num_rows()>0){

			$result = $query->row_object();

			return $result->unpaid_invoices;	

		}			
	
	}
	
	/* 
	
		index_active_clients()
		
		Funçao para retornar todos os clientes ativos sem paginar. 
		Usada nos select boxes ao criar faturas e planos para definir o cliente.
		
		Dá para melhorar aqui se fizermos um <select> com busca em ajax nas views (onde tem seleção de cliente)
		e que dispara só quando o usuário tiver digitado 3 chars.

	*/
	function index_active_clients(){
	
		$this->db->where('accounts.account_blocked_date', null);
		
		$this->db->where('accounts.account_is_admin', 0);
		
		$this->db->order_by('account_title');
		#Performs query
		
		$query = $this->db->get('accounts');
		
		#Return
		
		# echo $this->db->_error_message().$this->db->last_query(); # Debug assist

		return $query->result();
		
	
	}
	
	function get_account_data($account){
	
		$data = new stdClass;
		
		$data->account_role = $this->lang->line('account_is_regular');
	
		$data->photo_path = "assets/img/no-user.jpg";
	
		if($account->account_is_admin){
			
			$data->photo_path = "assets/img/admin.png";
			
			$data->account_role = $this->lang->line('account_is_admin');
			
		}else{
			
			$data->photo_path = "assets/img/client.png";
			
			$data->account_role = $this->lang->line('account_is_client');
			
		}
		
		if(!$data->photo_path){
		
			$data->photo_path = "assets/img/no-user.jpg";
			
		}
		
		
		return $data;
		
	}	

	function block($account_id, $account_blocked_date){

		if($account_blocked_date){
			$this->db->set('account_blocked_date', null);
		}else{
			$this->db->set('account_blocked_date', 'NOW()', false);
		}
		
		$this->db->set('account_updated_date', 'NOW()', false);
	
		$this->db->where('account_id', $account_id);

		$this->db->update('accounts');
		
		if($this->db->affected_rows()>0){

			return true;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}
	
	}

	# Index #
	
    function index(){

		# Security clauses goes here #
		if(!$this->System_log->is_admin()){
			$this->db->where('accounts.account_id !=', $this->System_log->logged->account_id);
		}
		
		
		
		# Joins #
		
	
		# Filters #
		
		if($this->input->get('account_id_min')){

			$this->db->where('account_id >=', $this->input->get('account_id_min'));

		}

		if($this->input->get('account_id_max')){

			$this->db->where('account_id <=', $this->input->get('account_id_max'));
		}
		
		if($this->input->get('account_title')){

			$this->db->like('account_title', $this->input->get('account_title'));

		}		

		if($this->input->get('account_username')){

			$this->db->like('account_username', $this->input->get('account_username'));

		}

		if($this->input->get('account_password')){

			$this->db->like('account_password', $this->input->get('account_password'));

		}

		if($this->input->get('account_email')){

			$this->db->like('account_email', $this->input->get('account_email'));

		}

		if($this->input->get('account_must_change_pass')){

			$this->db->where('account_must_change_pass', $this->input->get('account_must_change_pass'));

		}

		if($this->input->get('account_last_access_date_min')>0){

			$this->db->where('account_last_access_date >=', $this->input->get('account_last_access_date_min'));

		}

		if($this->input->get('account_last_access_date_max')>0){

			$this->db->where('account_last_access_date <=', $this->input->get('account_last_access_date_max'));

		}

		if($this->input->get('account_last_access_ip')){

			$this->db->like('account_last_access_ip', $this->input->get('account_last_access_ip'));

		}

		if($this->input->get('account_blocked_date_min')>0){

			$this->db->where('account_blocked_date >=', $this->input->get('account_blocked_date_min'));

		}

		if($this->input->get('account_blocked_date_max')>0){

			$this->db->where('account_blocked_date <=', $this->input->get('account_blocked_date_max'));

		}

		if($this->input->get('account_created_date_min')>0){

			$this->db->where('account_created_date >=', $this->input->get('account_created_date_min'));

		}

		if($this->input->get('account_created_date_max')>0){

			$this->db->where('account_created_date <=', $this->input->get('account_created_date_max'));

		}

		if($this->input->get('account_updated_date_min')>0){

			$this->db->where('account_updated_date >=', $this->input->get('account_updated_date_min'));

		}

		if($this->input->get('account_updated_date_max')>0){

			$this->db->where('account_updated_date <=', $this->input->get('account_updated_date_max'));

		}

		#Orderby

		if($this->input->get('order_by')){

			$this->db->order_by($this->input->get('order_by'));

		}else{
		
			$this->db->order_by('account_updated_date desc');
		
		}


		
		if(!$this->System_log->logged->account_is_admin){
			
			$this->db->where('account_is_admin', 0);
			
		}
		
		#Limit & Offset
		
		$this->db->limit(get_limit());

		$this->db->offset($this->input->get('offset'));

		#Performs query
		
		$query = $this->db->get('accounts');
		
		#Return
		
		# echo $this->db->_error_message().$this->db->last_query(); # Debug assist

		return $query->result();

    } 	

	function mysql_crypt_password($password){
	
		$query = $this->db->query("SELECT PASSWORD('".$password."') AS password");
		
		$result = $query->result();
		
		return $result[0]->password;		

	}

	# Create #

	function create($item){
	
		$item['account_password'] = $this->mysql_crypt_password($item['account_password']);
		
		$item['account_created_date'] = db_now();
		
		$item['account_updated_date'] = db_now();
	
		$insert = $this->db->insert('accounts', $item);

		if($id = $this->db->insert_id()){

			return $id;

		}else if($this->db->_error_message()){

			$exception_string = strstr($this->db->_error_message(), 'client_user_email')?$this->lang->line('client_user_email_exception'):$this->db->_error_message();
		
			throw new Exception($exception_string);

		}

	}

	function update_password($account_id, $item){
	
		$item['account_password'] = $this->mysql_crypt_password($item['account_password']);
	
		$this->db->set('account_updated_date', 'NOW()', false);
		
		$this->db->set('account_must_change_pass', '0');
	
		$this->db->where('account_id', $account_id);

		$this->db->update('accounts', $item);

		if($this->db->affected_rows()>0){

			return $item;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

	}	

	# Update #

	function update($account_id, $item){
	
		$this->db->set('account_updated_date', 'NOW()', false);
	
		$this->db->where('account_id', $account_id);

		$this->db->update('accounts', $item);

		if($this->db->affected_rows()>0){

			return $item;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

	}


	# Get item #

	function get_item($account_id){
	
		$query = $this->db->get_where('accounts', array('account_id' => $account_id), 1);

		# echo $this->db->_error_message().$this->db->last_query(); # Debug assist
		
		if($query->num_rows()>0){

			$result = $query->row_object();

			return $result;	

		}

	}

	# Remove #

    function remove($account_id){

		$this->db->where('account_id', $account_id);

		$this->db->delete('accounts'); 

		if($this->db->affected_rows()>0){

			return $account_id;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

    }

}


/* End of file account.php */
/* Location: ./application/models/account.php */