<?php
require_once __DIR__."/../helpers/SmsHelper.php";

/*CREATE TABLE mi_user_login (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mobile VARCHAR(15) UNIQUE NOT NULL,
  otp_code VARCHAR(6),
  otp_expiry DATETIME,
  api_token VARCHAR(64),
  token_expiry DATETIME,
  active TINYINT(1) DEFAULT 1
);
**/


class User {
    private $conn;
    private $login_table = "mi_user_login";
	private $ele_table = "mi_electrician";
	
	public $mobile;
	public $fcm_token;
	
    public function __construct($db) {
        $this->conn = $db;
    }
	
    public function sendOtp($mobile) {
        $otp = rand(1000, 9999);
		$actstatus='Verified';
		$mistatus='Yes';
        $expiry = date("Y-m-d H:i:s", strtotime("+1 year"));
        /*$stmt = $this->conn->prepare("SELECT id FROM ".$this->ele_table." WHERE mobile=? and act_status=? and mi_status=? LIMIT 1");
        $stmt->bind_param("sss", $mobile,$actstatus,$mistatus);
        $stmt->execute();
        $res = $stmt->get_result();
		if($res->num_rows<1){return 1;}*/
		
		$stmt = $this->conn->prepare("SELECT id FROM ".$this->login_table." WHERE mobile=? LIMIT 1");
        $stmt->bind_param("s", $mobile);
        $stmt->execute();
        $res = $stmt->get_result();
		
        if($res->num_rows > 0) {
            $upd = $this->conn->prepare("UPDATE ".$this->login_table." SET otp_code=?, otp_expiry=? WHERE mobile=?");
            $upd->bind_param("sss", $otp, $expiry, $mobile);
            $upd->execute();
        } else {
            $ins = $this->conn->prepare("INSERT INTO ".$this->login_table." (mobile, otp_code, otp_expiry) VALUES (?,?,?)");
            $ins->bind_param("sss", $mobile, $otp, $expiry);
            $ins->execute();
        }
		$sms = new SmsHelper();
		$message = "Your OTP for SUBTECH login is $otp. Valid for 10 min.";
		$ok=$sms->send($mobile, $message);
		if($ok){
			return 2;
		}else{
			return 3;
		}
    }
	
    public function verifyOtp($mobile, $otp) {         
        $stmt = $this->conn->prepare("SELECT id, otp_expiry FROM ".$this->login_table." WHERE mobile=? AND otp_code=? LIMIT 1");
        $stmt->bind_param("ss", $mobile, $otp);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            if(strtotime($row['otp_expiry']) >= time()) {
                $token = bin2hex(random_bytes(32));
                //$expiry = date("Y-m-d H:i:s", time() + TOKEN_EXPIRY);
                $expiry = date("Y-m-d H:i:s", strtotime("+1 year"));
                $upd = $this->conn->prepare("UPDATE ".$this->login_table." SET api_token=?, token_expiry=?, otp_code=NULL WHERE id=?");
                $upd->bind_param("ssi", $token, $expiry, $row['id']);
                $upd->execute();
				////// return user data ///////
				$actstatus='Verified';
				$mistatus='Yes';
				
				$stmt = $this->conn->prepare("SELECT id FROM ".$this->ele_table." WHERE mobile=? and mi_status=? LIMIT 1");
				$stmt->bind_param("ss", $mobile,$mistatus);
				$stmt->execute();
				$res = $stmt->get_result();
				if($res->num_rows<1){
					$dt=date("Y-m-d H:i:s");
					$src="APP";
					$lng="en";
					$str="INSERT INTO ".$this->ele_table."(`rdate`,`source`, `language`, `mobile`) VALUES (?,?,?,?)";
					$stmt1=$this->conn->prepare($str);
					$stmt1->bind_param("ssss",$dt,$src,$lng,$mobile);
					$stmt1->execute();
					
					$stmt2 = $this->conn->prepare("SELECT elect_id FROM ".$this->ele_table." WHERE mobile=? and mi_status=? LIMIT 1");
					$stmt2->bind_param("ss", $mobile,$mistatus);
					$stmt2->execute();
					$res1 = $stmt2->get_result();
				
					$data=[
						"elect_id"=>$res1['elect_id'],
						"mobile"=>$mobile,
						"first_name"=>"",
						"last_name"=>"",
						"email"=>"",
						"dob"=>"",
						"state"=>"",
						"city"=>"",
						"address"=>"",
						"image"=>"",
						"bank_name"=>"",
						"branch_name"=>"",
						"ifsc"=>"",
						"acno"=>"",
						"acname"=>"",
						"upid"=>"",
						"token"=>$token
					];
				}else{
					$stmt1 = $this->conn->prepare("SELECT e.*,s.state as state_name FROM ".$this->ele_table." e left join mi_state s on s.id=e.state WHERE e.mobile=? AND e.act_status=? and e.mi_status=? LIMIT 1");
					$stmt1->bind_param("sss", $mobile, $actstatus, $mistatus);
					$stmt1->execute();
					$res1 = $stmt1->get_result();
					$row1=$res1->fetch_assoc();
					
					$data=[
						"elect_id"=>$row1['elect_id'],
						"mobile"=>$row1['mobile'],
						"first_name"=>$row1['fname'],
						"last_name"=>$row1['lname'],
						"email"=>$row1['email'],
						"dob"=>$row1['dob'],
						"state"=>$row1['state_name'],
						"city"=>$row1['city'],
						"address"=>$row1['address'],
						"image"=>$row1['selfie'],
						"bank_name"=>$row1['bank'],
						"branch_name"=>$row1['branch'],
						"ifsc"=>$row1['ifsc'],
						"acno"=>$row1['acno'],
						"acname"=>$row1['acname'],
						"upid"=>$row1['upid'],
						"token"=>$token
					];
				}
				
				
                return $data;
            }
        }
        return false;
    }
	
    public function checkToken($token) {
        $stmt = $this->conn->prepare("SELECT id, token_expiry FROM ".$this->login_table." WHERE api_token=? LIMIT 1");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if(strtotime($row['token_expiry']) > time()) {
                return true;
            }
        }
        return false;
    }
    public function update_fcm_token() {
        $stmt = $this->conn->prepare("update ".$this->login_table." set fcm_token=? where mobile=?");
        $stmt->bind_param("ss", $this->fcm_token,$this->mobile);
        $result=$stmt->execute();
        if($result) {
            return true;
        }else{
			return false;
		}
    }
}
