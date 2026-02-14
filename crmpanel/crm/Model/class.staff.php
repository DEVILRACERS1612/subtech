<?php
class STAFF{

    private $conn;
    private $table_name = "mi_staff";
 
    // object properties
    public $rdate;
	public $dep_id;
	public $desi_id;
	public $doj;
    public $stname;
	public $salary;
	public $father;
	public $quali;
	public $email;
	public $mobile;
	public $address;
	public $image=NULL;
    public $description;
    public $edit_id;
    public $del_id;
    public $permission;
	
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->dep_id=$this->dep_id;
		$this->desi_id=$this->desi_id;
		$this->doj=$this->doj;
		$this->stname=$this->stname;
		$this->salary=$this->salary;
		$this->father=$this->father;
		$this->dep_id=$this->dep_id;
		$this->quali=$this->quali;
		$this->email=$this->email;
		$this->address=$this->address;
		$this->mobile=$this->mobile;
		$this->image=$this->image;
        $this->description=$this->description;
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and dep_id='".$this->dep_id."' and desi_id='".$this->desi_id."' and stname='".$this->stname."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and dep_id='".$this->dep_id."' and desi_id='".$this->desi_id."' and stname='".$this->stname."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function staff_name($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['stname'];
	}
	/// Raw List
	public function staff_list($id='')
	{
		$str="<option value=''>--Select--</option>";
		
		$query="select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.="<option value='".$row['id']."' selected>".$row['stname']."</option>";
			}else{
			$str.="<option value='".$row['id']."'>".$row['stname']." </option>";
			}
		}
		return $str;
	}
	public function staff_list_search()
	{
		$str="<option value=''>--Select--</option>";
		
		$query="select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and dep_id='".$this->dep_id."' and desi_id='".$this->desi_id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			$str.="<option value='".$row['id']."'>".$row['stname']." </option>";
		}
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `dep_id`, `desi_id`, `stname`, `father`, `email`, `doj`, `mobile`, `address`,`quali`,`salary`, `image`, `description`, `mi_status`) VALUES ('0','".$this->rdate."', '".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$this->dep_id."','".$this->desi_id."','".$this->stname."','".$this->father."','".$this->email."','".$this->doj."','".$this->mobile."','".$this->address."','".$this->quali."','".$this->salary."','','".$this->description."','Yes')";
			$ok=$this->conn->inserted_id($query);		
			if($ok){
				$this->updateimg($ok);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	 public function updateimg($id){
       if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   $imagename=$_SESSION['MISCHOOL_schoolid']."_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../images/staff_img/".$filename);
		   $query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
	   }else{
		   return true;
	   }
      
	   //write query
        
    }
public function update(){
      
      $this->edit_id=$this->conn->filterVar($this->edit_id);
      if($this->permission['pg_edit']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
        $query = "update ".$this->table_name." set `school_id`='".$_SESSION['MISCHOOL_schoolid']."',`stname`='".$this->stname."',`dep_id`='".$this->dep_id."',`desi_id`='".$this->desi_id."',`father`='".$this->father."',`dep_id`='".$this->dep_id."',`email`='".$this->email."',`doj`='".$this->doj."',`quali`='".$this->quali."',`mobile`='".$this->mobile."',`address`='".$this->address."', `description`='".$this->description."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
			$this->updateimg($this->edit_id);
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
		if($this->permission['pg_delete']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$q=$this->conn->exeQuery("select * from ".$this->table_name." where id='".$this->del_id."' and mi_status='Yes'");
			$r=$q->fetch_assoc();
			$picture='../images/staff_img/'.$r['image'];
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
		
		if($this->permission['pg_view']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			global $objdep;global $objdesignation;
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				if($row['image']!=''){
					$img="<img src='".BASE_PATH."images/staff_img/".$row['image']."' style='height:50px;' />";
				}
				$str.="<tr><td>".$i."</td><td>".$row['stname']."</td><td>".$objdep->dep_name($row['dep_id'])."</td><td>".$objdesignation->desig_name($row['desi_id'])."</td><td>".$row['father']."</td><td>".$row['email']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['quali']."</td><td>".$row['salary']."</td><td>".$row['description']."</td><td>".$img."</td><td><a href='".BASE_PATH."Add_Staff/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$this->permission."'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
}
$objstaff= new STAFF($db);
?>