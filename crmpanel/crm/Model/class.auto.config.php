<?php
class SESSION{
    private $conn;
    private $table_name = "mi_schools_session";
 
    // object properties
   
    public $rdate;
	public $from_date;
	public $to_date;
	public $session_txt;
	public $description;
	
    public $edit_id;
    public $del_id;
    public $permission;
    
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->conn->filterVar($this->rdate);
		$this->from_date=$this->conn->filterVar($this->from_date);
		$this->to_date=$this->conn->filterVar($this->to_date);
		$this->session_txt=$this->conn->filterVar($this->session_txt);
		
        $this->description=$this->conn->filterVar($this->description);
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and from_date='".$this->from_date."' and to_date='".$this->to_date."'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and from_date='".$this->from_date."' and to_date='".$this->to_date."' and id<>'".$this->edit_id."'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function school_session()
	{
		$query="select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		$_SESSION['MISCHOOL_Session']=$row;
		return 0;
	}

	
    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `school_id`, `from_date`, `to_date`, `session_txt`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$this->from_date."','".$this->to_date."','".$this->session_txt."','".$this->description."','No')";
			//echo $query;
			$ok=$this->conn->inserted_id($query);		
			if($ok){
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
		if($this->permission['pg_edit']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
	   		$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`from_date`='".$this->from_date."',`to_date`='".$this->to_date."',`session_txt`='".$this->session_txt."',`description`='".$this->description."' where id='".$this->edit_id."' and school_id='".$_SESSION['MISCHOOL_schoolid']."'";
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
		if($this->permission['pg_delete']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
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
		if($this->permission['pg_view']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['regno']."</td><td>".$row['school_name']."</td><td>".$row['description']."</td><td><a href='".BASE_PATH."Add_Class/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$this->permission."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
	
}
$objsession= new SESSION($db);
?>