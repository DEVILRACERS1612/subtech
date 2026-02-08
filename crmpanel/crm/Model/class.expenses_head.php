<?php
class EXPENSESHEAD{
    private $conn;
    private $table_name = "mi_expense_head";
 
    // object properties
   
    public $rdate;
	public $exp_type;
	public $expenses_head;
	public $exp_nature;
	public $unit;
	public $rate;
	
	
    public $edit_id;
    public $del_id;
    public $permission;
    
    public function __construct($db){
        $this->conn = $db;
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and expenses_head='".$this->expenses_head."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and expenses_head='".$this->expenses_head."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function expheadname($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['expenses_head'];
	}
	
	public function exphead_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['expenses_head'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['expenses_head'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `expense_head`, `exp_type`, `exp_nature`, `rate`, `unit`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->expenses_head."','".$this->exp_type."','".$this->exp_nature."','".$this->rate."','".$this->unit."','Yes')";
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
	   		$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`exp_type`='".$this->exp_type."',`expense_head`='".$this->expenses_head."',user_id='".$_SESSION[SITE_NAME]['MICMP_userid']."',`exp_nature`='".$this->exp_nature."',`rate`='".$this->rate."',`unit`='".$this->unit."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
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
				$str.="<tr><td>".$i."</td><td>".$row['expense_head']."</td><td>".$row['exp_type']."</td><td>".$row['exp_nature']."</td><td>".$row['rate']."</td><td>".$row['unit']."</td><td><a href='".BASE_PATH."Add_Expenses_Head/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
}
$objexp= new EXPENSESHEAD($db);
?>