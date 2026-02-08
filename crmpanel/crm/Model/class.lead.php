<?php
class LEAD{
    private $conn;
    private $lead_table_name = "mi_lead";
	private $seg_table_name = "mi_segment";
	private $lead_contact_table_name = "mi_lead_contacts";
	private $lead_activity_table_name = "mi_lead_activity";
	private $lead_product_table_name = "mi_lead_products";
	private $lead_address_table_name = "mi_lead_address";
	private $lead_profile_table_name = "mi_lead_profile";
	
    // object properties
   
    public $rdate;
	public $enq_date;
	public $ext_date;
	public $cmp_name;
	public $web_url;
	public $email;
	public $mobile;
	public $telephone;
	public $address;
	public $product;
	public $source;
	public $reference;
	public $tcode;
	public $industry;
	public $segment;
	public $country;
	public $state;
	public $location;
	public $pincode;
	public $executive;
	public $initiated_by;
	public $enquiry_status;
	public $remark;
	
	///////////Contacts////////////
	public $cdesig_id;
	public $cdep_id;
	public $ctitle;
	public $cfname;
	public $clname;
	public $cmobile;
	public $ccontact;
	public $cemail;
	/////////Activity////////
	public $act_date ;
	public $act_taken ;
	public $act_type;
	public $file1=NULL;
	public $file2=NULL;
	public $file3=NULL;
	public $plan_date ;
	public $plan_action;
	public $plan_act_type;
	public $plan_for; 
	public $lead_id; 
	
	///////////Product/////
	public $rate;
	public $qty;
	public $total;
	public $act_status;
	
	///////////Address/////
	public $address1;
	public $state_id;
	public $location_id;
	public $pin_code;
	public $gstin;
	
	/////////Profile/////
	public $panno;
	public $gstno;
	public $regno;
	public $staxno;
	public $faxno;
	public $dealsin;
	
    public $edit_id;
    public $del_id;
    public $permission;
    
    public function __construct($db){
        $this->conn = $db;
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->lead_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and cmp_name='".$this->cmp_name."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->lead_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and cmp_name='".$this->cmp_name."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	
	public function lead_name($id)
	{
		$query="select * from ".$this->lead_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cmp_name'];
	}
	
	public function lead_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->lead_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['cmp_name'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['cmp_name'].' </option>';
			}
		}
		return $str;
	}
	
    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			
			$ni=count($this->product);
			$prd="";
			for($i=0;$i<$ni;$i++)
			{
				$prd.=$this->product[$i].",";
			}
			$prd=rtrim($prd,",");
			$query = $this->conn->exeQuery("INSERT INTO ".$this->lead_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `enq_date`, `cmp_name`, `address`, `web_url`, `email`, `mobile`, `telephone`, `product`, `industry`, `segment`, `source`, `reference`, `tcode`, `ext_date`, `country`, `state`, `location`, `pincode`, `executive`, `initiated_by`, `enquiry_status`, `remark`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->enq_date."','".$this->cmp_name."','".$this->address."','".$this->web_url."','".$this->email."','".$this->mobile."','".$this->telephone."','".$prd."','".$this->industry."','".$this->segment."','".$this->source."','".$this->reference."','".$this->tcode."','".$this->ext_date."','".$this->country."','".$this->state."','".$this->location."','".$this->pincode."','".$this->executive."','".$this->initiated_by."','".$this->enquiry_status."','".$this->remark."','Yes')");
			
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
	   		$ni=count($this->product);
			$prd="";
			for($i=0;$i<$ni;$i++)
			{
				$prd.=$this->product[$i].",";
			}
			$prd=rtrim($prd,",");
			$query = "update ".$this->lead_table_name." set `user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',`enq_date`='".$this->enq_date."',`cmp_name`='".$this->cmp_name."',`address`='".$this->address."',`web_url`='".$this->web_url."',`email`='".$this->email."',`mobile`='".$this->mobile."',`telephone`='".$this->telephone."',`product`='".$prd."',`industry`='".$this->industry."',`segment`='".$this->segment."',`source`='".$this->source."',`reference`='".$this->reference."',`tcode`='".$this->tcode."',`ext_date`='".$this->ext_date."',`country`='".$this->country."',`state`='".$this->state."',`location`='".$this->location."',`pincode`='".$this->pincode."',`executive`='".$this->executive."',`initiated_by`='".$this->initiated_by."',`enquiry_status`='".$this->enquiry_status."',`remark`='".$this->remark."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				
			if($this->conn->exeQuery($query)){
				return 1;
			}else{
				return 3;
			}
			
		}else{
			return 3;
		}
    }
	public function deleteme(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="delete from ".$this->lead_table_name." where id='".$this->del_id."' and mi_status='Yes'";
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
			$qr=$this->conn->exeQuery("select * from ".$this->lead_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['industry']."</td><td><a href='".BASE_PATH."Add_Industry/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////////////
	public function segment_update(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$indus=$this->industry[0];
			$ni=count($this->segment);
			for($i=0;$i<$ni;$i++)
			{
				if($this->segment[$i]!="" and $this->check_segment($indus,$this->segment[$i])){
					if($this->edit_id==""){
						$query = $this->conn->exeQuery("INSERT INTO ".$this->seg_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `industry`,`segment`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$indus."','".$this->segment[$i]."','Yes')");
					}else{
						$query = $this->conn->exeQuery("update ".$this->seg_table_name." set `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `industry`='".$indus."',`segment`='".$this->segment[$i]."' where `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$this->edit_id."' ");
					}
					
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
	public function delete_segment(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="delete from ".$this->seg_table_name." where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function view_segment(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->seg_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and industry='".$this->industry."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['segment']."</td><td><a href='".BASE_PATH."Add_Segment/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	public function add_contacts(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$nq=$this->conn->exeQuery("select * from ".$this->lead_contact_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$this->edit_id."' and mi_status='Yes'");
			
			if($nq->num_rows){
				$this->conn->exeQuery("delete from ".$this->lead_contact_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$this->edit_id."' and mi_status='Yes'");
			}
			
			$ni=count($this->cdesig_id);
			for($i=0;$i<$ni;$i++)
			{
				if($this->cfname[$i]!='' or $this->ccontact[$i]!='' or $this->cmobile[$i]!='' or $this->ccontact[$i]!='' or $this->cemail[$i]!='' ){
				$query = $this->conn->exeQuery("INSERT INTO ".$this->lead_contact_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `lead_id`, `desig_id`, `dep_id`, `title`, `fname`, `lname`, `mobile`, `contact`, `email`,`act_status`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->edit_id."','".$this->cdesig_id[$i]."','".$this->cdep_id[$i]."','".$this->ctitle[$i]."','".$this->cfname[$i]."','".$this->clname[$i]."','".$this->cmobile[$i]."','".$this->ccontact[$i]."','".$this->cemail[$i]."','".$this->act_status[$i]."','Yes')");
				}
			}
			if($query){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
    }
	public function add_activity(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$ok="";
			if($this->act_type!=''){
				$query = "INSERT INTO ".$this->lead_activity_table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `lead_id`, `act_date`, `act_type`, `act_taken`, `plan_date`, `plan_action`, `plan_act_type`, `plan_for`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->edit_id."','".$this->act_date."','".$this->act_type."','".$this->act_taken."','".$this->plan_date."','".$this->plan_action."','".$this->plan_act_type."','".$this->plan_for."','Yes')";
			$ok=$this->conn->inserted_id($query);
			}
			if($ok){
				$this->updatefile($ok);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function activity_complete(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$ok="";
			
			$query = "update ".$this->lead_activity_table_name." set `act_by`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `plan_date`='".$this->plan_date."',`plan_act_type`='".$this->plan_act_type."', `plan_action`='".$this->plan_action."', `plan_for`='".$this->plan_for."', `lead_action`='Completed' where id ='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$this->lead_id."'";
			$ok=$this->conn->exeQuery($query);
			
			if($ok){
				//$this->updatefile($ok);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function activity_adv_complete(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$ok="";
			$this->plan_date=$this->act_date;
			$this->plan_action=$this->act_taken;
			$query = "update ".$this->lead_activity_table_name." set `act_by`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `plan_act_type`='".$this->act_type."', `plan_action`='".$this->act_taken."', `plan_for`='".$this->plan_for."', `lead_action`='Completed' where id ='".$this->lead_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$this->edit_id."'";
			$ok=$this->conn->exeQuery($query);
			
			if($ok){
				$this->add_activity();
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	
	public function updatefile($id){
		if($this->file1["name"]!=''){
			$exp = explode(".", $this->file1["name"]);
			$extension = end($exp);
			$imagename=$_SESSION[SITE_NAME]['MICMP_cmpid']."_".$this->edit_id."_f1_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->file1["tmp_name"], "../images/lead_file/".$filename);
			$query = "update ".$this->lead_activity_table_name." set `file1`='".$filename."' where id='".$id."'";
			$this->conn->exeQuery($query);
		}
		if($this->file2["name"]!=''){
			$exp = explode(".", $this->file2["name"]);
			$extension = end($exp);
			$imagename=$_SESSION[SITE_NAME]['MICMP_cmpid']."_".$this->edit_id."_f2_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->file2["tmp_name"], "../images/lead_file/".$filename);
			$query = "update ".$this->lead_activity_table_name." set `file2`='".$filename."' where id='".$id."'";
			$this->conn->exeQuery($query);
		}
		if($this->file3["name"]!=''){
		   
			$exp = explode(".", $this->file3["name"]);
			$extension = end($exp);
			$imagename=$_SESSION[SITE_NAME]['MICMP_cmpid']."_".$this->edit_id."_f3_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->file3["tmp_name"], "../images/lead_file/".$filename);
			$query = "update ".$this->lead_activity_table_name." set `file3`='".$filename."' where id='".$id."'";
			$this->conn->exeQuery($query);
		}
		return true;
    }
	public function add_products(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$nq=$this->conn->exeQuery("select * from ".$this->lead_product_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$this->edit_id."' and mi_status='Yes'");
			
			if($nq->num_rows){
				$this->conn->exeQuery("delete from ".$this->lead_product_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$this->edit_id."' and mi_status='Yes'");
			}
			
			$ni=count($this->product);
			$qry="INSERT INTO ".$this->lead_product_table_name." (`id`, `rdate`, `cmp_id`, `user_id`, `lead_id`, `prod_id`, `qty`, `rate`,`total`, `active_status`, `mi_status`) VALUES ";
			for($i=0;$i<$ni;$i++)
			{
				if($this->product[$i]!=''){
				$qry .= "('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->edit_id."','".$this->product[$i]."','".$this->qty[$i]."','".$this->rate[$i]."','".$this->total[$i]."','".$this->act_status[$i]."','Yes'),";
				}
			}
			$qry=rtrim($qry,",");
			$query=$this->conn->exeQuery($qry);
			//return $qry;
			if($query){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function add_address(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$this->conn->exeQuery("update ".$this->lead_address_table_name." set act_status='No' where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$this->edit_id."' and mi_status='Yes'");
			$qry="INSERT INTO ".$this->lead_address_table_name." (`id`, `rdate`, `cmp_id`, `user_id`, `lead_id`, `address`, `state`, `location`, `pincode`, `gstin`, `act_status`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->edit_id."','".$this->address1[0]."','".$this->state_id[0]."','".$this->location_id[0]."','".$this->pin_code[0]."','".$this->gstin[0]."','Yes','Yes')";
		//return $qry;
			$query=$this->conn->exeQuery($qry);

			if($query){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function update_address(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$nq=$this->conn->exeQuery("select * from ".$this->lead_address_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$this->edit_id."' and mi_status='Yes'");
			
			if($nq->num_rows){
				$this->conn->exeQuery("delete from ".$this->lead_address_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$this->edit_id."' and mi_status='Yes'");
			}
			
			$ni=count($this->address1);
			$qry="INSERT INTO ".$this->lead_address_table_name." (`id`, `rdate`, `cmp_id`, `user_id`, `lead_id`, `address`, `state`, `location`, `pincode`, `gstin`, `act_status`, `mi_status`) VALUES ";
			for($i=0;$i<$ni;$i++)
			{
				
				if($this->address1[$i]!=''){
				$qry .= "('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->edit_id."','".$this->address1[$i]."','".$this->state_id[$i]."','".$this->location_id[$i]."','".$this->pin_code[$i]."','".$this->gstin[$i]."','".$this->act_status[$i]."','Yes'),";
				}
			}
			$qry=rtrim($qry,",");
			$query=$this->conn->exeQuery($qry);
			//return $qry;
			if($query){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function update_profile(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$nq=$this->conn->exeQuery("select * from ".$this->lead_profile_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$this->edit_id."' and mi_status='Yes'");
			
			if($nq->num_rows){
				$qry="update ".$this->lead_profile_table_name." set `rdate`='".$this->rdate."',  `user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',  `panno`='".$this->panno."', `gstin`='".$this->gstno."', `regno`='".$this->regno."', `staxno`='".$this->staxno."', `faxno`='".$this->faxno."', `remark`='".$this->remark."', `dealsin`='".$this->dealsin."' where `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and `lead_id`='".$this->edit_id."'";
			}else{
				$qry="INSERT INTO ".$this->lead_profile_table_name." (`id`, `rdate`, `cmp_id`, `user_id`, `lead_id`, `panno`, `gstin`, `regno`, `staxno`, `faxno`, `remark`, `dealsin`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->edit_id."','".$this->panno."','".$this->gstno."','".$this->regno."','".$this->staxno."','".$this->faxno."','".$this->remark."','".$this->dealsin."','Yes')";
			}
			$query=$this->conn->exeQuery($qry);
			//return $qry;
			if($query){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
}
$objlead= new LEAD($db);
?>