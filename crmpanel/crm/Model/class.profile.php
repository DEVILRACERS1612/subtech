<?php
class PROFILE{
    private $conn;
    private $table_name = "mi_cmp_profile";
 
    // object properties
   
    public $rdate;
	public $regno;
	public $affiliation;
	public $mobile;
	public $address;
	public $emails;
	public $web_url;
	public $image=NULL;
	public $cmp_name;
	public $description;
	
    public $edit_id;
    public $del_id;
    public $permission;
    
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->conn->filterVar($this->rdate);
		$this->cmp_name=$this->conn->filterVar($this->cmp_name);
		$this->regno=$this->conn->filterVar($this->regno);
		$this->affiliation=$this->conn->filterVar($this->affiliation);
		$this->mobile=$this->conn->filterVar($this->mobile);
		$this->emails=$this->conn->filterVar($this->emails);
		$this->web_url=$this->conn->filterVar($this->web_url);
		$this->image=$this->image;
		
        $this->description=$this->conn->filterVar($this->description);
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function school_profile()
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		$_SESSION[SITE_NAME]['MICMP_Profile']=$row;
		return 0;
	}
	
	
	
    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`,`rdate`, `cmp_id`, `user_id`, `regno`, `affiliation`, `cmp_name`, `address`, `mobile`, `emails`, `web_url`, `description`, `logo`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->regno."','".$this->affiliation."','".$this->cmp_name."','".$this->address."','".$this->mobile."','".$this->emails."','".$this->web_url."','".$this->description."','','Yes')";
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
	public function update(){
      
       $this->edit_id=$this->conn->filterVar($this->edit_id);
		if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
	   		$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`affiliation`='".$this->affiliation."',`regno`='".$this->regno."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',`web_url`='".$this->web_url."',`emails`='".$this->emails."',`mobile`='".$this->mobile."',`address`='".$this->address."',`description`='".$this->description."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
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
	public function updateimg($id){
       if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   $imagename=$_SESSION[SITE_NAME]['MICMP_cmpid']."_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../../crm/images/cmp_img/".$filename);
		   $query = "update ".$this->table_name." set `logo`='".$filename."' where id='".$id."'";
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
				$str.="<tr><td>".$i."</td><td>".$row['regno']."</td><td>".$row['cmp_name']."</td><td>".$row['description']."</td><td><a href='".BASE_PATH."Add_Class/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$this->permission."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
}
$objprofile= new PROFILE($db);
?>