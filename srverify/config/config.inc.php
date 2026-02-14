<?php
error_reporting(0);
session_start();
date_default_timezone_set("Asia/Kolkata");
$post_id=md5(session_id());

if($_SERVER['HTTP_HOST']=="localhost")
{
	define("MAIN_PATH","http://localhost/subtech.in/srverify/");
	define("BASE_PATH","http://localhost/subtech.in/srverify/");
	define("WEB_PATH","http://localhost/subtech.in/crmpanel/");
	define("APP_PATH","http://localhost/crmpanel/microerpapp/");
	
	define("LOCAL_PATH","./");
	define("IMG_PATH","http://localhost/subtech.in/crmpanel/");
	define("LOCAL_IMG_PATH",BASE_PATH."img/");
	define("SITE_NAME","crmpanel");
	
	define("LOCALHOST","localhost");
	define("USERNAME","root");
	define("PASSWORD","");
	define("DATABASE","subtech");
	
}	
else
{
	define("BASE_PATH","https://www.subtech.in/srverify/");
	define("WEB_PATH","https://www.subtech.in/");
	define("IMG_PATH","https://www.subtech.in/crmpanel/");
	//define("APP_PATH","https://microelectra.in/erp/microerpapp/");
	define("LOCAL_PATH","./");
	define("IMG_PATH",BASE_PATH."funimg/");
	define("LOCAL_IMG_PATH",BASE_PATH."img/");
	//define("INNER_IMG_PATH",BASE_PATH."img/");
	
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
    public function __construct(){
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
    public function exeQuery($sql){
		$data = $this->db->query($sql);
       // $data = $result->fetch_assoc();
        return !empty($data)?$data:false;
    }
	/*public function fetchAssoc(){
		//$result = $this->db->query($sql);
        $data = $this->fetch_assoc();
        return !empty($data)?$data:false;
    }*/
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
	
	
    /*
     * Returns rows from the database based on the conditions
     * @param string name of the table
     * @param array select, where, order_by, limit and return_type conditions
     */
    public function getRows($table,$conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$table;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }
        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }
        
        $result = $this->db->query($sql);
        
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = $result->num_rows;
                    break;
                case 'single':
                    $data = $result->fetch_assoc();
                    break;
                default:
                    $data = '';
            }
        }else{
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
            }
        }
        return !empty($data)?$data:false;
    }
    
    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function insert($table,$data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
            if(!array_key_exists('created',$data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $columns .= $pre.$key;
                $values  .= $pre."'".$val."'";
                $i++;
            }
            $query = "INSERT INTO ".$table." (".$columns.") VALUES (".$values.")";
            $insert = $this->db->query($query);
            return $insert?$this->db->insert_id:false;
        }else{
            return false;
        }
    }
    
    /*
     * Update data into the database
     * @param string name of the table
     * @param array the data for updating into the table
     * @param array where condition on updating data
     */
    public function update($table,$data,$conditions){
        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $query = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            $update = $this->db->query($query);
            return $update?$this->db->affected_rows:false;
        }else{
            return false;
        }
    }
    
    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
    public function delete($table,$conditions){
        $whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $query = "DELETE FROM ".$table.$whereSql;
        $delete = $this->db->query($query);
        return $delete?true:false;
    }
}
global $db;
$db=new DB();
//////////////////////////////// Another Table/Class /////////////////////////

?>