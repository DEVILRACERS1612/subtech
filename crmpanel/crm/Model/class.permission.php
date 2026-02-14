<?php
class PERMISSION{
    private $conn;
    private $table_name = "mi_role_rights";
 
    // object properties
   
    public $rdate;
	public $emp_id;
	public $module;
	public $rr_page_code;
	public $rr_create;
	public $rr_edit;
	public $rr_delete;
	public $rr_view;
	
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and emp_id='".$this->emp_id."' and rr_page_code='".$this->rr_page_code."'  and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and emp_id='".$this->emp_id."' and rr_page_code='".$this->rr_page_code."'  and id<>'".$this->edit_id."' and mi_status='Yes'") )
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
	   $this->conn->exeQuery("delete from mi_role_rights where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and emp_id='".$this->emp_id."'");
        $query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `emp_id`,`module`, `rr_page_code`, `rr_create`, `rr_edit`, `rr_delete`, `rr_view`, `mi_status`) VALUES ";
		$c=count($this->rr_page_code);
		for($i=0;$i<$c;$i++)
		{
			$mod=$this->module[$i];
			if($this->rr_page_code[$i]!='')
			{
				$create=($this->conn->filterVar($this->rr_create[$i]));
				$edit=($this->conn->filterVar($this->rr_edit[$i]));
				$del=($this->conn->filterVar($this->rr_delete[$i]));
				$view=($this->conn->filterVar($this->rr_view[$i]));
				
				$query.="('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->emp_id."','".$mod."','".$this->rr_page_code[$i]."','".$create."','".$edit."','".$del."','".$view."','Yes'),";
			}
			
		}
		$query=rtrim($query,",");
	
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }
	/*public function update(){
      
       $this->edit_id=$this->conn->filterVar($this->edit_id);
      
	   //write query
        $query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`rr_create`='".$this->rr_create."',`rr_edit`='".$this->rr_edit."',`rr_delete`='".$this->rr_delete."',`rr_view`='".$this->rr_view."' where id='".$this->edit_id."' and cmp_id='".$_SESSION['MICMP_cmpid']."' and emp_id='".$this->emp_id."' and page_id='".$this->rr_page_code."'";
				
        if($this->conn->exeQuery($query)){
            return true;
        }else{
            return false;
        }
    }*/
	
	
	
}
$objpermission= new PERMISSION($db);
?>