<?php
class Master{

    private $conn;
    private $dealer_table = "mi_dealer";
    private $pcat_table = "mi_pcat";
    private $state_table = "mi_state";
    private $career_table = "mi_career";
    private $subscribe_table = "mi_subscribe";
    private $contact_table = "mi_contact";
    private $enquiry_table = "mi_enquiry";
    private $electrician_table = "mi_electrician";
    private $comment_table = "mi_comment";
    private $visitor_table = "mi_visitor";
    private $register_table = "mi_registration";
    private $varient_table="mi_varient";
	private $rating_table="mi_rating";
	private $ptype2_table="mi_ptype2";
	private $cmpl_table="mi_complains";
	private $prd_serial_table="mi_product_detail";
	private $order_table="mi_order";
	private $download_table = "mi_download_update";
	private $noti_table = "mi_notifications_soft";
	
    public $rdate;
    public $name;
    public $serial_no;
    public $job;
    public $blog_id;
    public $c_type;
    public $refid;
    public $visitin;
    public $subject;
    public $email;
    public $mobile;
    public $message;
    public $language;
    public $fname;
    public $lname;
    public $dob;
    public $state;
    public $city;
    public $address;
    public $ctype;
    public $otp;
    public $exp_date;
    public $prd_id;
    public $prd_name;
    public $qty;
    
    public $resume=NULL;
    public $image=NULL;
    
    public $data_id;
    public $cmp_id;
    public function __construct($db){
        $this->conn = $db;
		$this->cmp_id='subtech';
    }
	public function get_user_ip() {
		// Check for shared internet/ISP IP
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		// Check for IPs passing through proxies
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		// Return reliable remote address
		else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	public function add_notification($notitext,$page){
		$user_id=$this->get_user_ip();
		$query="SELECT 
				u.id, 
				u.username, 
				u.user_type,
				r.rr_page_code 
			FROM mi_user u 
			LEFT JOIN `mi_role_rights` r 
				ON u.id = r.emp_id AND r.rr_page_code = ?
			WHERE 
				u.user_type = 'Admin' 
				OR (u.user_type = 'User' AND r.rr_page_code IS NOT NULL)";
		$qr=$this->conn->query($query,[$page]);
		while($row=$qr->fetch_assoc()){
			$notifor=$row['id'];
			$sql="INSERT INTO ".$this->noti_table."(`rdate`, `cmp_id`, `user_id`, `noti_text`, `noti_for`, `noti_page_for`) VALUES (?,?,?,?,?,?)";
			$this->conn->execute($sql,[$this->rdate,$this->cmp_id,$user_id,$notitext,$notifor,$page]);
		}
		return true;
	}
    //////////////////////////////////
    public function update_download(){
		$ip=$_SERVER['REMOTE_ADDR'];
		$query="INSERT INTO ".$this->download_table."(`rdate`, `ip_address`, `res_id`) VALUES (?,?,?)";
		$ok=$this->conn->execute($query,[$this->rdate,$ip,$this->data_id]);
	    if($ok){
	        return 1;
	    }else{
	        return 3;
	    }
	}
    /////////////////////////////////
	public function varient_name($id){
		$ids=explode(",",$id);
		$str='';
		$placeholders = implode(',', array_fill(0, count($ids), '?'));
		
		$query="select * from ".$this->varient_table." where id in(".$placeholders.") and mi_status='Yes'";
		$qr=$this->conn->query($query,$ids);
		while($row=$qr->fetch_assoc())
		{
			$str.=$row['cat_name'].", ";
		}
		$str=rtrim($str,", ");
		return $str;
	}
	
	public function rating_name($id){
		$ids=explode(",",$id);
		$str='';
		$placeholders = implode(',', array_fill(0, count($ids), '?'));
		
		$query="select * from ".$this->rating_table." where id in(".$placeholders.") and mi_status='Yes'";
		$qr=$this->conn->query($query,$ids);
		while($row=$qr->fetch_assoc())
		{
			$str.=$row['cat_name'].", ";
		}
		$str=rtrim($str,", ");
		return $str;
	}
	public function ptype2_name($id){
		$ids=explode(",",$id);
		$str='';
		$placeholders = implode(',', array_fill(0, count($ids), '?'));
		
		$query="select * from ".$this->ptype2_table." where id in(".$placeholders.") and mi_status='Yes'";
		$qr=$this->conn->query($query,$ids);
		while($row=$qr->fetch_assoc())
		{
			$str.=$row['cat_name'].", ";
		}
		$str=rtrim($str,", ");
		return $str;
	}
	
	
	///////////////////////////////
    public function pcat_name($id='')
	{
		$ids=explode(",",$id);
		$str='';
		$placeholders = implode(',', array_fill(0, count($ids), '?'));
		
		$query="select * from ".$this->pcat_table." where id in(".$placeholders.") and mi_status='Yes'";
		$qr=$this->conn->query($query,$ids);
		while($row=$qr->fetch_assoc())
		{
			$str.=$row['cat_name'].", ";
		}
		$str=rtrim($str,", ");
		return $str;
	}
	public function pcat_list($id='')
	{
		$ids=explode(",",$id);
		$str='';
		$query="select * from ".$this->pcat_table." where mi_status='Yes'";
		$qr=$this->conn->query($query);
		while($row=$qr->fetch_assoc())
		{
			if($id!="" and in_array($row['id'],$ids))
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['cat_name'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['cat_name'].' </option>';
			}
		}
		return $str;
	}
	public function state_name($id='')
	{
		$ids=explode(",",$id);
		$str='';
		$placeholders = implode(',', array_fill(0, count($ids), '?'));
		$query="select * from ".$this->state_table." where id in(".$placeholders.") and mi_status='Yes'";
		$qr=$this->conn->query($query,$ids);
		while($row=$qr->fetch_assoc())
		{
			$str.=$row['state'].", ";
		}
		$str=rtrim($str,", ");
		return $str;
	}
	public function state_list($id='')
	{
		$str='';
		$query="select * from ".$this->state_table." where mi_status='Yes'";
		$qr=$this->conn->query($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['state'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['state'].' </option>';
			}
		}
		return $str;
	}
	public function update_subscriber(){
	    $qr=$this->conn->query("select * from ".$this->subscribe_table." where email=? and mi_status='Yes'",[$this->email]);
	    if($qr->num_rows){return 2;}
	    
	    $query = "INSERT INTO ".$this->subscribe_table."( `rdate`, `email`) VALUES (?,?)";
	    $ok=$this->conn->execute($query,[date("Y-m-d H:i:s"),$this->email]);
	    if($ok){
			$this->add_notification('A New Subscriber join in Subtech Website','subscribe');
	        return 1;
	    }else{
	        return 3;
	    }
	}
	public function update_registration(){
	    $qr=$this->conn->query("select * from ".$this->register_table." where mobile=? and mi_status='Yes'",[$this->mobile]);
	    if($qr->num_rows){return 2;}
	    
	    $query = "INSERT INTO ".$this->register_table."(`rdate`,`lang`, `ctype`, `cname`, `mobile`, `state`, `city`) VALUES (?,?,?,?,?,?,?)";
	    $ok=$this->conn->execute($query,[date("Y-m-d H:i:s"),$this->language, $this->ctype, $this->name,$this->mobile,$this->state,$this->city]);
	    if($ok){
	       
	        return 1;
	    }else{
	        return 3;
	    }
	}
	public function update_contact(){
	    $query = "INSERT INTO ".$this->contact_table."(`rdate`, `c_type`, `cname`, `email`, `mobile`, `subject`, `message`) VALUES (?,?,?,?,?,?,?)";
	    $ok=$this->conn->execute($query,[date("Y-m-d H:i:s"),$this->c_type,$this->name,$this->email,$this->mobile,$this->subject,$this->message]);
	    if($ok){
	       $this->add_notification('A New User Want to contact to Subtech Website','contact');
	        return true;
	    }else{
	        return false;
	    }
	}

	public function update_order(){
	    $query = "INSERT INTO ".$this->order_table."(`rdate`, `cname`, `email`, `mobile`, `prd_id`, `pname`,`qty`, `message`) VALUES (?,?,?,?,?,?,?,?)";
	    $ok=$this->conn->execute($query,[date("Y-m-d H:i:s"),$this->name,$this->email,$this->mobile,$this->prd_id,$this->prd_name,$this->qty,$this->message]);
	    if($ok){
			$this->add_notification('A New Order of Product entry through Subtech Website','order');
	        return true;
	    }else{
	        return false;
	    }
	}
	public function update_visitor(){
	    $query = "INSERT INTO ".$this->visitor_table."(`rdate`, `visitin`, `cname`, `mobile`, `subject`, `message`) VALUES (?,?,?,?,?,?)";
	    $ok=$this->conn->execute($query,[date("Y-m-d H:i:s"),$this->visitin,$this->name,$this->mobile,$this->subject,$this->message]);
	    if($ok){
	       $this->add_notification('A New visitor comes at Subtech Website','visitor');
	        return true;
	    }else{
	        return false;
	    }
	}
	public function update_enquiry(){
	    $query = "INSERT INTO ".$this->enquiry_table."(`rdate`, `cname`, `email`, `mobile`, `subject`, `message`) VALUES (?,?,?,?,?,?)";
	    $ok=$this->conn->execute($query,[date("Y-m-d H:i:s"),$this->name,$this->email,$this->mobile,$this->subject,$this->message]);
	    if($ok){
	       $this->add_notification('A New enquiry wants to know something by Subtech Website','enquiry');
	        return true;
	    }else{
	        return false;
	    }
	}	
	public function update_comment(){
	    $query = "INSERT INTO ".$this->comment_table."(`rdate`, `blog_id`, `cname`, `email`, `comment`) VALUES (?,?,?,?,?)";
	    $ok=$this->conn->execute($query,[date("Y-m-d H:i:s"),$this->blog_id,$this->fname,$this->email,$this->message]);
	    if($ok){
	        return true;
	    }else{
	        return false;
	    }
	}
	public function apply_job(){
	    $query = "INSERT INTO ".$this->career_table."( `rdate`, `cname`, `email`, `mobile`, `job`, `message`) VALUES ( ?,?,?,?,?,?)";
	    $ok=$this->conn->inserted_id($query,[date("Y-m-d H:i:s"),$this->name,$this->email,$this->mobile,$this->job,$this->message]);
	    if($ok){
	        $this->updateresume($ok);
	        return true;
	    }else{
	        return false;
	    }
	}
	public function updateresume($id){
        if($this->resume["name"]!=''){
		   
		   $exp = explode(".", $this->resume["name"]);
		   $extension = end($exp);
		   if($extension=='pdf' or $extension=='PDF')
		   {
				$imagename=$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->resume["tmp_name"], "../crmpanel/images/career_img/".$filename);
				$query = "update ".$this->career_table." set `resume`=? where id=?";
				if($this->conn->execute($query,[$filename,$id])){
					return true;
				}else{
					return false;
				}  
		   }else{
			   return false;
		   }
		  
	   }else{
		   return true;
	   }
    }
	public function warranty_check(){
		
		$query="select * from ".$this->prd_serial_table." where serial_no=? and mi_status='Yes'";
		$qr=$this->conn->query($query,[$this->serial_no]);
		if($qr->num_rows){
			$row=$qr->fetch_assoc();
			if($row['cust_id']!=""){
				$this->exp_date=$row['exp_date'];
				return 1;
			}else{
				return 2;
			}
		}else{
			return 3;
		}
		
	    $query = "INSERT INTO ".$this->cmpl_table."( `rdate`, `serial_no`, `cname`, `email`, `mobile`, `message`) VALUES ( ?,?,?,?,?,?)";
	    $ok=$this->conn->inserted_id($query,[date("Y-m-d H:i:s"),$this->serial_no,$this->name,$this->email,$this->mobile,$this->message]);
	    if($ok){
	        $this->updatecmpl($ok);
			$this->add_notification('A New user wants to getting service on product by Subtech Website','service-request');
	        return true;
	    }else{
	        return false;
	    }
	}
	public function update_complain(){
	    $query = "INSERT INTO ".$this->cmpl_table."( `rdate`, `serial_no`, `cname`, `email`, `mobile`, `message`) VALUES ( ?,?,?,?,?,?)";
	    $ok=$this->conn->inserted_id($query,[date("Y-m-d H:i:s"),$this->serial_no,$this->name,$this->email,$this->mobile,$this->message]);
	    if($ok){
			$this->add_notification('A New user wants to getting service on product by Subtech Website','service-request');
	        $this->updatecmpl($ok);
	        return true;
	    }else{
	        return false;
	    }
	}
	public function updatecmpl($id){
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG')
		   {
				$imagename=$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../images/cmpl_img/".$filename);
				$query = "update ".$this->cmpl_table." set `image`=? where id=?";
				if($this->conn->execute($query,[$filename,$id])){
					return true;
				}else{
					return false;
				}  
		   }else{
			   return false;
		   }
		  
	   }else{
		   return true;
	   }
    }
	//////////////////////////
	public function send_otp(){
		global $objsms;
		$qq=$this->conn->query("select mobile from ".$this->electrician_table." where mobile=?",[$this->mobile]);
		if($qq->num_rows){
			return 2;
		}else{
			$objsms->mobile=$this->mobile;
			$_SESSION['otp']=rand(1000,9999);
			$objsms->message='Your OTP for SUBTECH login is '.$_SESSION['otp'].'. Valid for 10 min.';
			$ok=$objsms->send_sms();
			if($ok){
				return 1;
			}else{
				return 3;
			}
		}
	}
	public function check_otp(){
		if($_SESSION['otp']==$this->otp){
			$_SESSION['otp']="";
			return 1;
		}else{
			return 2;
		}
	}
	public function check_refid(){
		$qq=$this->conn->query("select mobile from ".$this->electrician_table." where mobile=?",[$this->refid]);
		if($qq->num_rows){
			return true;
		}else{
			return false;
		}
	}
	public function update_electrician() {
		$filename = NULL;
		if($this->refid!="" and !$this->check_refid()){
			return false;
		}
		
		// Agar selfie base64 me mili hai
		if(isset($this->selfie) && $this->selfie != '') {
			$img = $this->selfie;

			// "data:image/png;base64," hatao
			$img = preg_replace('#^data:image/\w+;base64,#i', '', $img);

			// base64 decode
			$imgData = base64_decode($img);

			// file name generate
			$imagename = time()."_".rand(1000,9999).".png";
			$filepath = "../crmpanel/crm/images/ele_img/".$imagename;

			// save file
			file_put_contents($filepath, $imgData);

			$filename = $imagename;
		}
	$source="Website";
	$DOB = !empty($this->dob) ? date("Y-m-d", strtotime($this->dob)) : null;
		$act=($this->refid!="")?"Pending":"Verified";
		
		$query = "INSERT INTO ".$this->electrician_table."				 (`rdate`,`source`,`language`,`refid`,`mobile`,`fname`,`lname`,`email`,`dob`,`state`,`city`,`address`,`selfie`,`act_status`)  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$ok = $this->conn->execute($query,[
			date("Y-m-d H:i:s"),
			$source,
			$this->language,
			$this->refid,
			$this->mobile,
			$this->fname,
			$this->lname,
			$this->email,
			$DOB,
			$this->state,
			$this->city,
			$this->address,
			$filename,
			$act
		]);
		if($ok){
			$this->add_notification('A New Electrician register in Subtech Website','electrician-list');
			global $objsms;
			$reflink=base64_encode($this->mobile);
			$objsms->mobile=$this->mobile;
			if($this->language=='en'){
				
				$objsms->message="Hi ".$this->fname.", welcome to Subtech Soldiers! We've got your registration for Subtech Soldiers and will be in touch soon. Thanks!";
				$sm=$objsms->send_sms();
			}else{
				$objsms->message="नमस्ते ".$this->fname.", SUBTECH Soldiers में आपका स्वागत है! हमने आपका रजिस्ट्रेशन प्राप्त कर लिया है और जल्द ही आपसे संपर्क करेंगे। धन्यवाद!";
				$sm=$objsms->send_sms();
			}

			if($sm){
				$objsms->mobile=$this->mobile;
				$objsms->message="Become a Subtech Soldier! Refer your Electrician friends using your link & earn up to Rs.50 for every successful referral. Share your link now: https://subtech.in/electrician_register?refid=".$reflink;
				$objsms->send_sms();
			}
			
				
			return true;
		}else{
			return false;
		}
		return $ok ? true : false;
	}
	
}
$objmaster= new Master($db);