<?php
class UOM{

    private $conn;
    private $table_name = "am_uom";
 
    // object properties
   
    public $uom;
    public $uname;
       public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->uom=$this->conn->filterVar($this->uom);
        $this->uname=$this->conn->filterVar($this->uname);
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where uom='".$this->uom."'  and am_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where uom='".$this->uom."' and id<>'".$this->edit_id."' and am_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function uomname($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and am_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['uom'];
	}
	public function uomlist($id='')
	{
		$str='<option value="">--Select--</option>';
		$query="select * from ".$this->table_name." where am_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['uom'].'</option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['uom'].'</option>';
			}
		}
		
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   //write query
        $query = "INSERT INTO ".$this->table_name."(`id`, `uom`, `uname`, `am_status`) VALUES ('0', '".$this->uom."','".$this->uname."','Yes')";
				
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }
	 public function update(){
      
       $this->edit_id=$this->conn->filterVar($this->edit_id);
      
	   //write query
        $query = "update ".$this->table_name." set `uom`='".$this->uom."', `uname`='".$this->uname."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }
	
	
	
}
$objuom= new UOM($db);
?>