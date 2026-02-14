<?php
require_once "../config/config.php";
require_once "../config/database.php";
require_once "../helpers/response.php";
require_once "../classes/User.php";
require_once "../classes/Master.php";

$db = (new Database())->connect();
$user = new User($db);
$objmaster = new Master($db);

$endpoint = $_GET['endpoint'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"), true);

switch ($endpoint) {
    case "updateFCMtoken":
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				if($data['mobile']!=''){
					$user->mobile = $data['mobile'] ?? '';
					$user->fcm_token = $data['fcm_token'] ?? '';
					$res = $user->update_fcm_token();
					if($res){
						response(true, "FCM Token Updated", $res);
					}else{
						response(false, "Somthing Error", $res);
					}
				}else{
					response(false,"Mobile Data Missing");
				}
			} else {
				response(false, "Invalid request method");
			}
		}
    break;
    
	case "statelist":
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				$data = $objmaster->statelist();
				response(true, "State list fetched", $data);
			} else {
				response(false, "Invalid request method");
			}
		}
    break;
	case "updateProfile":
		$headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				if($data['elect_id']!=''){
					$objmaster->mobile = $data['mobile'] ?? '';
					$objmaster->elect_id = $data['elect_id'] ?? '';
					$objmaster->fname = $data['first_name'] ?? '';
					$objmaster->lname = $data['last_name'] ?? '';
					$objmaster->email = $data['email_id'] ?? '';
					$objmaster->dob = $data['date_of_birth'] ?? '';
					$objmaster->state = $data['state_id'] ?? '';
					$objmaster->city = $data['city_name'] ?? '';
					$objmaster->address = $data['address'] ?? '';
					$objmaster->bank = $data['bank_name'] ?? '';
					$objmaster->branch = $data['branch_name'] ?? '';
					$objmaster->ifsc = $data['ifsc_code'] ?? '';
					$objmaster->acno = $data['bank_acno'] ?? '';
					$objmaster->acname = $data['bank_acname'] ?? '';
					$objmaster->upid = $data['upid'] ?? '';
					
					$res = $objmaster->update_profile();
					if($res){
						response(true, "Profile Updated Successfully", $res);
					}else{
						response(false, "Somthing Error", $res);
					}
				}else{
					response(false,"Mobile Data Missing");
				}
			} else {
				response(false, "Invalid request method");
			}
		}
	
    break;
	case "sendOtp":
		$headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				if($data['mobile']!='' and $data['otp_type']!=''){
					$objmaster->mobile = $data['mobile'] ?? '';
					$objmaster->otp_type = $data['otp_type'] ?? '';
					$res = $objmaster->sendOtp();
					if($res){
						response(true, "OTP send Sucessfully", $res);
					}else{
						response(false, "Somthing Error", $res);
					}
				}else{
					response(false,"Mobile Data Missing");
				}
			} else {
				response(false, "Invalid request method");
			}
		}
	
    break;
	
	case "verifyOtp":
		$headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				$objmaster->mobile = $data['mobile'] ?? '';
				$objmaster->otp_type = $data['otp_type'] ?? '';
				$objmaster->otp = $data['otp'] ?? '';
				$objmaster->elect_id = $data['elect_id'] ?? '';
				$objmaster->cmpl_no = $data['cmpl_no'] ?? '';
				
				$res = $objmaster->verifyOtp();
				if($res){
					response(true, "OTP Action", $res);
				}else{
					response(false, "Somthing Error", $res);
				}
				
			} else {
				response(false, "Invalid request method");
			}
		}

    break;
	
	case "closeComplain":
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				$objmaster->elect_id = $data['elect_id'] ?? '';
				$objmaster->cmpl_no = $data['cmpl_no'] ?? '';
				$objmaster->remark = $data['remark'] ?? '';
				
				$res = $objmaster->closeComplain();
				if($res){
					response(true, "Complain Closing Successfully");
				}else{
					response(false, "Invalid Complain");
				}
				
				
			} else {
				response(false, "Invalid request method");
			}
		}
    break;
	case "rejectComplain":
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				$objmaster->elect_id = $data['elect_id'] ?? '';
				$objmaster->cmpl_no = $data['cmpl_no'] ?? '';
				$res = $objmaster->rejectComplain();
				response(true, "Complain Rejected", $res);
			} else {
				response(false, "Invalid request method");
			}
		}
    break;
	case "acceptComplain":
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				$objmaster->elect_id = $data['elect_id'] ?? '';
				$objmaster->cmpl_no = $data['cmpl_no'] ?? '';
				$res = $objmaster->acceptComplain();
				response(true, "Complain Accepted", $res);
			} else {
				response(false, "Invalid request method");
			}
		}
    break;
	
	case "get-allcomplain":
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				$objmaster->elect_id = $data['elect_id'] ?? '';
				$res = $objmaster->allComplain();
				response(true, "All Complain fetched", $res);
			} else {
				response(false, "Invalid request method");
			}
		}
    break;
	
	case "get-point":
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				$mobile = $data['mobile'] ?? '';
				if($mobile){
					$data = $objmaster->getPoint($mobile);
					response(true, "Point fetched", $data);
				}else{
					response(false, "Data Missing");
				}
			} else {
				response(false, "Invalid request method");
			}
		}
    break;
	
	case "get-top3rank":
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $token);
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }else{
			if($method == "POST") {
				$data = $objmaster->getTop3Rank();
				response(true, "Rank list fetched", $data);
			} else {
				response(false, "Invalid request method");
			}
		}
    break;
	
    case "send-otp":
        if($method == "POST") {
            $mobile = $data['mobile'] ?? '';
            if($mobile) {
                $otp = $user->sendOtp($mobile);
				if($otp=='2'){
					response(true, "OTP sent successfully");
				}else if($otp=='3'){
					response(false, "Please wait!.. OTP Not sent due to some internal Error");
				}else{
					response(false, "Unauthorized Mobile Number");
				}
            } else {
                response(false, "Mobile number required");
            }
        } else {
            response(false, "Invalid request method");
        }
    break;

    case "verify-otp":
        if($method == "POST") {
            $mobile = $data['mobile'] ?? '';
            $otp = $data['otp'] ?? '';
            if($mobile && $otp) {
                $result = $user->verifyOtp($mobile, $otp);
                if($result) {
                    response(true, "Login success", $result);
                } else {
                    response(false, "Invalid or expired OTP");
                }
            } else {
                response(false, "Missing parameters");
            }
        } else {
            response(false, "Invalid request method");
        }
    break;

    /*case "get-products":
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        if(!$user->checkToken($token)) {
            response(false,"Unauthorized");
        }
        $data = $product->getAll();
        response(true, "Product list fetched", $data);
    break;*/

    default:
        response(false, "Unknown Request: $endpoint");
}
