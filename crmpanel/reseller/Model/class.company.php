<?php
class COMPANY{

    private $conn;
    private $table_name = "mi_company";
	private $profile_table = "mi_cmp_profile";	
	private $user_table_name = "mi_user";
	private $ac_level1_table_name = "mi_ac_level1";
	private $ac_level2_table_name = "mi_ac_level2";
	
    // object properties
   
    public $cmp_id;
	public $cmp_pwd;
	public $cmp_name;
	public $cmp_url;
	public $mobile;
	public $other_contact;
	public $other_email;
	public $email;
	public $regno;
	public $level1;
	public $level2;
	public $newlevel1;
	public $newlevel2;
	
	public $gst_no;
	public $address;
	public $amount;
	public $shift;
	public $renew_amt;
	public $exp_date;
	public $image=NULL;
    
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->cmp_id=$this->cmp_id;
		$this->cmp_name=$this->cmp_name;
		$this->cmp_pwd=$this->cmp_pwd;
		$this->cmp_url=$this->cmp_url;
		$this->shift=$this->shift;
		$this->level1=$this->level1;
		$this->newlevel1=$this->newlevel1;
		$this->level2=$this->level2;
		$this->newlevel2=$this->newlevel2;
		
		$this->mobile=$this->mobile;
		$this->other_contact=$this->other_contact;
		$this->email=$this->email;
		$this->other_email=$this->other_email;
		$this->regno=$this->regno;
		$this->gst_no=$this->gst_no;
		$this->amount=$this->amount;
		$this->renew_amt=$this->renew_amt;
		$this->exp_date=$this->exp_date;
		$this->address=$this->address;
		
		$this->image=$this->image;
        $this->edit_id=$this->edit_id;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$this->cmp_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$this->cmp_id."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function cmpname($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cmp_name'];
	}
	public function cmpcount($id)
	{
		$query="select * from ".$this->table_name." where reseller_id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->num_rows;
		return $row;
	}
	/// Raw List
	public function cmp_list($id='')
	{
		$str='<option value="">--Select--</option>';
		
		$query="select * from ".$this->table_name." where reseller_id='".$_SESSION[SITE_NAME]['MI_reseller_id']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['cmp_id'])
			{
				$str.='<option value="'.$row['cmp_id'].'" selected>'.$row['cmp_name'].'</option>';
			}else{
			$str.='<option value="'.$row['cmp_id'].'">'.$row['cmp_name'].'</option>';
			}
		}
		
		return $str;
	}
	
	
    public function insert(){
 
	   $rdate=date("Y-m-d H:i:s");
        $query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `reseller_id`, `cmp_id`, `cmp_pwd`, `cmp_url`, `cmp_name`, `mobile`, `other_contact`, `email`, `other_email`, `regno`, `gst_no`, `address`, `amount`, `exp_date`, `renew_amt`, `image`, `act_status`, `mi_status`) VALUES ('0', '".$rdate."','".$_SESSION[SITE_NAME]['MI_reseller_id']."','".$this->cmp_id."','".$this->cmp_pwd."','".$this->cmp_url."','".$this->cmp_name."','".$this->mobile."','".$this->other_contact."','".$this->email."','".$this->other_email."','".$this->regno."','".$this->gst_no."','".$this->address."','".$this->amount."','".$this->exp_date."','".$this->renew_amt."','','Yes','Yes')";
		$ok=$this->conn->inserted_id($query);	
		 $this->conn->exeQuery("INSERT INTO ".$this->user_table_name."(`id`, `rdate`, `cmp_id`,`user_id`, `user_type`, `username`, `emp_id`, `pwd`, `email`, `mobile`, `address`, `other_detail`, `image`, `mi_status`) VALUES ('0', '".$rdate."','".$this->cmp_id."','".$_SESSION[SITE_NAME]['MI_reseller_id']."','Admin','".$this->cmp_name."','".$this->cmp_id."','".$this->cmp_pwd."','".$this->email."','".$this->mobile."','".$this->address."','','','Yes')");
		 
		 
		 
		 
		 $this->conn->exeQuery("INSERT INTO ".$this->profile_table."(`id`, `rdate`, `cmp_id`, `user_id`,`emp_id`, `regno`, `affiliation`, `cmp_name`, `address`, `mobile`, `emails`, `web_url`, `description`, `logo`,`level1`, `level2`, `shift`, `mi_status`) VALUES ('0', '".$rdate."','".$this->cmp_id."','".$_SESSION[SITE_NAME]['MI_reseller_id']."','".$this->cmp_id."','".$this->regno."','".$this->gst_no."','".$this->cmp_name."','".$this->address."','".$this->mobile."','".$this->email."','".$this->cmp_url."', '','','".$this->l1."','".$this->l2."','".$this->shift."','Yes')");
		 
		
        if($ok){
			$this->updateimg($ok);
            return true;
        }else{
            return false;
        }
    }
	 public function updateimg($id){
       if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   $imagename=$this->cmp_id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../../crm/images/cmp_img/".$filename);
		   $query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
		   $this->conn->exeQuery("update ".$this->user_table_name." set `image`='".$filename."' where emp_id='".$this->cmp_id."'");
			$this->conn->exeQuery("update ".$this->profile_table." set `logo`='".$filename."' where cmp_id='".$this->cmp_id."'");
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
		
	   //write query
        $query = "update ".$this->table_name." set `reseller_id`='".$_SESSION[SITE_NAME]['MI_reseller_id']."',`cmp_id`='".$this->cmp_id."',`cmp_pwd`='".$this->cmp_pwd."',`cmp_name`='".$this->cmp_name."',`cmp_url`='".$this->cmp_url."',`mobile`='".$this->mobile."',`other_contact`='".$this->other_contact."', `email`='".$this->email."', `other_email`='".$this->other_email."', `address`='".$this->address."', `regno`='".$this->regno."',`gst_no`='".$this->gst_no."',`amount`='".$this->amount."', `renew_amt`='".$this->renew_amt."', `exp_date`='".$this->exp_date."' where id='".$this->edit_id."'";
		
		 $this->conn->exeQuery("update ".$this->profile_table." set  `cmp_name`='".$this->cmp_name."', `level1`='".$l1."', `level2`='".$l2."', `shift`='".$this->shift."' where `cmp_id`='".$this->cmp_id."'");
		 



		
        if($this->conn->exeQuery($query)){
			$this->updateimg($this->edit_id);
            return true;
        }else{
            return false;
        }
    }
}
$objcmp= new COMPANY($db);
?>