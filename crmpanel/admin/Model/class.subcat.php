<?php
class SUBCAT{
    private $conn;
    private $table_name = "nt_subcategory";
 
    // object properties
   
    public $cat;
	public $subcat;
	public $urlname;
	public $ptitle;
    public $description;
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->cat=$this->conn->filterVar($this->cat);
		$this->subcat=$this->conn->filterVar($this->subcat);
		$this->urlname=$this->conn->filterVar($this->urlname);
		$this->ptitle=$this->conn->filterVar($this->ptitle);
        $this->description=$this->conn->filterVar($this->description);
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cat='".$this->cat."' and subcat='".$this->subcat."'  and nt_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cat='".$this->cat."' and subcat='".$this->subcat."' and id<>'".$this->edit_id."' and nt_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function subcatname($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and nt_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['subcat'];
	}
	public function subcaturl($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and nt_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['url_name'];
	}
	public function subcatlist($id='')
	{
		$str='<option value="">--Select--</option>';
		$query="select * from ".$this->table_name." where nt_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['subcat'].'</option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['subcat'].'</option>';
			}
		}
		
		return $str;
	}
	public function findsubcatlist($id)
	{
		$str="<option value=''>--Select--</option>";
		$query="select * from ".$this->table_name." where cat='".$id."' and nt_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.="<option value='".$row['id']."' selected>".$row['subcat']."</option>";
			}else{
				$str.="<option value='".$row['id']."'>".$row['subcat']."</option>";
			}
		}
		
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   //write query
        $query = "INSERT INTO ".$this->table_name."(`id`, `cat`,`subcat`,`url_name`,`ptitle`, `description`, `nt_status`) VALUES ('0', '".$this->cat."','".$this->subcat."','".$this->urlname."','".$this->ptitle."','".$this->description."','Yes')";
				
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }
	 public function update(){
      
       $this->edit_id=$this->conn->filterVar($this->edit_id);
      
	   //write query
        $query = "update ".$this->table_name." set `cat`='".$this->cat."',`subcat`='".$this->subcat."',`url_name`='".$this->urlname."',`ptitle`='".$this->ptitle."', `description`='".$this->description."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }
	
	
	
}
$objscat= new SUBCAT($db);
?>