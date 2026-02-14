<?php
class Gallery{

    private $conn;
    private $table_name = "nt_gallery";
	// object properties
   	public $dop;
	
	public $image=NULL;
   
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->dop=$this->dop;
		$this->image=$this->image;
    }
		
    // Insert Item
    public function insert(){
 
	   //write query
        $query = "INSERT INTO ".$this->table_name."(`id`, `pdate`, `image`, `nt_status`) VALUES ('0','".$this->dop."','','Yes')";
		$ok=$this->conn->inserted_id($query);	
		
        if($ok){
			$this->updateimg($ok);
            return true;
        }else{
            return false;
        }
    }
	
	public function updateimg($id){
		
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../images/galimg/".$filename);
				$query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
					
					return true;
				}else{
					return false;
				}  
		   }else{
			   return false;
		   }
		  
	   }else{
		   return true;
	   }
      
	   //write query
        
    }
	 public function update(){
      
       $this->edit_id=$this->conn->filterVar($this->edit_id);
      
	   //write query
        //$query = "update ".$this->table_name." set  where id='".$this->edit_id."'";
				
        if($this->updateimg($this->edit_id)){
			
            return true;
        }else{
            return false;
        }
    }
	
	
	
}
$objgallery= new Gallery($db);
?>