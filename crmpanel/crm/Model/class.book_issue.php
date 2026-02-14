<?php
class BOOKISSUE{

    private $conn;
    private $table_name = "mi_book_issue";
	private $issue_table_name = "mi_book_issue";
	private $receive_table_name = "mi_book_receive";
    
	public $rdate;
    public $book_id;
	public $i_date;
	public $description;
	
	
    public $edit_id;
    public $del_id;
    public $permission;
	
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->book_id=$this->book_id;
		$this->i_date=$this->i_date;
		$this->description=$this->description;
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and admno='".$this->admno."' and rec_status='No' and book_id='".$this->book_id."' and mi_status='Yes'"))
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and admno='".$this->admno."' and rec_status='No' and book_id='".$this->book_id."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}

/*	public function book_name($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['i_date'];
	}*/
    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `i_date`, `book_id`, `admno`, `description`, `rec_status`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$this->i_date."','".$this->book_id."','".$this->admno."','".$this->description."','No','Yes')";
			$ok=$this->conn->inserted_id($query);		
			if($ok){
				//$this->updateimg($ok);
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
        $query = "update ".$this->table_name." set `book_id`='".$this->book_id."',`i_date`='".$this->i_date."', `description`='".$this->description."' where id='".$this->edit_id."' and `school_id`='".$_SESSION['MISCHOOL_schoolid']."'";
				
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
			/*$q=$this->conn->exeQuery("select * from ".$this->table_name." where id='".$this->del_id."' and mi_status='Yes'");
			$r=$q->fetch_assoc();
			$picture='../images/book_img/'.$r['image'];
			chmod($picture, 0644);
			unlink($picture);*/
						
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
			global $objstu;global $objbook;
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$bk=$objbook->book_data($row['book_id']);
				if($bk['image']!=''){
					$img="<img src='".BASE_PATH."images/book_img/".$bk['image']."' style='height:50px;' />";
				}
				
				echo "<tr><td>".$i."</td><td>".date("d-M-Y",strtotime($row['i_date']))."</td><td>".$objstu->student_name_detail($row['admno'])."</td><td>".$bk['b_name']."</td><td>".$bk['language']."</td><td>".$bk['author']."</td><td>".$bk['edition']."</td><td>".$img."</td><td>".$row['description']."</td><td><a href='".BASE_PATH."Add_Book_Issue/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
}
$objbookissue= new BOOKISSUE($db);
?>