<?php
class DESIGNATION{
    private $conn;
    private $table_name = "mi_designation";
	private $dep_table_name = "mi_department";
	private $desig_auth_table_name = "mi_desig_authority";
	
    // object properties
   
    public $rdate;
	public $desig_level;
	public $designation;
	public $department_name;
	public $description;
	public $authority;
	public $desig_id;
	public $module;
	public $feature;
	
	public $permission;
	public $del_id;
	
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->conn->filterVar($this->rdate);
		$this->designation=$this->conn->filterVar($this->designation);
		$this->desig_level=$this->conn->filterVar($this->desig_level);
        $this->authority=$this->conn->filterVar($this->authority);
		$this->permission=$this->conn->filterVar($this->permission);
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and designation='".$this->designation."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and designation='".$this->designation."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function find_department()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->dep_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and department_name='".$this->department_name."' and mi_status='Yes'"))
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->dep_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and department_name='".$this->department_name."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function desig_name($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['designation'];
	}
	public function department_name($id)
	{
		$query="select * from ".$this->dep_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['department_name'];
	}
	
	public function desig_list($id='')
	{
		$str='';
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['designation'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['designation'].' </option>';
			}
		}
		
		return $str;
	}
	public function department_list($id='')
	{
		$str='';
		$query="select * from ".$this->dep_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['department_name'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['department_name'].' </option>';
			}
		}
		
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `designation`, `desig_level`, `authority`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->designation."','".$this->desig_level."','".$this->authority."','Yes')";
					
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    } 
	public function insert_department(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			if($this->edit_id!=""){
				$query = "update ".$this->dep_table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `department_name`='".$this->department_name."', `description`='".$this->description."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return true;
				}else{
					return false;
				}
			}else{
				$query = "INSERT INTO ".$this->dep_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `department_name`,`description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->department_name."','".$this->description."','Yes')";
				if($this->conn->exeQuery($query)){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
    } 
	public function authority_update(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$nok=$this->conn->exeQuery("select * from ".$this->desig_auth_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and desig_id='".$this->desig_id."' and mi_status='Yes'")->num_rows;
			if($nok){
				$query = "update ".$this->desig_auth_table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `module_id`='".$this->module."', `feature_id`='".$this->feature."' where `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and `desig_id`='".$this->desig_id."'";
			}else{
				$query = "INSERT INTO ".$this->desig_auth_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `desig_id`, `module_id`, `feature_id`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->desig_id."','".$this->module."','".$this->feature."','Yes')";
			}		
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
			$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',`designation`='".$this->designation."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
			//,`authority`='".$this->authority."'`desig_level`='".$this->desig_level."',		
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
			$qr=$this->conn->exeQuery("select * from mi_user where designation='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}
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
	public function deletedepartment(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_user where designation='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->dep_table_name." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
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
				$str.="<tr><td>".$i."</td><td>".$row['designation']."</td><td><a href='".BASE_PATH."Add_Designation/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a href='".BASE_PATH."UserPermission/Auth/".$row['id']."/' class='btn btn-primary btn-xs' title='Update Permission'><i class='fa fa-lock'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}public function view_department(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->dep_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['department_name']."</td><td><a href='".BASE_PATH."Add_Department/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a href='#' data-id='".$row['id']."' class='btn btn-danger btn-xs delme'><i class='fa fa-trash'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	public function view_authority(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$nok=$this->conn->exeQuery("select * from ".$this->desig_auth_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and desig_id='".$this->desig_id."' and mi_status='Yes'")->num_rows;
			if($nok){
				$q=$this->conn->exeQuery("select * from ".$this->desig_auth_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and desig_id='".$this->desig_id."' and mi_status='Yes'");
			}else{
				$q=$this->conn->exeQuery("select * from ".$this->desig_auth_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and desig_id='".$this->authority."' and mi_status='Yes'");
			}
			
			$row=$q->fetch_assoc();
			$module=$row['module_id'];
			$feature=$row['feature_id'];
			
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$m_array=explode(",",$module);
			$f_array=explode(",",$feature);
			$sql=$this->conn->exeQuery("select * from mi_module where mi_status='Yes'");
			$i=0;$f=1;
			while($row=$sql->fetch_assoc())
			{
				$ch=(in_array($row['m_code'],$m_array ) )?"checked":'';
				$str.= "<div class='col-md-12 col-sm-12 ml-10 mb-3'><div class='checkbox checkbox-icon-black'><input id='checkbox".$i."' data-id='".$i."' class='chk1' type='checkbox' name='' value='".$row['m_code']."' ".$ch." /><label class='mb-0' for='checkbox".$i."'> <b> ".$row['m_name']."</b> </label>";
				$fsql=$this->conn->exeQuery("select * from mi_feature where m_code='".$row['m_code']."' and mi_status='Yes'");
				while($frow=$fsql->fetch_assoc())
				{
					$ch1=(in_array($frow['f_code'],$f_array ) )?"checked":'';
					$str.= "<div class='col-md-12 ml-10'><div class='checkbox checkbox-icon-black'><input id='fea".$f."' class='chk2' type='checkbox' name='' value='".$frow['f_code']."' ".$ch1." /><label class='mb-0' for='fea".$f."'> ".$frow['f_name']." </label></div></div>";
					$f++;
				}
				$str.= "</div></div>";
				$i++;
			}
			$str.="<input type='hidden' name='desig_id' value='".$this->desig_id."' /><input type='hidden' id='module' name='module' value='".$module."' /><input type='hidden' id='feature' name='feature' value='".$feature."' /><div class='col-md-12 col-sm-12'><div><label>Check Modules which require</label></div></div><div class='col-md-12 col-sm-12'><div class='form-group'><input name='submit' class='btn btn-primary' type='submit' value='Submit' /></div></div><div id='msg'></div>";
			
			return $str;
		}else{
			return false;
		}
	}
}
$objdesignation= new DESIGNATION($db);
?>