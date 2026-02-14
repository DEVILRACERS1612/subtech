<?php
class EXPENSES{

    private $conn;
    private $table_name = "mi_office_exp";
 
    // object properties
    public $rdate;
	public $dep_id;
	public $desi_id;
	public $doe;
    public $exat;
	public $empid;
	public $vehicle;
	public $bname;
	public $amount;
	public $pmode;
	public $chequed;
	public $image=NULL;
    public $remark;
    public $edit_id;
    public $del_id;
    public $permission;
	
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->dep_id=$this->dep_id;
		$this->desi_id=$this->desi_id;
		$this->doe=$this->doe;
		$this->exat=$this->exat;
		$this->empid=$this->empid;
		$this->vehicle=$this->vehicle;
		$this->bname=$this->bname;
		$this->amount=$this->amount;
		$this->chequed=$this->chequed;
		$this->pmode=$this->pmode;
		$this->image=$this->image;
        $this->remark=$this->remark;
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and dep_id='".$this->dep_id."' and desi_id='".$this->desi_id."' and exat='".$this->exat."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and dep_id='".$this->dep_id."' and desi_id='".$this->desi_id."' and exat='".$this->exat."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}

    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `doe`, `exat`, `dep_id`, `desi_id`, `empid`, `vehicle`, `bname`, `amount`, `pmode`, `chequed`, `image`, `remark`, `mi_status`) VALUES ('0','".$this->rdate."', '".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$this->doe."','".$this->exat."','".$this->dep_id."','".$this->desi_id."','".$this->empid."','".$this->vehicle."','".$this->bname."','".$this->amount."','".$this->pmode."','".$this->chequed."','','".$this->remark."','Yes')";
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
			move_uploaded_file($this->image["tmp_name"], "../images/exp_img/".$filename);
		   $query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
	   }else{
		   return true;
	   }
      
	   //write query
        
    }
public function update(){
      
      $this->edit_id=$this->conn->filterVar($this->edit_id);
      if($this->permission['pg_edit']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
        $query = "update ".$this->table_name." set `school_id`='".$_SESSION['MISCHOOL_schoolid']."',`exat`='".$this->exat."',`dep_id`='".$this->dep_id."',`desi_id`='".$this->desi_id."',`empid`='".$this->empid."',`vehicle`='".$this->vehicle."',`bname`='".$this->bname."',`amount`='".$this->amount."',`pmode`='".$this->pmode."',`doe`='".$this->doe."',`chequed`='".$this->chequed."', `remark`='".$this->remark."' where id='".$this->edit_id."'";
				
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
			$picture='../images/exp_img/'.$r['image'];
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
			global $objdep;global $objdesignation;
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				if($row['image']!=''){
					$img="<img src='".BASE_PATH."images/exp_img/".$row['image']."' style='height:50px;' />";
				}
				$str.="<tr><td>".$i."</td><td>".date("d-M-Y",strtotime($row['doe']))."</td><td>".$row['exat']."</td><td>".$row['amount']."</td><td>".$row['pmode']."</td><td>".$row['remark']."</td><td>".$img."</td><td><a href='".BASE_PATH."Add_Expenses/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$this->permission."'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
}
$objexp= new EXPENSES($db);
?>