<?php
class FEATURE{

    private $conn;
    private $table_name = "mi_feature";
	
    // object properties
   
    public $f_code;
	public $m_code;
	public $f_name;
	public $f_page_name;
	   
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->f_code=$this->f_code;
		$this->m_code=$this->m_code;
		$this->f_name=$this->f_name;
		$this->f_page_name=$this->f_page_name;
		
		$this->edit_id=$this->edit_id;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			$pq=$this->conn->num_rows("select * from ".$this->table_name." where m_code='".$this->m_code."' and f_code='".$this->f_code."'  and f_name='".$this->f_name."' and f_page_name='".$this->f_page_name."' and  mi_status='Yes'");
			
			if($pq )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where m_code='".$this->m_code."' and f_code='".$this->f_code."'  and f_name='".$this->f_name."' and f_page_name='".$this->f_page_name."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function feature_name($id)
	{
		//global $objcat;global $objcolor;
		$query="select * from ".$this->table_name." where f_code='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['f_name'];
	}
	/// Raw List
	public function feature_list($id='')
	{
		$str='<option value="">--Select--</option>';
		$query="select * from ".$this->table_name." where mi_status='Yes' group by f_code order by f_name asc";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['f_code'])
			{
				$str.='<option value="'.$row['f_code'].'" selected>'.$row['f_name'].'</option>';
			}else{
			$str.='<option value="'.$row['f_code'].'">'.$row['f_name'].'</option>';
			}
		}
		
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   //write query
	   $query = "INSERT INTO ".$this->table_name."(`id`, `m_code`, `f_code`, `f_name`, `f_page_name`, `mi_status`) VALUES ('0', '".$this->m_code."','".$this->f_code."','".$this->f_name."','".$this->f_page_name."', 'Yes')";
	   $ok=$this->conn->exeQuery($query);
       		
        if($ok){
			
            return true;
        }else{
            return false;
        }
    }
	
	public function update(){

	   //write query
        $query = "update ".$this->table_name." set m_code='".$this->m_code."' ,f_code='".$this->f_code."' , f_name='".$this->f_name."', f_page_name='".$this->f_page_name."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
			//$this->updateimg($this->edit_id);
            return true;
        }else{
            return false;
        }
    }
}
$objfeature= new FEATURE($db);
?>