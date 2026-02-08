<?php
class SMSSETTING{
    private $conn;
    private $table_name = "mi_sms_setting";
 
    // object properties
   
    public $rdate;
	public $user_id;
	public $page_code;

	
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->user_id=$this->user_id;
		$this->page_code=$this->page_code;
		
		
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and user_id='".$this->user_id."' and page_code='".$this->page_code."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and user_id='".$this->user_id."' and page_code='".$this->page_code."' and sess_year='".$_SESSION['sess_year']."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	
    // Insert Item
    public function insert(){
 
	   //write query
	   if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes'") )
		{
		}else{
			
		}
	   
	   
	   
	   $this->conn->exeQuery("delete from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and user_id='".$this->user_id."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes'");
	   
        $query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `sess_year`,`school_id`, `user_id`, `page_code`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION['sess_year']."','".$_SESSION['MISCHOOL_schoolid']."','".$this->user_id."','".$this->page_code."','Yes')";

        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }
	public function valid_sms_page()
	{
		$q=$this->conn->exeQuery("select * from ".$this->table_name."  where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes'");
		$r=$q->fetch_assoc();
		return $r['page_code'];
	}
	
}
$objsmsset= new SMSSETTING($db);
?>