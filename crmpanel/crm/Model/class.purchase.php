<?php
class PURCHASE{

    private $conn;
	private $itm_table_name = "mi_item";
    private $pur_table_name = "mi_purchase";
	private $pur_detail_table = "mi_purchase_detail";
	
    // object properties
    public $rdate;
	public $inv_no;
	public $inv_date;
	public $party_id;
	public $gtotal;
	public $ggsttotal;
	public $gsubtotal;
	public $fright;
	public $adjustment;
	public $nettotal;
	public $remark;
	public $pdetail;
	
	public $pmode;
	public $item_id;
	public $cat_id;
	public $unit_id;
	public $rate;
	public $drate;
	public $qty;
	public $total;
	public $gst;
	public $gsttotal;
	public $subtotal;
	
	
    public $edit_id;
    public $del_id;
    public $permission;
	
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->inv_date=$this->inv_date;
		$this->party_id=$this->party_id;
		$this->gtotal=$this->gtotal;
		$this->ggsttotal=$this->ggsttotal;
		$this->gsubtotal=$this->gsubtotal;
		$this->fright=$this->fright;
		$this->adjustment=$this->adjustment;
		$this->nettotal=$this->nettotal;
		$this->remark=$this->remark;
		$this->pmode=$this->pmode;
		$this->pdetail=$this->pdetail;
				
		$this->item_id=$this->item_id;
		$this->cat_id=$this->cat_id;
		$this->unit_id=$this->unit_id;
		$this->rate=$this->rate;
		$this->drate=$this->drate;
		$this->qty=$this->qty;
		$this->total=$this->total;
		$this->gst=$this->gst;
		$this->gsttotal=$this->gsttotal;
		$this->subtotal=$this->subtotal;

		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->pur_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and inv_no='".$this->inv_no."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->pur_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and inv_no='".$this->inv_no."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function item_id($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['item_id'];
	}
	public function item_details()
	{
		$query="select * from ".$this->itm_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$this->item_id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row;
		
	}
    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			
			$s=$this->pmode;
			$pm='';
			foreach($s as $v)
			{
				$pm.=$this->conn->filterVar($v).",";
			}
			$pm=rtrim($pm,",");
			
			$query = "INSERT INTO ".$this->pur_table_name."(`id`, `rdate`, `cmp_id`, `user_id`,  `inv_no`, `inv_date`, `party_id`, `gtotal`, `ggsttotal`, `gsubtotal`, `fright`, `adjustment`, `nettotal`, `pmode`, `pdetail`, `remark`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->inv_no."','".$this->inv_date."','".$this->party_id."','".$this->gtotal."','".$this->ggsttotal."','".$this->gsubtotal."','".$this->fright."','".$this->adjustment."','".$this->nettotal."','".$pm."','".$this->pdetail."','".$this->remark."','Yes')";
			$ok=$this->conn->inserted_id($query);		
			if($ok){
				
				$q="INSERT INTO ".$this->pur_detail_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `inv_id`, `inv_no`, `cat_id`, `item_id`, `rate`, `drate`, `qty`,`unit_id`, `total`, `gst`, `gsttotal`, `subtotal`, `mi_status`) VALUES ";
				$n=count($this->cat_id);
				for($i=0;$i<$n;$i++)
				{
					if($this->cat_id[$i]!='')
					{
						$q.="('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$ok."','".$this->inv_no."','".$this->conn->filterVar($this->cat_id[$i])."','".$this->conn->filterVar($this->item_id[$i])."','".$this->conn->filterVar($this->rate[$i])."','".$this->conn->filterVar($this->drate[$i])."','".$this->conn->filterVar($this->qty[$i])."','".$this->conn->filterVar($this->unit_id[$i])."','".$this->conn->filterVar($this->total[$i])."','".$this->conn->filterVar($this->gst[$i])."','".$this->conn->filterVar($this->gsttotal[$i])."','".$this->conn->filterVar($this->subtotal[$i])."','Yes'),";
					}
						
					
				}
				$q=rtrim($q,",");
				$this->conn->exeQuery($q);
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
			$this->del_id=$this->conn->filterVar($this->edit_id);
			$ok=$this->deleteme();
			if($ok)
			{
				$s=$this->pmode;
				$pm='';
				foreach($s as $v)
				{
					$pm.=$this->conn->filterVar($v).",";
				}
				$pm=rtrim($pm,",");
				
				$query = "INSERT INTO ".$this->pur_table_name."(`id`, `rdate`, `cmp_id`, `user_id`,  `inv_no`, `inv_date`, `party_id`, `gtotal`, `ggsttotal`, `gsubtotal`, `fright`, `adjustment`, `nettotal`, `pmode`, `pdetail`, `remark`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->inv_no."','".$this->inv_date."','".$this->party_id."','".$this->gtotal."','".$this->ggsttotal."','".$this->gsubtotal."','".$this->fright."','".$this->adjustment."','".$this->nettotal."','".$pm."','".$this->pdetail."','".$this->remark."','Yes')";
				$ok=$this->conn->inserted_id($query);		
				if($ok){
					
					$q="INSERT INTO ".$this->pur_detail_table."(`id`, `rdate`, `cmp_id`, `user_id`,  `inv_id`, `inv_no`, `cat_id`, `item_id`, `rate`, `drate`, `qty`,`unit_id`, `total`, `gst`, `gsttotal`, `subtotal`, `mi_status`) VALUES ";
					$n=count($this->cat_id);
					for($i=0;$i<$n;$i++)
					{
						if($this->cat_id[$i]!='')
						{
							$q.="('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$ok."','".$this->inv_no."','".$this->conn->filterVar($this->cat_id[$i])."','".$this->conn->filterVar($this->item_id[$i])."','".$this->conn->filterVar($this->rate[$i])."','".$this->conn->filterVar($this->drate[$i])."','".$this->conn->filterVar($this->qty[$i])."','".$this->conn->filterVar($this->unit_id[$i])."','".$this->conn->filterVar($this->total[$i])."','".$this->conn->filterVar($this->gst[$i])."','".$this->conn->filterVar($this->gsttotal[$i])."','".$this->conn->filterVar($this->subtotal[$i])."','Yes'),";
						}
						
					}
					$q=rtrim($q,",");
					$this->conn->exeQuery($q);
					return true;
				}else{
					return false;
				}
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
			$query=$this->conn->exeQuery("delete from ".$this->pur_detail_table." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and inv_id='".$this->del_id."' and mi_status='Yes'");
						
			$query="delete from ".$this->pur_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$this->del_id."' and mi_status='Yes'";
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
			global $objparty;
			$qr=$this->conn->exeQuery("select * from ".$this->pur_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				
				$str.="<tr><td>".$i."</td><td>".$objparty->party_name($row['party_id'])."</td><td>".$row['inv_no']."</td><td>".$row['inv_date']."</td><td>".$row['gtotal']."</td><td>".$row['ggsttotal']."</td><td>".$row['gsubtotal']."</td><td>".$row['fright']."</td><td>".$row['adjustment']."</td><td>".$row['nettotal']."</td> <td><a href='".BASE_PATH."Add_Purchase/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
}
$objpur= new PURCHASE($db);
?>