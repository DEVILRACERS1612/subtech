<?php
class PARTY{

    private $conn;
    private $table_name = "mi_party";
 
    // object properties
    public $rdate;
    public $party_name;
	public $party_type;
	public $gstin;
	public $email;
	public $price;
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
		$this->party_name=$this->party_name;
		$this->party_type=$this->party_type;
		$this->gstin=$this->gstin;
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
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and party_name='".$this->party_name."' and mobile='".$this->mobile."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and party_name='".$this->party_name."' and mobile='".$this->mobile."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function party_name($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['party_name'];
	}
	/// Raw List
	public function party_list($id='')
	{
		$str='<option value="">--Select--</option>';
		
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['party_name'].'</option>';
			}else{
			$str.='<option value="'.$row['id'].'">'.$row['party_name'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`,`cmp_id`,`user_id`, `party_type`,`party_name`,`gstin`, `email`,  `mobile`,`address`,`other_detail`, `mi_status`) VALUES ('0','".$this->rdate."', '".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->party_type."','".$this->party_name."','".$this->gstin."','".$this->email."','".$this->mobile."','".$this->address."','".$this->other_detail."','Yes')";
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
		   $imagename=$_SESSION[SITE_NAME]['MICMP_cmpid']."_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../images/party_img/".$filename);
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
        $query = "update ".$this->table_name." set `user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',`party_type`='".$this->party_type."',`gstin`='".$this->gstin."',`email`='".$this->email."',`mobile`='".$this->mobile."',`address`='".$this->address."', `other_detail`='".$this->other_detail."' where id='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				
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
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$q=$this->conn->exeQuery("select * from ".$this->table_name." where id='".$this->del_id."' and mi_status='Yes'");
			$r=$q->fetch_assoc();
			$picture='../images/party_img/'.$r['image'];
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
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				if($row['image']!=''){
					$img="<img src='".BASE_PATH."images/party_img/".$row['image']."' style='height:50px;' />";
				}
				$str.="<tr><td>".$i."</td><td>".$row['party_name']."</td><td>".$row['gstin']."</td><td>".$row['email']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['other_detail']."</td><td>".$img."</td><td><a href='".BASE_PATH."Add_User/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$this->permission."' title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
}
$objparty= new PARTY($db);
?>