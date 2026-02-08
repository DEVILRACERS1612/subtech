<?php
class MODULE{

    private $conn;
    private $table_name = "mi_module";
	
    // object properties
   
    public $m_grp_code;
	public $m_grp_name;
	public $m_code;
	public $m_name;
	public $m_page_name;
	   
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->m_grp_code=$this->m_grp_code;
		$this->m_grp_name=$this->m_grp_name;
		$this->m_code=$this->m_code;
		$this->m_name=$this->m_name;
		$this->m_page_name=$this->m_page_name;
		
		$this->edit_id=$this->edit_id;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			$pq=$this->conn->num_rows("select * from ".$this->table_name." where m_grp_name='".$this->m_grp_name."' and m_code='".$this->m_code."'  and m_name='".$this->m_name."' and  mi_status='Yes'");
			
			if($pq )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where m_grp_name='".$this->m_grp_name."' and m_code='".$this->m_code."' and m_name='".$this->m_name."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function module_name($id)
	{
		//global $objcat;global $objcolor;
		$query="select * from ".$this->table_name." where m_code='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['m_name'];
	}
	/// Raw List
	public function module_list($id='')
	{
		$str='<option value="">--Select--</option>';
		$query="select * from ".$this->table_name." where mi_status='Yes' order by m_name asc";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['m_code'])
			{
				$str.='<option value="'.$row['m_code'].'" selected>'.$row['m_name'].'</option>';
			}else{
			$str.='<option value="'.$row['m_code'].'">'.$row['m_name'].'</option>';
			}
		}
		
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   //write query
	   $query = "INSERT INTO ".$this->table_name."(`id`, `m_grp_code`, `m_grp_name`, `m_code`, `m_name`, `m_page_name`, `mi_status`) VALUES ('0', '".$this->m_grp_code."','".$this->m_grp_name."','".$this->m_code."','".$this->m_name."','".$this->m_page_name."', 'Yes')";
	   $ok=$this->conn->exeQuery($query);
       		
        if($ok){
			
            return true;
        }else{
            return false;
        }
    }
	
	public function update(){

	   //write query
        $query = "update ".$this->table_name." set m_grp_code='".$this->m_grp_code."' , m_grp_name='".$this->m_grp_name."' , m_code='".$this->m_code."' , m_name='".$this->m_name."', m_page_name='".$this->m_page_name."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
			//////$this->updateimg($this->edit_id);
            return true;
        }else{
            return false;
        }
    }
}
$objmodule= new MODULE($db);
?>