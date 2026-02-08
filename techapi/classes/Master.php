<?php
require_once __DIR__."/../helpers/SmsHelper.php";

class Master {
    private $conn;
    private $cashback_table = "mi_electrician_cashback";
	private $electrician_table = "mi_electrician";
	private $customer_table = "mi_customer";	
	private $customer_cmpl_table = "mi_customer_complain";
	private $cmpl_assign_table = "mi_complain_assign";
	private $elect_cmpl_table = "mi_electrician_complain";
	private $product_table="mi_product";
	private $state_table="mi_state";
	private $otp_table="mi_user_otp";
	
	public $elect_id;
	public $cmpl_no;
	public $mobile;
	public $fname;
	public $lname;
	public $email;
	public $dob;
	public $state;
	public $city;
	public $address;
	public $bank;
	public $branch;
	public $ifsc;
	public $acno;
	public $acname;
	public $upid;
	
	public $otptype;
	public $remark;
	
    public function __construct($db) {
        $this->conn = $db;
    }
	public function update_profile(){

        // Step 1: Check row exists
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->electrician_table." WHERE elect_id=? AND mi_status='Yes'");
        $stmt->bind_param("i", $this->elect_id);
        $stmt->execute();
        $res = $stmt->get_result();
    
        if($res->num_rows){
    
            $stmt->close(); // optional but clean
    
            // Step 2: Update query
            $stmt = $this->conn->prepare("
                UPDATE ".$this->electrician_table."
                SET fname=?, lname=?, email=?, dob=?,
                    state=?, city=?, address=?, bank=?,
                    branch=?, ifsc=?, acno=?, acname=?, upid=?
                WHERE elect_id=? AND mobile=?
            ");
    
            // Correct bind types (15 params)
            $stmt->bind_param(
                "sssssssssssssis",
                $this->fname,
                $this->lname,
                $this->email,
                $this->dob,
                $this->state,
                $this->city,
                $this->address,
                $this->bank,
                $this->branch,
                $this->ifsc,
                $this->acno,
                $this->acname,
                $this->upid,
                $this->elect_id,  // integer
                $this->mobile     // string
            );
    
            $success = $stmt->execute();
            if (!$success) {
                return "Execute failed: " . $stmt->error;
            } else {
                return true;
            }
    
        } else {
            return "Invalid ID";
        }
    }
	public function statelist(){
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->state_table." where mi_status='Yes' ORDER BY state ");
		//$stmt->bind_param("s",$mobile); 
		$stmt->execute();
        $res = $stmt->get_result();
		if($res->num_rows<1){return false;}
		
        $data = [];
        while($row = $res->fetch_assoc()) {
            $data[] = [
				'status'=>'success',
				'id'=>$row['id'],
				'state'=>$row['state']
			];
        }
        return $data;
	}
	public function sendOtp() {
        $otp = rand(1000, 9999);
		$mistatus='Yes';
		$now=date("Y-m-d H:i:s");
        $expiry = date("Y-m-d H:i:s", time() + 600);
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->otp_table." WHERE mobile=? and otp_type=? and mi_status=? order by id desc LIMIT 1");
        $stmt->bind_param("sss", $this->mobile,$this->otp_type,$mistatus);
        $stmt->execute();
        $res = $stmt->get_result();
		if($res->num_rows<1){
			$ins = $this->conn->prepare("INSERT INTO ".$this->otp_table." (rdate,otp_type,mobile, otp, otp_expiry) VALUES (?,?,?,?,?)");
            $ins->bind_param("sssss",$now,$this->otp_type, $this->mobile, $otp, $expiry);
            $ins->execute();
			$sms = new SmsHelper();
			$message = "Your OTP for SUBTECH login is ".$otp.". Valid for 10 min.";
			$ok=$sms->send($this->mobile, $message);
			if($ok){
				return 1;
			}else{
				return 2;
			}
			
		}else{
			$row = $res->fetch_assoc();
			
			if(strtotime($row['otp_expiry'])<strtotime($now)){
				$stmt = $this->conn->prepare("update ".$this->otp_table." set verify_status='No',verify_time='".$now."', mi_status='No' WHERE mobile=? and otp_type=? and mi_status=? order by id desc LIMIT 1");
				$stmt->bind_param("sss", $this->mobile,$this->otp_type,$mistatus);
				$stmt->execute();
				return $this->sendOtp();
			}else{
				$sms = new SmsHelper();
				$message = "Your OTP for SUBTECH login is ".$row['otp'].". Valid for 10 min.";
				$ok=$sms->send($this->mobile, $message);
				if($ok){
					return 1;
				}else{
					return 2;
				}
			}
		}
    }
	public function verifyOtp() {         
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->otp_table." WHERE mobile=? AND otp_type=? AND otp=? LIMIT 1");
        $stmt->bind_param("sss", $this->mobile,$this->otp_type, $this->otp);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            if(strtotime($row['otp_expiry']) >= time()) {
				$now=date("Y-m-d H:i:s");
				$upd = $this->conn->prepare("UPDATE ".$this->otp_table." SET verify_status='Yes', verify_time='".$now."', mi_status='No' WHERE id=?");
                $upd->bind_param("i", $row['id']);
                $upd->execute();
				////// Complain Start /////////
				$upd1=$this->conn->prepare("update ".$this->cmpl_assign_table." set status='Start' where tech=? and cmpl_no=?");
				$upd1->bind_param("ss",$this->elect_id,$this->cmpl_no);
                $upd1->execute();
				
				$data=[
					"status"=>"success",
					"message"=>"Complain Started Successfully"
				];
                return $data;
            }else{
				$data=[
					"status"=>"fail",
					"message"=>"OTP Expired"
				];
				return $data;
			}
        }
        return false;
    }
	public function closeComplain(){
		$stmt=$this->conn->prepare("select cmpl_no from ".$this->cmpl_assign_table." where tech=? and cmpl_no=?");
		$stmt->bind_param("ss",$this->elect_id,$this->cmpl_no);
		$stmt->execute();
		$res=$stmt->get_result();
		if($res->num_rows){
			$now=date("Y-m-d H:i:s");
			$upd=$this->conn->prepare("update ".$this->cmpl_assign_table." set status='Close', cldate=?, clremark=? where tech=? and cmpl_no=?");
			$upd->bind_param("ssss",$now,$this->remark,$this->elect_id,$this->cmpl_no);
			$upd->execute();
			return true;
		}else{
			return false;
		}
	}
	public function allComplain(){
		//$stmt=$this->conn->prepare("select cpl.cmpl_no, cpl.defect, cpl.remark,ecpl.status AS elect_status, cpl.status as progress_status, cp.mobile,c.mobile2, cp.address,cp.google_map_link, cp.product, cp.serial_no, cp.priority from ".$this->cmpl_assign_table." cpl left join ".$this->customer_cmpl_table." cp on cpl.cmpl_no=cp.cmpl_no left join ".$this->elect_cmpl_table." ecpl on ecpl.elect_id=cpl.tech and ecpl.cmpl_no=cpl.cmpl_no left join ".$this->customer_table." c on c.mobile=cp.mobile where cpl.tech=? and cpl.mi_status='Yes' and ecpl.status!='Rejected' ");
		$stmt = $this->conn->prepare("SELECT 
					cpl.cmpl_no, 
					cpl.defect, 
					cpl.remark, 
					ecpl.status AS elect_status, 
					cpl.status AS progress_status, 
					cp.mobile,
					c.mobile2, 
					cp.address, 
					cp.google_map_link, 
					cp.product, 
					cp.serial_no, 
					cp.priority
				FROM ".$this->cmpl_assign_table." AS cpl
				LEFT JOIN ".$this->customer_cmpl_table." AS cp 
					   ON cpl.cmpl_no = cp.cmpl_no
				LEFT JOIN ".$this->elect_cmpl_table." AS ecpl 
					   ON ecpl.elect_id = cpl.tech 
					  AND ecpl.cmpl_no = cpl.cmpl_no
				LEFT JOIN ".$this->customer_table." AS c 
					   ON c.mobile = cp.mobile
				WHERE 
					cpl.tech = ?
					AND cpl.mi_status = 'Yes'
					AND (
						 ecpl.status IS NULL 
						 OR ecpl.status <> 'Rejected'
					)
				");
		
		$stmt->bind_param("s",$this->elect_id);
		$stmt->execute();
        $res = $stmt->get_result();
		$data = [];
		if($res->num_rows>0){
			while($row = $res->fetch_assoc()){
				$data[] = [
					'cmpl_no'=>$row['cmpl_no'],
					'defect'=>$row['defect'],
					'remark'=>$row['remark'],
					'status'=>$row['elect_status'],
					'progress_status'=>$row['progress_status'],
					'mobile'=>$row['mobile'],
					'alternate_mobile'=>$row['mobile2'],
					'address'=>$row['address'],
					'google_map_link'=>$row['google_map_link'],
					'priority'=>$row['priority'],
					'serial_no'=>$row['serial_no'],
					'product'=>$this->getProduct($row['product'])
				];
			}
		}else{
			$data[] = [
				'status'=>'fail',
				'message'=>'No Complain Assigned'
			];
		}
		return $data;
	}
	public function acceptComplain(){
		$stmt=$this->conn->prepare("select * from ".$this->elect_cmpl_table." where elect_id=? and cmpl_no=? and status='Pending' ");
		$stmt->bind_param("ss",$this->elect_id,$this->cmpl_no); 
		$stmt->execute();
		$res = $stmt->get_result();
		if($res->num_rows){
			$stmt=$this->conn->prepare("update ".$this->elect_cmpl_table." set status='Rejected',remark='Complain Already Assigned by other electrician', adate='".date("Y-m-d H:i:s")."' where elect_id!=? and  cmpl_no=? and status='Pending' ");
			$stmt->bind_param("ss",$this->elect_id,$this->cmpl_no); 
			$stmt->execute();
			
			$stmt=$this->conn->prepare("update ".$this->elect_cmpl_table." set status='Accepted', adate='".date("Y-m-d H:i:s")."' where elect_id=? and cmpl_no=?");
			$stmt->bind_param("ss",$this->elect_id,$this->cmpl_no); 
			$stmt->execute();
			$data[] = [
					'status'=>'success',
					'message'=>'Complain Accepted Successfully'
				];
		}else{
			$data[] = [
					'status'=>'fail',
					'message'=>'Complain Already Assigned by other electrician'
				];
		}
		return $data;	
	}
	public function rejectComplain(){
		$stmt=$this->conn->prepare("select * from ".$this->elect_cmpl_table." where elect_id=? and cmpl_no=? and status='Pending' ");
		$stmt->bind_param("ss",$this->elect_id,$this->cmpl_no); 
		$stmt->execute();
		$res = $stmt->get_result();
		if($res->num_rows){
			$stmt=$this->conn->prepare("update ".$this->elect_cmpl_table." set status='Rejected',remark='Rejected by electrician', adate='".date("Y-m-d H:i:s")."' where elect_id=? and cmpl_no=? and status='Pending' ");
			
			$stmt->bind_param("ss",$this->elect_id,$this->cmpl_no); 
			$stmt->execute();
			
			$stmt=$this->conn->prepare("select * from ".$this->elect_cmpl_table." where cmpl_no=? and status='Pending' ");
			$stmt->bind_param("s",$this->cmpl_no); 
			$stmt->execute();
			$res=$stmt->get_result();
			if(!$res->num_rows){
				$stmt=$this->conn->prepare("update ".$this->customer_cmpl_table." set tech_assigned='No' where cmpl_no=? and mi_status='Yes' ");
				$stmt->bind_param("s",$this->cmpl_no); 
				$stmt->execute();
			}
			$data[] = [
					'status'=>'success',
					'message'=>'Complain Rejected'
				];
		}else{
			$data[] = [
					'status'=>'fail',
					'message'=>'Complain Not Found'
				];
		}
		return $data;	
	}
	
	
	
	public function getProduct($prd){
		$stmt = $this->conn->prepare("SELECT pname from ".$this->product_table." WHERE id = ?");
		$stmt->bind_param("s",$prd); 
		$stmt->execute();
        $res = $stmt->get_result();
		if($res->num_rows>0){
			$row=$res->fetch_assoc();
			return $row['pname'];
		}else{
			return $prd;
		}
	}
    public function getPoint($mobile) {
        $stmt = $this->conn->prepare("SELECT rank, elect_id, point
		FROM (
			SELECT 
				elect_id,
				SUM(cashback) AS point,
				RANK() OVER (ORDER BY SUM(cashback) DESC) AS rank
			FROM ".$this->cashback_table."
			GROUP BY elect_id
		) AS ranked
		WHERE elect_id = ?");
		$stmt->bind_param("s",$mobile); 
		$stmt->execute();
        $res = $stmt->get_result();
		$data = [];
		if($res->num_rows>0){
			$row = $res->fetch_assoc();
			$data[] = [
				'status'=>'success',
				'rank'=>$row['rank'],
				'point'=>intval($row['point'])
			];
		}else{
			$data[] = [
				'status'=>'success',
				'rank'=>'0',
				'point'=>'0'
			];
		}
		return $data;
    }
	
	public function getTop3Rank(){
		$stmt = $this->conn->prepare("SELECT e.mobile AS elect_id,
               e.fname AS elect_name,
               SUM(c.cashback) AS point
        FROM ".$this->cashback_table." AS c
        JOIN ".$this->electrician_table." AS e ON e.mobile = c.elect_id
        GROUP BY e.id
        ORDER BY point DESC
        LIMIT 3");
		//$stmt->bind_param("s",$mobile); 
		$stmt->execute();
        $res = $stmt->get_result();
		if($res->num_rows<1){return false;}
		
        $data = [];
		$r=1;
        while($row = $res->fetch_assoc()) {
            $data[] = [
				'status'=>'success',
				'fname'=>$row['elect_name'],
				'point'=>intval($row['point']),
				'rank'=>$r
			];
			$r++;
        }
        return $data;
	}
	
}
