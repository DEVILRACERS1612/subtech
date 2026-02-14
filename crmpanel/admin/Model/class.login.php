<?php
class Login{

    private $conn;
    private $table_name = "mi_sys_user";
 
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
			$res=$this->conn->exeQuery($query);
			$row=$res->fetch_assoc();
			$_SESSION[SITE_NAME]['MI_admin_id']=$row['user_id'];
			$_SESSION[SITE_NAME]['MI_username']=$row['user_name'];
			$_SESSION[SITE_NAME]['MI_Role']=$row['role_code'];
			
            return true;
        }else{
            return false;
        }
    }
}
$login= new Login($db);
?>