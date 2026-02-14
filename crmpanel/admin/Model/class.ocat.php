<?php
class OCAT{
    private $conn;
    private $table_name = "nt_othercategory";
 
    // object properties
   
    public $cat;
	public $urlname;
	public $ptitle;
    public $description;
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->cat=$this->conn->filterVar($this->cat);
		$this->urlname=$this->conn->filterVar($this->urlname);
		$this->ptitle=$this->conn->filterVar($this->ptitle);
		
        $this->description=$this->conn->filterVar($this->description);
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cat='".$this->cat."'  and nt_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cat='".$this->cat."' and id<>'".$this->edit_id."' and nt_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function catname($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and nt_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat'];
	}
	public function catlist($id='')
	{
		$str='<option value="">--Select--</option>';
		$query="select * from ".$this->table_name." where nt_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['cat'].'</option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['cat'].'</option>';
			}
		}
		
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   //write query
        $query = "INSERT INTO ".$this->table_name."(`id`, `cat`,`url_name`,`ptitle`, `description`, `nt_status`) VALUES ('0', '".$this->cat."','".$this->urlname."','".$this->ptitle."','".$this->description."','Yes')";
				
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }
	 public function update(){
      
       $this->edit_id=$this->conn->filterVar($this->edit_id);
      
	   //write query
        $query = "update ".$this->table_name." set `cat`='".$this->cat."',`url_name`='".$this->urlname."',`ptitle`='".$this->ptitle."', `description`='".$this->description."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }
	
	
	
}
$objocat= new OCAT($db);
?>