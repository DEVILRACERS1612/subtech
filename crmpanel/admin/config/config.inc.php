<?php
session_start();
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");


if($_SERVER['HTTP_HOST']=="localhost")
{
	define("BASE_PATH","/crmpanel/admin/");
	define("WEB_PATH","/crmpanel/");
	define("RESELLER_PATH","/crmpanel/reseller/");
	define("IMG_PATH",BASE_PATH."funimg/");
	define("LOCAL_IMG_PATH",BASE_PATH."img/");
	define("SITE_NAME","localcrmpanel");
	
	define("LOCALHOST","localhost");
	define("USERNAME","root");
	define("PASSWORD","");
	define("DATABASE","crm_db");
	
}	
else
{
	define("BASE_PATH","https://subtech.in/crmpanel/admin/");
	define("WEB_PATH","https://subtech.in/crmpanel/");
	define("LOCAL_PATH","./");
	define("RESELLER_PATH","/crmpanel/reseller/");
	//define("IMG_PATH", BASE_PATH."funimg/");
	//define("LOCAL_IMG_PATH",BASE_PATH."img/");
	//define("INNER_IMG_PATH",BASE_PATH."img/");
	
	define("SITE_NAME","webadmincrmpanel");
	
	define("LOCALHOST","localhost");
	define("USERNAME","subtech_user");
	define("PASSWORD","w.Y_IMgIHX(w");
	define("DATABASE","subtech_db");
}
//////////////////////
class DB{
    private $dbHost     = LOCALHOST;//"localhost";
    private $dbUsername = USERNAME;//"root";
    private $dbPassword = PASSWORD;//"";
    private $dbName = DATABASE;//"burka";
	private $data='';
	private $result='';
    private $db=NULL;
 /* */  public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: ".$conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
	public function __destruct() {
		if($this->db){
			$this->dbHost=NULL;
			$this->dbUsername=NULL;
			$this->dbPassword=NULL;
			$this->dbName=NULL;
			$this->db = NULL;
		}
	}
    public function exeQuery($sql){
		$data = $this->db->query($sql);
       // $data = $result->fetch_assoc();
        return !empty($data)?$data:false;
    }

	public function num_rows($sql){
        $result = $this->db->query($sql);
        $data = $result->num_rows;
        return !empty($data)?$data:false;
    }
	public function inserted_id($sql){
        $data = $this->db->query($sql);
        return $data?$this->db->insert_id:false;
        
    }
	public function filterVar($val)
	{
		return $this->db->real_escape_string(((trim($val))));
	}
	


   
    
}
//global $db;
$db=new DB();
//////////////////////////////// Another Table/Class /////////////////////////

?>