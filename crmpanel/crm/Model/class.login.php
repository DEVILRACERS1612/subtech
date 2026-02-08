<?php
class Login{

    private $conn;
    private $table_name = "mi_user";
	private $cmp_table_name = "mi_company";
 
    // object properties
	public $cmp_id;
    public $uname;
    public $pass;
    public $mobile;
    public $otp;
    
    public function __construct($db){
        $this->conn = $db;
    }
	//Login Test
    public function mobile_login_test($tdata,$sch,$mobile)
	{
		$n=count($tdata);
		for($i=0;$i<$n;$i++)
		{
			if(md5($tdata[$i]['cmp_id'])===md5($sch) and md5($tdata[$i]['mobile'])===md5($mobile) )
			{
				return $i;
			}
		}
		return -1;
	}
	public function login_test($tdata,$sch,$name,$pwd)
	{
		$n=count($tdata);
		for($i=0;$i<$n;$i++)
		{
			if(md5($tdata[$i]['cmp_id'])===md5($sch) and md5($tdata[$i]['emp_id'])===md5($name) and md5($tdata[$i]['pwd'])===md5($pwd) )
			{
				return $i;
			}
		}
		return -1;
	}			
	// Login Check
    public function login_check(){
		$this->cmp_id=htmlspecialchars(strip_tags(trim($this->cmp_id)));
		$this->uname=htmlspecialchars(strip_tags(trim($this->uname)));
		$this->pass=htmlspecialchars(strip_tags(trim($this->pass)));
        
	   //write query
        //$query = "select * from  ".$this->table_name." where cmp_id='".$this->cmp_id."' and user_id='".$this->uname."' and pwd='".$this->pass."' and mi_status='Yes'";
		
		$query = $this->conn->exeQuery("select * from ".$this->table_name." where mi_status='Yes'");
		$data=array();
		$i=0;
		while($row=$query->fetch_assoc())
		{
			$data[$i]=$row;
			$i++;
		}
		
		$t=$this->login_test($data,$this->cmp_id,$this->uname,$this->pass);
		//return $t;//data[$t]['cmp_id'];
		if($t>=0){
			$sq = $this->conn->exeQuery("select * from ".$this->cmp_table_name." where cmp_id='".$this->cmp_id."' and exp_date>'".date("Y-m-d")."' and mi_status='Yes'");
			if($sq->num_rows)
			{
				$_SESSION[SITE_NAME]['MICMP_region']=$data[$t]['region'];
				$_SESSION[SITE_NAME]['MICMP_branch']=$data[$t]['branch'];
				$_SESSION[SITE_NAME]['MICMP_mobile']=$data[$t]['mobile'];
				$_SESSION[SITE_NAME]['MICMP_cmpid']=$data[$t]['cmp_id'];
				$_SESSION[SITE_NAME]['MICMP_email']=$data[$t]['email'];
				$_SESSION[SITE_NAME]['MICMP_name']=$data[$t]['username'];
				$_SESSION[SITE_NAME]['MICMP_userid']= $data[$t]['id'];
				$_SESSION[SITE_NAME]['MICMP_usertype']= $data[$t]['user_type'];
				$_SESSION[SITE_NAME]['MICMP_loginid']= $data[$t]['emp_id'];
				
				$prmsql=$this->conn->exeQuery("select * from mi_role_rights where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and emp_id='".$_SESSION[SITE_NAME]['MICMP_userid']."' and mi_status='Yes'");
				$permission=array();
				$per=0;
				while($perrow=$prmsql->fetch_assoc())
				{
					$permission[$per]=$perrow;
					$per++;
				}
				$_SESSION[SITE_NAME]['PAGE_PERMISSION']=$permission;
				return 1;
			}else{
				return 2;
			}	
        }else{
            return 3;
        }
    }

}
$login= new Login($db);
?>