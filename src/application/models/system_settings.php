<?
class System_settings extends CI_Model {
		
		
    function __construct()
    {
	
        // Call the Model constructor

        parent::__construct();
		
		$this->load->helper('file');
		
		$this->filepath = 'settings.json';
		
		$this->settings = $this->get_settings();	
	
    }

	function get_settings(){
	
		$string = read_file($this->filepath);
	
		$settings = (object) unserialize($string);
		
		return $settings;
	
	}
	
	
	function update($item){
	
		$data = serialize($item);

		if ( ! write_file($this->filepath, $data))
		{
			 throw new Exception($this->lang->line('operation_fail'));
		}
		else
		{
			 return true;
		}
	
	}
	
}


/* End of file System_settings.php */
/* Location: ./application/models/System_settings.php */