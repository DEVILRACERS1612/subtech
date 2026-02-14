<?php
error_reporting(0);
session_start();
date_default_timezone_set("Asia/Kolkata");
$post_id=md5(session_id());

if($_SERVER['HTTP_HOST']=="localhost")
{
	define("MAIN_PATH","http://localhost/subtech.in/");
	define("BASE_PATH","http://localhost/subtech.in/");
	define("WEB_PATH","http://localhost/subtech.in/");
	define("IMG_PATH","http://localhost/subtech/crmpanel/");
	define("LOCAL_PATH","./");
	define("IMG_PATH",BASE_PATH."funimg/");
	define("LOCAL_IMG_PATH",BASE_PATH."img/");
	define("SITE_NAME","subtech");
	
	define("LOCALHOST","localhost");
	define("USERNAME","root");
	define("PASSWORD","");
	define("DATABASE","subtech_db");
}	
else
{
	$current_host = $_SERVER['HTTP_HOST'];

	if (strpos($current_host, 'www.') === 0) {
		$base_url = "https://www.subtech.in/";
	} else {
		$base_url = "https://subtech.in/";
	}
	define("BASE_PATH",$base_url);
	define("WEB_PATH",$base_url);
	define("IMG_PATH",$base_url."crmpanel/");
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
class DB {
    private $mysqli;

    public function __construct($host=LOCALHOST, $user=USERNAME, $pass=PASSWORD, $db=DATABASE) {
        $this->mysqli = new mysqli($host, $user, $pass, $db);
        if ($this->mysqli->connect_errno) {
            die("Database connection failed: " . $this->mysqli->connect_error);
        }
        $this->mysqli->set_charset("utf8mb4");
    }

    // Detect parameter types for bind_param
    private function getParamTypes($params) {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i'; // integer
            } elseif (is_float($param)) {
                $types .= 'd'; // double
            } elseif (is_string($param)) {
                $types .= 's'; // string
            } else {
                $types .= 'b'; // blob or unknown
            }
        }
        return $types;
    }
	 // INSERT with last inserted ID
	public function inserted_id($query, $params = []) {
        $stmt = $this->mysqli->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->mysqli->error);
        }

        if (!empty($params)) {
            $types = $this->getParamTypes($params);
            $stmt->bind_param($types, ...$params);
        }

        $success = $stmt->execute();
        if (!$success) {
            die("Execute failed: " . $stmt->error);
        }

        $last_id = $this->mysqli->insert_id;
        $stmt->close();
        return $last_id; // returns the auto_increment ID
    }
	public function insert_id() {
        return $this->mysqli->insert_id;
    }
    // General execute (INSERT, UPDATE, DELETE)
    public function execute($query, $params = []) {
        $stmt = $this->mysqli->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->mysqli->error);
        }

        if (!empty($params)) {
            $types = $this->getParamTypes($params);
            $stmt->bind_param($types, ...$params);
        }

        $success = $stmt->execute();
        if (!$success) {
            die("Execute failed: " . $stmt->error);
        }
        $stmt->close();
        return $success;
    }

    // SELECT query
    public function select($query, $params = []) {
        $stmt = $this->mysqli->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->mysqli->error);
        }

        if (!empty($params)) {
            $types = $this->getParamTypes($params);
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
	public function num_rows($query, $params = []) {
		$stmt = $this->mysqli->prepare($query);
		if (!$stmt) {
			die("Prepare failed: " . $this->mysqli->error);
		}

		if (!empty($params)) {
			$types = $this->getParamTypes($params);
			$stmt->bind_param($types, ...$params);
		}

		$stmt->execute();
		$result = $stmt->get_result();
		$count = $result->num_rows;
		$stmt->close();
		return $count;
	}
	public function query($query, $params = []) {
		$stmt = $this->mysqli->prepare($query);
		if (!$stmt) {
			die("Prepare failed: " . $this->mysqli->error);
		}

		if (!empty($params)) {
			$types = $this->getParamTypes($params);
			$stmt->bind_param($types, ...$params);
		}

		$stmt->execute();
		$result = $stmt->get_result();
		return $result; 
	}
    // HTML escape
    public function e($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    // Close connection
    public function __destruct() {
        $this->mysqli->close();
    }
}
global $db;
$db=new DB();
//////////////////////////////// Another Table/Class /////////////////////////

?>