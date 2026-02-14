<?php
class PRODUCT{

    private $conn;
    private $table_name = "mi_product";
	private $in_product_table = "mi_item_in";
	private $in_detail_product_table = "mi_item_in_detail";
	private $serial_table = "mi_product_detail";
	private $solution_table = "mi_solution";
	private $solution_client_table = "mi_solution_client";
	private $solution_prob_table = "mi_solution_prob";
	private $solution_sol_table = "mi_solution_sol";
	private $solution_wcu_table = "mi_solution_wcu";
	private $solution_faq_table = "mi_solution_faq";
	
	private $pur_table_name = "mi_purchase_detail";
	private $bill_table_name = "mi_billing_detail";
 
    // object properties
    public $rdate;
    public $pname;
	public $pcode;
	public $hsncode;
	public $cat_id;
	public $varient;
	public $ptype;
	public $ptype2;
	public $sectors;
	public $rating;
	public $model;
	public $url_name;
	public $length;
	public $breadth;
	public $height;
	public $weight;
	public $unit_id;
	public $srate;
	public $drate;
	public $mrp;
	public $relay;
	public $mcb;
	public $mccb;
	public $kw;
	public $kva;
	public $minv;
	public $maxv;
	public $cat220;
	public $cat415;
	public $startmfd;
	public $runmfd;
	public $inbox;
	public $op_qty;
	public $gst;
	public $godown;
	public $supplier;
	public $remark;
	public $save_for;
	public $nettotal;
	public $data_id;
	public $cat;
	public $subcat;
	public $brand;
	public $batch;
	public $item;
	public $qty;
	public $total;
	public $items;
	public $warranty;
	
	public $srno;
	public $models;
	public $brands;
	public $mfgdates;
	
	public $stitle;
	public $pf_title;
	public $sol_title;
	public $wcu_title;
	public $sdes;
	public $soldes;
	public $wcudes;
	public $pfdes;
	public $clname;
	public $reason;
	public $solution;
	public $alttext;
	public $calculator;
	public $faq;
	public $ans;
	
	
	public $image=NULL;
    public $climage=NULL;
    public $solimage=NULL;
    public $pbimage=NULL;
    public $voucher=NULL;
	
    public $description;
    public $edit_id;
    public $del_id;
	public $edid;
	
    public $permission;
	
    public function __construct($db){
        $this->conn = $db;
    }
	public function find_solution(){
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->solution_table." where cat_id='".$this->cat_id."' and subcat_id='".$this->subcat_id."' and stitle='".$this->stitle."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->solution_table." where cat_id='".$this->cat_id."' and subcat_id='".$this->subcat_id."' and stitle='".$this->stitle."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	
	public function update_solution(){
		if($this->edit_id!=""){
			$query = "update ".$this->solution_table." set `cat_id`='".$this->cat_id."', `subcat_id`='".$this->subcat_id."', `stitle`='".$this->stitle."', `sdes`='".$this->sdes."',`alttext`='".$this->alttext."', `calculator`='".$this->calculator."' where id='".$this->edit_id."'";
			$ok=$this->conn->exeQuery($query);
			if($ok){
				$this->updatesolimg($this->edit_id);
				$this->updatesolvoucher($this->edit_id);
				return true;
			}else{
				return false;
			}
			
		}else{
			$query = "INSERT INTO ".$this->solution_table."(`rdate`, `cat_id`, `subcat_id`, `stitle`, `sdes`,`alttext`, `calculator`) VALUES ('".$this->rdate."','".$this->cat_id."','".$this->subcat_id."','".$this->stitle."','".$this->sdes."','".$this->alttext."','".$this->calculator."')";
			$ok=$this->conn->inserted_id($query);
			if($ok)
			{
				$this->updatesolimg($ok);
				$this->updatesolvoucher($ok);
				return true;
			}else{
				return false;
			}
		}
	}
	public function delete_solution(){
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->solution_table." where id='".$this->del_id."'");
			while($row=$qr->fetch_assoc()){
				if($row['image']!=""){
					unlink('../../../images/solution_img/'.$row['image']);
				}
			}
			$query=$this->conn->exeQuery("delete from  ".$this->solution_table." where id='".$this->del_id."'");
			if($query){
				$this->delete_solution_client();
				return true;
			}else{
				return false;
			}
		}
	}
	
	public function updatesolimg($id){
		if($this->image["name"]!=''){
		    $exp = explode(".", $this->image["name"]);
		    $extension = end($exp);
		    $imagename=$_SESSION[SITE_NAME]['MICMP_cmpid']."_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../../../images/solution_img/".$filename);
		    $query = "update ".$this->solution_table." set `image`='".$filename."' where id='".$id."'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
	    }else{
		   return true;
	    }
    }
	public function updatesolvoucher($id){
		if($this->voucher["name"]!=''){
		    $exp = explode(".", $this->voucher["name"]);
		    $extension = end($exp);
		    $imagename="voucher_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->voucher["tmp_name"], "../../../images/solution_img/".$filename);
		    $query = "update ".$this->solution_table." set `voucher`='".$filename."' where id='".$id."'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
	    }else{
		   return true;
	    }
    }
	public function update_solution_client(){
		//$this->del_id=$this->edit_id;
		//$this->delete_solution_client();
		$n=count($this->clname);
		for($i=0;$i<$n;$i++){
			if($this->clname[$i]!=""){
				if($this->edid[$i]!=""){
					$query = $this->conn->exeQuery("update ".$this->solution_client_table." set `rdate`='".$this->rdate."',`data_id`='".$this->edit_id."', `clname`='".$this->conn->filterVar($this->clname[$i])."', `alttext`='".$this->conn->filterVar($this->alttext[$i])."' where id='".$this->edid[$i]."' ");
					$insert_id=$this->edid[$i];
				}else{
					$query = "insert into ".$this->solution_client_table." set `rdate`='".$this->rdate."',`data_id`='".$this->edit_id."', `clname`='".$this->conn->filterVar($this->clname[$i])."', `alttext`='".$this->conn->filterVar($this->alttext[$i])."'";
					$insert_id=$this->conn->inserted_id($query);
				}
				
				if(!$insert_id){
					return false;
				}
				
				if (!empty($this->climage['name'][$i])) {

					$upload_dir = "../../../images/solution_img/";
					if (!file_exists($upload_dir)) {
						mkdir($upload_dir, 0777, true);
					}

					$file_tmp = $this->climage['tmp_name'][$i];
					$file_name = basename($this->climage['name'][$i]);
					$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

					// Allowed extensions
					$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

					if (in_array($ext, $allowed)) {
						// Create unique name
						$new_name = "client_" . $insert_id . "_" . time() . "." . $ext;
						$target_path = $upload_dir . $new_name;

						if (move_uploaded_file($file_tmp, $target_path)) {
							// Update DB with image name
							$update_q = "UPDATE " . $this->solution_client_table . " 
										 SET `climage` = '" . $new_name . "' 
										 WHERE `id` = '" . $insert_id . "'";
							$this->conn->exeQuery($update_q);
						}
					}
				}
				
			}
		}
		return true;
	}
	
	public function delete_solution_client(){
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->solution_client_table." where id='".$this->del_id."'");
			while($row=$qr->fetch_assoc()){
				if($row['climage']!=""){
					unlink('../../../images/solution_img/'.$row['climage']);
				}
			}
			$query=$this->conn->exeQuery("delete from ".$this->solution_client_table." where id='".$this->del_id."'");
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_solution_prob(){
		//$this->del_id=$this->edit_id;
		//$this->delete_solution_prob();
		$this->conn->exeQuery("update ".$this->solution_table." set pf_title='".$this->pf_title."',pfdes='".$this->pfdes."' where id='".$this->edit_id."'");
		$n=count($this->reason);
		for($i=0;$i<$n;$i++){
			if($this->reason[$i]!=""){
				if($this->edid[$i]!=""){
					$query = $this->conn->exeQuery("update ".$this->solution_prob_table." set `rdate`='".$this->rdate."',`data_id`='".$this->edit_id."', `reason`='".$this->conn->filterVar($this->reason[$i])."', `alttext`='".$this->conn->filterVar($this->alttext[$i])."' where id='".$this->edid[$i]."'");
					$insert_id=$this->edid[$i];
				}else{
					$query = "insert into ".$this->solution_prob_table." set `rdate`='".$this->rdate."',`data_id`='".$this->edit_id."', `reason`='".$this->conn->filterVar($this->reason[$i])."', `alttext`='".$this->conn->filterVar($this->alttext[$i])."'";
					$insert_id=$this->conn->inserted_id($query);
				}
				
				if(!$insert_id){
					return false;
				}
				
				if (!empty($this->pbimage['name'][$i])) {

					$upload_dir = "../../../images/solution_img/";
					if (!file_exists($upload_dir)) {
						mkdir($upload_dir, 0777, true);
					}

					$file_tmp = $this->pbimage['tmp_name'][$i];
					$file_name = basename($this->pbimage['name'][$i]);
					$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

					// Allowed extensions
					$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

					if (in_array($ext, $allowed)) {
						// Create unique name
						$new_name = "prob_" . $insert_id . "_" . time() . "." . $ext;
						$target_path = $upload_dir . $new_name;

						if (move_uploaded_file($file_tmp, $target_path)) {
							// Update DB with image name
							$update_q = "UPDATE " . $this->solution_prob_table . " 
										 SET `pbimage` = '" . $new_name . "' 
										 WHERE `id` = '" . $insert_id . "'";
							$this->conn->exeQuery($update_q);
						}
					}
				}
				
			}
		}
		return true;
	}
	public function delete_solution_prob(){
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$qr=$this->conn->exeQuery("select * from ".$this->solution_prob_table." where id='".$this->edit_id."'");
			while($row=$qr->fetch_assoc()){
				if($row['climage']!=""){
					unlink('../../../images/solution_img/'.$row['climage']);
				}
			}
			$query=$this->conn->exeQuery("delete from ".$this->solution_prob_table." where id='".$this->del_id."'");
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_solution_sol(){
		$this->del_id=$this->edit_id;
		$this->delete_solution_sol();
		$this->conn->exeQuery("update ".$this->solution_table." set sol_title='".$this->sol_title."',soldes='".$this->soldes."' where id='".$this->edit_id."'");
		
		if (!empty($this->solimage['name'])) {

			$upload_dir = "../../../images/solution_img/";
			if (!file_exists($upload_dir)) {
				mkdir($upload_dir, 0777, true);
			}

			$file_tmp = $this->solimage['tmp_name'];
			$file_name = basename($this->solimage['name']);
			$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

			// Allowed extensions
			$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

			if (in_array($ext, $allowed)) {
				// Create unique name
				$new_name = "sol_" . $this->edit_id . "_" . time() . "." . $ext;
				$target_path = $upload_dir . $new_name;

				if (move_uploaded_file($file_tmp, $target_path)) {
					// Update DB with image name
					$update_q = "UPDATE " . $this->solution_table . " 
								 SET `solimage` = '" . $new_name . "' 
								 WHERE `id` = '" . $this->edit_id . "'";
					$this->conn->exeQuery($update_q);
				}
			}
		}
		$n=count($this->solution);
		for($i=0;$i<$n;$i++){
			if($this->solution[$i]!=""){
				$query = "insert into ".$this->solution_sol_table." set `rdate`='".$this->rdate."',`data_id`='".$this->edit_id."', `solution`='".$this->conn->filterVar($this->solution[$i])."'";
				$insert_id=$this->conn->inserted_id($query);
			}
		}
		return true;
	}
	public function delete_solution_sol(){
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query=$this->conn->exeQuery("delete from ".$this->solution_sol_table." where data_id='".$this->del_id."'");
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_solution_wcu(){
		$this->del_id=$this->edit_id;
		$this->delete_solution_wcu();
		$this->conn->exeQuery("update ".$this->solution_table." set wcu_title='".$this->wcu_title."',wcudes='".$this->wcudes."' where id='".$this->edit_id."'");
		
		
		$n=count($this->reason);
		for($i=0;$i<$n;$i++){
			if($this->reason[$i]!=""){
				$query = "insert into ".$this->solution_wcu_table." set `rdate`='".$this->rdate."',`data_id`='".$this->edit_id."', `reason`='".$this->conn->filterVar($this->reason[$i])."'";
				$insert_id=$this->conn->inserted_id($query);
			}
		}
		return true;
	}
	public function delete_solution_wcu(){
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query=$this->conn->exeQuery("delete from ".$this->solution_wcu_table." where data_id='".$this->del_id."'");
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
	public function update_solution_faq(){
		$this->del_id=$this->edit_id;
		$this->delete_solution_faq();
			
		$n=count($this->faq);
		for($i=0;$i<$n;$i++){
			if($this->faq[$i]!=""){
				$query = "insert into ".$this->solution_faq_table." set `rdate`='".$this->rdate."',`data_id`='".$this->edit_id."', `faq`='".$this->conn->filterVar($this->faq[$i])."', `ans`='".$this->conn->filterVar($this->ans[$i])."'";
				$insert_id=$this->conn->inserted_id($query);
			}
		}
		return true;
	}
	public function delete_solution_faq(){
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query=$this->conn->exeQuery("delete from ".$this->solution_faq_table." where data_id='".$this->del_id."'");
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
	
/////////////////////////////////////////////////////	
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (pname='".$this->pname."' or url_name='".$this->url_name."') and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (pname='".$this->pname."' or url_name='".$this->url_name."') and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function item_qoh($itm)
	{
		//$q1=$this->conn->exeQuery("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$itm."' and mi_status='Yes'");
		//$qr=$q1->fetch_assoc();
		$op=0;//$qr['op_qty'];
		
		$q2=$this->conn->exeQuery("select sum(qty) as qty from ".$this->in_detail_product_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and item_id='".$itm."' and mi_status='Yes'");
		$qr1=$q2->fetch_assoc();
		$dr=$qr1['qty'];
		$cr=0;
		$q3=$this->conn->exeQuery("select count(*) as qty from ".$this->serial_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and prd_id='".$itm."' and mi_status='Yes'");
		$qr2=$q3->fetch_assoc();
		$cr=$qr2['qty'];
		
		$bal=($op+$dr)-$cr;
		return $bal;
		/*return 0;*/
	}
	public function pname($id)
	{
		$query="select pname from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		
		if($qr->num_rows){
			$row=$qr->fetch_assoc();
			return $row['pname'];
		}else{
			return $id;
		}
	}
	public function product_brand($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		
		if($qr->num_rows){
			$row=$qr->fetch_assoc();
			$query="select brand_name from mi_brand where id='".$row['brand']."' and mi_status='Yes'";
			$qr1=$this->conn->exeQuery($query);
			if($qr->num_rows){
				$row1=$qr1->fetch_assoc();
				return $row1['brand_name'];
			}else{
				return "SUBTECH";
			}
			
		}else{
			return "SUBTECH";
		}
	}
	public function item_details($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row;
	}
	
	/// Raw List
	public function item_list($id='')
	{
		$cid=explode(",",$id);
		$str='<option value=""> Product</option>';
		
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if(in_array($row['id'],$cid))
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['pname'].'</option>';
			}else{
			$str.='<option value="'.$row['id'].'">'.$row['pname'].' </option>';
			}
		}
		return $str;
	}
	public function item_cat_list($catid,$id='')
	{
		$str='<option value="">--Select--</option>';
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and cat_id='".$catid."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['pname'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['pname'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$ctid=implode(",",$this->cat_id);
			$sector=implode(",",$this->sectors);
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`, `user_id`, `cat_id`, `subcat_id`, `varient`, `ptype`,`ptype2`, `rating`, `model`, `pname`, `url_name`, `brand`, `sectors`, `pcode`, `length`, `breadth`, `height`, `weight`, `hsncode`,  `mrp`, `srate`, `drate`, `unit_id`, `gst`, `warranty`, `relay`, `mcb`, `mccb`, `kw`,`kva`, `minv`, `maxv`, `cat220`, `cat415`, `startmfd`, `runmfd`,`inbox`, `description`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$ctid."','".$this->subcat_id."','".$this->varient."','".$this->ptype."','".$this->ptype2."','".$this->rating."','".$this->model."','".$this->pname."','".$this->url_name."','".$this->brand."','".$sector."','".$this->pcode."','".$this->length."','".$this->breadth."','".$this->height."','".$this->weight."','".$this->hsncode."','".$this->mrp."','".$this->srate."','".$this->drate."','".$this->unit_id."','".$this->gst."','".$this->warranty."','".$this->relay."','".$this->mcb."','".$this->mccb."','".$this->kw."','".$this->kva."','".$this->minv."','".$this->maxv."','".$this->cat220."','".$this->cat415."','".$this->startmfd."','".$this->runmfd."','".$this->inbox."','".$this->description."','Yes')";
			$ok=$this->conn->inserted_id($query);		
			if($ok){
				$this->updateimg($ok);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function updateimg($id){
       if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   $imagename=$_SESSION[SITE_NAME]['MICMP_cmpid']."_".$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../images/prod_img/".$filename);
		   $query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
			if($this->conn->exeQuery($query)){
				return true;
			}else{
				return false;
			}
	   }else{
		   return true;
	   }
    }
	public function update(){
      
      $this->edit_id=$this->conn->filterVar($this->edit_id);
      if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$ctid=implode(",",$this->cat_id);
			$sector=implode(",",$this->sectors);
			
        $query = "update ".$this->table_name." set `cat_id`='".$ctid."',`subcat_id`='".$this->subcat_id."',`varient`='".$this->varient."',`rating`='".$this->rating."',`sectors`='".$sector."',`ptype`='".$this->ptype."',`ptype2`='".$this->ptype2."',`model`='".$this->model."',`pcode`='".$this->pcode."',`pname`='".$this->pname."',`url_name`='".$this->url_name."',`brand`='".$this->brand."',`mrp`='".$this->mrp."',`srate`='".$this->srate."',`drate`='".$this->drate."',`length`='".$this->length."',`breadth`='".$this->breadth."',`height`='".$this->height."',`weight`='".$this->weight."',`hsncode`='".$this->hsncode."',`warranty`='".$this->warranty."',`unit_id`='".$this->unit_id."',`warranty`='".$this->warranty."',`gst`='".$this->gst."',`relay`='".$this->relay."',`mcb`='".$this->mcb."',`mccb`='".$this->mccb."',`kw`='".$this->kw."',`kva`='".$this->kva."',`minv`='".$this->minv."',`maxv`='".$this->maxv."',`cat220`='".$this->cat220."',`cat415`='".$this->cat415."',`startmfd`='".$this->startmfd."',`runmfd`='".$this->runmfd."',`inbox`='".$this->inbox."', `description`='".$this->description."' where id='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				
        if($this->conn->exeQuery($query)){
			$this->updateimg($this->edit_id);
            return true;
        }else{
            return false;
        }
	}else{
			return false;
		}
	}
	public function deleteme(){
      
		$this->del_id=$this->del_id;
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$q=$this->conn->exeQuery("select * from ".$this->table_name." where id='".$this->del_id."' and mi_status='Yes'");
			$r=$q->fetch_assoc();
			$picture='../images/prod_img/'.$r['image'];
			chmod($picture, 0644);
			unlink($picture);
						
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
			global $objcat;global $objunit;
			$qr=$this->conn->exeQuery("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				if($row['image']!=''){
					$img="<img src='".BASE_PATH."images/prod_img/".$row['image']."' style='height:50px;' />";
				}
				$stk=$this->item_qoh($row['id']);
				$str.="<tr><td>".$i."</td><td>".$row['pname']."</td><td>".$objcat->cat_name($row['cat_id'])."</td><td>".$row['pcode']."</td><td>".$row['hsncode']."</td><td>".$stk."</td><td>".$img."</td><td><a href='#' class='btn btn-primary btn-xs serial' title='Serial No.' data_id='".$row['id']."' data_stk='".$stk."'><i class='fa fa-asterisk'></i></a><a href='".BASE_PATH."Add_Product/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	//////////////////// Serial Number /////////////////
	public function create_serial(){
		global $objcat;
		$pd=$this->item_details($this->pcode);
		$mon=Array('Jan' => '01', 'Feb' => '02','Mar' => '03','Apr' => '04','May' => '05','Jun' => '06','Jul' => '07','Aug' => '08','Sep' => '09','Oct' => '10','Nov' => '11','Dec' => '12');
		$csql=$this->conn->exeQuery("SELECT MAX(CAST(SUBSTRING(serial_no, 5) AS UNSIGNED)) AS max_serial FROM mi_product_detail WHERE cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' AND batch_no<>'OLD' AND mi_status = 'Yes' ")->fetch_assoc();	
		
		if(!empty($csql['max_serial'])) {

			$sr = (int)$csql['max_serial'] + 1;
		} else {
			$sr = 1;
		}
		if($sr<99999){
			$sr = str_pad($sr, 6, '0', STR_PAD_LEFT);
		}
		

		return $sr;
	}
	public function create_batch(){
		
		$today_date_for_batch = date('Ymd'); 
		$batch_prefix = "BAT";
		$candidate_batch_code = $batch_prefix . "-" . $today_date_for_batch;
		$sql_check_batch = "SELECT MAX(CAST(SUBSTRING_INDEX(batch_no, '-', -1) AS UNSIGNED)) AS max_numeric_batch_suffix FROM mi_product_detail WHERE cmp_id = '".$_SESSION[SITE_NAME]['MICMP_cmpid']."' AND mi_status = 'Yes' AND batch_no LIKE '".$candidate_batch_code . "%' AND batch_no <> 'OLD' order by batch_no desc LIMIT 1";
		
		$current_max_batch_suffix = 0;
		$row_max_batch_suffix=$this->conn->exeQuery($sql_check_batch)->fetch_assoc();
		if ($row_max_batch_suffix && $row_max_batch_suffix['max_numeric_batch_suffix'] !== null) {
			$current_max_batch_suffix = (int)$row_max_batch_suffix['max_numeric_batch_suffix'];
		}
		$next_batch_suffix = $current_max_batch_suffix + 1;
		$padded_next_batch_suffix = str_pad($next_batch_suffix, 2, '0', STR_PAD_LEFT); 

		$final_batch_no = $batch_prefix . "-" . $today_date_for_batch . "-" . $padded_next_batch_suffix;
		return $final_batch_no;
	}		
	public function view_serial(){
		if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			global $objcat;
			$pd=$this->item_details($this->pcode);
			$mon=Array('Jan' => '01', 'Feb' => '02','Mar' => '03','Apr' => '04','May' => '05','Jun' => '06','Jul' => '07','Aug' => '08','Sep' => '09','Oct' => '10','Nov' => '11','Dec' => '12');

			$s1=$mon[date("M")].date("y");

			$sr=$this->create_serial();
			$dt=($this->mfgdates!='')?date("Y-m-d",strtotime($this->mfgdates)):date("Y-m-d");
			for($i=0;$i<$this->qty;$i++){
				$ser=$s1.$sr;
				$str.="<tr><td><input type='text' value='".$ser."' name='srno[]' readonly class='form-control' /></td><td><input type='text' name='models[]' value='".$pd['model']."' class='form-control' /></td><td><select name='brands[]' class='form-control'>".$objcat->brand_list($pd['brand'])."</select></td><td><input type='date' class='form-control' name='mfgdates[]'  value='".$dt."' /></td></tr>";
				$sr+=1;
				if($sr<99999){
					$sr = str_pad($sr, 6, '0', STR_PAD_LEFT);
				}
			}
			return $str;
		}
	}
	public function view_all_serial(){
		if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			global $objcat;
			$pd=$this->item_details($this->pcode);
			
			$csql=$this->conn->exeQuery("select * from ".$this->serial_table." where batch_no='".$this->pcode."' order by id ");
			$str="<table class='table table-bordered' id='serialtable'><thead><th>Sr.</th><th>Serial No.</th><th>Model</th><th>Brand</th><th>MFG.</th><th>Customer.</th><th>Act.</th></thead><tbody>";
			$n=$csql->num_rows;
			$sr=1;
			$s1=$mon[date("M")].date("y");
			if($n){
				while($row=$csql->fetch_assoc()){
					$str.="<tr><td>".$sr.".</td><td>".$row['serial_no']."</td><td>".$row['model']."</td><td>".$objcat->brand_name($row['brand'])."</td><td>".date("d-M-Y",strtotime($row['mfg_date']))."</td><td>".$row['cust_id']."</td><td><a href='".BASE_PATH."pkt_print/SGL/".$row['id']."' target='_blank' title='Print'> <i class='fa fa-print'></i></a>";
					if($_SESSION[SITE_NAME]['MICMP_usertype']=='Admin'){
					$str.="<a href='#' data-id='".$row['serial_no']."' title='Delete' class='text-danger del'> <i class='fa fa-trash'></i></a>";
					}
					$str.="</td></tr>";
					
					
					$sr++;
				}
			}else{
				$str.="<tr><td colspan='6'>Record not Found</td></tr>";
			}
			$str.="</tbody></table><script>$('#serialtable').DataTable( {dom: 'Blfrtip',buttons: [ 'excel', 'pdf', 'print' ],'lengthMenu': [ [25, 50, 100, -1], [25, 50, 100, 'All'] ], 'pageLength': 25});</script>";
			return $str;
		}
	}
	public function update_serial(){
		if($this->permission['pg_edit']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$n=count($this->srno);
			$this->batch=$this->create_batch();
			$sr=$this->create_serial();
			$mon=Array('Jan' => '01', 'Feb' => '02','Mar' => '03','Apr' => '04','May' => '05','Jun' => '06','Jul' => '07','Aug' => '08','Sep' => '09','Oct' => '10','Nov' => '11','Dec' => '12');
			$s1=$mon[date("M")].date("y");
			
			$sql="insert into ".$this->serial_table." (`id`, `rdate`, `cmp_id`, `user_id`, `prd_id`, `batch_no`,`serial_no`, `model`, `brand`, `mfg_date`, `mi_status`) values ";
			//return $sql;
			$qr="";
			for($i=0;$i<$n;$i++){
				if($this->srno[$i]!=""){
					$ser=$s1.$sr;
					$qr.="('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->pcode."','".$this->batch."','".$ser."','".$this->conn->filterVar($this->models[$i])."','".$this->conn->filterVar($this->brands[$i])."','".$this->conn->filterVar($this->mfgdates[$i])."','Yes'),";
					$sr++;
					if($sr<99999){
						$sr = str_pad($sr, 6, '0', STR_PAD_LEFT);
					}
				}
			}
			//return $qr;
			if($qr!=""){
				$qr=rtrim($qr,",");
				$ok=$this->conn->exeQuery($sql.$qr);
				if($ok){
					$this->conn->exeQuery("update ".$this->table_name." set mrp='".$this->mrp."' where id='".$this->pcode."' and mi_status='Yes'");
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}
	public function delete_all_serial_by_batch(){
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query=$this->conn->exeQuery("delete from ".$this->serial_table." where batch_no='".$this->del_id."'");
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
	public function delete_serial(){
		if($this->permission['pg_delete']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query=$this->conn->exeQuery("delete from ".$this->serial_table." where serial_no='".$this->del_id."'");
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
	//////////////////////////////   Product In ////////////////////////
	
	public function update_product_in(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$sup=($this->supplier!="")?$this->supplier:'Self';
			$query = "INSERT INTO ".$this->in_product_table."(`id`, `rdate`, `cmp_id`, `user_id`, `party_id`, `nettotal`, `remark`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$sup."','".$this->nettotal."','".$this->remark."','Yes')";
			$ok=$this->conn->inserted_id($query);		
			if($ok){
				$this->data_id=$ok;
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function update_product_in_detail(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->in_detail_product_table."(`id`, `rdate`, `cmp_id`, `user_id`, `data_id`, `cat_id`, `subcat_id`, `item_id`, `brand_id`, `god_id`, `rate`, `qty`, `total`, `mi_status`) VALUES ";

			$q1="";
				//$n=count($this->cat);
				foreach ($this->items as $row)
				{
					if($row['cat']!='' and $this->data_id!='')
					{	
						$q1.="('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->data_id."','".$this->conn->filterVar($row['cat'])."','".$this->conn->filterVar($row['subcat'])."','".$this->conn->filterVar($row['item'])."','".$this->conn->filterVar($row['brand'])."','".$this->conn->filterVar($this->godown)."','".$this->conn->filterVar($row['rate1'])."','".$this->conn->filterVar($row['qty'])."','".$this->conn->filterVar($row['total'])."','Yes'),";
					}
				}
			if($q1!=""){
				$query=$query.rtrim($q1,",");
				//return $query;
				$ok=$this->conn->exeQuery($query);
				if($ok){
					return true;
				}else{
					return false;
				}
			}
			
		}else{
			return false;
		}
    }
}
$objproduct= new PRODUCT($db);
?>