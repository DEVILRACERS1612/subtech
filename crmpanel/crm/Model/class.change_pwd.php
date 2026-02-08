<?php
class CHANGE_PWD{
    private $conn;
    private $table_name = "mi_user";
 
    // object properties
   
    public $pdate;
	public $user_id;
    public $newpwd;
	public $oldpwd;
	public $cnfpwd;
	
	public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->pdate=$this->conn->filterVar($this->pdate);
		$this->user_id=$this->conn->filterVar($this->user_id);
        $this->newpwd=$this->conn->filterVar($this->newpwd);
		$this->oldpwd=$this->conn->filterVar($this->oldpwd);
		$this->cnfpwd=$this->conn->filterVar($this->cnfpwd);
    }
	public function find_pwd()
	{
		if($this->conn->num_rows("select * from ".$this->table_name." where user_id='".$this->user_id."' and pwd='".$this->oldpwd."' and mi_status='Yes'"))
		{
			return true;
		}else{
			return false;
		}
		
	}
	public function cnf_pwd()
	{
		if(trim($this->newpwd)!='' and $this->newpwd==$this->cnfpwd )
		{
			return true;
		}else{
			return false;
		}
	}
	
    // Insert Item

	public function update(){
        //write query
        $query = "update ".$this->table_name." set `pwd`='".$this->newpwd."' where `user_id`='".$this->user_id."' and school_id='".$_SESSION['MISCHOOL_schoolid']."' and id='".$_SESSION['MISCHOOL_userid']."' and mi_status='Yes'";
				
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }

}
$objpwd= new CHANGE_PWD($db);
?>