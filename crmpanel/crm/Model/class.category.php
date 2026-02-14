<?php
class ADDCATEGORY{
    private $conn;
    private $table_name = "mi_category";
	private $subcat_table = "mi_subcategory";
	private $solcat_table = "mi_solcat";
	private $solsubcat_table = "mi_solsubcat";
	private $godown_table = "mi_godown";
	private $varient_table = "mi_varient";
	private $sectors_table = "mi_sectors";
	private $ptype_table = "mi_ptype";
	private $ptype2_table = "mi_ptype2";
	private $rating_table = "mi_rating";
	private $brand_table = "mi_brand";
	private $blog_table = "mi_blogs";
	private $slider_table = "mi_slider";
	private $pcat_table = "mi_pcat";
	private $bcat_table = "mi_bcat";
	private $product_table = "mi_wproduct";
	private $product_detail_table = "mi_wproduct_detail";
	private $news_table = "mi_news";
	private $job_table = "mi_jobs";
	private $state_table = "mi_state";
	private $dealer_table = "mi_dealer";
	private $faq_table = "mi_faq";
	private $comment_table = "mi_comment";
	private $dealership_table = "mi_dealership";
	private $resourcecat_table = "mi_rcat";
	private $resource_table = "mi_resources";
	
    // object properties
   
    public $rdate;
	public $code;
	public $cat_name;
	public $soft_title;
	public $web_title;
	public $product_name;
	public $rate;
	public $moq;
	public $keyname;
	public $keyvalue;
	public $edid;
	public $god_name;
	public $brand_name;
	public $cat_id;
	public $subcat_id;
	public $varient_id;
	public $ptype_id;
	public $ptype2_id;
	public $rating_id;
	public $subcat_name;
	public $description;
	public $job_type;
	public $location;
	public $aname;
	public $dname;
	public $mobile;
	public $email;
	public $address;
	public $state;
	public $city;
	public $pincode;
	public $pcat_id;
	public $prd_id;
	public $ques;
	public $ans;
	public $vurl;
	
	public $title;
	public $subtitle;
	public $urlname;
	public $sdes;
	public $blogs;
	public $author;
	public $mtitle;
	public $mdes;
	public $mkeywords;
	public $mtags;
	public $alttext;
	public $alttext1;
	public $alttext2;
	public $alttext3;
	public $alttext4;
	public $alttext5;
	public $alttext6;
	public $alttext7;
	public $alttext8;
	public $schematext;
	
	public $image=NULL;
    public $image1=NULL;
    public $image2=NULL;
    public $image3=NULL;
    public $image4=NULL;
    public $image5=NULL;
    public $image6=NULL;
    public $image7=NULL;
    public $image8=NULL;
    public $voucher=NULL;
	
	public $catlist;
	public $subcatlist;
	public $varientlist;
	public $ptypelist;
	public $ptype2list;
	public $ratinglist;
	
	public $reg_type;
	public $photo=NULL;
	public $firm_name;
	public $trade_name;
	public $billing_address;
	public $full_name;
	public $designation;
	public $whatsapp;
	public $dob;
	public $yoe;
	public $owner_type;
	public $buss_type;
	public $other_buss_type;
	public $gstno;
	public $panno;
	public $msmeno;
	public $stock;
	public $shop_size;
	public $staff;
	public $addfile=NULL;
	public $cheqfile=NULL;
	public $shopphoto=NULL;
	public $certifile=NULL;
	public $appfile=NULL;
	public $agreefile=NULL;
	public $place;
	public $doa;
	
    public $edit_id;
    public $del_id;
    public $permission;
    
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->conn->filterVar($this->rdate);
		$this->cat_name=$this->conn->filterVar($this->cat_name);
		$this->code=$this->conn->filterVar($this->code);
        $this->description=$this->conn->filterVar($this->description);
		$this->permission=$this->permission;
    }
	
	public function find_product_for_serial(){
		$sql="select * from mi_product where ";
		/*if($this->cat_id!=""){
			$sql.=" cat_id='".$this->cat_id."' and";
		}*/
		if($this->subcat_id!=""){
			$sql.=" subcat_id='".$this->subcat_id."' and";
		}
		if($this->ptype_id!=""){
			$sql.=" ptype='".$this->ptype_id."' and";
		}
		if($this->ptype2_id!=""){
			$sql.=" ptype2='".$this->ptype2_id."' and";
		}
		if($this->varient_id!=""){
			$sql.=" varient='".$this->varient_id."' and";
		}
		if($this->rating_id!=""){
			$sql.=" rating='".$this->rating_id."' and";
		}
		$sql.=" mi_status='Yes'";

	$str='<option value="">--Select-- </option>';
		$qr=$this->conn->exeQuery($sql);
		while($row=$qr->fetch_assoc())
		{
			$str.='<option value="'.$row['id'].'">'.$row['pname'].' </option>';
			
		}
		return $str;
	}
	public function find_type_list(){
		$sql="select distinct(ptype) from mi_product where ptype!='' and ";
		if($this->subcat_id!=""){
			$sql.=" subcat_id='".$this->subcat_id."' and";
		}
		$sql.=" mi_status='Yes' order by ptype";
		$str='<option value="">--Select-- </option>';
		$qr=$this->conn->exeQuery($sql);
		while($row=$qr->fetch_assoc())
		{
			if($row['ptype']!=""){
				$str.='<option value="'.$row['ptype'].'">'.$this->ptype_name($row['ptype']).' </option>';
			}
			
		}
		return $str;
	}
	public function find_type2_list(){
		$sql="select distinct(ptype2) from mi_product where ptype2!='' and ";
		if($this->subcat_id!=""){
			$sql.=" subcat_id='".$this->subcat_id."' and";
		}
		if($this->ptype_id!=""){
			$sql.=" ptype='".$this->ptype_id."' and";
		}
		$sql.=" mi_status='Yes' order by ptype2";
		$str='<option value="">--Select-- </option>';
		$qr=$this->conn->exeQuery($sql);
		while($row=$qr->fetch_assoc())
		{
			$str.='<option value="'.$row['ptype2'].'">'.$this->ptype2_name($row['ptype2']).' </option>';
		}
		return $str;
	}
	public function find_varient_list(){
		$sql="select distinct(varient) from mi_product where varient!='' and ";
		if($this->subcat_id!=""){
			$sql.=" subcat_id='".$this->subcat_id."' and";
		}
		if($this->ptype_id!=""){
			$sql.=" ptype='".$this->ptype_id."' and";
		}
		if($this->ptype2_id!=""){
			$sql.=" ptype2='".$this->ptype2_id."' and";
		}
		$sql.=" mi_status='Yes' order by varient";
		$str='<option value="">--Select-- </option>';
		$qr=$this->conn->exeQuery($sql);
		while($row=$qr->fetch_assoc())
		{
			$str.='<option value="'.$row['varient'].'">'.$this->varient_name($row['varient']).' </option>';
		}
		return $str;
	}
	public function find_rating_list(){
		$sql="select distinct(rating) from mi_product where rating!='' and ";
		if($this->subcat_id!=""){
			$sql.=" subcat_id='".$this->subcat_id."' and";
		}
		if($this->ptype_id!=""){
			$sql.=" ptype='".$this->ptype_id."' and";
		}
		if($this->ptype2_id!=""){
			$sql.=" ptype2='".$this->ptype2_id."' and";
		}
		if($this->varient_id!=""){
			$sql.=" varient='".$this->varient_id."' and";
		}
		$sql.=" mi_status='Yes' order by rating";
		$str='<option value="">--Select-- </option>';
		$qr=$this->conn->exeQuery($sql);
		while($row=$qr->fetch_assoc())
		{
			$str.='<option value="'.$row['rating'].'">'.$this->rating_name($row['rating']).' </option>';
		}
		return $str;
	}
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (cat_name='".$this->cat_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (cat_name='".$this->cat_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function cat_name($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id in('".implode("','",explode(",",$id))."') and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$txt="";
		while($row=$qr->fetch_assoc()){
			$txt.=$row['cat_name'].",";
		}
		return rtrim($txt,",");
	}
	public function print_cat_name($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id in('".implode("','",explode(",",$id))."') and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		//$row=$qr->fetch_assoc();
		$txt="";
		while($row=$qr->fetch_assoc()){
			$txt.=($row['soft_title']!="")?$row['soft_title']:$row['cat_name'].",";
		}
		return rtrim($txt,",");
	}
	public function cat_code_name($id)
	{
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['code'];
	}
	public function cat_list($id='')
	{
		$ids=explode(",",$id);
		$str='';
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
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
    // Insert Item
    public function insert(){
		if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`, `user_id`,  `cat_name`,`url_name`,`code`,`soft_title`,`web_title`, `description`,`alttext`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_name."',LOWER(REPLACE(REPLACE(REPLACE(TRIM('".$this->cat_name."'), ' ', '-'),'&', 'and'), '/', '-')),'".$this->code."','".$this->soft_title."','".$this->web_title."','".$this->description."','".$this->alttext."','Yes')";
			$ok=$this->conn->inserted_id($query);
			if($ok){
				$this->updatecatimg($ok);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
    }
	public function update(){
      
       $this->edit_id=$this->conn->filterVar($this->edit_id);
		if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
	   		$query = "update ".$this->table_name." set `rdate`='".$this->rdate."',`cat_name`='".$this->cat_name."',`url_name`=LOWER(REPLACE(REPLACE(REPLACE(TRIM('".$this->cat_name."'), ' ', '-'),'&', 'and'), '/', '-')),`code`='".$this->code."',`soft_title`='".$this->soft_title."',`web_title`='".$this->web_title."',`description`='".$this->description."',`alttext`='".$this->alttext."' where id='".$this->edit_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
			if($this->conn->exeQuery($query)){
				$this->updatecatimg($this->edit_id);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function updatecatimg($id){
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename="cat".$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../../images/cat_img/".$filename);
				$query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
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
	public function deleteme(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from mi_product where cat_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}
			$query="update ".$this->table_name." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
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
				$str.="<tr><td>".$i."</td><td>".$row['cat_name']."</td><td>".$row['code']."</td><td><a href='".BASE_PATH."Add_Category/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$this->permission."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////// SOlution Category //////////////////
	public function find_solcat_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->solcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (cat_name='".$this->cat_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->solcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (cat_name='".$this->cat_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function solcat_list($id='')
	{
		$str="<option value=''>Select</option>";
		$query="select * from ".$this->solcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.="<option value='".$row['id']."' selected>".$row['cat_name']." </option>";
			}else{
				$str.="<option value='".$row['id']."'>".$row['cat_name']." </option>";
			}
		}
		return $str;
	}
    // Insert Item
    public function update_solcat(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_solcat_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->solcat_table." set  `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',  `cat_name`='".$this->cat_name."',url_name=LOWER(REPLACE(REPLACE(REPLACE(TRIM('".$this->cat_name."'), ' ', '-'),'&', 'and'), '/', '-')), `description`='".$this->description."',`alttext`='".$this->alttext."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				//return $query;
				if($this->conn->exeQuery($query)){
					$this->updatesolcatimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_solcat_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->solcat_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `cat_name`,`url_name`, `description`,`alttext`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_name."',LOWER(REPLACE(REPLACE(REPLACE(TRIM('".$this->cat_name."'), ' ', '-'),'&', 'and'), '/', '-')),'".$this->description."','".$this->alttext."','Yes')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					$this->updatesolcatimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function updatesolcatimg($id){
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename="cat".$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../../images/solcat_img/".$filename);
				$query = "update ".$this->solcat_table." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
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
	public function solcat_name($id)
	{
		$query="select * from ".$this->solcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat_name'];
	}
	public function deletesolcat(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_product where cat_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->solcat_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function solcat_view(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->solcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['cat_name']."</td><td><a href='".BASE_PATH."Add_Solcat/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////// SOlution Sub-Category //////////////////
	public function find_solsubcat_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->solsubcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (subcat_name='".$this->subcat_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->solsubcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (subcat_name='".$this->subcat_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function solsubcat_list($cat='',$id='')
	{
		if($cat!=""){
			$query="select * from ".$this->solsubcat_table." where cat_id='".$cat."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		}else{
			$query="select * from ".$this->solsubcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		}
		$str="<option value=''>Select</option>";
		
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.="<option value='".$row['id']."' selected>".$row['subcat_name']." </option>";
			}else{
				$str.="<option value='".$row['id']."'>".$row['subcat_name']." </option>";
			}
		}
		return $str;
	}
    // Insert Item
    public function update_solsubcat(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_solsubcat_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->solsubcat_table." set  `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',  `cat_id`='".$this->cat_id."', `subcat_name`='".$this->subcat_name."', url_name=LOWER(REPLACE(REPLACE(REPLACE(TRIM('".$this->subcat_name."'), ' ', '-'),'&', 'and'), '/', '-')), `description`='".$this->description."',`alttext`='".$this->alttext."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				//return $query;
				if($this->conn->exeQuery($query)){
					$this->updatesolsubcatimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_solsubcat_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->solsubcat_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `cat_id`,`subcat_name`,`url_name`, `description`,`alttext`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_id."','".$this->subcat_name."',LOWER(REPLACE(REPLACE(REPLACE(TRIM('".$this->subcat_name."'), ' ', '-'),'&', 'and'), '/', '-')),'".$this->description."','".$this->alttext."','Yes')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					$this->updatesolsubcatimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function updatesolsubcatimg($id){
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename="subcat".$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../../images/solsubcat_img/".$filename);
				$query = "update ".$this->solsubcat_table." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
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
	public function solsubcat_name($id)
	{
		$query="select * from ".$this->solsubcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['subcat_name'];
	}
	public function deletesolsubcat(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_product where cat_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->solsubcat_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function solsubcat_view(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->solsubcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$this->solcat_name($row['cat_id'])."</td><td>".$row['subcat_name']."</td><td><a href='".BASE_PATH."Add_Solsubcat/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////// Subcategory ///////////////////////////
	public function find_subcat_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->subcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (code='".$this->code."' or subcat_name='".$this->subcat_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->subcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (code='".$this->code."' or subcat_name='".$this->subcat_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function subcat_name($id)
	{
		$query="select * from ".$this->subcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['subcat_name'];
	}
	public function print_subcat_name($id)
	{
		$query="select * from ".$this->subcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return ($row['soft_title']!="")?$row['soft_title']:$row['subcat_name'];
	}
	public function subcat_code_name($id)
	{
		$query="select * from ".$this->subcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['code'];
	}
	public function subcat_list($id='')
	{
		$str="<option value=''>Select</option>";
		$query="select * from ".$this->subcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.="<option value='".$row['id']."' selected>".$row['subcat_name']." </option>";
			}else{
				$str.="<option value='".$row['id']."'>".$row['subcat_name']." </option>";
			}
		}
		return $str;
	}
    // Insert Item
    public function update_subcat(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_subcat_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->subcat_table." set  `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',  `subcat_name`='".$this->subcat_name."',url_name=LOWER(REPLACE(REPLACE(REPLACE(TRIM('".$this->subcat_name."'), ' ', '-'),'&', 'and'), '/', '-')),`code`='".$this->code."',`soft_title`='".$this->soft_title."',`web_title`='".$this->web_title."', `description`='".$this->description."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_subcat_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->subcat_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `subcat_name`,`url_name`,`code`,`soft_title`,`web_title`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->subcat_name."',LOWER(REPLACE(REPLACE(REPLACE(TRIM('".$this->subcat_name."'), ' ', '-'),'&', 'and'), '/', '-')),'".$this->code."','".$this->soft_title."','".$this->web_title."','".$this->description."','Yes')";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function deletesubcat(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from mi_product where subcat_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}
			$query="update ".$this->subcat_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function viewsubcat(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->subcat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['subcat_name']."</td><td>".$row['code']."</td><td><a href='".BASE_PATH."Add_SubCategory/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////// Varient ///////////////////////////
	public function find_varient_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->varient_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (code='".$this->code."' or cat_name='".$this->cat_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->varient_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (code='".$this->code."' or cat_name='".$this->cat_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function varient_name($id)
	{
		$query="select * from ".$this->varient_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat_name'];
	}
	public function varient_code_name($id)
	{
		$query="select * from ".$this->varient_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['code'];
	}
	public function varient_list($id='')
	{
		$str="<option value=''>Select</option>";
		$query="select * from ".$this->varient_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.="<option value='".$row['id']."' selected>".$row['cat_name']." </option>";
			}else{
				$str.="<option value='".$row['id']."'>".$row['cat_name']." </option>";
			}
		}
		return $str;
	}
    // Insert Item
    public function update_varient(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_varient_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->varient_table." set  `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',  `cat_name`='".$this->cat_name."',`code`='".$this->code."', `description`='".$this->description."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_varient_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->varient_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `cat_name`,`code`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_name."','".$this->code."','".$this->description."','Yes')";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function deletevarient(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_product where varient_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->varient_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function viewvarient(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->varient_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['cat_name']."</td><td>".$row['code']."</td><td><a href='".BASE_PATH."Add_Varient/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////// Rating ///////////////////////////
	public function find_rating_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->rating_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (cat_name='".$this->cat_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->rating_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (cat_name='".$this->cat_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function rating_name($id)
	{
		$query="select * from ".$this->rating_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat_name'];
	}
	public function rating_code_name($id)
	{
		$query="select * from ".$this->rating_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['code'];
	}
	public function rating_list($id='')
	{
		$str="<option value=''>Select</option>";
		$query="select * from ".$this->rating_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.="<option value='".$row['id']."' selected>".$row['cat_name']." </option>";
			}else{
				$str.="<option value='".$row['id']."'>".$row['cat_name']." </option>";
			}
		}
		return $str;
	}
    // Insert Item
    public function update_rating(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_rating_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->rating_table." set  `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',  `cat_name`='".$this->cat_name."',`code`='".$this->code."', `description`='".$this->description."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_rating_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->rating_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `cat_name`,`code`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_name."','".$this->code."','".$this->description."','Yes')";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function deleterating(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_product where varient_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->rating_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function viewrating(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->rating_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['cat_name']."</td><td>".$row['code']."</td><td><a href='".BASE_PATH."Add_Rating/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////// P-type ///////////////////////////
	public function find_ptype_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->ptype_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (code='".$this->code."' or cat_name='".$this->cat_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->ptype_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (code='".$this->code."' or cat_name='".$this->cat_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function ptype_name($id)
	{
		$query="select * from ".$this->ptype_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat_name'];
	}
	public function ptype_code_name($id)
	{
		$query="select * from ".$this->ptype_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['code'];
	}
	public function ptype_list($id='')
	{
		$str="<option value=''>Select</option>";
		$query="select * from ".$this->ptype_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.="<option value='".$row['id']."' selected>".$row['cat_name']." </option>";
			}else{
				$str.="<option value='".$row['id']."'>".$row['cat_name']." </option>";
			}
		}
		return $str;
	}
    // Insert Item
    public function update_ptype(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_ptype_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->ptype_table." set  `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',  `cat_name`='".$this->cat_name."',`url_name`=LOWER(REPLACE(REPLACE(REPLACE(TRIM('".$this->cat_name."'), ' ', '-'),'&', 'and'), '/', '-')),`code`='".$this->code."', `description`='".$this->description."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_ptype_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->ptype_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `cat_name`, `url_name`,`code`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_name."', LOWER(REPLACE(REPLACE(REPLACE(TRIM('".$this->cat_name."'), ' ', '-'),'&', 'and'), '/', '-')), '".$this->code."','".$this->description."','Yes')";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function deleteptype(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_product where varient_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->ptype_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function viewptype(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->ptype_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['cat_name']."</td><td>".$row['code']."</td><td><a href='".BASE_PATH."Add_Ptype/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////// P-type-2 ///////////////////////////
	public function find_ptype2_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->ptype2_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (code='".$this->code."' or cat_name='".$this->cat_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->ptype2_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (code='".$this->code."' or cat_name='".$this->cat_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function ptype2_name($id)
	{
		$query="select * from ".$this->ptype2_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['cat_name'];
	}
	public function ptype2_code_name($id)
	{
		$query="select * from ".$this->ptype2_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['code'];
	}
	public function ptype2_list($id='')
	{
		$str="<option value=''>Select</option>";
		$query="select * from ".$this->ptype2_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.="<option value='".$row['id']."' selected>".$row['cat_name']." </option>";
			}else{
				$str.="<option value='".$row['id']."'>".$row['cat_name']." </option>";
			}
		}
		return $str;
	}
    // Insert Item
    public function update_ptype2(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_ptype2_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->ptype2_table." set  `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',  `cat_name`='".$this->cat_name."',`code`='".$this->code."', `description`='".$this->description."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_ptype2_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->ptype2_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `cat_name`,`code`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_name."','".$this->code."','".$this->description."','Yes')";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function deleteptype2(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_product where varient_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->ptype2_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function viewptype2(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->ptype2_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['cat_name']."</td><td>".$row['code']."</td><td><a href='".BASE_PATH."Add_Ptype2/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////////// Sectors ///////////////////////////
	public function find_sector_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->sectors_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (code='".$this->code."' or cat_name='".$this->cat_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->sectors_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (code='".$this->code."' or cat_name='".$this->cat_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function sector_name($id)
	{	
		$txt="";
		if($id!=""){
			$query="select * from ".$this->sectors_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id in('".implode("','",explode(",",$id))."') and mi_status='Yes'";
			$qr=$this->conn->exeQuery($query);
			while($row=$qr->fetch_assoc()){
				$txt.=$row['cat_name'].",";
			}
			return rtrim($txt,",");
		}else{
			return $txt;
		}
		
	}
	
	public function sector_list($id='')
	{
		$ids=explode(",",$id);
		$str="";
		$query="select * from ".$this->sectors_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id!="" and in_array($row['id'],$ids))
			{
				$str.="<option value='".$row['id']."' selected>".$row['cat_name']." </option>";
			}else{
				$str.="<option value='".$row['id']."'>".$row['cat_name']." </option>";
			}
		}
		return $str;
	}
    // Insert Item
    public function update_sector(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_sector_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->sectors_table." set  `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."',  `cat_name`='".$this->cat_name."',`code`='".$this->code."', `description`='".$this->description."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_sector_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->sectors_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `cat_name`,`code`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_name."','".$this->code."','".$this->description."','Yes')";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function deletesector(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_product where varient_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->sectors_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function viewsector(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->sectors_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['cat_name']."</td><td>".$row['code']."</td><td><a href='".BASE_PATH."Add_Sectors/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	///////////////////////// GODOWN //////////////////////
	public function find_godown_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->godown_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (god_name='".$this->god_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->godown_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (god_name='".$this->god_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function godown_name($id)
	{
		$query="select * from ".$this->godown_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['god_name'];
	}
	
	public function godown_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->godown_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['god_name'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['god_name'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function update_godown(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_godown_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->godown_table." set  `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `god_name`='".$this->god_name."', `description`='".$this->description."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_godown_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->godown_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `god_name`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->god_name."','".$this->description."','Yes')";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function deletegodown(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_product where subcat_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->godown_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function viewgodown(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->godown_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['god_name']."</td><td>".$row['description']."</td><td><a href='".BASE_PATH."Add_Godown/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	///////////////////////// Brand //////////////////////
	public function find_brand_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->brand_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and (brand_name='".$this->brand_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->brand_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (brand_name='".$this->brand_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function brand_name($id)
	{
		$query="select * from ".$this->brand_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['brand_name'];
	}
	
	public function brand_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->brand_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and  mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['brand_name'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['brand_name'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function update_brand(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_brand_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->brand_table." set  `rdate`='".$this->rdate."',`user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."', `brand_name`='".$this->brand_name."', `description`='".$this->description."' where `id`='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_godown_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->brand_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `brand_name`, `description`, `mi_status`) VALUES ('0', '".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->brand_name."','".$this->description."','Yes')";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function deletebrand(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from mi_product where brand_id='".$this->del_id."' and cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'");
			if($qr->num_rows){
				return false;
			}/**/
			$query="update ".$this->brand_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function viewbrand(){
		if($this->permission['pg_view']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->brand_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				$str.="<tr><td>".$i."</td><td>".$row['brand_name']."</td><td>".$row['description']."</td><td><a href='".BASE_PATH."Add_Brand/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	///////////////////// \\\\\\\\\\\\Blogs
	public function find_blog_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->blog_table." where (title='".$this->title."' or urlname='".$this->urlname."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->blog_table." where (title='".$this->title."' and urlname='".$this->urlname."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_blogs(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_blog_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->blog_table." set  `cat_id`='".$this->cat_id."', `title`='".$this->title."', `urlname`='".$this->urlname."', `sdes`='".$this->sdes."', `blogs`='".$this->blogs."',`author`='".$this->author."', `mtitle`='".$this->mtitle."', `mdes`='".$this->mdes."', `mkeywords`='".$this->mkeywords."', `mtags`='".$this->mtags."', `alttext`='".$this->alttext."', `schematext`='".$this->schematext."' where `id`='".$this->edit_id."'";
				if($this->conn->exeQuery($query)){
					$this->updateblogimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_blog_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->blog_table."(`id`, `dop`, `top`,`cat_id`, `title`, `urlname`, `sdes`, `blogs`,`author`, `mtitle`, `mdes`, `mkeywords`, `mtags`, `alttext`, `schematext`,  `mi_status`) VALUES ('0', '".date("Y-m-d")."','".date("H:i:s")."','".$this->cat_id."','".$this->title."','".$this->urlname."','".$this->sdes."','".$this->blogs."','".$this->author."','".$this->mtitle."','".$this->mdes."','".$this->mkeywords."','".$this->mtags."','".$this->alttext."','".$this->schematext."','Yes')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					$this->updateblogimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function updateblogimg($id){
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../../images/blog_img/".$filename);
				$query = "update ".$this->blog_table." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
					
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
	public function deleteblog(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_blogs where id='".$this->del_id."' and mi_status='Yes'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->blog_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	/////////////////  Slider ///////////////////
	public function find_slider_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->slider_table." where title='".$this->title."' or urlname='".$this->urlname."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->slider_table." where title='".$this->title."' and urlname='".$this->urlname."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_slider(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_slider_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->slider_table." set  `title`='".$this->title."', `urlname`='".$this->urlname."', `sdes`='".$this->sdes."', `subtitle`='".$this->subtitle."', `alttext`='".$this->alttext."' where `id`='".$this->edit_id."'";
				if($this->conn->exeQuery($query)){
					$this->updatesliderimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_slider_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->slider_table."(`id`, `pdate`, `title`, `subtitle`, `urlname`, `alttext`, `sdes`, `mi_status`) VALUES ('0', '".date("Y-m-d")."','".$this->title."','".$this->subtitle."','".$this->urlname."','".$this->alttext."','".$this->sdes."','Yes')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					$this->updatesliderimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function updatesliderimg($id){
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../images/slider_img/".$filename);
				$query = "update ".$this->slider_table." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
					
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
	public function deleteslider(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_blogs where id='".$this->del_id."' and mi_status='Yes'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->slider_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	/////////////////  Blog Cateogry for Web ///////////////////
	public function bcat_list($id='')
	{
		$ids=explode(",",$id);
		$str='<option value="">Select</option>';
		$query="select * from ".$this->bcat_table." where mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
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
	public function bcat_name($id='')
	{
		$ids=explode(",",$id);
		$str='';
		$query="select * from ".$this->bcat_table." where id in('".implode("','",$ids)."') and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			$str.=$row['cat_name'].",";
		}
		$str=rtrim($str,",");
		return $str;
	}
	public function find_bcat_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->bcat_table." where cat_name='".$this->cat_name."' or urlname='".$this->urlname."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->bcat_table." where cat_name='".$this->cat_name."' and urlname='".$this->urlname."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_bcat(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_bcat_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->bcat_table." set  `cat_name`='".$this->cat_name."', `urlname`='".$this->urlname."', `sdes`='".$this->sdes."', `alttext`='".$this->alttext."' where `id`='".$this->edit_id."'";
				if($this->conn->exeQuery($query)){
					$this->updatebcatimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_bcat_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->bcat_table."(`id`, `pdate`, `user_id`, `cat_name`,  `urlname`, `alttext`, `sdes`, `mi_status`) VALUES ('0', '".date("Y-m-d")."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_name."','".$this->urlname."','".$this->alttext."','".$this->sdes."','Yes')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					$this->updatebcatimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function updatebcatimg($id){
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../../images/bcat_img/".$filename);
				$query = "update ".$this->bcat_table." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
					
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
	public function deletebcat(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_blogs where id='".$this->del_id."' and mi_status='Yes'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->bcat_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function verify_comment(){
		$query="update ".$this->comment_table." set act_status='Verified' where id='".$this->del_id."' and mi_status='Yes'";
		if($this->conn->exeQuery($query)){
			return true;
		}else{
			return false;
		}
    }
	public function delete_comment(){
		$query="update ".$this->comment_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
		if($this->conn->exeQuery($query)){
			return true;
		}else{
			return false;
		}
    }
	/////////////////  Product Cateogry for Web ///////////////////
	public function pcat_list($id='')
	{
		$ids=explode(",",$id);
		$str='<option value="">Select</option>';
		$query="select * from ".$this->pcat_table." where mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
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
	public function pcat_name($id='')
	{
		$ids=explode(",",$id);
		$str='';
		$query="select * from ".$this->pcat_table." where id in('".implode("','",$ids)."') and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			$str.=$row['cat_name'].",";
		}
		$str=rtrim($str,",");
		return $str;
	}
	public function find_pcat_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->pcat_table." where cat_name='".$this->cat_name."' or urlname='".$this->urlname."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->pcat_table." where cat_name='".$this->cat_name."' and urlname='".$this->urlname."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_pcat(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_pcat_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->pcat_table." set  `cat_name`='".$this->cat_name."', `urlname`='".$this->urlname."', `sdes`='".$this->sdes."', `alttext`='".$this->alttext."' where `id`='".$this->edit_id."'";
				if($this->conn->exeQuery($query)){
					$this->updatepcatimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_pcat_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->pcat_table."(`id`, `pdate`, `user_id`, `cat_name`,  `urlname`, `alttext`, `sdes`, `mi_status`) VALUES ('0', '".date("Y-m-d")."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_name."','".$this->urlname."','".$this->alttext."','".$this->sdes."','Yes')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					$this->updatepcatimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function updatepcatimg($id){
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../images/cat_img/".$filename);
				$query = "update ".$this->pcat_table." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
					
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
	public function deletepcat(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_blogs where id='".$this->del_id."' and mi_status='Yes'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->pcat_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	///////////////Product /////////////////////
	public function product_list($id='')
	{
		$ids=explode(",",$id);
		$str='<option value="">Select</option>';
		$query="select * from ".$this->product_table." where mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id!="" and in_array($row['id'],$ids))
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['product_name'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['product_name'].' </option>';
			}
		}
		return $str;
	}
	public function prd_name($id='')
	{
		$ids=explode(",",$id);
		$str='';
		$query="select * from ".$this->product_table." where id in('".implode("','",$ids)."') and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			$str.=$row['product_name'].",";
		}
		$str=rtrim($str,",");
		return $str;
	}
	public function find_prd_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->product_table." where product_name='".$this->product_name."' or urlname='".$this->urlname."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->product_table." where product_name='".$this->product_name."' and urlname='".$this->urlname."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_product(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_prd_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->product_table." set  `cat_id`='".$this->cat_id."', `product_name`='".$this->product_name."', `urlname`='".$this->urlname."',`rate`='".$this->rate."',`moq`='".$this->moq."', `sdes`='".$this->sdes."', `description`='".$this->description."', `alttext`='".$this->alttext."', `alttext1`='".$this->alttext1."', `alttext2`='".$this->alttext2."', `alttext3`='".$this->alttext3."', `alttext4`='".$this->alttext4."', `alttext5`='".$this->alttext5."', `alttext6`='".$this->alttext6."', `alttext7`='".$this->alttext7."', `alttext8`='".$this->alttext8."', `vurl`='".$this->vurl."' where `id`='".$this->edit_id."'";
				$n=count($this->edid);
				for($i=0;$i<$n;$i++)
				{
					if($this->edid[$i]!=''){
						$this->conn->exeQuery("update ".$this->product_detail_table." set keyname='".$this->conn->filterVar($this->keyname[$i])."', keyvalue='".$this->conn->filterVar($this->keyvalue[$i])."' where id='".$this->edid[$i]."'");
					}else{
						if($this->keyname[$i]!=""){
						$this->conn->exeQuery("insert into ".$this->product_detail_table." (`id`,`pdate`,`user_id`,`prd_id`,`keyname`,`keyvalue`,`mi_status`) values ('0','".date("Y-m-d H:i:s")."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->edit_id."','".$this->conn->filterVar($this->keyname[$i])."','".$this->conn->filterVar($this->keyvalue[$i])."','Yes')");
						}
						
					}
				}
				if($this->conn->exeQuery($query)){
					$this->updateprdimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_prd_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->product_table."(`id`, `pdate`, `user_id`, `cat_id`, `product_name`, `urlname`, `rate`, `moq`, `sdes`, `description`,`vurl`, `alttext`,  `alttext1`, `alttext2`,  `alttext3`,  `alttext4`, `alttext5`, `alttext6`, `alttext7`, `alttext8`, `mi_status`) VALUES ('0', '".date("Y-m-d H:i:s")."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_id."','".$this->product_name."','".$this->urlname."','".$this->rate."','".$this->moq."','".$this->sdes."','".$this->description."','".$this->vurl."','".$this->alttext."','".$this->alttext1."','".$this->alttext2."','".$this->alttext3."','".$this->alttext4."','".$this->alttext5."','".$this->alttext6."','".$this->alttext7."','".$this->alttext8."','Yes')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					$n=count($this->edid);
					for($i=0;$i<$n;$i++)
					{
						if($this->edid[$i]!=''){
							$this->conn->exeQuery("update ".$this->product_detail_table." set keyname='".$this->conn->filterVar($this->keyname[$i])."', keyvalue='".$this->conn->filterVar($this->keyvalue[$i])."' where id='".$ok."'");
						}else{
							if($this->keyname[$i]!=""){
							$this->conn->exeQuery("insert into ".$this->product_detail_table." (`id`,`pdate`,`user_id`,`prd_id`,`keyname`,`keyvalue`,`mi_status`) values ('0','".date("Y-m-d H:i:s")."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$ok."','".$this->conn->filterVar($this->keyname[$i])."','".$this->conn->filterVar($this->keyvalue[$i])."','Yes')");
							}
							
						}
					}
					$this->updateprdimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function updateprdimg($id){
        if($this->image["name"]!=''){
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id."_0.";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../../images/prod_img/".$filename);
				$query = "update ".$this->product_table." set `image`='".$filename."' where id='".$id."'";
				$this->conn->exeQuery($query);  
		   }
	   }
	   if($this->image1["name"]!=''){
		   $exp = explode(".", $this->image1["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id."_1.";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image1["tmp_name"], "../../../images/prod_img/".$filename);
				$query = "update ".$this->product_table." set `image1`='".$filename."' where id='".$id."'";
				$this->conn->exeQuery($query);  
		   }
	   }
	   if($this->image2["name"]!=''){
		   $exp = explode(".", $this->image2["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id."_2.";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image2["tmp_name"], "../../../images/prod_img/".$filename);
				$query = "update ".$this->product_table." set `image2`='".$filename."' where id='".$id."'";
				$this->conn->exeQuery($query);  
		   }
	   }
	   if($this->image3["name"]!=''){
		   $exp = explode(".", $this->image3["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id."_3.";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image3["tmp_name"], "../../../images/prod_img/".$filename);
				$query = "update ".$this->product_table." set `image3`='".$filename."' where id='".$id."'";
				$this->conn->exeQuery($query);  
		   }
	   }
	   if($this->image4["name"]!=''){
		   $exp = explode(".", $this->image4["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id."_4.";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image4["tmp_name"], "../../../images/prod_img/".$filename);
				$query = "update ".$this->product_table." set `image4`='".$filename."' where id='".$id."'";
				$this->conn->exeQuery($query);  
		   }
	   }
	   if($this->image5["name"]!=''){
		   $exp = explode(".", $this->image5["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id."_5.";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image5["tmp_name"], "../../../images/prod_img/".$filename);
				$query = "update ".$this->product_table." set `image5`='".$filename."' where id='".$id."'";
				$this->conn->exeQuery($query);  
		   }
	   }
	   if($this->image6["name"]!=''){
		   $exp = explode(".", $this->image6["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id."_6.";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image6["tmp_name"], "../../../images/prod_img/".$filename);
				$query = "update ".$this->product_table." set `image6`='".$filename."' where id='".$id."'";
				$this->conn->exeQuery($query);  
		   }
	   }
	   if($this->image7["name"]!=''){
		   $exp = explode(".", $this->image7["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id."_7.";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image7["tmp_name"], "../../../images/prod_img/".$filename);
				$query = "update ".$this->product_table." set `image7`='".$filename."' where id='".$id."'";
				$this->conn->exeQuery($query);  
		   }
	   }
	   if($this->image8["name"]!=''){
		   $exp = explode(".", $this->image8["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id."_8.";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image8["tmp_name"], "../../../images/prod_img/".$filename);
				$query = "update ".$this->product_table." set `image8`='".$filename."' where id='".$id."'";
				$this->conn->exeQuery($query);  
		   }
	   }
	   if($this->voucher["name"]!=''){
		   $exp = explode(".", $this->voucher["name"]);
		   $extension = end($exp);
		   if($extension=='pdf' or $extension=='PDF')
		   {
				$imagename=$id."_voucher.";
				$filename=$imagename.$extension;
				move_uploaded_file($this->voucher["tmp_name"], "../../../images/prod_img/".$filename);
				$query = "update ".$this->product_table." set `voucher`='".$filename."' where id='".$id."'";
				$this->conn->exeQuery($query);  
		   }
	   }
	   
    }
	public function deleteproduct(){
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_blogs where id='".$this->del_id."' and mi_status='Yes'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->product_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	/////////////////  News & Media for Web ///////////////////

	public function find_news_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->news_table." where title='".$this->title."' or urlname='".$this->urlname."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->news_table." where title='".$this->title."' and urlname='".$this->urlname."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_news(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_news_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->news_table." set  `title`='".$this->title."', `urlname`='".$this->urlname."', `sdes`='".$this->sdes."', `alttext`='".$this->alttext."' where `id`='".$this->edit_id."'";
				if($this->conn->exeQuery($query)){
					$this->updatenewsimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_news_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->news_table."(`id`, `pdate`, `user_id`, `title`,  `urlname`, `alttext`, `sdes`, `mi_status`) VALUES ('0', '".date("Y-m-d")."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->title."','".$this->urlname."','".$this->alttext."','".$this->sdes."','Yes')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					$this->updatenewsimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function updatenewsimg($id){
        if($this->image["name"]!=''){
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../images/news_img/".$filename);
				$query = "update ".$this->news_table." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
					
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
	public function deletenews(){
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_blogs where id='".$this->del_id."' and mi_status='Yes'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->news_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	
	/////////////////  Resources Category ///////////////////

	public function find_rcat()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->resourcecat_table." where cat_name='".$this->cat_name."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->resourcecat_table." where cat_name='".$this->cat_name."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function rcat_list($id='')
	{
		$str="<option value=''>Select</option>";
		$query="select * from ".$this->resourcecat_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes' and act_status='Yes' order by cat_name";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.="<option value='".$row['id']."' selected>".$row['cat_name']." </option>";
			}else{
				$str.="<option value='".$row['id']."'>".$row['cat_name']." </option>";
			}
		}
		return $str;
	}
	public function update_resourcecat(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_rcat();
				if($ck){
					return 2;
				}
				$query = "update ".$this->resourcecat_table." set  `cat_name`='".$this->cat_name."', `user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."' where `id`='".$this->edit_id."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_rcat();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->resourcecat_table."( `cmp_id`,`user_id`, `cat_name`) VALUES ('".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_name."')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function resource_view(){
		if($this->permission['pg_view']=='Yes' || $_SESSION[SITE_NAME]['MICMP_usertype']==='Admin')
		{
			$query=$this->conn->exeQuery("select * from ".$this->resourcecat_table." where mi_status='Yes' and act_status='Yes' order by cat_name");
			$str='';
			$sr=1;
			while($row=$query->fetch_assoc()){
				$str.='<tr><td>'.$sr.'.</td><td>'.$row['cat_name'].'</td><td><a href="#" class="btn btn-xs btn-primary editrcat" data-id="'.$row['id'].'" data-name="'.$row['cat_name'].'"><i class="fa fa-pencil"></i></a><a href="#" class="btn btn-xs btn-danger delrcat" data-id="'.$row['id'].'"><i class="fa fa-trash"></i></a></td></tr>';
				$sr++;
			}
			return $str;
		}
	}
	
	public function deletercat(){
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->resource_table." where cat_id='".$this->del_id."' and mi_status='Yes'");
			if($qr->num_rows){
				return false;
			}
			$query="update ".$this->resourcecat_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	/////////////////  Resources Form ///////////////////

	public function find_resource()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->resource_table." where cat_id='".$this->cat_id."' and web_title='".$this->web_title."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->resource_table." where cat_id='".$this->cat_id."' and web_title='".$this->web_title."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}

	public function update_resource(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_rcat();
				if($ck){
					return 2;
				}
				$query = "update ".$this->resource_table." set  `adate`='".date("Y-m-d")."', `cat_id`='".$this->cat_id."',`web_title`='".$this->web_title."', `description`='".$this->description."', `user_id`='".$_SESSION[SITE_NAME]['MICMP_userid']."' where `id`='".$this->edit_id."'";
				if($this->conn->exeQuery($query)){
					$this->updateresimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_rcat();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->resource_table."( `rdate`,`cmp_id`,`user_id`, `cat_id`, `adate`, `web_title`, `description`) VALUES ('".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_id."','".date("Y-m-d")."','".$this->web_title."','".$this->description."')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					$this->updateresimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function updateresimg($id) {
		$uploadDir = "../images/resource_img/"; // Aapka folder path
		if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

		// Sabhi document fields ki list
		$fields = ['photo', 'addfile'];
		$updateData = [];

		foreach ($fields as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$fileName = $_FILES[$field]['name'];
				$fileTmp  = $_FILES[$field]['tmp_name'];
				$fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
				
				// Unique file name banana (ID_field_timestamp)
				$newName = $id . "_" . $field . "_" . time() . "." . $fileExt;
				$targetPath = $uploadDir . $newName;

				if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])) {
					// Image Resize Logic (e.g., Max width 800px)
					$this->resizeImage($fileTmp, $targetPath, 800);
					$updateData[] = "`$field` = '$newName'";
				} elseif ($fileExt == 'pdf') {
					// PDF Direct Upload
					if (move_uploaded_file($fileTmp, $targetPath)) {
						$updateData[] = "`$field` = '$newName'";
					}
				}
			}
		}

		// Agar koi file upload hui hai to table update karein
		if (!empty($updateData)) {
			$sql = "UPDATE " . $this->resource_table . " SET " . implode(', ', $updateData) . " WHERE id = '$id'";
			return $this->conn->exeQuery($sql);
		}
	}
	public function deleteresource(){
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query="update ".$this->resource_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	/////////////////  Job for Web ///////////////////

	public function find_job_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->job_table." where title='".$this->title."' and cat_name='".$this->cat_name."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->job_table." where title='".$this->title."' and cat_name='".$this->cat_name."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function generateSlug($text) {
		$text = trim($text);
		$text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
		$text = strtolower($text);
		$text = preg_replace('/[^a-z0-9]+/', '-', $text);
		$text = trim($text, '-');
		return $text;
	}
	public function update_jobs(){
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_job_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->job_table." set  `title`='".$this->title."',`url_name`='".$this->generateSlug($this->title)."', `job_type`='".$this->job_type."',`cat_name`='".$this->cat_name."',`location`='".$this->location."', `sdes`='".$this->sdes."' where `id`='".$this->edit_id."'";
				if($this->conn->exeQuery($query)){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_job_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->job_table."(`id`, `pdate`, `user_id`, `title`, `url_name`,`cat_name`, `location`, `job_type`, `sdes`, `mi_status`) VALUES ('0', '".date("Y-m-d")."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->title."','".$this->generateSlug($this->title)."','".$this->cat_name."','".$this->location."','".$this->job_type."','".$this->sdes."','Yes')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function jobcat_list($id='')
	{
		$str='<option value="">Select</option>';
		$query="select * from ".$this->job_table." where mi_status='Yes' group by cat_name";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['cat_name'])
			{
				$str.='<option value="'.$row['cat_name'].'" selected>'.$row['cat_name'].' </option>';
			}else{
				$str.='<option value="'.$row['cat_name'].'">'.$row['cat_name'].' </option>';
			}
		}
		return $str;
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
	public function deletejobs(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_blogs where id='".$this->del_id."' and mi_status='Yes'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->job_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	/////////////////  Dealer for Web ///////////////////

	public function find_dealer_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->dealer_table." where dname='".$this->dname."' and mobile='".$this->mobile."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->dealer_table." where dname='".$this->dname."' and mobile='".$this->mobile."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_dealer(){
		$n=count($this->pcat_id);
		$pcat="";
		for($i=0;$i<$n;$i++){
			$pcat.=$this->pcat_id[$i].",";
		}
		$pcat= rtrim($pcat,",");
		if($this->edit_id!=""){
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_dealer_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->dealer_table." set  `aname`='".$this->aname."', `dname`='".$this->dname."',`email`='".$this->email."',`mobile`='".$this->mobile."', `address`='".$this->address."',`state`='".$this->state."',`city`='".$this->city."',`pincode`='".$this->pincode."',`urlname`='".$this->urlname."',`pcat_id`='".$pcat."',`alttext`='".$this->alttext."', `description`='".$this->description."' where `id`='".$this->edit_id."'";
				if($this->conn->exeQuery($query)){
					$this->updatedealerimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_dealer_id();
				if($ck){
					return 2;
				}
				$query = "INSERT INTO ".$this->dealer_table."(`id`, `pdate`, `user_id`, `aname`, `dname`, `email`, `mobile`, `address`, `urlname`, `state`, `city`, `pincode`, `pcat_id`, `description`, `alttext`, `mi_status`) VALUES ('0', '".date("Y-m-d")."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->aname."','".$this->dname."','".$this->email."','".$this->mobile."','".$this->address."','".$this->urlname."','".$this->state."','".$this->city."','".$this->pincode."','".$pcat."','".$this->description."','".$this->alttext."','Yes')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					$this->updatedealerimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function deletedealer(){
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_blogs where id='".$this->del_id."' and mi_status='Yes'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->dealer_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function updatedealerimg($id){
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../images/dealer_img/".$filename);
				$query = "update ".$this->dealer_table." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
					
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
	/////////// Dealership form ///////////////////
	public function find_dealership_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->dealership_table." where firm_name='".$this->firm_name."' and mobile='".$this->mobile."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->dealership_table." where firm_name='".$this->firm_name."' and mobile='".$this->mobile."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_dealership(){
		if(count($this->buss_type)>0){
			$buss = implode(",", $this->buss_type);
		}else{
			$buss='';
		}	
		if($this->edit_id!=""){
			
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_dealership_id();
				if($ck){
					return 2;
				}
				$query = "update ".$this->dealership_table." set `reg_type`='".$this->reg_type."', `firm_name`='".$this->firm_name."',`trade_name`='".$this->trade_name."',`billing_address`='".$this->billing_address."',`email`='".$this->email."',`mobile`='".$this->mobile."', `full_name`='".$this->full_name."',`state`='".$this->state."',`city`='".$this->city."',`pincode`='".$this->pincode."',`designation`='".$this->designation."',`whatsapp`='".$this->whatsapp."',`dob`='".$this->dob."', `yoe`='".$this->yoe."', `owner_type`='".$this->owner_type."', `buss_type`='".$buss."', `other_buss_type`='".$this->other_buss_type."', `gstno`='".$this->gstno."', `panno`='".$this->panno."', `msmeno`='".$this->msmeno."', `stock`='".$this->stock."', `shop_size`='".$this->shop_size."', `staff`='".$this->staff."', `place`='".$this->place."', `doa`='".$this->doa."' where `id`='".$this->edit_id."'";
				if($this->conn->exeQuery($query)){
					$this->updatedealershipimg($this->edit_id);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				$ck=$this->find_dealership_id();
				if($ck){
					return 2;
				}
				
				$query = "INSERT INTO ".$this->dealership_table."(`rdate`, `cmp_id`,`user_id`, `reg_type`, `firm_name`, `trade_name`, `billing_address`, `city`, `state`, `pincode`, `full_name`, `mobile`, `email`, `designation`, `whatsapp`, `dob`, `yoe`, `owner_type`, `buss_type`, `other_buss_type`, `gstno`, `panno`, `msmeno`, `stock`, `shop_size`, `staff`,  `place`, `doa`) VALUES ('".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->reg_type."','".$this->firm_name."','".$this->trade_name."','".$this->billing_address."','".$this->city."','".$this->state."','".$this->pincode."','".$this->full_name."','".$this->mobile."','".$this->email."','".$this->designation."','".$this->whatsapp."','".$this->dob."','".$this->yoe."','".$this->owner_type."','".$buss."','".$this->other_buss_type."','".$this->gstno."','".$this->panno."','".$this->msmeno."','".$this->stock."','".$this->shop_size."','".$this->staff."','".$this->place."','".$this->doa."')";
				$ok=$this->conn->inserted_id($query);
				if($ok){
					/*`gstfile`, `panfile`, `msmefile`, `addfile`, `cheqfile`, `shopphoto`, `certifile`, `appfile`, `agreefile`,*/
					$this->updatedealershipimg($ok);
					return 1;
				}else{
					return 3;
				}
			}else{
				return 4;
			}
		}
    }
	public function updatedealershipimg($id) {
		$uploadDir = "../images/dealership_img/"; // Aapka folder path
		if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

		// Sabhi document fields ki list
		$fields = ['photo', 'gstfile', 'panfile', 'msmefile', 'addfile', 'cheqfile', 'shopphoto', 'certifile', 'appfile', 'agreefile'];
		$updateData = [];

		foreach ($fields as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$fileName = $_FILES[$field]['name'];
				$fileTmp  = $_FILES[$field]['tmp_name'];
				$fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
				
				// Unique file name banana (ID_field_timestamp)
				$newName = $id . "_" . $field . "_" . time() . "." . $fileExt;
				$targetPath = $uploadDir . $newName;

				if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])) {
					// Image Resize Logic (e.g., Max width 800px)
					$this->resizeImage($fileTmp, $targetPath, 800);
					$updateData[] = "`$field` = '$newName'";
				} elseif ($fileExt == 'pdf') {
					// PDF Direct Upload
					if (move_uploaded_file($fileTmp, $targetPath)) {
						$updateData[] = "`$field` = '$newName'";
					}
				}
			}
		}

		// Agar koi file upload hui hai to table update karein
		if (!empty($updateData)) {
			$sql = "UPDATE " . $this->dealership_table . " SET " . implode(', ', $updateData) . " WHERE id = '$id'";
			return $this->conn->exeQuery($sql);
		}
	}
	private function resizeImage($sourcePath, $destPath, $maxWidth) {
		list($width, $height, $type) = getimagesize($sourcePath);
		
		// Nayi height calculate karna ratio maintain karne ke liye
		$newWidth = ($width > $maxWidth) ? $maxWidth : $width;
		$newHeight = ($height / $width) * $newWidth;

		$newImage = imagecreatetruecolor($newWidth, $newHeight);

		// Extension ke hisaab se image create karna
		switch ($type) {
			case IMAGETYPE_JPEG: $source = imagecreatefromjpeg($sourcePath); break;
			case IMAGETYPE_PNG:  $source = imagecreatefrompng($sourcePath); break;
			case IMAGETYPE_GIF:  $source = imagecreatefromgif($sourcePath); break;
			default: return false;
		}

		imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

		// Save karna
		imagejpeg($newImage, $destPath, 80); // 80% quality
		imagedestroy($newImage);
		imagedestroy($source);
	}
	
	public function deletedealership(){
		$this->del_id=$this->del_id;
		if((isset($this->permission['pg_delete']) && $this->permission['pg_delete']==='Yes') || $_SESSION[SITE_NAME]['MICMP_usertype']==='Admin')
		{
			$query="update ".$this->dealership_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }

	
	/////////////////  FAQ for Web ///////////////////

	
	public function update_faq(){
		$p=count($this->prd_id);
		$prdid="";
		for($i=0;$i<$p;$i++){
			$prdid.=$this->prd_id[$i].",";
		}
		$prdid= rtrim($prdid,",");
			
		if($this->edit_id!=""){
			
			if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				/*$ck=$this->find_dealer_id();
				if($ck){
					return 2;
				}*/
				$query = "update ".$this->faq_table." set  `prd_id`='".$prdid."', `ques`='".$this->conn->filterVar($this->ques[0])."',`ans`='".$this->conn->filterVar($this->ans[0])."' where `id`='".$this->edit_id."'";
				///return $query;
				if($this->conn->exeQuery($query)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
			{
				/*$ck=$this->find_dealer_id();
				if($ck){
					return 2;
				}*/
				
				 $str="INSERT INTO ".$this->faq_table."(`id`, `rdate`, `user_id`, `prd_id`, `ques`, `ans`, `mi_status`) VALUES ";
				 $str1="";
				 $n=count($this->ques);
				   for($i=0;$i<$n;$i++){
					$str1.="('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$prdid."', '".$this->conn->filterVar($this->ques[$i])."','".$this->conn->filterVar($this->ans[$i])."','Yes'),";
				   }
				   
				if($str1!=""){
					$str.=rtrim($str1,",");
					
					$ok=$this->conn->exeQuery($str);
				}
				if($ok){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
    }
	
	public function deletefaq(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			/*$qr=$this->conn->exeQuery("select * from mi_blogs where id='".$this->del_id."' and mi_status='Yes'");
			if($qr->num_rows){
				return false;
			}*/
			$query="update ".$this->faq_table." set mi_status='No' where id='".$this->del_id."' and mi_status='Yes'";
			
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	
}
$objcat= new ADDCATEGORY($db);
?>