<?php
class ADMFORM{

    private $conn;
    private $table_name = "mi_admform";
	//private $table_auth_name = "mi_sys_user";
 
    // object properties
   
    public $title;
	public $image=NULL;
    public $description;
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->title=$this->title;
		$this->edit_id=$this->edit_id;
		
		$this->image=$this->image;
        $this->description=$this->description;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			$pq=$this->conn->num_rows("select * from ".$this->table_name." where title='".$this->title."' and mi_status='Yes'");
			
			if($pq)
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where title='".$this->title."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
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

        $query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `title`, `description`, `image`, `mi_status`) VALUES ('0','".date("Y-m-d H:i:s")."', '".$this->title."','".$this->description."','','Yes')";
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
		   $imagename=$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../../school/images/adm_img/".$filename);
		   $query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
	   }else{
		   return true;
	   }
    }
	 public function update(){
        //write query
        $query = "update ".$this->table_name." set `title`='".$this->title."',`description`='".$this->description."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
			$this->updateimg($this->edit_id);
            return true;
        }else{
            return false;
        }
    }
}
$objtc= new ADMFORM($db);
?>