<?php
class BOOKLATEFEE{
    private $conn;
    private $table_name = "mi_book_late_fee";
 
    // object properties
   
    public $rdate;
	public $latefeeday;
	public $latefee;
	public $description;
	
    public $edit_id;
    public $del_id;
    public $permission;
    
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->conn->filterVar($this->rdate);
		$this->latefee=$this->conn->filterVar($this->latefee);
		$this->latefeeday=$this->conn->filterVar($this->latefeeday);
        $this->description=$this->conn->filterVar($this->description);
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."'  and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function latefee_detail()
	{
		$query="select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row;
	}

    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `school_id`,`sess_year`, `user_id`, `latefeeday`, `latefee`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['sess_year']."','".$_SESSION['MISCHOOL_userid']."',".$this->latefeeday.",".$this->latefee.",'".$this->description."','Yes')";
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
		if($this->permission['pg_edit']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
	   		$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`latefeeday`='".$this->latefeeday."',`latefee`='".$this->latefee."',`description`='".$this->description."' where id='".$this->edit_id."' and school_id='".$_SESSION['MISCHOOL_schoolid']."'";
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
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$row['latefeeday']."</td><td>".$row['latefee']."</td><td>".$row['description']."</td><td><a href='".BASE_PATH."Book_Late_Fee/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delfe' data-id='".$row['id']."' data-per='".$this->permission."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}

}
$objblatefee= new BOOKLATEFEE($db);
?>