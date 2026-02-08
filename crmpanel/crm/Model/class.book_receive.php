<?php
class BOOKRECEIVE{

    private $conn;
    private $table_name = "mi_book_receive";
	private $issue_table_name = "mi_book_issue";
	private $receive_detail_table_name = "mi_book_receive_detail";
    
    public $rdate;
	public $recno;
	public $recdate;
	public $admno;
	public $total;
	public $disc;
	public $payamt;
	public $pmode;
	public $description;
	
	public $tdays;
	public $book_id;
	public $exdays;
	public $i_date;
	public $charge;
	public $r_status;
	
    public $edit_id;
    public $del_id;
    public $permission;
	
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->recdate=$this->recdate;
		$this->admno=$this->admno;
		$this->total=$this->total;
		$this->disc=$this->disc;
		$this->payamt=$this->payamt;
		$this->pmode=$this->pmode;
		$this->book_id=$this->book_id;
		$this->tdays=$this->tdays;
		$this->exdays=$this->exdays;
		$this->i_date=$this->i_date;
		$this->charge=$this->charge;
		$this->r_status=$this->r_status;
		$this->description=$this->description;
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and recno='".$this->recno."' and mi_status='Yes'"))
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and recno='".$this->recno."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
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
			$adq=$this->conn->exeQuery("select max(recno) as recno from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."'");
			$ad=$adq->fetch_assoc();
			if($ad['recno']==$this->recno)
			{
				$i=intval($ad['recno'])+1;
				$this->recno=$i;
			}
				
			
			$q="INSERT INTO ".$this->receive_detail_table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `recno`, `recdate`, `admno`, `book_id`, `i_date`, `tdays`, `exdays`, `charge`, `r_status`, `mi_status`) VALUES ";
			$n=count($this->r_status);
			for($i=0;$i<$n;$i++)
			{
				if($this->r_status[$i]=='Yes')
				{
					$q.="('0','".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$this->recno."','".$this->recdate."','".$this->admno."','".$this->conn->filterVar($this->book_id[$i])."','".$this->conn->filterVar($this->i_date[$i])."','".$this->conn->filterVar($this->tdays[$i])."','".$this->conn->filterVar($this->exdays[$i])."','".$this->conn->filterVar($this->charge[$i])."','".$this->conn->filterVar($this->r_status[$i])."','Yes'),";
					
					$this->conn->exeQuery("update ".$this->issue_table_name." set rec_status='Yes' where school_id='".$_SESSION['MISCHOOL_schoolid']."' and i_date='".$this->conn->filterVar($this->i_date[$i])."' and admno='".$this->admno."' and book_id='".$this->conn->filterVar($this->book_id[$i])."' and mi_status='Yes'");
				}
			}
			$q=rtrim($q,",");
			$ok=$this->conn->exeQuery($q);

			if($ok){
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `recno`, `recdate`, `admno`, `total`, `disc`, `payamt`, `pmode`, `description`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$this->recno."','".$this->recdate."','".$this->admno."','".$this->total."','".$this->disc."','".$this->payamt."','".$this->pmode."','".$this->description."','Yes')";
			$ok=$this->conn->inserted_id($query);
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
        $this->deleteme();
		
		$q="INSERT INTO ".$this->receive_detail_table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `recno`, `recdate`, `admno`, `book_id`, `i_date`, `tdays`, `exdays`, `charge`, `r_status`, `mi_status`) VALUES ";
			$n=count($this->r_status);
			for($i=0;$i<$n;$i++)
			{	
				$this->conn->exeQuery("update ".$this->issue_table_name." set rec_status='".$this->r_status[$i]."' where school_id='".$_SESSION['MISCHOOL_schoolid']."' and i_date='".$this->conn->filterVar($this->i_date[$i])."' and admno='".$this->admno."' and book_id='".$this->conn->filterVar($this->book_id[$i])."' and mi_status='Yes'");
				
				if($this->r_status[$i]=='Yes')
				{
					$q.="('0','".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$this->recno."','".$this->recdate."','".$this->admno."','".$this->conn->filterVar($this->book_id[$i])."','".$this->conn->filterVar($this->i_date[$i])."','".$this->conn->filterVar($this->tdays[$i])."','".$this->conn->filterVar($this->exdays[$i])."','".$this->conn->filterVar($this->charge[$i])."','".$this->conn->filterVar($this->r_status[$i])."','Yes'),";
					
					
				}
			}
			$q=rtrim($q,",");
			$ok=$this->conn->exeQuery($q);

			if($ok){
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `recno`, `recdate`, `admno`, `total`, `disc`, `payamt`, `pmode`, `description`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$this->recno."','".$this->recdate."','".$this->admno."','".$this->total."','".$this->disc."','".$this->payamt."','".$this->pmode."','".$this->description."','Yes')";
			$ok=$this->conn->inserted_id($query);
				return true;
			}else{
				return true;
			}

	}else{
			return false;
		}
   }
	public function deleteme(){
      
		//$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			/*$q=$this->conn->exeQuery("select * from ".$this->table_name." where id='".$this->del_id."' and mi_status='Yes'");
			$r=$q->fetch_assoc();
			$picture='../images/book_img/'.$r['image'];
			chmod($picture, 0644);
			unlink($picture);*/
			$query=$this->conn->exeQuery("delete from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and recno='".$this->recno."' and mi_status='Yes'");			
			$query="delete from ".$this->receive_detail_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and recno='".$this->recno."' and mi_status='Yes'";
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
				
				echo "<tr><td>".$i."</td><td>".date("d-M-Y",strtotime($row['i_date']))."</td><td>".$objstu->student_name_detail($row['admno'])."</td><td>".$bk['b_name']."</td><td>".$bk['language']."</td><td>".$bk['author']."</td><td>".$bk['edition']."</td><td>".$img."</td><td>".$row['description']."</td><td><a href='".BASE_PATH."Add_Book_Receive/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	public function issued_book(){

		global $objstu; global $objbook; global $objblatefee;
		$qr=$this->conn->exeQuery("select * from ".$this->issue_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and admno='".$this->admno."' and rec_status='No' and mi_status='Yes'");
		$fee=$objblatefee->latefee_detail();
		$dd=$fee['latefeeday'];
		$lfee=$fee['latefee'];
		$str="<table class='table table-bordered table-striped table-hover'><thead><tr><th>Sr.No.</th><th>Book</th><th>Issue Date</th><th>Total Day</th><th>Extra Day</th><th>Charge ( &#8377; ".$lfee."/day)</th><th>Received</th></tr></thead><tbody>";
		$i=1;
		
		if($qr->num_rows)
		{
			$total=0;
			while($row=$qr->fetch_assoc())
			{
				$bk=$objbook->book_data($row['book_id']);
				if($bk['image']!=''){
					$img="<img src='".BASE_PATH."images/book_img/".$bk['image']."' style='height:50px;' />";
				}
				$date1=date_create($row['i_date']);
				$date2=date_create(date("Y-m-d"));
				$diff=date_diff($date1,$date2);
				$d=$diff->format("%a");
				$cd=($d>$dd)?$d-$dd:0;
				$tc=$cd*$lfee;
				$total+=$tc;
				$str.="<tr><td>".$i.".<input type='hidden' name='book_id[]' value='".$bk['id']."' /><input type='hidden' name='i_date[]' value='".$row['i_date']."' /><input type='hidden' name='tdays[]' value='".$d."' /><input type='hidden' name='exdays[]' value='".$cd."' /><input type='hidden' name='charge[]' value='".$tc."' /></td><td>".$bk['b_name']."</td><td>".date("d-M-Y",strtotime($row['i_date']))."</td><td>".$d."</td><td>".$cd."</td><td>".$tc."</td><td><select name='r_status[]'><option value='No'>No</option><option value='Yes'>Yes</option></select></td></tr>";
				$i++;
			}
			$str.="</tbody></table><div class='row'><div class='col-md-3 col-sm-12'><div class='form-group'><label>Total Charge</label><input class='form-control' id='total' name='total' value='".$total."' readonly /></div></div><div class='col-md-3 col-sm-12'><div class='form-group'><label>Discount </label><input class='form-control' id='disc' name='disc' value='' /></div></div><div class='col-md-3 col-sm-12'><div class='form-group'><label>Payable Amount </label><input class='form-control' id='payamt' name='payamt' value='".$total."' readonly /></div></div><div class='form-group col-md-3 col-sm-12'><label>Pay Mode</label><div class='form-group'><select class='form-control' name='pmode'><option value='Cash'>Cash</option><option value='Cheque'>Cheque</option><option value='Online Transfer'>Online Transfer</option></select></div></div></div>";
			
		}else{
			$str.="<tr><th colspan='7'><h4><span class='text-danger'>No any book Pending for Receive</span></h4></th></tr>";
		}
		$str.="</tbody></table>";
		
		return $str;
		
	}
	
}
$objbookreceive= new BOOKRECEIVE($db);
?>