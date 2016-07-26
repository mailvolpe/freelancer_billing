<?php 

class Gateway {


	
	function __construct(){
		
		$this->load_folders(array("application/libraries/gateway/lib", "application/libraries/gateway/"));
	
	}
	
	function load_folders($array){
	
		if($array){
			foreach($array as $folder){
				foreach (glob($folder."/*.php") as $filename)
				{
					include $filename;
				}					
			}
		}
	
	}

}