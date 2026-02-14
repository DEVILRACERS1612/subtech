<?php
class Login{

    private $conn;
    private $table_name = "mi_sys_user";
	private $reseller_table = "mi_reseller";
 
    // object properties
   
    public $uname;
    public $pass;
     
    public function __construct($db){
        $this->conn = $db;
    }
    // create product
    function login_check(){
 
       $this->uname=htmlspecialchars(strip_tags(trim($this->uname)));
        $this->pass=htmlspecialchars(strip_tags(trim($this->pass)));
        
	   //write query
        $query = "select * from  ".$this->table_name." where user_id='".$this->uname."' and user_auth='".$this->pass."' and mi_status='Yes'";
 
        if($this->conn->num_rows($query)){
			
			$cq = "select * from  ".$this->reseller_table." where user_id='".$this->uname."' and exp_date>'".date("Y-m-d")."' and mi_status='Yes'";
			if($this->conn->num_rows($cq))
			{
				$res=$this->conn->exeQuery($query);
				$row=$res->fetch_assoc();
				$_SESSION[SITE_NAME]['MI_reseller_id']=$row['user_id'];
				$_SESSION[SITE_NAME]['MI_username']=$row['user_name'];
				$_SESSION[SITE_NAME]['MI_Role']=$row['role_code'];
				return 1;
			}else{
				return 2;
			}
        }else{
            return 0;
        }
    }
}
$login= new Login($db);
?>