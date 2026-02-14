<?php
class AUTHORITY{

    private $conn;
    private $table_name = "mi_module_assign";
 
    // object properties
    public $reseller_id;
    public $cmp_id;
	public $module;
	public $feature;
	public $rdate;
	
	public $image=NULL;
    
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->cmp_id=$this->cmp_id;
		$this->reseller_id=$this->reseller_id;
		$this->module=$this->module;
		$this->feature=$this->feature;
		
        $this->edit_id=$this->edit_id;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where reseller_id='".$this->reseller_id."' and cmp_id='".$this->cmp_id."' and module_id='".$this->module."' and feature_id='".$this->feature."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where  reseller_id='".$this->reseller_id."' and cmp_id='".$this->cmp_id."' and module_id='".$this->module."' and feature_id='".$this->feature."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	
    // Insert Item
    public function insert(){
 
	   //write query
	   $q=$this->conn->exeQuery("select * from mi_module_assign where cmp_id='".$this->cmp_id."' and mi_status='Yes'"); 
	   if($q->num_rows)
	   {
		    $query = "update ".$this->table_name." set `module_id`='".$this->module."',`feature_id`='".$this->feature."',`auth_status`='Yes' where cmp_id='".$this->cmp_id."'";
			
			$ok=$this->conn->exeQuery($query);
			if($ok){
				return true;
			}else{
				return false;
			}
			//return true;
	   }else{
		   $query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `reseller_id`, `cmp_id`, `module_id`, `feature_id`, `auth_status`, `mi_status`) VALUES ('0', '".$this->rdate."','".$this->reseller_id."','".$this->cmp_id."','".$this->module."','".$this->feature."','Yes','Yes')";
			$ok=$this->conn->inserted_id($query);		
			if($ok){
				return true;
			}else{
				return false;
			}
	   }
        
    }
	 public function updateimg($id){
       if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   $imagename=$this->cmp_id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../../crm/images/cmp_img/".$filename);
		   $query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
			if($this->conn->exeQuery($query)){
				return true;
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
        $query = "update ".$this->table_name." set `reseller_id`='".$this->reseller_id."',`cmp_id`='".$this->cmp_id."',`module_id`='".$this->module."',`feature_id`='".$this->feature."',`auth_status`='Yes' where cmp_id='".$this->cmp_id."'";
				
        if($this->conn->exeQuery($query)){
			//$this->updateimg($this->edit_id);
            return true;
        }else{
            return false;
        }
    }
}
$objmodauth= new AUTHORITY($db);
?>