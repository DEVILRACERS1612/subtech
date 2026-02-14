<?php
class COUNTRY{
    private $conn;
    private $table_name = "mi_country";
	private $ref_table_name = "mi_state";
	private $loca_table_name = "mi_location";
	
    // object properties
   
    public $rdate;
	public $country;
	public $state;
	public $location;
	
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
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and country='".$indus."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and country='".$indus."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}
	}
	public function check_state($indus,$seg)
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->ref_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and country='".$indus."' and state='".$seg."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->ref_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and country='".$indus."' and state='".$seg."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}
	}
	public function check_location($stat,$loca)
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->loca_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and state='".$stat."' and location='".$loca."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->loca_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and state='".$stat."' and location='".$loca."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}
	}
	
	public function country_name($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['country'];
	}
	public function state_name($id)
	{
		$query="select * from ".$this->ref_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['state'];
	}
	public function location_name($id)
	{
		$query="select * from ".$this->loca_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['location'];
	}
	public function country_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['country'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['country'].' </option>';
			}
		}
		return $str;
	}
	public function state_list($indus='',$id='')
	{
		$str='<option value="">Select</option>';
		if($indus==''){
			$query="select * from ".$this->ref_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and  mi_status='Yes'";
		}else{
			$query="select * from ".$this->ref_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and country='".$indus."' and  mi_status='Yes'";
		}
		
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['state'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['state'].' </option>';
			}
		}
		return $str;
	}
	public function location_list($stat,$id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->loca_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and state='".$stat."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['location'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['location'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			
			$ni=count($this->country);
			for($i=0;$i<$ni;$i++)
			{
				if($this->country[$i]!="" and $this->find_id($this->country[$i])){
					$query = $this->conn->exeQuery("INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `country`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->country[$i]."','Yes')");
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
	   		if($this->country[0]!="" and $this->find_id($this->country[0])){
				
			$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',`country`='".$this->country[0]."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
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
			$query="delete from ".$this->table_name." where id='".$this->del_id."' and mi_status='Yes' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
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
				$str.="<tr><td>".$i."</td><td>".$row['country']."</td><td><a href='".BASE_PATH."Add_State/Add/".$row['id']."/'>State</a></td><td><a href='".BASE_PATH."Add_Country/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////////////
	public function state_update(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$indus=$this->country[0];
			$ni=count($this->state);
			for($i=0;$i<$ni;$i++)
			{
				if($this->state[$i]!="" and $this->check_state($indus,$this->state[$i])){
					if($this->edit_id==""){
						$query = $this->conn->exeQuery("INSERT INTO ".$this->ref_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `country`,`state`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$indus."','".$this->state[$i]."','Yes')");
					}else{
						$query = $this->conn->exeQuery("update ".$this->ref_table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `country`='".$indus."',`state`='".$this->state[$i]."' where `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$this->edit_id."' ");
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
	public function delete_state(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="delete from ".$this->ref_table_name." where id='".$this->del_id."' and mi_status='Yes' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function view_state(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->ref_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and country='".$this->country."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['state']."</td><td><a href='".BASE_PATH."Add_Location/Add/".$row['id']."/' >Location</a></td><td><a href='".BASE_PATH."Add_State/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////////////
	public function location_update(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$stat=$this->state[0];
			$ni=count($this->location);
			for($i=0;$i<$ni;$i++)
			{
				if($this->location[$i]!="" and $this->check_location($stat,$this->location[$i])){
					if($this->edit_id==""){
						$query = $this->conn->exeQuery("INSERT INTO ".$this->loca_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `state`,`location`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$stat."','".$this->location[$i]."','Yes')");
					}else{
						$query = $this->conn->exeQuery("update ".$this->loca_table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `state`='".$stat."',`location`='".$this->location[$i]."' where `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$this->edit_id."' ");
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
	public function delete_location(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="delete from ".$this->loca_table_name." where id='".$this->del_id."' and mi_status='Yes' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' ";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function view_location(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->loca_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and state='".$this->state."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['location']."</td><td><a href='".BASE_PATH."Add_Location/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
}
$objcountry= new COUNTRY($db);
?>