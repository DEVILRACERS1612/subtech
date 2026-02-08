<?php
class CAT{
    private $conn;
    private $table_name = "am_category";
 
    // object properties
   
    public $cat;
	public $urlname;
	public $pagetitle;
	public $pagecontent;
    public $description;
	public $ptitle;
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->cat=$this->conn->filterVar($this->cat);
		$this->pagetitle=$this->conn->filterVar($this->pagetitle);
		$this->pagecontent=$this->conn->filterVar($this->pagecontent);
		$this->urlname=$this->conn->filterVar($this->urlname);
        $this->ptitle=$this->conn->filterVar($this->ptitle);
		$this->description=$this->conn->filterVar($this->description);
		
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cat='".$this->cat."'  and am_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cat='".$this->cat."' and id<>'".$this->edit_id."' and am_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function catname($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and am_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat'];
	}
	public function caturl($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and am_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['url_name'];
	}
	public function catlist($id='')
	{
		$str='<option value="">--Select--</option>';
		$query="select * from ".$this->table_name." where am_status='Yes'";
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
        $query = "INSERT INTO ".$this->table_name."(`id`, `cat`,`url_name`,`pagetitle`,`pcontent`,`ptitle`, `description`, `am_status`) VALUES ('0', '".$this->cat."','".$this->urlname."','".$this->pagetitle."','".$this->pagecontent."','".$this->ptitle."','".$this->description."','Yes')";
				
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }
	 public function update(){
      
       $this->edit_id=$this->conn->filterVar($this->edit_id);
      
	   //write query
        $query = "update ".$this->table_name." set `cat`='".$this->cat."',`url_name`='".$this->urlname."',`pagetitle`='".$this->pagetitle."',`pagecontent`='".$this->pagecontent."',`ptitle`='".$this->ptitle."', `description`='".$this->description."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }
	
	
	
}
$objcat= new CAT($db);
?>