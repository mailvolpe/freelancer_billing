<?php

class Recurrency extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	 
    }
	
	function count_generated_invoices($recurrency_id){
	
		$this->db->select('count(*) as recurrency_generated_invoices');
	
		$this->db->where('invoice_recurrency_id', $recurrency_id);
	
		$query = $this->db->get('invoices');

		#echo $this->db->_error_message().$this->db->last_query(); # Debug assist
		
		if($query->num_rows()>0){

			$result = $query->row_object();

			return $result->recurrency_generated_invoices;	

		}
	
	}

	function todays_recurrencies(){

		$today_is_last_day_of_month = false; //STARTANDO COMO FALSO SE HOJE É O ÚLTIMO DIA DO MES
	
		$this_month = ltrim(date('m'),0);
		
		$this_day = ltrim(date('d'),0);
		
		$this_month_last_day = ltrim(date('t'),0);
	
		if( $this_day == $this_month_last_day ){
			
			$today_is_last_day_of_month = true;
			
		}
	
		$this->db->join('accounts', 'accounts.account_id = recurrencies.recurrency_account_id');
	
		$this->db->where('accounts.account_blocked_date', null);
	
		$this->db->where('recurrencies.recurrency_start', 1);
		
		//Ou é o último dia do mês e o dia da recorrencia é maior ou igual ao ultimo dia do mes.
		if($today_is_last_day_of_month){
		
			$this->db->where('recurrencies.recurrency_when_day >=', $this_month_last_day);
		
		}else{
			//ou o dia da recorrencia é igual ou menor (e não fatura gerou neste mes - veja abaixo) ao dia do mes
			$this->db->where('recurrencies.recurrency_when_day <=', $this_day);
		
		}
		
		//Ou o mes da recorrencia é nulo ou mes da recorrencia é igual ao mes
		$this->db->where(' (recurrencies.recurrency_when_month IS NULL OR recurrencies.recurrency_when_month = '.$this_month.')', null, false);
		
		//Gerou menos que o limite de faturas geradas pela recorrencias
		$this->db->where(' ( recurrency_limit=0 OR (SELECT count(*) FROM invoices WHERE invoice_recurrency_id = recurrencies.recurrency_id) < recurrencies.recurrency_limit )', null, false);		
		
		//E não que não tenha gerado nenhuma fatura este mês
		$this->db->where(' (SELECT count(*) FROM invoices WHERE invoice_recurrency_id = recurrencies.recurrency_id AND MONTH(invoice_created_date) = '.$this_month.') = 0', null, false);
		
		$query = $this->db->get('recurrencies');
		
		echo $this->db->_error_message().$this->db->last_query(); # Debug assist
		
		return $query->result();		
	
	}

	function generate_invoices(){
	
		$this->load->model('Invoice');
	
		# Obtem as recorrencias que estão ativas e que devem gerar recorrencia hoje.
		$active = $this->todays_recurrencies();
		
		$created_invoices = 0;
		
		foreach($active as $recurrency){
		
			$invoice = new stdClass;
			
			$invoice->invoice_account_id = $recurrency->recurrency_account_id;
			
			$invoice->invoice_amount = $recurrency->recurrency_amount;
			
			$invoice->invoice_description = $recurrency->recurrency_description;
			
			$invoice->invoice_due_date = date("Y-m-d", strtotime("+3 days", strtotime( db_now() ) )); 
			
			$invoice->invoice_recurrency_id = $recurrency->recurrency_id;
			
			$create = $this->Invoice->create( (array) $invoice );
		
			if($create){
			
				$this->Invoice->send_invoice_notification($create);
			
				$created_invoices++;
			}
		
		}
		
		return $created_invoices;
	
	}
	
	
	# Index #
	
    function index($recurrency_account_id=false){

		# Security clauses goes here #
	
		# Joins #
		
		$this->db->join('accounts', 'accounts.account_id = recurrencies.recurrency_account_id');
	
		# Filters #
		if($recurrency_account_id){
		
			$this->db->where('recurrency_account_id', $recurrency_account_id);
		
		}
		
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