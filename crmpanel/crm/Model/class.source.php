<?php
class SOURCE{
    private $conn;
    private $table_name = "mi_source";
	private $ref_table_name = "mi_reference";
	private $cmpl_table_name = "mi_complaint_source";
	
    // object properties
   
    public $rdate;
	public $source;
	public $reference;
	
    public $edit_id;
    public $del_id;
    public $permission;
    
    public function __construct($db){
        $this->conn = $db;
		$this->permission=$this->permission;
    }
	public function find_id($indus)
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and source='".$indus."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and source='".$indus."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}
	}
	public function check_reference($indus,$seg)
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->ref_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and source='".$indus."' and reference='".$seg."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->ref_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and source='".$indus."' and reference='".$seg."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}
	}
	
	public function source_name($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['source'];
	}
	
	public function source_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['source'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['source'].' </option>';
			}
		}
		return $str;
	}
	public function reference_list($indus,$id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->ref_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and source='".$indus."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['reference'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['reference'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			
			$ni=count($this->source);
			for($i=0;$i<$ni;$i++)
			{
				if($this->source[$i]!="" and $this->find_id($this->source[$i])){
					$query = $this->conn->exeQuery("INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `source`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->source[$i]."','Yes')");
				}else{
					return 2;
				}
			}
			
			if($query){
				return 1;
			}else{
				return 3;
			}
		}else{
			return 3;
		}
		
    }
	
	public function update(){
       $this->edit_id=$this->conn->filterVar($this->edit_id);
		if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
	   		if($this->source[0]!="" and $this->find_id($this->source[0])){
				
			$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',`source`='".$this->source[0]."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 2;
			}
		}else{
			return 3;
		}
    }
	public function deleteme(){
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="update ".$this->table_name." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
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
				$str.="<tr><td>".$i."</td><td>".$row['source']."</td><td><a href='".BASE_PATH."Add_Reference/Add/".$row['id']."/'>Reference</a></td><td><a href='".BASE_PATH."Add_Source/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////////////
	public function reference_update(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$indus=$this->source[0];
			$ni=count($this->reference);
			for($i=0;$i<$ni;$i++)
			{
				if($this->reference[$i]!="" and $this->check_reference($indus,$this->reference[$i])){
					if($this->edit_id==""){
						$query = $this->conn->exeQuery("INSERT INTO ".$this->ref_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `source`,`reference`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$indus."','".$this->reference[$i]."','Yes')");
					}else{
						$query = $this->conn->exeQuery("update ".$this->ref_table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `source`='".$indus."',`reference`='".$this->reference[$i]."' where `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$this->edit_id."' ");
					}
					
				}else{
					return 2;
				}
			}
			
			if($query){
				return 1;
			}else{
				return 3;
			}
		}else{
			return 3;
		}
		
    }
	public function delete_reference(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="update ".$this->ref_table_name." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function view_reference(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->ref_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['reference']."</td><td><a href='".BASE_PATH."Add_Reference/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	////////////////////// Update complaint Source ////////////////////
	
	public function find_cmpl_id($indus)
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->cmpl_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and source='".$indus."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->cmpl_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and source='".$indus."' and id<>'".$this->edit_id."' and mi_status='Yes'"))
			{
				return false;
			}else{
				return true;
			}
		}
	}
	
	public function cmp_source_name($id)
	{
		$query="select * from ".$this->cmpl_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['source'];
	}
	
	public function cmp_source_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->cmpl_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['source'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['source'].' </option>';
			}
		}
		return $str;
	}
    public function insert_cmpl_source(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$ni=count($this->source);
			for($i=0;$i<$ni;$i++)
			{
				if($this->source[$i]!="" and $this->find_cmpl_id($this->source[$i])){
					$query = $this->conn->exeQuery("INSERT INTO ".$this->cmpl_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `source`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->source[$i]."','Yes')");
				}else{
					return 2;
				}
			}
			
			if($query){
				return 1;
			}else{
				return 3;
			}
		}else{
			return 3;
		}
    }
	
	public function update_cmpl_source(){
       $this->edit_id=$this->conn->filterVar($this->edit_id);
		if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
	   		if($this->source[0]!="" and $this->find_cmpl_id($this->source[0])){
				
			$query = "update ".$this->cmpl_table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',`source`='".$this->source[0]."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 2;
			}
		}else{
			return 3;
		}
    }
	public function delete_cmpl_source(){
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="update ".$this->cmpl_table_name." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function view_cmpl_source(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->cmpl_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['source']."</td><td><a href='".BASE_PATH."Add_CSource/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
}
$objsource= new SOURCE($db);
?>