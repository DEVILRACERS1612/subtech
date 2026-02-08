<?php
class IMPORT{

    private $conn;
    private $table_name = "mi_student";
	private $fee_table_name = "mi_stu_fee";
	
    // object properties
    
    public $import_file=NULL;
	public $image=NULL;
    
	public $permission;
    public $edit_id;
	
    
    public function __construct($db){
        $this->conn = $db;

		$this->image=$this->image;
		
	
		$this->import_file=$this->import_file;
		$this->permission=$this->permission;
		
    }
	
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where phone='".$this->phone."' or email='".$this->email."'  and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where phone='".$this->phone."' and email='".$this->email."'  and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	

	public function upload(){
      if($this->permission['pg_create']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			global $objstu;
		   if(($this->import_file["name"])!='')
			{
				$validextensions = array("csv");
				$temporary = explode(".", $this->import_file["name"]);
				$file_extension = end($temporary);
				//echo $file_extension;
				
				if ( in_array($file_extension, $validextensions))
				{
					//////////Find COLUMNS///////
					$csql=$this->conn->exeQuery("SHOW COLUMNS FROM ".$this->table_name);
					$c=0;
					$col=array();
					while($row=$csql->fetch_assoc())
					{
						$col[$c]=$row['Field'];
						$c++;
					}
					//////////////////////////////
					$i=0;
					$fld='(';
					$val='';
					while($i<$c)
					{
						$fld.=$col[$i].",";
						$i++;
					}
					$fld=rtrim($fld,",");
					$fld.=")";
					//echo $fld;
				
					$vlv='';
					$file = $this->import_file['tmp_name'];
					$handle = fopen($file, "r");
					$filesop = fgetcsv($handle, ",");
					$id='0';
				//	(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `acno`, `srno`, `admno`, `stu_type`, `prebal`, `admdate`, `class_id`, `sec_id`, `shift`, `fname`, `lname`, `dob`, `gender`, `religion`, `caste`, `nationality`, `hobbies`, `aadharno`, `father`, `mother`, `contact`, `address`, `vill`, `city`, `distt`, `state`, `pin`, `reference`, `rtedu`, `loginid`, `pwd`, `smsmobile`, `email`, `description`, `image`, `tc`, `birth`, `aadhar`, `block_status`, `stuck_status`, `mi_status`)
					$sql1="INSERT INTO ".$this->fee_table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `rectype`, `recno`, `recdate`, `admno`, `class_id`, `sec_id`, `due_date`, `tdays`, `fee_for_mnth`, `tamt`, `prebalamt`, `latefeeamt`, `pamt`, `lessamt`, `payamt`, `pmode`, `balamt`, `remark`, `mi_status`) VALUES ";
					$n=0;
					while(($filesop = fgetcsv($handle, ",")) !== false)
					{
						if($objstu->check_admno($filesop[2])==0 and $objstu->check_loginid($filesop[27])==0) 
						{
							if($filesop[2]!="")
							{
							$vlv.="('".$id."','".date("Y-m-d H:i:s")."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."',";
							
							for($d=0;$d<$c;$d++)
							{
								if($d==$c-1)
								{
									$vlv.="'Yes',";
								}else if($d==5 and $filesop[$d]!='')
								{
									$vlv.="'".date("Y-m-d",strtotime($this->conn->filterVar($filesop[$d])))."',";
								}
								else if($d==11 and $filesop[$d]!='')
								{
									$vlv.="'".date("Y-m-d",strtotime($this->conn->filterVar($filesop[$d])))."',";
								}
								else if($d==16 or $d==31)
								{
									$vlv.="'','".$this->conn->filterVar($filesop[$d])."',";
									if($d==31)
									{
										$d+=8;
									}
								}
								else if($d==27 )
								{
									$vlv.="'No','".$this->conn->filterVar($filesop[$d])."',";
								}
								else if($d==0 )
								{
									$vlv.="'','".$this->conn->filterVar($filesop[$d])."',";
								}
								else if( $d==40 or $d==41 or $d==42)
								{
									$vlv.="'',";
								}
								else if($d==43 or $d==44)
								{
									$vlv.="'No',";
								}
								else if($d==45)
								{
									$vlv.="";
								}
								else
								{
									$vlv.="'".$this->conn->filterVar($filesop[$d])."',";
								}
								
								
								
							}
							$vlv=rtrim($vlv,",");
							
							$vlv.="),";
							$sql1.="('0', '".date("Y-m-d H:i:s")."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','Prebal','','".date("Y-m-d")."','".$filesop[2]."','".$filesop[6]."','".$filesop[7]."','','','','','".$filesop[4]."','','','','','','','','Yes'),";
							
							$n++;
							}
							
							
							
						}else{
							return 2;
						}
					
					}
					$sql1=rtrim($sql1,",");
					$sql=rtrim($sql,",");
					$vlv=rtrim($vlv,",");
					//echo $n.$vlv;
					//return "INSERT INTO mi_student ".$fld." VALUES ".$vlv."";
					$sql = $this->conn->exeQuery("INSERT INTO ".$this->table_name." ".$fld." VALUES ".$vlv."");
					$this->conn->exeQuery($sql1);
					
					if($sql){
						return 4;
					}else{
						return 3;
					}
						
				}
				else
				{
					return 1;
				}
			}else{
				return 6;
			}
		}else{
			return 5;
		}
    }
	
	public function upload_photo()
	{
		$n=sizeof($this->image);
		
		if($n>0)
		{	$i=0;
			while($i<$n)
			{
				if($this->image["name"][$i]!=''){
				   
				   $exp = explode(".", $this->image["name"][$i]);
				   $extension = end($exp);
				   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
				   {
						$imagename=$this->image["name"][$i];
						$filename=$imagename;
						move_uploaded_file($this->image["tmp_name"][$i], "../images/stu_img/".$filename);
						//$query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
				   }
				  
			   }
			   $i++;
			}
			return true; 
		}else{
			return false; 
		}
		
       
    
	}
	
	
}
$objimport= new IMPORT($db);
?>