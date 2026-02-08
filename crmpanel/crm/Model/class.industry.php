<?php
class INDUSTRY{
    private $conn;
    private $table_name = "mi_industry";
	private $seg_table_name = "mi_segment";
	
    // object properties
   
    public $rdate;
	public $industry;
	public $segment;
	
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
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and industry='".$indus."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and industry='".$indus."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}
	}
	public function check_segment($indus,$seg)
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->seg_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and industry='".$indus."' and segment='".$seg."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->seg_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and industry='".$indus."' and segment='".$seg."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}
	}
	
	public function industry_name($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['industry'];
	}
	
	public function industry_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['industry'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['industry'].' </option>';
			}
		}
		return $str;
	}
	public function segment_list($indus,$id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->seg_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and industry='".$indus."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['segment'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['segment'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			
			$ni=count($this->industry);
			for($i=0;$i<$ni;$i++)
			{
				if($this->industry[$i]!="" and $this->find_id($this->industry[$i])){
					$query = $this->conn->exeQuery("INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `industry`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->industry[$i]."','Yes')");
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
	   		if($this->industry[0]!="" and $this->find_id($this->industry[0])){
				
			$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',`industry`='".$this->industry[0]."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
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
				$str.="<tr><td>".$i."</td><td>".$row['industry']."</td><td><a href='".BASE_PATH."Add_Industry/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////////////
	public function segment_update(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$indus=$this->industry[0];
			$ni=count($this->segment);
			for($i=0;$i<$ni;$i++)
			{
				if($this->segment[$i]!="" and $this->check_segment($indus,$this->segment[$i])){
					if($this->edit_id==""){
						$query = $this->conn->exeQuery("INSERT INTO ".$this->seg_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `industry`,`segment`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$indus."','".$this->segment[$i]."','Yes')");
					}else{
						$query = $this->conn->exeQuery("update ".$this->seg_table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `industry`='".$indus."',`segment`='".$this->segment[$i]."' where `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$this->edit_id."' ");
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
	public function delete_segment(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="delete from ".$this->seg_table_name." where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function view_segment(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->seg_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and industry='".$this->industry."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['segment']."</td><td><a href='".BASE_PATH."Add_Segment/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
}
$objindustry= new INDUSTRY($db);
?>