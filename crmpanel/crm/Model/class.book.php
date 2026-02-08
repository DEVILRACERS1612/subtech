<?php
class BOOK{

    private $conn;
    private $table_name = "mi_book";
	private $issue_table_name = "mi_book_issue";
	private $receive_table_name = "mi_book_receive";
 
    // object properties
    public $rdate;
    public $isbn_no;
	public $cat_id;
	public $b_code;
	public $b_name;
	public $language;
	public $author;
	public $edition;
	public $price;
	public $publication;
	public $qty;
	public $binding;
	public $image=NULL;
    public $description;
	
	
    public $edit_id;
    public $del_id;
    public $permission;
	
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->isbn_no=$this->isbn_no;
		$this->cat_id=$this->cat_id;
		$this->b_code=$this->b_code;
		$this->b_name=$this->b_name;
		$this->language=$this->language;
		$this->author=$this->author;
		$this->edition=$this->edition;
		$this->publication=$this->publication;
		$this->price=$this->price;
		$this->qty=$this->qty;
		$this->binding=$this->binding;
		
		$this->image=$this->image;
        $this->description=$this->description;
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and cat_id='".$this->cat_id."' and isbn_no='".$this->isbn_no."' and b_code='".$this->b_code."' and mi_status='Yes'"))
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and cat_id='".$this->cat_id."' and isbn_no='".$this->isbn_no."' and b_code='".$this->b_code."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function book_qoh($itm)
	{
		$op=0;$dr=0;$cr=0;
		$q1=$this->conn->exeQuery("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and id='".$itm."' and mi_status='Yes'");
		$qr=$q1->fetch_assoc();
		$op=$qr['qty'];
		
		$q2=$this->conn->exeQuery("select * from ".$this->issue_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and  book_id='".$itm."' and rec_status='No' and mi_status='Yes'");
		//$qr1=$q2->fetch_assoc();
		$cr=$q2->num_rows;
		
		$q3=$this->conn->exeQuery("select * from ".$this->issue_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and  book_id='".$itm."' and rec_status='Yes' and mi_status='Yes'");
		//$qr1=$q2->fetch_assoc();
		$dr=$q3->num_rows;
		


		$bal=($op-$cr);
		return $bal;
	}
	public function book_data($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row;
	}
	public function book_name($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['b_name'];
	}
	/// Raw List
	public function book_list($id='')
	{
		global $objbcat;
		$str='<option value="">--Select--</option>';
		
		$query="select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['b_name'].'-'.$row['author'].'-'.$objbcat->cate_name($row['cat_id']).'</option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['b_name'].'-'.$row['author'].'-'.$objbcat->cate_name($row['cat_id']).' </option>';
			}
		}
		return $str;
	}
	public function book_cat_list($catid,$id='')
	{
		$str='<option value="">--Select--</option>';
		$query="select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and cat_id='".$catid."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['b_name'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['b_name'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `cat_id`, `isbn_no`, `b_code`, `b_name`, `author`, `edition`, `publication`, `price`, `qty`, `language`, `binding`, `description`, `image`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$this->cat_id."','".$this->isbn_no."','".$this->b_code."','".$this->b_name."','".$this->author."','".$this->edition."','".$this->publication."','".$this->price."','".$this->qty."','".$this->language."','".$this->binding."','".$this->description."','','Yes')";
			$ok=$this->conn->inserted_id($query);		
			if($ok){
				$this->updateimg($ok);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	 public function updateimg($id){
       if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   $imagename=$_SESSION['MISCHOOL_schoolid']."_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../images/book_img/".$filename);
		   $query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
	   }else{
		   return true;
	   }
 
    }
public function update(){
      
      $this->edit_id=$this->conn->filterVar($this->edit_id);
      if($this->permission['pg_edit']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
        $query = "update ".$this->table_name." set `cat_id`='".$this->cat_id."',`b_code`='".$this->b_code."',`b_name`='".$this->b_name."',`author`='".$this->author."',`edition`='".$this->edition."',`qty`='".$this->qty."',`publication`='".$this->publication."',`price`='".$this->price."',`binding`='".$this->binding."',`isbn_no`='".$this->isbn_no."',`language`='".$this->language."', `description`='".$this->description."' where id='".$this->edit_id."' and `school_id`='".$_SESSION['MISCHOOL_schoolid']."'";
				
        if($this->conn->exeQuery($query)){
			$this->updateimg($this->edit_id);
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
			$q=$this->conn->exeQuery("select * from ".$this->table_name." where id='".$this->del_id."' and mi_status='Yes'");
			$r=$q->fetch_assoc();
			$picture='../images/book_img/'.$r['image'];
			chmod($picture, 0644);
			unlink($picture);
						
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
			global $objbcat;global $objunit;
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				if($row['image']!=''){
					$img="<img src='".BASE_PATH."images/book_img/".$row['image']."' style='height:50px;' />";
				}
				$str.="<tr><td>".$i."</td><td>".$row['isbn_no']."</td><td>".$row['b_code']."</td><td>".$objbcat->cate_name($row['cat_id'])."</td><td>".$row['b_name']."</td><td>".$row['language']."</td><td>".$row['author']."</td><td>".$row['edition']."</td><td>".$row['qty']."</td><td>".($row['id'])."</td><td>".$row['description']."</td><td>".$img."</td><td><a href='".BASE_PATH."Add_Book/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
}
$objbook= new BOOK($db);
?>