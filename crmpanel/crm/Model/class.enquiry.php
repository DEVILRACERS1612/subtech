<?php
class ENQUIRY{
    private $conn;
    private $table_name = "mi_enq_student";
	private $stu_table_name = "mi_student";
	private $ref_table_name = "mi_reference";
	
    public $rdate;
	public $acno;
	public $regid;
	public $class_id;
	public $sname;
	public $dob;
	public $doe;
	public $gender;
	public $father;
	public $mother;
	public $post;
	public $vill;
	public $city;
	public $distt;
	public $state;
	public $reference;
	public $newref;
	public $preschool;
	public $amount;
	public $mobile;
	
	
    public $edit_id;
    public $del_id;
    public $permission;
    
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->sname=$this->sname;
		$this->regid=$this->regid;
		$this->doe=$this->doe;
		$this->class_id=$this->class_id;
		$this->dob=$this->dob;
		$this->gender=$this->gender;
		$this->father=$this->father;
		$this->mother=$this->mother;
		$this->vill=$this->vill;
		$this->city=$this->city;
		$this->distt=$this->distt;
		$this->state=$this->state;
		$this->reference=$this->reference;
		$this->newref=$this->newref;
		$this->mobile=$this->mobile;
		$this->preschool=$this->preschool;
		$this->amount=$this->amount;
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and regid='".$this->regid."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and regid='".$this->regid."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	
	public function total_student()
	{
		$query="select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes'";
		$allstu=array();
		$qr=$this->conn->exeQuery($query);
		$i=0;
		while($row=$qr->fetch_assoc())
		{
			$allstu[$i]=$row;
			$i++;
		}
		return $allstu;
	}
	
	public function total_no_student()
	{
		$query="select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$n=$qr->num_rows;
		return $n;
	}
	public function all_student()
	{
		$query="select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."'  and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		//$row=$qr->fetch_assoc();
		//$_SESSION['MISCHOOL_Profile']=$row;
		return $qr;
	}
	
	
	public function student_detail($regid)
	{
		$query="select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and regid='".$regid."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row;
	}

	
    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			if($this->newref!="" and $this->reference=='New')
			{
				$query = "INSERT INTO ".$this->ref_table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `refname`, `mobile`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['MISCHOOL_Session']['session_txt']."','".$this->newref."','','','Yes')";
				$ref=$this->conn->inserted_id($query);
			}else{
				$ref=$this->reference;
			}
			
			
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `regid`, `sname`, `father`, `mother`, `dob`, `gender`, `class_id`, `preschool`, `mobile`, `city`, `vill`, `post`, `distt`, `reference`, `doe`, `amount`, `adm_status`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['MISCHOOL_Session']['session_txt']."','".$this->regid."','".$this->sname."','".$this->father."','".$this->mother."','".$this->dob."','".$this->gender."','".$this->class_id."','".$this->preschool."','".$this->mobile."','".$this->city."','".$this->vill."','".$this->post."','".$this->distt."','".$ref."','".$this->doe."','".$this->amount."','No','Yes')";
			
			
			$ok=$this->conn->inserted_id($query);		
			if($ok){
				
				/////////////// SMS ////////////////
				/*global $objsmsset;
				$pg=explode(",",$objsmsset->valid_sms_page());
				if(in_array("stu_admission_page",$pg))
				{
					global $objsms;global $objclass;global $objsection;
					$objsms->mobile=$this->smsmobile;
					$msg="Your warden ".$this->sname." ".$this->lname." has been successfully admitted in class-".$objclass->class_name($this->class_id)."(".$objsection->section_name($this->sec_id).") at ".$_SESSION['MISCHOOL_Profile']['school_name']."(".$_SESSION['MISCHOOL_Profile']['address']."). His/her admission no is ".$this->regid;
					$objsms->message=$msg;
					$objsms->send_sms();
				}*/
				/////////////// SMS ////////////////
				
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
	   		if($this->newref!="" and $this->reference=='New')
			{
				$query = "INSERT INTO ".$this->ref_table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `refname`, `mobile`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['MISCHOOL_Session']['session_txt']."','".$this->newref."','','','Yes')";
				$ref=$this->conn->inserted_id($query);
			}else{
				$ref=$this->reference;
			}
			
			$query = "update ".$this->table_name." set `user_id`='".$_SESSION['MISCHOOL_userid']."',`regid`='".$this->regid."',`sname`='".$this->sname."',`father`='".$this->father."',`mother`='".$this->mother."', `class_id`='".$this->class_id."',`dob`='".$this->dob."',`preschool`='".$this->preschool."',`gender`='".$this->gender."',`mobile`='".$this->mobile."',`vill`='".$this->vill."', `city`='".$this->city."',`distt`='".$this->distt."',`post`='".$this->post."',`reference`='".$ref."',`doe`='".$this->doe."',`amount`='".$this->amount."' WHERE `school_id`='".$_SESSION['MISCHOOL_schoolid']."' and `sess_year`='".$_SESSION['sess_year']."' and regid='".$this->regid."'";

			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}/*return $query;*/
		}else{
			return false;
		}
		
    }

	public function deleteme(){
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$sok=$this->conn->exeQuery("delete from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and id='".$this->del_id."'");
			
			if($sok){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function view(){
		global $objclass;global $objstu;
		if($this->permission['pg_view']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$cl=($row['adm_status']=='Yes')?"style='background:lightgreen;'":"";
				$str.= "<tr ".$cl."><td>".$i."</td><td>".$row['regid']."</td><td>".date("d-M-Y",strtotime($row['rdate']))."</td><td>".$row['sname']."</td><td>".$objclass->class_name($row['class_id'])."</td><td>".$row['father']."</td><td>".$row['mother']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$objstu->ref_name($row['reference'])."</td><td>".$row['adm_status']."</td>";
												
				$str.= "<td>";
				if($row['adm_status']=='No')
				{
				$str.= "<a href='".BASE_PATH."student-admission/Enq/".$row['id']."/' title='Admission' class='btn btn-primary btn-xs'><i class='fa fa-plus'></i></a>";
				}
				$str.= "<a href='".BASE_PATH."enquiry-student/Edit/".$row['id']."/' title='Edit' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' title='Delete' ><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
	
}
$objenq= new ENQUIRY($db);
?>