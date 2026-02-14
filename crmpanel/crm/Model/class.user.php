<?php
class USER{

    private $conn;
    private $table_name = "mi_user";
	private $electrician_table_name = "mi_electrician";
	private $jnr_table_name = "mi_emp_juniors";
 
    // object properties
    public $rdate;
    public $username;
	public $user_type;
	public $emp_id;
	public $emp_code;
	public $report_to;
	public $division;
	public $region;
	public $department;
	public $branch;
	public $dob;
	public $doj;
	public $gender;
	public $experience;
	public $designation;
	public $pwd;
	public $email;
	public $email1;
	public $email2;
	public $smtp_pwd;
	public $smtp_email;
	public $phone;
	public $mobile;
	public $address;
	public $image=NULL;
    public $other_detail;
    public $edit_id;
    public $del_id;
    public $permission;
	
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->username=$this->username;
		$this->user_type=$this->user_type;
		$this->user_id=$this->user_id;
		$this->pwd=$this->pwd;
		$this->email=$this->email;
		$this->price=$this->price;
		$this->address=$this->address;
		$this->mobile=$this->mobile;
		$this->image=$this->image;
        $this->other_detail=$this->other_detail;
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (user_id='".$this->user_id."' or email='".$this->email."' or mobile='".$this->mobile."' ) and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (user_id='".$this->user_id."' or email='".$this->email."' or mobile='".$this->mobile."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function username($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['username'];
	}
	/// Raw List
	public function user_list($id='')
	{
		$str='<option value="">--Select--</option>';
		if($_SESSION[SITE_NAME]['MICMP_usertype']=='Admin'){
		    $query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and user_type!='Admin' and mi_status='Yes'";
		}else{
		    $jnrs=$this->find_juniors();
		    $jnrs=$jnrs.",".$_SESSION[SITE_NAME]['MICMP_userid'];
		    $jnr=explode(",",$jnrs);
		    $query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and user_type!='Admin' and id in('".implode("','",$jnr)."') and mi_status='Yes'";
		}
		
		
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['username'].'</option>';
			}else{
			$str.='<option value="'.$row['id'].'">'.$row['username'].' </option>';
			}
		}
		return $str;
	}
	public function electrician_name($id)
	{
		$query="select * from ".$this->electrician_table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['fname'];
	}
	public function electrician_token($id){
		$id = (int)$id;
		$row=$this->conn->exeQuery("select fcm_token from mi_user_login ul left join mi_electrician e on e.mobile=ul.mobile where e.id='".$id."' and e.act_status='Verified' and e.mi_status='Yes'")->fetch_assoc();
		return $row['fcm_token'];
	}
	public function electrician_list($id='')
	{
		$str='';
		$query="select * from ".$this->electrician_table_name." where fname!='' and act_status='Verified' and mi_status='Yes'";

		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['fname'].' ('.$row['city'].') '.$row['mobile'].'</option>';
			}else{
			$str.='<option value="'.$row['id'].'">'.$row['fname'].' ('.$row['city'].') '.$row['mobile'].'</option>';
			}
		}
		return $str;
	}
	public function technician_list($id='')
	{
		$str='';
		 $query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and user_type!='Admin' and designation in(select id from mi_designation where designation='Technician' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes') and mi_status='Yes'";
		
		
		
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['username'].'</option>';
			}else{
			$str.='<option value="'.$row['id'].'">'.$row['username'].' </option>';
			}
		}
		return $str;
	}
	public function report_to_list($id='')
	{
		global $objdesignation;
		$str='<option value="">--Select--</option>';
		
		    //$jnrs=$this->find_juniors();
		    //$jnrs=$jnrs.",".$_SESSION[SITE_NAME]['MICMP_userid'];
		    //$jnr=explode(",",$jnrs);
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		
		
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['username'].'-'.$objdesignation->desig_name($row['designation']).'</option>';
			}else if($id=='self'){
				$str.='<option value="self" selected>Self-'.$objdesignation->desig_name($row['designation']).'</option>';
			}else{
			$str.='<option value="'.$row['id'].'">'.$row['username'].'- '.$objdesignation->desig_name($row['designation']).'</option>';
			}
		}
		return $str;
	}
	public function check_emp_code(){
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (emp_code='".$this->emp_code."')") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (emp_code='".$this->emp_code."') and id<>'".$this->edit_id."' ") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			if($this->emp_code!=""){
				if($this->check_emp_code()){
					return 2;
				}
			}
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`,`user_id`, `user_type`, `username`, `emp_id`, `pwd`, `emp_code`,`report_to`, `division`, `region`, `branch`, `designation`, `doj`, `experience`, `dob`, `gender`, `email`, `mobile`, `phone`, `address`, `smtp_email`, `smtp_pwd`, `email1`, `email2`, `other_detail`, `mi_status`) VALUES ('0','".$this->rdate."', '".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->user_type."','".$this->username."','".$this->emp_id."','".$this->pwd."','".$this->emp_code."','".$this->report_to."','".$this->division."','".$this->region."','".$this->branch."','".$this->designation."','".$this->doj."','".$this->experience."','".$this->dob."','".$this->gender."','".$this->email."','".$this->mobile."','".$this->phone."','".$this->address."','".$this->smtp_email."','".$this->smtp_pwd."','".$this->email1."','".$this->email2."','".$this->other_detail."','Yes')";
			//return $query;
			$ok=$this->conn->inserted_id($query);		
			if($ok){
				$this->updateimg($ok);
				return 1;
			}else{
				return 3;
			}
		}else{
			return 3;
		}
    }
	 public function updateimg($id){
       if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   $imagename=$_SESSION[SITE_NAME]['MICMP_cmpid']."_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../images/user_img/".$filename);
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
      
      $this->edit_id=$this->conn->filterVar($this->edit_id);
      if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			if($this->emp_code!=""){
				if($this->check_emp_code()){
					return 2;
				}
			}
        $query = "update ".$this->table_name." set `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."',`user_type`='".$this->user_type."',`emp_id`='".$this->emp_id."',`username`='".$this->username."',`division`='".$this->division."',`designation`='".$this->designation."',`region`='".$this->region."',`branch`='".$this->branch."',`emp_code`='".$this->emp_code."',`dob`='".$this->dob."',`doj`='".$this->doj."',`experience`='".$this->experience."',`smtp_email`='".$this->smtp_email."',`smtp_pwd`='".$this->smtp_pwd."',`email`='".$this->email."',`pwd`='".$this->pwd."',`mobile`='".$this->mobile."',`phone`='".$this->phone."',`address`='".$this->address."', `other_detail`='".$this->other_detail."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				
        if($this->conn->exeQuery($query)){
			$this->updateimg($this->edit_id);
            return 1;
        }else{
            return 3;
        }
	}else{
			return 3;
		}
   }
   
    public function find_juniors($senior=''){
       if($senior==''){
           $jqr=$this->conn->exeQuery("select * from ".$this->jnr_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and emp_id='".$_SESSION[SITE_NAME]['MICMP_userid']."' and mi_status='Yes'")->fetch_assoc();
       }else{
           $jqr=$this->conn->exeQuery("select * from ".$this->jnr_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and emp_id='".$senior."' and mi_status='Yes'")->fetch_assoc();
       }
       return $jqr['juniors'];
    }
   
   public function add_juniors()
   {
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$jqr=$this->conn->exeQuery("select * from ".$this->jnr_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and emp_id='".$this->emp_id."' and mi_status='Yes'")->num_rows;
			if($jqr)
			{
				$jq="update ".$this->jnr_table_name." set juniors='".$this->juniors."' where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and emp_id='".$this->emp_id."' and mi_status='Yes'";
			}else{
				$jq="INSERT INTO `mi_emp_juniors`(`id`, `rdate`, `cmp_id`, `user_id`, `emp_id`, `juniors`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->emp_id."','".$this->juniors."','Yes')";
			}
			$ok=$this->conn->exeQuery($jq);
			if($ok){
				return true;
			}else{
				return false;
			}
		}
   }
	public function deleteme(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$q=$this->conn->exeQuery("select * from ".$this->table_name." where id='".$this->del_id."' and mi_status='Yes'");
			$r=$q->fetch_assoc();
			$picture='../images/user_img/'.$r['image'];
			chmod($picture, 0644);
			unlink($picture);
						
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
			global $objbranch;
			global $objdesignation;
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				if($row['image']!=''){
					$img="<img src='".BASE_PATH."images/user_img/".$row['image']."' style='height:50px;' />";
				}
				$str.="<tr><td>".$i."</td><td>".$row['username']."</td><td>".$objdesignation->desig_name($row['designation'])."</td><td>".$objbranch->branchname($row['branch'])."</td><td>".$row['email']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['other_detail']."</td><td>".$img."</td><td><a href='".BASE_PATH."Add_User/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a href='".BASE_PATH."UserPermission/Auth/".$row['id']."/' class='btn btn-primary btn-xs' title='Update Permission'><i class='fa fa-lock'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$this->permission."' title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
}
$objuser= new USER($db);
?>