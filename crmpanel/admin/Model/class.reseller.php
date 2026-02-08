<?php
class RESELLER{

    private $conn;
    private $table_name = "mi_reseller";
	private $table_auth_name = "mi_sys_user";
 
    // object properties
   
    public $user_id;
	public $user_name;
	public $pwd;
	public $email;
	public $mobile;
	public $company;
	public $address;
	public $city;
	public $amount;
	public $exp_date;
	public $renew_amt;
	
	public $image=NULL;
    public $description;
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->user_id=$this->user_id;
		$this->user_name=$this->user_name;
		$this->pwd=$this->pwd;
		$this->email=$this->email;
		$this->mobile=$this->mobile;
		$this->company=$this->company;
		$this->address=$this->address;
		$this->city=$this->city;
		$this->amount=$this->amount;
		$this->exp_date=$this->exp_date;
		$this->renew_amt=$this->renew_amt;
		$this->edit_id=$this->edit_id;
		
		$this->image=$this->image;
        $this->description=$this->description;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			$pq=$this->conn->num_rows("select * from ".$this->table_name." where user_id='".$this->user_id."' and mi_status='Yes'");
			$uq=$this->conn->num_rows("select * from ".$this->table_auth_name." where user_id='".$this->user_id."' and mi_status='Yes'");
			if($pq or $uq)
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where user_id='".$this->user_id."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function username($id)
	{
		//global $objcat;global $objcolor;
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['user_name'];
	}
	/// Raw List
	public function userlist($id='')
	{
		$str='<option value="">--Select--</option>';
		$query="select * from ".$this->table_name." where mi_status='Yes' order by user_name asc";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['user_name'].'</option>';
			}else{
			$str.='<option value="'.$row['id'].'">'.$row['user_name'].'</option>';
			}
		}
		
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   //write query
	   $query = "INSERT INTO ".$this->table_auth_name."(`id`, `user_id`, `user_name`, `user_auth`, `role_code`, `mi_status`) VALUES ('0', '".$this->user_id."','".$this->user_name."','".$this->pwd."','ADMIN','Yes')";
	   $this->conn->exeQuery($query);
        $query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `user_id`, `user_name`, `email`, `mobile`, `city`, `company`, `address`, `amount`, `exp_date`, `renew_amt`, `description`, `image`, `mi_status`) VALUES ('0','".date("Y-m-d")."', '".$this->user_id."','".$this->user_name."','".$this->email."','".$this->mobile."','".$this->city."','".$this->company."','".$this->address."','".$this->amount."','".$this->exp_date."','".$this->renew_amt."','".$this->description."','','Yes')";
		$ok=$this->conn->inserted_id($query);		
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
		   $imagename=$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../../reseller/images/reseller_img/".$filename);
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
      

		$query="update ".$this->table_auth_name." set user_name='".$this->user_name."', user_auth='".$this->pwd."' where user_id='".$this->user_id."'";
		$this->conn->exeQuery($query);
	   //write query
        $query = "update ".$this->table_name." set `user_name`='".$this->user_name."',`email`='".$this->email."',`mobile`='".$this->mobile."',`city`='".$this->city."',`address`='".$this->address."',`company`='".$this->company."',`amount`='".$this->amount."',`exp_date`='".$this->exp_date."',`renew_amt`='".$this->renew_amt."', `description`='".$this->description."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
			$this->updateimg($this->edit_id);
            return true;
        }else{
            return false;
        }
    }
}
$objreseller= new RESELLER($db);
?>