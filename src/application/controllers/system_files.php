<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_files extends CI_Controller {
	 
	
	private function validate(){
	
		$this->form_validation->set_rules(array(
		   array(
				 'field'   => 'file_title', 
				 'label'   => 'Título',
				 'rules'   => ''
			  ),
		   array(
				 'field'   => 'file_description', 
				 'label'   => 'Descriçao',
				 'rules'   => ''
			  ),
		   array(
				 'field'   => 'file_index_date', 
				 'label'   => 'Data de indexação',
				 'rules'   => ''
			  ),   
		   array(
				 'field'   => 'file_index_time', 
				 'label'   => 'Hora de indexação', 
				 'rules'   => ''
			  ),
			array(
				'field' => 'file_index_order',
				'label'   => 'Ordem', 
				'rules'   => ''
			),
			array(
				'field' => 'return_url',
				'label'   => 'return_url', 
				'rules'   => ''
			)
		));		
		
		
		return $this->form_validation->run();
		
	}
	
	
	public function update($file_id){

		if($this->input->post() AND $this->validate()){
								
			if($this->System_file->update($file_id)){
			
				$this->session->set_flashdata(array(

					'message'=>$this->lang->line('file_updated'),
					'message_class'=>"success"

				));									
			
				redirect($this->input->post('return_url'), 'location');
			
			}
		
		}
		
		 
			
		
		if(!$file = $this->System_file->getfile($file_id)){
		
			return false;
		
		}
		
		$this->load->vars(array("file" => $file));

		
				
		$this->load->vars(array("page" => "system_files/update"));
		
		$this->load->view('template/template');
		
	}
	
	
	public function delete($file_id){
	
		if($this->input->post('delete_confirm')=="true"){
				
			if($this->System_file->deleteFile($file_id)){
			
				$this->session->set_flashdata(array(

					'message'=>$this->lang->line('file_removed')

				));			
			
				redirect($this->input->post('return_url'), 'location');
			
			}
		
		}

		if(!$file = $this->System_file->getFile($file_id)){
		
			return false;
		
		}
		
		$this->load->vars(array("file" => $file));

		$this->load->vars(array("page" => "system_files/delete"));
		
		$this->load->view('template/template');
			
	
	}

	
	function __construct(){

		// Call the Model constructor

		parent::__construct();
		


	}
	

	 	
}
