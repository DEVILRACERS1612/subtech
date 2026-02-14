<?php
class BILLING{

    private $conn;
	private $itm_table_name = "mi_item";
    private $bill_table_name = "mi_billing";
	private $bill_detail_table = "mi_billing_detail";
	
    // object properties
    public $rdate;
	public $inv_no;
	public $inv_date;
	public $admno;
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
		$this->admno=$this->admno;
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
			if($this->conn->num_rows("select * from ".$this->bill_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and inv_no='".$this->inv_no."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->bill_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and inv_no='".$this->inv_no."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
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
		$query="select * from ".$this->itm_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and id='".$this->item_id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row;
		
	}
	public function new_invno()
	{
		$adq=$this->conn->exeQuery("select max(inv_no) as inv_no from ".$this->bill_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."'");
		$ad=$adq->fetch_assoc();
		if($ad['inv_no']!='')
		{
			$i=intval($ad['inv_no'])+1;
			return $i;
		}
	}
    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$adq=$this->conn->exeQuery("select max(inv_no) as inv_no from ".$this->bill_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."'");
			$ad=$adq->fetch_assoc();
			if($ad['inv_no']==$this->inv_no)
			{
				$i=intval($ad['inv_no'])+1;
				$this->inv_no=$i;
			}

			$s=$this->pmode;
			$pm='';
			foreach($s as $v)
			{
				$pm.=$this->conn->filterVar($v).",";
			}
			$pm=rtrim($pm,",");
			
			$query = "INSERT INTO ".$this->bill_table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `inv_no`, `inv_date`, `admno`, `gtotal`, `ggsttotal`, `gsubtotal`, `fright`, `adjustment`, `nettotal`, `pmode`, `pdetail`, `remark`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$this->inv_no."','".$this->inv_date."','".$this->admno."','".$this->gtotal."','".$this->ggsttotal."','".$this->gsubtotal."','".$this->fright."','".$this->adjustment."','".$this->nettotal."','".$pm."','".$this->pdetail."','".$this->remark."','Yes')";
			$ok=$this->conn->inserted_id($query);		
			if($ok){
				
				$q="INSERT INTO ".$this->bill_detail_table."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `inv_id`, `inv_no`, `cat_id`, `item_id`, `rate`, `drate`, `qty`,`unit_id`, `total`, `gst`, `gsttotal`, `subtotal`, `mi_status`) VALUES ";
				$n=count($this->cat_id);
				for($i=0;$i<$n;$i++)
				{
					if($this->cat_id[$i]!='')
					{
						$q.="('0','".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$ok."','".$this->inv_no."','".$this->conn->filterVar($this->cat_id[$i])."','".$this->conn->filterVar($this->item_id[$i])."','".$this->conn->filterVar($this->rate[$i])."','".$this->conn->filterVar($this->drate[$i])."','".$this->conn->filterVar($this->qty[$i])."','".$this->conn->filterVar($this->unit_id[$i])."','".$this->conn->filterVar($this->total[$i])."','".$this->conn->filterVar($this->gst[$i])."','".$this->conn->filterVar($this->gsttotal[$i])."','".$this->conn->filterVar($this->subtotal[$i])."','Yes'),";
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
      if($this->permission['pg_edit']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
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
				
				$query = "INSERT INTO ".$this->bill_table_name."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `inv_no`, `inv_date`, `admno`, `gtotal`, `ggsttotal`, `gsubtotal`, `fright`, `adjustment`, `nettotal`, `pmode`, `pdetail`, `remark`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$this->inv_no."','".$this->inv_date."','".$this->admno."','".$this->gtotal."','".$this->ggsttotal."','".$this->gsubtotal."','".$this->fright."','".$this->adjustment."','".$this->nettotal."','".$pm."','".$this->pdetail."','".$this->remark."','Yes')";
				$ok=$this->conn->inserted_id($query);		
				if($ok){
					
					$q="INSERT INTO ".$this->bill_detail_table."(`id`, `rdate`, `school_id`, `user_id`, `sess_year`, `inv_id`, `inv_no`, `cat_id`, `item_id`, `rate`, `drate`, `qty`,`unit_id`, `total`, `gst`, `gsttotal`, `subtotal`, `mi_status`) VALUES ";
					$n=count($this->cat_id);
					for($i=0;$i<$n;$i++)
					{
						if($this->cat_id[$i]!='')
						{
							$q.="('0','".$this->rdate."','".$_SESSION['MISCHOOL_schoolid']."','".$_SESSION['MISCHOOL_userid']."','".$_SESSION['sess_year']."','".$ok."','".$this->inv_no."','".$this->conn->filterVar($this->cat_id[$i])."','".$this->conn->filterVar($this->item_id[$i])."','".$this->conn->filterVar($this->rate[$i])."','".$this->conn->filterVar($this->drate[$i])."','".$this->conn->filterVar($this->qty[$i])."','".$this->conn->filterVar($this->unit_id[$i])."','".$this->conn->filterVar($this->total[$i])."','".$this->conn->filterVar($this->gst[$i])."','".$this->conn->filterVar($this->gsttotal[$i])."','".$this->conn->filterVar($this->subtotal[$i])."','Yes'),";
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
		if($this->permission['pg_delete']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			$query=$this->conn->exeQuery("delete from ".$this->bill_detail_table." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and inv_id='".$this->del_id."' and mi_status='Yes'");
						
			$query="delete from ".$this->bill_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and id='".$this->del_id."' and mi_status='Yes'";
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
		if($this->permission['pg_view']=='Yes' or $_SESSION['MISCHOOL_usertype']=='Admin')
		{
			global $objparty;
			$qr=$this->conn->exeQuery("select * from ".$this->bill_table_name." where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes' order by rdate desc");
			$str="";
			$i=1;
			while($row=$qr->fetch_assoc())
			{
				
				$str.="<tr><td>".$i."</td><td>".$objstu->student_name($row['admno'])."</td><td>".$row['inv_no']."</td><td>".$row['inv_date']."</td><td>".$row['gtotal']."</td><td>".$row['ggsttotal']."</td><td>".$row['gsubtotal']."</td><td>".$row['fright']."</td><td>".$row['adjustment']."</td><td>".$row['nettotal']."</td> <td><a href='".BASE_PATH."Print_Bill/".$row['inv_no']."/' target='_blank' class='btn btn-success btn-xs' title='Print Bill'><i class='fa fa-print'></i></a><a href='".BASE_PATH."Add_Billing/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
}
$objbilling= new BILLING($db);
?>