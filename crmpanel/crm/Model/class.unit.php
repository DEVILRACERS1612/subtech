<?php
class ADDUNIT{
    private $conn;
    private $table_name = "mi_unit";
 
    // object properties
   
    public $rdate;
	public $cl_code;
	public $unit_name;
	public $description;
	
    public $edit_id;
    public $del_id;
    public $permission;
    
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->conn->filterVar($this->rdate);
		$this->unit_name=$this->conn->filterVar($this->unit_name);
		$this->cl_code=$this->conn->filterVar($this->cl_code);
        $this->description=$this->conn->filterVar($this->description);
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (cl_code='".$this->cl_code."' or unit_name='".$this->unit_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (cl_code='".$this->cl_code."' or unit_name='".$this->unit_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function unit_name($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['unit_name'];
	}
	
	public function unit_list($id='')
	{
		$str='<option value="">--Select--</option>';
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['unit_name'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['unit_name'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`, `user_id`,  `unit_name`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->unit_name."','".$this->description."','Yes')";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
    }
	public function update(){
      
       $this->edit_id=$this->conn->filterVar($this->edit_id);
		if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
	   		$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`unit_name`='".$this->unit_name."',`description`='".$this->description."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
    }
	public function deleteme(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="delete from ".$this->table_name." where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function view(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['unit_name']."</td><td>".$row['description']."</td><td><a href='".BASE_PATH."Add_Unit/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$this->permission."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
}
$objunit= new ADDUNIT($db);
?>