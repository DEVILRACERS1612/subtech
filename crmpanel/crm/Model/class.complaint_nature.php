<?php
class COMPLAINTNATURE{
    private $conn;
    private $table_name = "mi_complaint_nature";
	private $customer_table = "mi_customer";
	private $noti_table = "mi_notifications";
	private $address_table = "mi_customer_address";
	private $customer_product_table = "mi_customer_product";
	private $customer_cmpl_table = "mi_customer_complain";
	private $complain_assign_table = "mi_complain_assign";
	private $product_detail_table = "mi_product_detail";
	private $product_table = "mi_product";
	private $cashback_table = "mi_electrician_cashback";
	private $payment_table = "mi_electrician_payment";
	private $electrician_table = "mi_electrician";
	
    // object properties
   
    public $rdate;
	public $complaint_nature;
	
	public $csource;
	public $mobile;
	public $amount;
	public $mobile2;
	public $cname;
	public $email;
	public $address;
	public $google_map_link;
	public $defect;
	public $remark;
	public $serial_no;
	public $vdate;
	public $vtime;
	public $tech;
	public $product;
	public $pfrom;
	public $priority;
	public $pdate;
	public $cmpl_no;
	public $data_id;
	public $image = NULL;
	public $cdata;
	public $pdata;
	public $bank;
	public $branch;
	public $ifsc;
	public $acno;
	public $acname;
	public $upid;
	
    public $edit_id;
    public $del_id;
    public $permission;
    
    public function __construct($db){
        $this->conn = $db;
		$this->permission=$this->permission;
    }
	public function find_id($indus)
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and complaint_nature='".$indus."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and complaint_nature='".$indus."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return false;
			}else{
				return true;
			}
		}
	}

	public function transport_mode_name($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['complaint_nature'];
	}

	public function transport_mode_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['complaint_nature'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['complaint_nature'].' </option>';
			}
		}
		return $str;
	}

    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*return "ok";*/
			$ni=count($this->complaint_nature);
			for($i=0;$i<$ni;$i++)
			{
				if($this->complaint_nature[$i]!="" and $this->find_id($this->complaint_nature[$i])){
					$query = $this->conn->exeQuery("INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `complaint_nature`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->complaint_nature[$i]."','Yes')");
					//return $query;
				}else{
					return 2;
				}
			}
			
			if($query){
				return 1;
			}else{
				return 3;
			}
		}else{
			return 3;
		}
		
    }
	
	public function update(){
       $this->edit_id=$this->conn->filterVar($this->edit_id);
		if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
	   		if($this->complaint_nature[0]!="" and $this->find_id($this->complaint_nature[0])){
				
			$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',`complaint_nature`='".$this->complaint_nature[0]."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 2;
			}
		}else{
			return 3;
		}
    }
	public function deleteme(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="delete from ".$this->table_name." where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function view(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['complaint_nature']."</td><td><a href='".BASE_PATH."Add_Complaint_Nature/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////\\\\ New Complaint \\\\///////////////////////////////////
	public function create_cmpl_no()
	{
		//$id=rand(1000000000,9999999999);
		$d=date("ym");
		$id=$d.substr(str_shuffle("0123456789"), 0, 4);
		
		if($this->check_cmpl_no($id) or strlen($id)<6)
		{
			$this->create_cmpl_no();
		}else{
			return $id;
		}
	}
	public function check_cmpl_no($id)
	{
		$sql=$this->conn->exeQuery("select * from ".$this->customer_cmpl_table." where cmpl_no='".$id."'");
		if($sql->num_rows)
		{
			return true;
		}else{
			return false;
		}
	}
	public function register_new_complaint(){
       //$this->edit_id=$this->conn->filterVar($this->edit_id);
		if($this->permission['pg_create']=='Yes' or $this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
	   		global $objproduct;global $objsms;
			//$objsms->message="We have registered your complaint ID: 1234 on 04-08-2025 for Product1. Thank you for reaching out to Subtech Support";
			//$objsms->mobile=$this->mobile;
			//$oksms=$objsms->send_sms();
			//return $oksms;
			$uploadDir = '../images/warranty_img/';
			$maxWidth = 400; // Resize width
			$quality = 85;   // JPEG quality (0–100)

			if (!file_exists($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}
			
			if($this->edit_id!=""){
				$this->cmpl_no=$this->edit_id;
				$str="update ".$this->customer_table." set `user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `mobile2`='".$this->mobile2."',`cname`='".$this->cname."', `email`='".$this->email."', `address`='".$this->address."' where `mobile`='".$this->mobile."' ";	
				$this->conn->exeQuery($str);
				//////////////////////
				$prdrow=$this->conn->exeQuery("select * from ".$this->customer_product_table." where mobile='".$this->mobile."' and cmpl_no='".$this->cmpl_no."' and mi_status='Yes'")->fetch_assoc();
				
				$this->conn->exeQuery("update ".$this->product_detail_table." set `exp_date`=null, cust_id=null where serial_no='".$prdrow['serial_no']."' and mi_status='Yes'");
				////////////
				$pr=$objproduct->item_details($this->product);
			
				$warranty=($pr['warranty']!="")?$pr['warranty']:'12 Months';
				
				$expdate=date("Y-m-d",strtotime($this->pdate." + ".$warranty));
				/////////////////////////////////
				$cq=$this->conn->exeQuery("select * from ".$this->customer_product_table." where mobile='".$this->mobile."' and cmpl_no='".$this->cmpl_no."' and mi_status='Yes'");
				
				if(!$cq->num_rows){
					$str="INSERT INTO ".$this->customer_product_table."(`id`, `rdate`, `cmp_id`, `user_id`, `cmpl_no`, `mobile`, `product`, `serial_no`, `pr_from`, `pr_date`,`exp_date`, `mi_status`) values ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cmpl_no."','".$this->mobile."','".$this->product."','".$this->serial_no."','".$this->pfrom."','".$this->pdate."','".$expdate."','Yes')";	
					$ok=$this->conn->inserted_id($str);
				}else{
					$this->conn->exeQuery("update ".$this->customer_product_table." set `rdate`='".$this->rdate."', `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."', `user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `product`='".$this->product."', `serial_no`='".$this->serial_no."', `pr_from`='".$this->pfrom."', `pr_date`='".$this->pdate."',`exp_date`='".$expdate."', `mi_status`='Yes' where `mobile`='".$this->mobile."' and `cmpl_no`='".$this->cmpl_no."' ");
					$cqrow=$cq->fetch_assoc();
					$ok=$cqrow['id'];
				}
				/////////////////////
				if($_FILES['image']['name']!=""){
					$tmpName = $_FILES['image']['tmp_name'];
					$fileName = basename($_FILES['image']['name']);
					$extension = end(explode(".",$fileName));
					$fileType = mime_content_type($tmpName);
					
					$filename=$this->serial_no."_".uniqid(). "_" . $id.".".$extension;
					$targetFile = $uploadDir . $filename;
					
					if (strpos($fileType, 'image/') === 0) {
						// Resize and save
					//$this->resizeAndSaveImage($tmpName, $targetFile, $maxWidth, $quality);
					move_uploaded_file($tmpName, $targetFile);
					$query = $this->conn->exeQuery("update ".$this->customer_product_table." set image='".$filename."' where `cmpl_no`='".$this->cmpl_no."' ");
					}
				}
				/////////////////////				
				
				if($this->serial_no!=""){
					$q=$this->conn->exeQuery("select * from ".$this->product_detail_table." where serial_no='".$this->serial_no."' and cust_id='' and mi_status='Yes'");
					if(!$q->num_rows){
						$this->conn->exeQuery("INSERT INTO ".$this->product_detail_table."(`id`, `rdate`, `cmp_id`, `user_id`, `prd_id`, `batch_no`, `serial_no`, `model`, `brand`, `mfg_date`,`exp_date`, `cust_id`, `mi_status`) values('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->product."','OLD','".$this->serial_no."','".$pr['model']."','".$pr['brand']."','".$this->pdate."','".$expdate."','".$this->mobile."','Yes')");
					}else{
						$this->conn->exeQuery("update ".$this->product_detail_table." set `exp_date`='".$expdate."',cust_id='".$this->mobile."' where serial_no='".$this->serial_no."' and mi_status='Yes'");
					}
				}
				$str="update ".$this->customer_cmpl_table." set `rdate`='".$this->rdate."', `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."', `user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',  `csource`='".$this->csource."', `address`='".$this->address."',`google_map_link`='".$this->google_map_link."', `product`='".$this->product."', `serial_no`='".$this->serial_no."', `defect`='".$this->defect."', `priority`='".$this->priority."',`remark`='".$this->remark."' where `mobile`='".$this->mobile."' and `cmpl_no`='".$this->cmpl_no."' ";	
				$ok=$this->conn->exeQuery($str);
				
				
				if($ok){
					return 1;
				}else{
					return 3;
				}
			}else{
				$n=$this->conn->exeQuery("select * from ".$this->customer_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mobile='".$this->mobile."' and mi_status='Yes'")->num_rows;
							
				if($this->mobile!=""){
					$this->cmpl_no=$this->create_cmpl_no();
				if(!$n){
					$str="INSERT INTO ".$this->customer_table."(`id`, `rdate`, `cmp_id`, `user_id`, `mobile`,`mobile2`, `cname`, `email`, `address`, `mi_status`) values ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->mobile."','".$this->mobile2."','".$this->cname."','".$this->email."','".$this->address."','Yes')";	
					$ok=$this->conn->exeQuery($str);
				}else{
					$str="update ".$this->customer_table." set `user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `mobile2`='".$this->mobile2."',`cname`='".$this->cname."', `email`='".$this->email."', `address`='".$this->address."' where `mobile`='".$this->mobile."' ";	
					$this->conn->exeQuery($str);
				}
				$pr=$objproduct->item_details($this->product);
				
				$warranty=($pr['warranty']!="")?$pr['warranty']:'12 Months';
				
				$expdate=date("Y-m-d",strtotime($this->pdate." + ".$warranty));
				/////////////////////////////////
				$cq=$this->conn->exeQuery("select * from ".$this->customer_product_table." where mobile='".$this->mobile."' and cmpl_no='".$this->cmpl_no."' and product='".$this->product."' and serial_no='".$this->serial_no."' and mi_status='Yes'");
				
				if(!$cq->num_rows){
					$str="INSERT INTO ".$this->customer_product_table."(`id`, `rdate`, `cmp_id`, `user_id`, `cmpl_no`, `mobile`, `product`, `serial_no`, `pr_from`, `pr_date`,`exp_date`, `mi_status`) values ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cmpl_no."','".$this->mobile."','".$this->product."','".$this->serial_no."','".$this->pfrom."','".$this->pdate."','".$expdate."','Yes')";	
					$ok=$this->conn->inserted_id($str);
				}
					
				
				if($this->serial_no!=""){
					$q=$this->conn->exeQuery("select * from ".$this->product_detail_table." where serial_no='".$this->serial_no."' and cust_id='' and mi_status='Yes'");
					if(!$q->num_rows){
						$this->conn->exeQuery("INSERT INTO ".$this->product_detail_table."(`id`, `rdate`, `cmp_id`, `user_id`, `prd_id`, `batch_no`, `serial_no`, `model`, `brand`, `mfg_date`,`exp_date`, `cust_id`, `mi_status`) values('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->product."','OLD','".$this->serial_no."','".$pr['model']."','".$pr['brand']."','".$this->pdate."','".$expdate."','".$this->mobile."','Yes')");
					}else{
						$this->conn->exeQuery("update ".$this->product_detail_table." set `exp_date`='".$expdate."',cust_id='".$this->mobile."' where serial_no='".$this->serial_no."' and mi_status='Yes'");
					}
				}
				/////Image saving here
					if($_FILES['image']['name']!=""){
						$tmpName = $_FILES['image']['tmp_name'];
						$fileName = basename($_FILES['image']['name']);
						$extension = end(explode(".",$fileName));
						$fileType = mime_content_type($tmpName);
						
						$filename=$this->serial_no."_".uniqid(). "_" . $id.".".$extension;
						$targetFile = $uploadDir . $filename;
						
						if (strpos($fileType, 'image/') === 0) {
							// Resize and save
						//$this->resizeAndSaveImage($tmpName, $targetFile, $maxWidth, $quality);
						move_uploaded_file($tmpName, $targetFile);
						$query = $this->conn->exeQuery("update ".$this->customer_product_table." set image='".$filename."' where `id`='".$ok."' ");
						}
					}
					$objsms->message="We have registered your complaint ID: ".$this->cmpl_no." on ".date("d-M-Y")." for ".$pr['model'].". Thank you for reaching out to Subtech Support";
					$objsms->mobile=$this->mobile;
					$oksms=$objsms->send_sms();
						
					$str="INSERT INTO ".$this->customer_cmpl_table."(`id`, `rdate`, `cmp_id`, `user_id`, `cmpl_no`, `csource`, `mobile`,`address`,`google_map_link`, `product`, `serial_no`, `defect`, `priority`,`remark`, `mi_status`) values ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cmpl_no."','".$this->csource."','".$this->mobile."','".$this->address."','".$this->google_map_link."','".$this->product."','".$this->serial_no."','".$this->defect."','".$this->priority."','".$this->remark."','Yes')";	
					$ok=$this->conn->exeQuery($str);
					if($ok){
						return 1;
					}else{
						return 3;
					}
				}else{
					return 4;
				}
			}
			
		}else{
			return 3;
		}
    }
	public function check_serial(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$q=$this->conn->exeQuery("select * from ".$this->product_detail_table." where serial_no='".$this->serial_no."' and mi_status='Yes'");
			if($q->num_rows){
				$row=$q->fetch_assoc();
				$this->product=$row['prd_id'];
				if($row['cust_id']!=""){
					$crow=$this->conn->exeQuery("select pr_from,pr_date from ".$this->customer_product_table." where mobile='".$row['cust_id']."' and serial_no='".$row['serial_no']."' and mi_status='Yes'")->fetch_assoc();
					$this->pfrom=$crow['pr_from'];
					$this->pdate=$crow['pr_date'];
				}
				return 1;
				/*if($row['cust_id']!=""){
					return 2;
				}else{
					return 1;
				}*/
			}else{
				return 3;
			}
		}
	}
	public function add_warranty(){
       //$this->edit_id=$this->conn->filterVar($this->edit_id);
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
	   		global $objproduct;
			$n=$this->conn->exeQuery("select * from ".$this->customer_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mobile='".$this->mobile."' and mi_status='Yes'")->num_rows;
			if(!$n){
				$str="INSERT INTO ".$this->customer_table."(`id`, `rdate`, `cmp_id`, `user_id`, `mobile`,`mobile2`, `cname`, `email`, `address`, `remark`, `mi_status`) values ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->mobile."','".$this->mobile2."','".$this->cname."','".$this->email."','".$this->address."','".$this->remark."','Yes')";	
				$ok=$this->conn->exeQuery($str);
			}
			$n=$this->conn->exeQuery("select * from ".$this->customer_product_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and product='".$this->product."' and serial_no='".$this->serial_no."' and mi_status='Yes'")->num_rows;
			if($n){return 2;}
			if($this->mobile!=""){
				
				$uploadDir = '../images/warranty_img/';
				$maxWidth = 400; // Resize width
				$quality = 85;   // JPEG quality (0–100)

				if (!file_exists($uploadDir)) {
					mkdir($uploadDir, 0755, true);
				}	
				//$this->cmpl_no=$this->create_cmpl_no();
			//return "ok";
			$pr=$objproduct->item_details($this->product);
			$expdate=date("Y-m-d",strtotime($this->pdate." + ".$pr['warranty']));
			/////////////////////////////////
				$str="INSERT INTO ".$this->customer_product_table."(`id`, `rdate`, `cmp_id`, `user_id`, `mobile`, `product`, `serial_no`, `pr_from`, `pr_date`,`exp_date`,`sono`, `mi_status`) values ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->mobile."','".$this->product."','".$this->serial_no."','".$this->pfrom."','".$this->pdate."','".$expdate."','".$this->sono."','Yes')";	
				$ok=$this->conn->inserted_id($str);
			/////Image saving here
				if($_FILES['image']['name']!=""){
					$tmpName = $_FILES['image']['tmp_name'];
					$fileName = basename($_FILES['image']['name']);
					$extension = end(explode(".",$fileName));
					$fileType = mime_content_type($tmpName);
					
					$filename=$this->serial_no."_".uniqid(). "_" . $id.".".$extension;
					$targetFile = $uploadDir . $filename;
					
					if (strpos($fileType, 'image/') === 0) {
						// Resize and save
					//$this->resizeAndSaveImage($tmpName, $targetFile, $maxWidth, $quality);
					move_uploaded_file($tmpName, $targetFile);
					$query = $this->conn->exeQuery("update ".$this->customer_product_table." set image='".$filename."' where `id`='".$ok."' ");
					}
				}
	
				if($ok){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			return 3;
		}
    }
	public function customer_detail($id){
		$qr=$this->conn->exeQuery("select * from ".$this->customer_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (mobile='".$id."' or email='".$id."') and mi_status='Yes'");
		if($qr->num_rows){
			return $qr->fetch_assoc();
		}else{
			return false;
		}
	}
	public function update_bank_detail(){
		$qr=$this->conn->exeQuery("update ".$this->electrician_table." set bank='".$this->bank."', branch='".$this->branch."', acno='".$this->acno."', ifsc='".$this->ifsc."', acname='".$this->acname."', upid='".$this->upid."' where mobile='".$this->mobile."' and mi_status='Yes'");
		if($qr){
			return true;
		}else{
			return false;
		}
	}
	public function electrician_payment(){
		$qr=$this->conn->exeQuery("insert into ".$this->payment_table." (`rdate`, `cmp_id`, `user_id`, `elect_id`, `amount`, `remark`) values ('".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->mobile."','".$this->amount."','".$this->remark."')");
		if($qr){
			return true;
		}else{
			return false;
		}
	}
	public function search_complain_data(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			global $objproduct;global $objcat;
			$str=$this->conn->exeQuery("select * from ".$this->customer_cmpl_table." where  cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (cmpl_no='".$this->data_id."' or mobile='".$this->data_id."' or serial_no='".$this->data_id."') and mi_status='Yes' limit 1");
			//return $str;
			$cd="";
			$pd="";$n=1;
			if($str->num_rows){
				while($row=$str->fetch_assoc()){
					$cust=$this->customer_detail($row['mobile']);
					$cd.="<tr><td>".$cust['cname']."</td><td>".$cust['mobile']."</td><td>".$cust['address']."</td></tr>";
					$str1=$this->conn->exeQuery("select * from ".$this->customer_product_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and ( mobile='".$cust['mobile']."') and mi_status='Yes'");
					if($str1->num_rows){
						
						while($row1=$str1->fetch_assoc()){
							$pr=$objproduct->item_details($row1['product']);
							$pd.="<tr><td>".$n.". </td><td>".$objcat->brand_name($pr['brand'])."</td><td>".$pr['model']."</td><td>".$row1['serial_no']."</td><td>".$row1['exp_date']."</td><td><a href=''><i class='fa fa-edit'></i></a></td></tr>";
							$n++;
						}
					}
				}
			}else{
				$this->cdata="<tr><td colspan='3'>Customer Not Matched</td></tr>";;
				$this->pdata="<tr><td colspan='6'>Product Not Found</td></tr>";;
				return false;
			}
			$this->cdata=$cd;
			$this->pdata=$pd;
			return true;
		}
	}
	public function complain_detail(){
		$row=$this->conn->exeQuery("select * from ".$this->customer_cmpl_table." where cmpl_no='".$this->cmpl_no."' and mi_status='Yes'")->fetch_assoc();
		return $row;
	}
	public function all_complain_detail(){
		global $objproduct;
		$row=$this->conn->exeQuery("select c.rdate,c.cmpl_no,c.csource,c.mobile,c.address, c.google_map_link, c.defect, c.priority, c.tech_assigned, s.source,cus.mobile2, cus.cname, cus.email, cp.product, cp.serial_no, cp.pr_from, cp.pr_date, cp.exp_date from mi_customer_complain c left join mi_customer_product cp on cp.mobile=c.mobile and cp.product=c.product and cp.serial_no=c.serial_no left join mi_customer cus on cus.mobile=c.mobile left join mi_source s on c.csource=s.id where c.cmpl_no='".$this->cmpl_no."' and c.mi_status='Yes'")->fetch_assoc();
		$data=[
			"type"=>"success",
			"cmpl_date"=>date("d-m-Y",strtotime($row['rdate'])),
			"cmpl_no"=>$row['cmpl_no'],
			"mobile"=>$row['mobile'],
			"address"=>$row['address'],
			"google_map"=>$row['google_map_link'],
			"defect"=>$row['defect'],
			"priority"=>$row['priority'],
			"tech_assigned"=>$row['tech_assigned'],
			"source"=>$row['source'],
			"mobile2"=>$row['mobile2'],
			"cname"=>$row['cname'],
			"email"=>$row['email'],
			"product_data"=>$objproduct->item_details($row['product']),
			"product"=>$objproduct->pname($row['product']),
			"brand"=>$objproduct->product_brand($row['product']),
			"serial_no"=>$row['serial_no'],
			"pur_from"=>$row['pr_from'],
			"pur_date"=>date("d-M-Y",strtotime($row['pr_date'])),
			"exp_date"=>date("d-M-Y",strtotime($row['exp_date']))
		];
		return $data;
	}
	public function complain_tech(){
		$row=$this->conn->exeQuery("select * from ".$this->complain_assign_table." where cmpl_no='".$this->cmpl_no."' and mi_status='Yes' order by id desc limit 1")->fetch_assoc();
		return $row;
	}
//////////// Firebase Notification  //////////////	
function send_notification($device_token, $title, $body)
{
    $serviceAccountPath = __DIR__ . "/../service-account.json"; 
    $serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);
	
	// Load Service Account JSON file
    //$serviceAccount = json_decode(file_get_contents('../service-account.json'), true);

    // Create a JWT (JSON Web Token) for OAuth2
    $header = [
        'alg' => 'RS256',
        'typ' => 'JWT'
    ];

    $now = time();
    $claim = [
        "iss" => $serviceAccount['client_email'],
        "scope" => "https://www.googleapis.com/auth/firebase.messaging",
        "aud" => $serviceAccount['token_uri'],
        "iat" => $now,
        "exp" => $now + 3600
    ];

    $base64UrlHeader = rtrim(strtr(base64_encode(json_encode($header)), '+/', '-_'), '=');
    $base64UrlPayload = rtrim(strtr(base64_encode(json_encode($claim)), '+/', '-_'), '=');
    $signature = '';

    openssl_sign(
        $base64UrlHeader . "." . $base64UrlPayload,
        $signature,
        $serviceAccount['private_key'],
        "sha256"
    );

    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . rtrim(
        strtr(base64_encode($signature), '+/', '-_'),
        '='
    );

    // POST request for Access Token
    $tokenRequestData = http_build_query([
        "grant_type" => "urn:ietf:params:oauth:grant-type:jwt-bearer",
        "assertion"  => $jwt
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $serviceAccount['token_uri']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $tokenRequestData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $tokenData = json_decode($result, true);
    $accessToken = $tokenData['access_token'];

    // Build Notification Body for FCM v1
    $payload = [
        "message" => [
            "token" => $device_token,
            "notification" => [
                "title" => $title,
                "body" => $body
            ]
        ]
    ];

    $projectId = $serviceAccount['project_id'];
    $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

    // Send Push Notification
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    /*return $response;
    return [
        "http_code" => $httpCode,
        "response" => $response
    ];*/
    
}

///////////// Complain Assigned ///////////////////////
	public function tech_assign(){
		if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			global $objuser;
			$this->conn->exeQuery("update ".$this->customer_cmpl_table." set tech_assigned='Yes' where cmpl_no='".$this->cmpl_no."' and mi_status='Yes'");
			
			$str="INSERT INTO ".$this->complain_assign_table."(`rdate`, `cmp_id`, `user_id`, `cmpl_no`, `pdate`, `tech`, `vdate`, `vtime`, `defect`, `remark`, `mi_status`) values ";
			$str1="INSERT INTO ".$this->noti_table."( `rdate`, `cmp_id`, `user_id`, `tech_id`, `cmpl_no`, `message`, `mi_status`) values ";
			$str2="INSERT INTO `mi_electrician_complain`(`rdate`, `elect_id`, `cmpl_no`) VALUES ";
			
			$tch=array();
			$tch=$this->tech;
			foreach($tch as $t){
				$str.="('".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cmpl_no."','".$this->pdate."','".$t."','".$this->vdate."','".$this->vtime."','".$this->defect."','".$this->remark."','Yes'),";
				
				$str1.=" ('".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$t."','".$this->cmpl_no."','Complain no ".$this->cmpl_no." is assigned for you. ".$this->remark."','Yes'),";
				$str2.=" ('".$this->rdate."','".$t."','".$this->cmpl_no."'),";

				$deviceToken = $objuser->electrician_token($t);
				//return $deviceToken;
				if($deviceToken!=""){
					$title='Complain Assigned';
					$noti='Complain No. '.$this->cmpl_no.' is assigned for you';
					$this->send_notification($deviceToken,$title,$noti);
				}
				
				
				
				
				
				
			}
			$str=rtrim($str,",");
			$str1=rtrim($str1,",");
			$str2=rtrim($str2,",");
			
			$ok=$this->conn->exeQuery($str);
			$ok=$this->conn->exeQuery($str1);
			$ok=$this->conn->exeQuery($str2);
			//$ok=1;
			if($ok){
				return true;
			}else{
				return false;
			}
		}
	}
	
	
	
	
	public function assigned_detail(){
		$sql="select e.fname,e.mobile,e.city,c.id,c.cmpl_no,c.rdate,c.status,c.adate from mi_electrician_complain c left join mi_electrician e on e.id=c.elect_id where c.cmpl_no='".$this->cmpl_no."' and c.mi_status='Yes'";
		$str="";
		$qr=$this->conn->exeQuery($sql);
		while($row=$qr->fetch_assoc()){
			$btn='';
			if($row['status']=="Rejected"){
				$btn='';
			}else if($row['status']=="Accepted"){
				$btn='<a href="#" class="btn btn-xs btn-danger reject" data-cmpl="'.$row['cmpl_no'].'" data-id="'.$row['id'].'"><i class="fa fa-times"></i></a>';
			}else{
				$btn='<a href="#" class="btn btn-xs btn-danger reject" data-cmpl="'.$row['cmpl_no'].'" data-id="'.$row['id'].'"><i class="fa fa-times"></i></a> <a href="#" class="btn btn-xs btn-success accept" data-cmpl="'.$row['cmpl_no'].'" data-id="'.$row['id'].'"><i class="fa fa-check"></i></a>';
			}
			
			
			$str.='<tr><td>'.date("d-M-Y H:i",strtotime($row['rdate'])).'</td><td>'.$row['fname'].'</td><td>'.$row['mobile'].'</td><td>'.$row['city'].'</td><td>'.$row['cmpl_no'].'</td><td>'.$row['status'].'</td><td>'.$btn.'</td></tr>';
		}
		return $str;
	}
	public function rej_assigned_elect(){
		$row=$this->conn->exeQuery("select * from mi_electrician_complain where id='".$this->data_id."' and mi_status='Yes'")->fetch_assoc();
		
		$this->conn->exeQuery("update mi_electrician_complain set status='Rejected',adate='".date("Y-m-d H:i:s")."' where id='".$this->data_id."'");
		
		$this->conn->exeQuery("update mi_complain_assign set status='Rejected',cldate='".date("Y-m-d H:i:s")."' where id='".$this->data_id."' and tech='".$row['elect_id']."' ");
		
		$qr=$this->conn->exeQuery("select * from mi_electrician_complain where cmpl_no='".$row['cmpl_no']."' and (status='Accepted' or status='Pending') and mi_status='Yes'");
		if(!$qr->num_rows){
			$this->conn->exeQuery("update ".$this->customer_cmpl_table." set tech_assigned='No' where cmpl_no='".$row['cmpl_no']."' and mi_status='Yes'");
		}
		return 'Rejected Successfull';
	}
	public function accept_assigned_elect(){
		$row=$this->conn->exeQuery("select * from mi_electrician_complain where id='".$this->data_id."' and mi_status='Yes'")->fetch_assoc();
		$qr=$this->conn->exeQuery("select * from mi_electrician_complain where cmpl_no='".$row['cmpl_no']."' and (status='Accepted') and mi_status='Yes'");
		if(!$qr->num_rows){
			$this->conn->exeQuery("update mi_electrician_complain set status='Accepted',adate='".date("Y-m-d H:i:s")."',remark='Accepted By ".$_SESSION[SITE_NAME]['MICMP_name']."' where id='".$this->data_id."'");
			return 'Electrician Accepted Successfull';
		}else{
			return 'Already Accepted by other Electrician';
		}
		
	}
	////////////////////////
	public function electrician_customer_list(){
		$str="<tr><td colspan='5'>Error! Some Data Missing</td></tr>";
		if($this->mobile!=""){
			global $objproduct;
			$str="";

			$qr=$this->conn->exeQuery("SELECT 
					a.id, 
					a.mobile, 
					a.elect_by, 
					a.rdate, 
					a.video, 
					a.cashback, 
					a.act_status, 
					b.cname, 
					ca.state, 
					ca.city, 
					e.fname, 
					p.pname, 
					s.state as state_name
				FROM mi_customer_product a
				LEFT JOIN mi_customer b ON b.mobile = a.mobile
				LEFT JOIN (
					SELECT mobile, state, city 
					FROM mi_customer_address 
					GROUP BY mobile
				) ca ON ca.mobile = a.mobile
				LEFT JOIN mi_state s on s.id=ca.state
				LEFT JOIN mi_electrician e ON e.mobile = a.elect_by
				LEFT JOIN mi_product p ON p.id = a.`product`
				WHERE a.elect_by = '".$this->mobile."' order by a.rdate desc");
			
			if($qr->num_rows){
				$i=1;$tot=0;
				while($row=$qr->fetch_assoc()){
					$tot+=$row['cashback'];
					$vd='';
					if($row['video']!=""){
						$vd="<a href='#' class='vd' data-src='".BASE_PATH."images/cust_img/".$row['video']."'>Video</a>";	
					}
					$actbtn='';
					if($row['act_status']=='Pending'){
						$actbtn="<a href='#' class='btn btn-xs btn-primary verify' data-mobile='".$this->mobile."' data-id='".$row['id']."' title='Verify this Product'><i class='fa fa-check'></i></a> <a href='#' class='btn btn-xs btn-danger reject' data-mobile='".$this->mobile."' data-id='".$row['id']."' title='Reject this Product'><i class='fa fa-times'></i></a>";
					}
					
					$str.="<tr><td>".$i."</td><td>".$row['pname']."</td><td>".$row['fname']."</td><td>".$row['elect_by']."</td><td>".$row['cname']."</td><td>".$row['mobile']."</td><td>".date("d-M-Y",strtotime($row['rdate']))."</td><td>".$row['cashback']."</td><td>".$row['city']."</td><td>".$row['state_name']."</td><td>".$vd."</td><td>".$row['act_status']."</td><td>".$actbtn."</td></tr>";
					//$str="<tr><td colspan='5'>No Customer Found</td></tr>";
					$i++;
				}
				$str.="<tr><th></th><th></th><th></th><th></th><th></th><th></th><th>Total</th><th>".$tot."</th><th></th><th></th><th></th><th></th><th></th></tr>";
			}else{
			$str="<tr><td colspan='5'>No Customer Found</td></tr>";
			}
		}
			return $str;
	}
	public function view_ref_electrician(){
		$str="<tr><td colspan='5'>Error! Some Data Missing</td></tr>";
		if($this->mobile!=""){
			
			$str="";

			$qr=$this->conn->exeQuery("SELECT 
					a.id, 
					a.mobile, 
					a.refid, 
					a.rdate, 
					a.fname, 
					a.email, 
					a.act_status, 
					a.city, 
					a.address, 
					s.state as state_name,
					coalesce(e.cashback,0) as cashback
				FROM mi_electrician a

				LEFT JOIN mi_state s on s.id=a.state
				LEFT JOIN mi_electrician_cashback e on e.elect_id='".$this->mobile."' and e.ref_id=a.mobile
				WHERE a.refid = '".$this->mobile."' order by a.rdate desc");
			
			if($qr->num_rows){
				$i=1;$tot=0;
				while($row=$qr->fetch_assoc()){
					$tot+=$row['cashback'];
					
					$actbtn='';
					if($row['act_status']=='Pending'){
						$actbtn="<a href='#' class='btn btn-xs btn-primary refverify' data-mobile='".$row['refid']."' data-id='".$row['id']."' title='Verify this Product'><i class='fa fa-check'></i></a> <a href='#' class='btn btn-xs btn-danger refreject' data-mobile='".$row['refid']."' data-id='".$row['id']."' title='Reject this Product'><i class='fa fa-times'></i></a>";
					}
					
					$str.="<tr><td>".$i."</td><td>".date("d-M-Y",strtotime($row['rdate']))."</td><td>".$row['fname']."</td><td>".$row['mobile']."</td><td>".$row['email']."</td><td>".$row['state_name']."</td><td>".$row['city']."</td><td>".$row['address']."</td><td>".$row['cashback']."</td><td>".$row['act_status']."</td><td>".$actbtn."</td></tr>";

					$i++;
				}
				$str.="<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th>Total</th><th>".$tot."</th><th></th><th></th></tr>";
			}else{
			$str="<tr><td colspan='5'>No Electrician Found</td></tr>";
			}
		}
			return $str;
	}
	public function customer_rejected(){
		$reject=$this->conn->exeQuery("update ".$this->customer_product_table." set act_status='Rejected',act_by='".$_SESSION[SITE_NAME]['MICMP_userid']."',act_date='".$this->rdate."' where id='".$this->data_id."'");
		if($reject){
			return true;
		}else{
			return false;
		}
	}
	public function customer_verify(){
		
		$row=$this->conn->exeQuery("select * from ".$this->customer_product_table." where id='".$this->data_id."' and act_status='Pending'")->fetch_assoc();
		
		if($row['elect_by']!=""){
			$rr=$this->conn->exeQuery("select id,pname,mrp from ".$this->product_table." where id='".$row['product']."' and mi_status='Yes'")->fetch_assoc();
			$pname = $rr['pname'];
			$cashback=0;
			if (stripos($pname, "base") !== false) {
				$cashback = rand(40, 50);
			} else {
				$qr=$this->conn->exeQuery("select * from ".$this->cashback_table." where elect_id='".$row['elect_by']."' and mi_status='Yes'");
				if($qr->num_rows){
					$cback=$rr['mrp']*(1/100);
					$cashback=($cback>=200)?200:$cback;
				}else{
					$cashback=rand(190,200);
				}
			}
			
			$verify=$this->conn->exeQuery("update ".$this->customer_product_table." set cashback=".$cashback.",act_status='Verified',act_by='".$_SESSION[SITE_NAME]['MICMP_userid']."',act_date='".$this->rdate."' where id='".$this->data_id."'");
			
			$cash=$this->conn->exeQuery("INSERT INTO ".$this->cashback_table."( `rdate`, `cmp_id`, `user_id`, `earn_type`,`elect_id`, `cust_id`, `prd_id`, `cashback`) values ('".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','Cashback','".$row['elect_by']."','".$row['mobile']."','".$row['product']."',".$cashback.")");
			if($verify and $cash){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function referral_verify(){
		//return "select * from ".$this->electrician_table." where id='".$this->data_id."' and act_status='Pending'";
		$row=$this->conn->exeQuery("select * from ".$this->electrician_table." where id='".$this->data_id."' and act_status='Pending'")->fetch_assoc();
		//return $this->mobile;
		if($row['refid']==$this->mobile){
			
			$cashback=0;
			$cashback = rand(20, 30);
			
			$verify=$this->conn->exeQuery("update ".$this->electrician_table." set act_status='Verified' where id='".$this->data_id."'");
			
			$cash=$this->conn->exeQuery("INSERT INTO ".$this->cashback_table."( `rdate`, `cmp_id`, `user_id`,`earn_type`, `elect_id`, `ref_id`, `cashback`) values ('".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','Referral','".$row['refid']."','".$row['mobile']."',".$cashback.")");
			if($cash){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function referral_rejected(){
		$reject=$this->conn->exeQuery("update ".$this->electrician_table." set act_status='Rejected' where id='".$this->data_id."'");
		if($reject){
			return true;
		}else{
			return false;
		}
	}
	
	public function electrician_paydata(){
		$str="<div class='table-responsive'><table class='table table-bordered'><thead><tr><th>#</th><th>Earn Type</th><th>Amount</th></tr></thead><tbody>";
		if($this->mobile!=""){
			$qr=$this->conn->exeQuery("SELECT earn_type, coalesce(sum(cashback),0) as amount from ".$this->cashback_table." where elect_id='".$this->mobile."' and mi_status='Yes' group by earn_type");
			
				$i=1;$tot=0;
				while($row=$qr->fetch_assoc()){
					$tot+=$row['amount'];
					$str.="<tr><td>".$i.".</td><td>".$row['earn_type']."</td><td>".$row['amount']."</td></tr>";
					$i++;
				}
				$str.="</tbody><tfoot>";
				$pr=$this->conn->exeQuery("SELECT coalesce(sum(amount),0) as amount from ".$this->payment_table." where elect_id='".$this->mobile."' and mi_status='Yes'")->fetch_assoc();
				$bal=number_format($tot-$pr['amount'],2);
				$str.="<tr><th></th><th>Total</th><th>".$tot."</th></tr><tr><th></th><th>Total Paid</th><th>".$pr['amount']."</th></tr><tr><th></th><th>Total Balance</th><th>".($bal)."</th></tr><tr><th></th><th><div id='perror'></div></th><th><a href='#' data-mobile='".$this->mobile."'  data-bal='".$bal."' class='btn btn-sm btn-primary pay'>Pay Now</a></th></tr></tfoot></table></div>";

		}
			return $str;
	}
	public function customer_product_list(){
		$str="<tr><td colspan='5'>Error! Some Data Missing</td></tr>";
		if($this->mobile!=""){
			global $objproduct;
			$str="";

			$qr=$this->conn->exeQuery("SELECT a.mobile,a.cname, a.address, b.product, b.serial_no, b.exp_date, b.image, b.bill_img, b.install_img, b.selfie_prd_img, b.amf_img, b.amf_con_img, b.gen_con_img, b.gen_name FROM `mi_customer` a left join mi_customer_product b on a.mobile=b.mobile and  b.mi_status='Yes' WHERE a.mobile='".$this->mobile."'");
			
			if($qr->num_rows){
				$i=1;
				while($row=$qr->fetch_assoc()){
					$expdt=($row['serial_no']!='')?date("d M, Y",strtotime($row['exp_date'])):'';
					$billimg=($row['bill_img']!='')?"<a href='".BASE_PATH."images/cust_img/".$row['bill_img']."' target='_blank'>Click</a> ":"";
					$instlimg=($row['install_img']!='')?"<a href='".BASE_PATH."images/cust_img/".$row['install_img']."' target='_blank'>Click</a> ":"";
					$selfiimg=($row['selfie_prd_img']!='')?"<a href='".BASE_PATH."images/cust_img/".$row['selfie_prd_img']."' target='_blank'>Click</a> ":"";
					$amfimg=($row['amf_img']!='')?"<a href='".BASE_PATH."images/cust_img/".$row['amf_img']."' target='_blank'>Click</a> ":"";
					$amfcnimg=($row['amf_con_img']!='')?"<a href='".BASE_PATH."images/cust_img/".$row['amf_con_img']."' target='_blank'>Click</a> ":"";
					$gencnimg=($row['gen_con_img']!='')?"<a href='".BASE_PATH."images/cust_img/".$row['gen_con_img']."' target='_blank'>Click</a> ":"";
					
					$str.="<tr><td>".$i."</td><td>".$objproduct->pname($row['product'])."</td><td>".$row['serial_no']."</td><td>".$expdt."</td><td>".$billimg."</td><td>".$instlimg."</td><td>".$selfiimg."</td><td>".$amfimg."</td><td>".$amfcnimg."</td><td>".$gencnimg."</td><td>".$row['gen_name']."</td></tr>";
					//$str="<tr><td colspan='5'>No Customer Found</td></tr>";
					$i++;
				}
			}else{
			$str="<tr><td colspan='5'>No Product Found</td></tr>";
			}
		}
			return $str;
	}
	////////////////////// Image Save ///////////////////////
	public function resizeAndSaveImage($srcPath, $destPath, $maxWidth, $quality) {
		[$width, $height, $type] = getimagesize($srcPath);

		if ($width <= $maxWidth) {
			move_uploaded_file($srcPath, $destPath);
			return;
		}

		$ratio = $height / $width;
		$newWidth = $maxWidth;
		$newHeight = $maxWidth * $ratio;

		switch ($type) {
			case IMAGETYPE_JPEG:
				$srcImage = imagecreatefromjpeg($srcPath);
				break;
			case IMAGETYPE_PNG:
				$srcImage = imagecreatefrompng($srcPath);
				break;
			case IMAGETYPE_WEBP:
				$srcImage = imagecreatefromwebp($srcPath);
				break;
			default:
				return;
		}

		$dstImage = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, 
						   $newWidth, $newHeight, $width, $height);

		switch ($type) {
			case IMAGETYPE_JPEG:
				imagejpeg($dstImage, $destPath, $quality);
				break;
			case IMAGETYPE_PNG:
				imagepng($dstImage, $destPath, 6); // PNG quality: 0 (best) – 9 (worst)
				break;
			case IMAGETYPE_WEBP:
				imagewebp($dstImage, $destPath, $quality);
				break;
		}

		imagedestroy($srcImage);
		imagedestroy($dstImage);
	}
}
$objcomplaint= new COMPLAINTNATURE($db);
?>