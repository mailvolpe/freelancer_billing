<?/*
PARA USAR:
Preparando---------------OK
0. Model File() no autoloader

Adicionando FILEZONES aos forms de criação e edição.
1. Prepare os forms---------SCAFFOLDED
enctype="multipart/form-data"

2. Chamadas no form-------------------------
file_zone_field('client_logo', $client->client_id, 1)

Adicionando FILEZONES aos Models -------------------------
1. Create-------------------------
$pk_id = mysql_insert_id();
$this->File->uploadFiles('conteudo', $pk_id, $limit);

2. Update-------------------------
$this->File->uploadFiles('conteudo', $conteudo_id, [$parent_table_id]);

3. Delete-------------------------
$this->File->deleteFileZone('conteudo', $conteudo_id);

*/

$base_folder = "images";

$icons_folder = "assets/apaxy";

$create = false;

$files = $this->System_file->indexZone($file_zone_name, $pk_id, $limit);


if(!$pk_id){

    $sm = "12";
    
}else{

	$sm = "9";

}

?>

<a name="<?=$file_zone_name?>"></a>

<?if($limit > count($files)){?>

    <!-- UPLOAD -->
    <div class="row">

        <div class="col-sm-<?=$sm?>">
        
            <input class="form-control <?=$add_class?>" type="file" name="<?=$file_zone_name?>[]" value="" multiple=true>
            
        </div>
    
        <?if($pk_id){?>
    
            <div class="col-sm-3">
            
                <input type="submit" class="btn-block btn btn-default" value="Enviar">

            </div>
        
        <?}?>
    
    </div>  
    
<?}?>                   

<?if($files){?>

    <!-- LISTA -->
    <p></p>

    <table class="table table-hover">

        <tbody>
			
			<? foreach($files as $row){

				$file_name = explode(".", $row->file_name);

				$ext = $file_name[1];
				
				$dimensions = false;

				$filepath = $base_folder."/".$row->file_path."/".$row->file_name;
				
				if(!is_file($filepath)){
					continue;
				}
				
				//Sets Image or Icon
				if(in_array(strtolower($ext), array("png", "jpg", "bmp", "gif", "jpeg", "ico"))){

					if($img = getimagesize ($filepath)){

						$dimensions = $img[0]."px &times; ".$img[1]."px";

						if($img[0] < 80){
							$min_width = $img[0];
						}else{
							$min_width = 80;
						}

					}

				}else{

					if(is_file($icons_folder.'/'.$ext.'.png')){

						$ext_icon = $ext.'.png';

					}else{

						$ext_icon = 'unknown.png';

					}
				}  

			?>
				<tr role="row">
					
					<td style="vertical-align:middle; text-align:center;" width="1%" nowrap>

						<?if($dimensions){?>
						
							<a href="<?=$filepath?>" target="_new"><img style="min-width:<?=$min_width?>px; max-height:80px; max-width:200px;" src="<?=$filepath?>"></a>
						
						<?}else{?>
						
							<a href="<?=$filepath?>" target="_new"><img src="<?=$icons_folder.'/'.$ext_icon?>" alt="" class=""></a>
						
						<?}?>

					</td>
				  
					<td style="vertical-align:middle;">

						<?=$row->file_name;?>
					
						<div><strong><?=$row->file_title;?></strong></div>

						<?if($row->file_title){?><div><?=$row->file_description?></div><?}?>

					</td>			  

					<td style="vertical-align:middle; display:none;">

						<?if($row->file_index_order != null){?>
							<div>Ordem: <?=$row->file_index_order;?></div>
						<?}?>

						<div><?=human_date($row->file_index_date).' '.human_time($row->file_index_time)?></div>
						
						
					</td>
					
					<td style="vertical-align:middle;" nowrap>

						<strong><?=byte_format($row->file_size, 1, 'Kb');?></strong>

						<?if($dimensions){?><div><?=$dimensions?></div><?}?>

					</td>

					<td style="vertical-align:middle; text-align:center;" width="1%" nowrap>
					
						<!--<a href="system_files/update/<?=$row->file_id?>" class="btn btn-default">Editar</a>  -->
						
						<a href="system_files/delete/<?=$row->file_id?>" class="btn btn-danger">Excluir</a>                
					</td>
					
				</tr>
				
			<?}?>
            
        </tbody>
		
    </table>
	
<?}?>