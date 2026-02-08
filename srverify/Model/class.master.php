<?php
class MASTER{
    private $conn;
    private $cat_table_name = "mi_category";
	private $subcat_table = "mi_subcategory";
	private $godown_table = "mi_godown";
	private $varient_table = "mi_varient";
	private $ptype_table = "mi_ptype";
	private $rating_table = "mi_rating";
	private $brand_table = "mi_brand";
	private $blog_table = "mi_blogs";
	private $slider_table = "mi_slider";
	private $pcat_table = "mi_pcat";
	private $wproduct_table = "mi_wproduct";
	private $wproduct_detail_table = "mi_wproduct_detail";
	private $news_table = "mi_news";
	private $job_table = "mi_jobs";
	private $state_table = "mi_state";
	private $dealer_table = "mi_dealer";
	private $faq_table = "mi_faq";
	private $product_table = "mi_product";
	private $product_detail_table = "mi_product_detail";
	private $customer_table = "mi_customer";
	private $electrician_table = "mi_electrician";
	private $customer_prd_table = "mi_customer_product";
	private $electrician_prd_table = "mi_electrician_product";
	
    // object properties
   
    public $rdate;
	public $fname;
	public $cfname;
	public $gen_name;
	public $lname;
	public $clname;
	public $usertype;
	public $mobile;
	public $mobile2;
	public $state;
	public $cmobile;
	public $cstate;
	public $otp;
	public $city;
	public $address;
	public $ccity;
	public $caddress;
	public $pdate;
	public $serial_no;
	public $prd_id;
	public $message;
	public $language;
	public $warranty;
	
	public $video = NULL;
	public $selfie = NULL;
	public $bill_img = NULL;
	public $install_img = NULL;
	public $selfie_prd_img = NULL;
	public $amf_img = NULL;
	public $amf_con_img = NULL ;
	public $gen_con_img = NULL ;
	
	
	
	
	public function __construct($db){
        $this->conn = $db;
    }
	public function send_otp(){
		global $objsms;
		$objsms->mobile=$this->mobile;
		$_SESSION['otp']=rand(1000,9999);
		$objsms->message='Your OTP for SUBTECH login is '.$_SESSION['otp'].'. Valid for 10 min.';
		$ok=$objsms->send_sms();
		if($ok){
			return 1;
		}else{
			return 2;
		}
	}
	public function send_cotp(){
		global $objsms;
		
		$objsms->mobile=$this->mobile;
		
		$_SESSION['otp']=rand(1000,9999);
		$objsms->message='Your OTP for SUBTECH login is '.$_SESSION['otp'].'. Valid for 10 min.';
		$ok=$objsms->send_sms();
		if($ok){
			$_SESSION['cmobile']=$this->mobile;
			return 1;
		}else{
			return 2;
		}
	}
	public function check_otp(){
		if($this->otp==$_SESSION['otp']){  //'12345'
			if($this->usertype=='customer'){
				$nc=$this->conn->exeQuery("select * from ".$this->customer_table." where mobile='".$this->mobile."' and mi_status='Yes'");
			}else if($this->usertype=='electrician'){
				$nc=$this->conn->exeQuery("select * from ".$this->electrician_table." where mobile='".$this->mobile."' and mi_status='Yes'");
			}
			if($nc->num_rows){
				$_SESSION['usertype']=$this->usertype;
				$_SESSION['mobile']=$this->mobile;
				return 3;
			}
			$_SESSION['otp']=='';
			return true;
		}else{
			return false;
		}
	}
	public function update_step1(){
		if($this->usertype=='customer'){
			$_SESSION['usertype']='customer';
			$_SESSION['mobile']=$this->mobile;
			$nc=$this->conn->exeQuery("select * from ".$this->customer_table." where mobile='".$this->mobile."' and mi_status='Yes'");
			if(!$nc->num_rows){
				$str="INSERT INTO ".$this->customer_table."(`rdate`, `cmp_id`, `user_id`,`language`, `mobile`) VALUES ('".$this->rdate."','subtech','self','".$this->language."','".$this->mobile."')";
				return $this->conn->exeQuery($str);
			}else{
				return true;
			}
			
		}else if($this->usertype=='electrician'){
			$_SESSION['usertype']='electrician';
			$_SESSION['mobile']=$this->mobile;
			$nc=$this->conn->exeQuery("select * from ".$this->electrician_table." where mobile='".$this->mobile."' and mi_status='Yes'");
			if(!$nc->num_rows){
				$str="INSERT INTO ".$this->electrician_table."(`rdate`, `language`, `mobile`) VALUES ('".$this->rdate."','".$this->language."','".$this->mobile."')";
				return $this->conn->exeQuery($str);
			}else{
				return true;
			}
		}
	}
	public function update_step2(){
		if($_SESSION['usertype']=='customer'){
			$this->conn->exeQuery("update ".$this->customer_table." set cname='".$this->fname." ".$this->lname."' where mobile='".$_SESSION['mobile']."'");
			$nc=$this->conn->exeQuery("select * from mi_customer_address where mobile='".$this->mobile."' and mi_status='Yes'");
			if(!$nc->num_rows){
				$str="INSERT INTO mi_customer_address(`rdate`, `cmp_id`, `user_id`, `mobile`, `mi_status` ) VALUES ('".$this->rdate."','subtech','self','".$_SESSION['mobile']."','Yes')";
				return $this->conn->exeQuery($str);
			}/*else{
				$str="update mi_customer_address set `state`='".$this->state."', `city`='".$this->city."', `address`='".$this->address."' where `mobile`='".$_SESSION['mobile']."'";
				return $this->conn->exeQuery($str);
			}*/
			
		}else if($this->usertype=='electrician'){
			$_SESSION['cmobile']=$this->cmobile;
			$str="update ".$this->electrician_table." set `fname`='".$this->fname."', `state`='".$this->state."',`city`='".$this->city."',`address`='".$this->address."'  where `mobile`='".$_SESSION['mobile']."' ";
			
			$ok= $this->conn->exeQuery($str);
			if($ok){

				$nc=$this->conn->exeQuery("select * from ".$this->customer_table." where mobile='".$this->cmobile."' and mi_status='Yes'");
				if(!$nc->num_rows){
					$this->conn->exeQuery("insert into ".$this->customer_table." (`rdate`, `cmp_id`, `user_id`,`elect_by`,`language`, `mobile`,`mobile2`, `cname`, `mi_status` ) values ('".$this->rdate."','subtech','electrician','".$_SESSION['mobile']."','".$this->language."','".$this->cmobile."','".$this->mobile2."', '".$this->cfname." ".$this->clname."', 'Yes')");
					$str="INSERT INTO mi_customer_address(`rdate`, `cmp_id`, `user_id`, `mobile`, `mi_status`) VALUES ('".$this->rdate."','subtech','electrician','".$this->cmobile."','Yes')";
					$this->conn->exeQuery($str);
				}else{
					$str="INSERT INTO mi_customer_address(`rdate`, `cmp_id`, `user_id`, `mobile`, `mi_status`) VALUES ('".$this->rdate."','subtech','electrician','".$this->cmobile."','Yes')";
					//$str="update mi_customer_address set `state`='".$this->cstate."', `city`='".$this->ccity."', `address`='".$this->caddress."' where `mobile`='".$this->cmobile."'";
					$this->conn->exeQuery($str);
				}

				//$this->updateselfie();
				return true;
			}else{
				return false;
			}
		}
	}
	public function updateselfie(){
		$selfie_filename = $this->saveCompressedImage($this->selfie, 'selfie_'.$_SESSION['mobile']);
		if($selfie_filename){
			$query = "update ".$this->electrician_table." set `selfie`='".$selfie_filename."' where mobile='".$_SESSION['mobile']."'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
		   return true;
		}
 
    }
	public function update_step3(){
		
		if($_SESSION['usertype']=='customer'){
			
			$qr=$this->conn->exeQuery("select * from ".$this->customer_prd_table." where mobile='".$_SESSION['mobile']."' and serial_no='".$this->serial_no."' and mi_status='Yes'");
			
			$expdate=date("Y-m-d",strtotime($this->pdate."+ ".$this->warranty));
			//return $expdate;
			if($qr->num_rows){
				$sql="update ".$this->customer_prd_table." set pr_date='".$this->pdate."', exp_date='".$expdate."' where mobile='".$_SESSION['mobile']."' and serial_no='".$this->serial_no."'";  
			}else{
				$sql="insert into ".$this->customer_prd_table." (`rdate`, `cmp_id`, `user_id`, `mobile`, `product`, `serial_no`, `pr_from`, `pr_date`, `exp_date`, `gen_name`, `mi_status`) values('".$this->rdate."','subtech','self','".$_SESSION['mobile']."','".$this->prd_id."','".$this->serial_no."','','".$this->pdate."','".$expdate."','".$this->gen_name."','Yes')"; 
			}
			$this->conn->exeQuery($sql);
			$this->conn->exeQuery("update mi_product_detail set cust_id='".$_SESSION['mobile']."' where serial_no='".$this->serial_no."' and mi_status='Yes'");
			$this->updatebillimg($_SESSION['mobile']);
		}else{
			$qr=$this->conn->exeQuery("select * from ".$this->customer_prd_table." where mobile='".$_SESSION['cmobile']."' and serial_no='".$this->serial_no."' and mi_status='Yes'");
			
			$expdate=date("Y-m-d",strtotime($this->pdate."+ ".$this->warranty));
			//return $expdate;
			if($qr->num_rows){
				$sql="update ".$this->customer_prd_table." set elect_by='".$_SESSION['mobile']."', pr_date='".$this->pdate."', exp_date='".$expdate."' where mobile='".$_SESSION['cmobile']."' and serial_no='".$this->serial_no."'";  
			}else{
				$sql="insert into ".$this->customer_prd_table." (`rdate`, `cmp_id`, `user_id`, `elect_by`, `mobile`, `product`, `serial_no`, `pr_from`, `pr_date`, `exp_date`, `gen_name`, `mi_status`) values('".$this->rdate."','subtech','self','".$_SESSION['mobile']."','".$_SESSION['cmobile']."','".$this->prd_id."','".$this->serial_no."','".$_SESSION['mobile']."','".$this->pdate."','".$expdate."','".$this->gen_name."','Yes')"; 

			}
			$this->conn->exeQuery($sql);
			$this->conn->exeQuery("update mi_product_detail set cust_id='".$_SESSION['cmobile']."' where serial_no='".$this->serial_no."' and mi_status='Yes'");
			$this->uploadVideo();
			//$this->updatebillimg($_SESSION['cmobile']);
		}
		$_SESSION['usertype']='';
		$_SESSION['mobile']='';
		$_SESSION['cmobile']='';
		return true;
	}
	
	function uploadVideo( $uploadDir = '../../crmpanel/crm/images/cust_img/', $maxSize = 20971520) {
		// 20MB = 20 * 1024 * 1024
		if (!isset($this->video) || $this->video['error'] !== UPLOAD_ERR_OK) {
			return false;//['status' => false, 'message' => 'No video uploaded'];
		}

		// Size check
		if ($this->video['size'] > $maxSize) {
			return false;//['status' => false, 'message' => '❌ File too large (Max 20MB allowed)'];
		}

		// Create folder if not exists
		$dir = rtrim($uploadDir, '/').'/';
		if (!is_dir($dir)) {
			mkdir($dir, 0775, true);
		}

		// Allowed extensions
		$ext = '.bin';
		$type = $this->video['type'];
		if (strpos($type, 'mp4') !== false) $ext = '.mp4';
		elseif (strpos($type, 'webm') !== false) $ext = '.webm';

		$filename = 'video_' . time() . $ext;
		$destination = $dir . $filename;

		if (move_uploaded_file($this->video['tmp_name'], $destination)) {
			$query = "update " . $this->customer_prd_table . " set `video`='" . $filename . "' where mobile='".$_SESSION['cmobile']."' and serial_no='" . $this->serial_no . "'";
			$this->conn->exeQuery($query);
			return true;
		} else {
			return true;
		}
	}
	/*public function updatebillimg($mob){
       if($this->bill_img["name"]!=''){
		   $exp = explode(".", $this->bill_img["name"]);
		   $extension = end($exp);
		   $imagename=$this->serial_no."_billimg.";
			$filename=$imagename.$extension;
			move_uploaded_file($this->bill_img["tmp_name"], "../../crmpanel/crm/images/cust_img/".$filename);
		   $query = "update ".$this->customer_prd_table." set `bill_img`='".$filename."' where mobile='".$mob."' and serial_no='".$this->serial_no."'";
		   $this->conn->exeQuery($query);
	   }
	   if($this->amf_con_img["name"]!=''){
		   $exp = explode(".", $this->amf_con_img["name"]);
		   $extension = end($exp);
		   $imagename=$this->serial_no."_amfconimg.";
			$filename=$imagename.$extension;
			move_uploaded_file($this->amf_con_img["tmp_name"], "../../crmpanel/crm/images/cust_img/".$filename);
		   $query = "update ".$this->customer_prd_table." set `amf_con_img`='".$filename."' where mobile='".$mob."' and serial_no='".$this->serial_no."'";
		   $this->conn->exeQuery($query);
	   }
	   if($this->gen_con_img["name"]!=''){
		   $exp = explode(".", $this->gen_con_img["name"]);
		   $extension = end($exp);
		   $imagename=$this->serial_no."_genconimg.";
			$filename=$imagename.$extension;
			move_uploaded_file($this->gen_con_img["tmp_name"], "../../crmpanel/crm/images/cust_img/".$filename);
		   $query = "update ".$this->customer_prd_table." set `gen_con_img`='".$filename."' where mobile='".$mob."' and serial_no='".$this->serial_no."'";
		   $this->conn->exeQuery($query);
	   }
	   if($this->install_img["name"]!=''){
		   $exp = explode(".", $this->install_img["name"]);
		   $extension = end($exp);
		   $imagename=$this->serial_no."_installimg.";
			$filename=$imagename.$extension;
			move_uploaded_file($this->install_img["tmp_name"], "../../crmpanel/crm/images/cust_img/".$filename);
		   $query = "update ".$this->customer_prd_table." set `install_img`='".$filename."' where mobile='".$mob."' and serial_no='".$this->serial_no."'";
		   $this->conn->exeQuery($query);
	   }
	   if($this->selfie_prd_img["name"]!=''){
		   $exp = explode(".", $this->selfie_prd_img["name"]);
		   $extension = end($exp);
		   $imagename=$this->serial_no."_selfieprdimg.";
			$filename=$imagename.$extension;
			move_uploaded_file($this->selfie_prd_img["tmp_name"], "../../crmpanel/crm/images/cust_img/".$filename);
		   $query = "update ".$this->customer_prd_table." set `selfie_prd_img`='".$filename."' where mobile='".$mob."' and serial_no='".$this->serial_no."'";
		   $this->conn->exeQuery($query);
	   }
	   return true;
	   
    }*/
	public function updatebillimg($mob) {
		$bill_img_filename = $this->saveCompressedImage($this->bill_img, 'billimg');
		if ($bill_img_filename) {
			$query = "update " . $this->customer_prd_table . " set `bill_img`='" . $bill_img_filename . "' where mobile='" . $mob . "' and serial_no='" . $this->serial_no . "'";
			$this->conn->exeQuery($query);
		}
		
		$amf_con_filename = $this->saveCompressedImage($this->amf_con_img, 'amfconimg');
		if ($amf_con_filename) {
			$query = "update " . $this->customer_prd_table . " set `amf_con_img`='" . $amf_con_filename . "' where mobile='" . $mob . "' and serial_no='" . $this->serial_no . "'";
			$this->conn->exeQuery($query);
		}

		$gen_con_filename = $this->saveCompressedImage($this->gen_con_img, 'genconimg');
		if ($gen_con_filename) {
			$query = "update " . $this->customer_prd_table . " set `gen_con_img`='" . $gen_con_filename . "' where mobile='" . $mob . "' and serial_no='" . $this->serial_no . "'";
			$this->conn->exeQuery($query);
		}

		$install_filename = $this->saveCompressedImage($this->install_img, 'installimg');
		if ($install_filename) {
			$query = "update " . $this->customer_prd_table . " set `install_img`='" . $install_filename . "' where mobile='" . $mob . "' and serial_no='" . $this->serial_no . "'";
			$this->conn->exeQuery($query);
		}

		$selfie_prd_filename = $this->saveCompressedImage($this->selfie_prd_img, 'selfieprdimg');
		if ($selfie_prd_filename) {
			$query = "update " . $this->customer_prd_table . " set `selfie_prd_img`='" . $selfie_prd_filename . "' where mobile='" . $mob . "' and serial_no='" . $this->serial_no . "'";
			$this->conn->exeQuery($query);
		}
		return true;
	}
	public function saveCompressedImage($uploadedFile, $prefix) {
		if (!isset($uploadedFile["name"]) || $uploadedFile["name"] == '') {
			return false;
		}
		
		$exp = explode(".", $uploadedFile["name"]);
		$extension = strtolower(end($exp));
		$imagename = $this->serial_no . "_" . $prefix . ".";
		$filename = $imagename . $extension;
		$target_dir = "../../crmpanel/crm/images/cust_img/";
		$target_file = $target_dir . $filename;

		$img_info = getimagesize($uploadedFile["tmp_name"]);
		if ($img_info === false) {
			return false; // Not a valid image
		}

		if ($extension == 'jpg' || $extension == 'jpeg') {
			$image = imagecreatefromjpeg($uploadedFile["tmp_name"]);
			imagejpeg($image, $target_file, 75);
		} elseif ($extension == 'png') {
			$image = imagecreatefrompng($uploadedFile["tmp_name"]);
			imagepng($image, $target_file, 6);
		} else {
			move_uploaded_file($uploadedFile["tmp_name"], $target_file);
		}
		imagedestroy($image);
		
		return $filename;
	}
	public function update_step4(){
		$_SESSION['usertype']='';
		$_SESSION['mobile']='';
		$_SESSION['cmobile']='';
		
		return true;
	}
	
    public function prod_details($id)
	{
		$query="select * from ".$this->product_table." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row;
	}
	
    public function cat_name($id)
	{
		$query="select * from ".$this->cat_table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat_name'];
	}
	public function subcat_name($id)
	{
		$query="select * from ".$this->subcat_table." where  id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['subcat_name'];
	}
	public function varient_name($id)
	{
		$query="select * from ".$this->varient_table." where  id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat_name'];
	}
	public function rating_name($id)
	{
		$query="select * from ".$this->rating_table." where  id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat_name'];
	}
	public function ptype_name($id)
	{
		$query="select * from ".$this->ptype_table." where  id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat_name'];
	}
	public function state_name($id)
	{
		$query="select * from ".$this->state_table." where  id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['state'];
	}
	public function state_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->state_table." where mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
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
	
	
	
	
	
	
	
}
$objmaster= new Master($db);