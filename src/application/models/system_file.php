<?
class System_file extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
		$this->base_folder = "images";
        
    }
    	
	public function update($file_id){
	
		$file = new stdClass;
		
		foreach($this->input->post() as $key=>$value){
		
			if(!$value AND $value !== '0'){$value = null;}
			$file->$key = $value;
		
		}		
	
		unset($file->return_url);
		
		$this->db->where('file_id', $file_id);
		
		if($this->db->update('files', $file)){
		
			return true;
		
		}
	
	}


	#Set Path
	private function setPath($file){
	
		$path = $this->base_folder.'/';
		
		if($file->file_path){
			$path .= $file->file_path.'/';
		}

		$path .= $file->file_name;
			
		return $path;
	
	}
	
	#Get file - Gets First
	public function getFiles($file_zone='', $fk_id='', $first_path_only=false){
		
		$return_array = array();
		
		$files = $this->indexZone($file_zone, $fk_id);
		
		foreach ($files as $key=>$file){
		
			$return_file = new stdClass;

			$return_file->path = $this->setPath($file);
			
			$return_file->title = $file->file_title;
			
			$return_file->description = $file->file_description;			

			$return_array[] = $return_file;
			
			if($first_path_only){
			
				return $return_file->path;
				
			}
			
		}
			
		if($first_path_only){
		
			return false;
			
		}
			
		return $return_array;
		
	}	
	
	#Get file - Gets First
	public function getFirstFile($file_zone='', $fk_id=''){
		
		$return_file = new stdClass;
		
		$array = $this->indexZone($file_zone, $fk_id, 1);
		
		if(isset($array[0]) AND $file = $array[0]){
		
			$return_file->path = $this->setPath($file);
			
			$return_file->title = $file->file_title;
			
			$return_file->description = $file->file_description;			
		
		}
		
		return $return_file;
		
	}
	
	#Index zone
    function indexZone($file_zone='', $fk_id='', $limit=false)
    {
	
		#Security clauses goes here

		$this->db->where('file_zone', $file_zone);

		$this->db->where('file_zone_fk_id', $fk_id);

		#Orderby

		$this->db->order_by('file_index_order, file_index_date, file_index_time, file_id desc');

		if($limit){
			$this->db->limit($limit);
		}
		
		#Performs query
		
		$query = $this->db->get('files');
		
		#Return
		//echo $this->db->last_query();
		#echo mysql_error();
		return $query->result();
		
    }
	
	
	
	
	#############################################################
	
	function uploadFiles($file_zone, $fk_id, $limit = 1){

		#$client = $this->Client->getClient();
	
		$client = new stdClass;
	
		#$client->client_domain = 'flordamata';
	
		$used = count($this->indexZone($file_zone, $fk_id));
		
		$avaliable = $limit - $used;
		
		
		#UPPER FOLDER - DOMAIN FOLDER

		#$upper_folder = slugify($client->client_domain);
		
		if(!is_dir($this->base_folder)){

			mkdir($this->base_folder);

		}		
		
		#FOLDER - ZONE FOLDER
		
		$folder = $file_zone;

		# Creates folder if it doesn't exist.

		if(!is_dir($this->base_folder.'/'.$folder)){

			mkdir($this->base_folder.'/'.$folder);

		}
		
		$movedFiles = false;
		
		#Error 4 is when no upload was made.
		
		if(!isset($_FILES[$file_zone]) OR $_FILES[$file_zone]["error"][0]=='4'){
		
			return false;
			
		}
		
		for ($i = 0; $i < count($_FILES["$file_zone"]['name']); $i++) 
		{	
			
			//SKIP IF MAX
			
			if($i>=$avaliable){continue;}
			
			
			// PREPARAÇÃO DAS VARIÁVEIS
			
			$size = $_FILES[$file_zone]['size'][$i];
			
			$original = $_FILES["$file_zone"]['tmp_name'][$i];
			
			$local_target = "temp/" . $_FILES[$file_zone]['name'][$i];
			
			$name = explode(".", $_FILES[$file_zone]['name'][$i]);
			
			$filename = array_reverse($name);
			
			
			//DIMINUI CASE DA EXTENSÃO
			
			$extension = strtolower($filename[0]);
			
			
			#ORIGINAL FILENAME
			
			$original_filename = slugify($filename[1]).'.'.$extension;
			
			$converted_filename = $this->convertFilename($this->base_folder.'/'.$folder, $original_filename, $extension);
			
			$server_target = $this->base_folder.'/'.$folder.'/'.$converted_filename;
			

			//VERIFICA SE EXTENSAO É PERMITIDA
			
			$not_extensions = array('exe', 'bat', 'com', 'php', 'cgi', 'pl');
			
			if(in_array($extension, $not_extensions)){continue;} #TIRA EXTENSÕES NEGATIVAS
			
			
			//VERIFICA SE TAMANHO MÁXIMO DO SISTEMA É PERMITID0 # Não tem mais essa regra
			//if($size > ((1*1024)*1024)*5){continue;} #MAX:5MB
			
			
			if(move_uploaded_file($original, $server_target))
			{
								
				#INSERT RECORD DB
				
				$filename = $server_target;
				
				$file = new stdClass;
				
				$file->file_path = $folder;
				$file->file_name = $converted_filename;
				$file->file_zone = $file_zone;
				$file->file_zone_fk_id = $fk_id;
				$file->file_size = $size;
				$file->file_title = "";
				$file->file_description = "";
				$file->file_index_date = db_now();
				$file->file_index_time = db_now();
				$file->file_index_order = NULL;
				$file->file_upload_date = db_now();
				
				$this->db->insert('files', $file);
				
				$movedFiles[] = $this->db->insert_id();
				
			}
			
		}
	
		return $movedFiles;
						
	}
	
	#GET ITEM
	function getFile($file_id){
		
		$this->db->where('file_id', $file_id);

		$this->db->limit(1);
				
		$query = $this->db->get('files');
		
		#Return
		return $query->row();
	
	}	
	
	
	#DELETE
    function deleteFile($file_id)
    {
	
		$file = $this->getFile($file_id);
		
		$filename = $this->base_folder.'/'.$file->file_path.'/'.$file->file_name;
	
		if(!unlink($filename)){
		
			return false;
		
		}
		
		#TIRA DA TABELA

		$this->db->where('file_id', $file_id);

		$this->db->limit(1);
				
		$query = $this->db->delete('files');		
		
		return true;					
		
    }      
	
	#DELETE ZONE

	function deleteZone($file_zone, $fk_id){
	
		#Itera arquivos da zona chamando remove() em cada 1
		
		$zone = $this->indexZone($file_zone, $fk_id);
			
		foreach($zone as $file){
		
			$this->deleteFile($file->file_id);
			
		}
		
	}
		

	function convertFilename($folder, $filename, $extension, $last=0){

		$next = $last+1;
	
		if(is_file($folder.'/'.$filename)){

			if($last>0){
			
				$name = str_replace('_'.$last.'.'.$extension, '_'.$next.'.'.$extension, $filename);
				
			}else{
			
				$name = str_replace('.'.$extension, '_'.$next.'.'.$extension, $filename);
				
			}
			
			$filename = $name;

		}else{

			return $filename;

		}

		return $this->convertFilename($folder, $filename, $extension, $next);

	}

}


/* End of file midia.php */
/* Location: ./application/models/midia.php */