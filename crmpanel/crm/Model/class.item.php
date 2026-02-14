<?php
class STOCK_ITEM{

    private $conn;
    private $table_name = "mi_item";
	private $pur_table_name = "mi_purchase_detail";
	private $bill_table_name = "mi_billing_detail";
 
    // object properties
    public $rdate;
    public $item_name;
	public $i_code;
	public $hsncode;
	public $cat_id;
	public $unit_id;
	public $rate;
	public $prate;
	public $op_qty;
	public $gst;
	
	
	public $image=NULL;
    public $description;
    public $edit_id;
    public $del_id;
    public $permission;
	
    public function __construct($db){
        $this->conn = $db;
		$this->rdate=$this->rdate;
		$this->item_name=$this->item_name;
		$this->cat_id=$this->cat_id;
		$this->unit_id=$this->unit_id;
		$this->prate=$this->prate;
		$this->rate=$this->rate;
		$this->op_qty=$this->op_qty;
		$this->gst=$this->gst;
		
		$this->image=$this->image;
        $this->description=$this->description;
		$this->permission=$this->permission;
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and cat_id='".$this->cat_id."' and item_name='".$this->item_name."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and cat_id='".$this->cat_id."' and item_name='".$this->item_name."' and id<>'".$this->edit_id."' and mi_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function item_qoh($itm)
	{
		$q1=$this->conn->exeQuery("select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$itm."' and mi_status='Yes'");
		$qr=$q1->fetch_assoc();
		$op=$qr['op_qty'];
		
		$q2=$this->conn->exeQuery("select sum(qty) as qty from ".$this->pur_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and item_id='".$itm."' and mi_status='Yes'");
		$qr1=$q2->fetch_assoc();
		$dr=$qr1['qty'];
		
		$q3=$this->conn->exeQuery("select sum(qty) as qty from ".$this->bill_table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and item_id='".$itm."' and mi_status='Yes'");
		$qr2=$q3->fetch_assoc();
		$cr=$qr2['qty'];
		$bal=($op+$dr)-$cr;
		return $bal;
		/*return 0;*/
	}
	public function item_name($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['item_name'];
	}
	/// Raw List
	public function item_list($id='')
	{
		$str='<option value="">--Select--</option>';
		
		$query="select * from ".$this->table_name." where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['item_name'].'</option>';
			}else{
			$str.='<option value="'.$row['id'].'">'.$row['item_name'].' </option>';
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
				$str.='<option value="'.$row['id'].'" selected>'.$row['item_name'].' </option>';
			}else{
				$str.='<option value="'.$row['id'].'">'.$row['item_name'].' </option>';
			}
		}
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   if($this->permission['pg_create']=='Yes' or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
		{
			$query = "INSERT INTO ".$this->table_name."(`id`, `rdate`, `cmp_id`,  `user_id`, `cat_id`, `i_code`,`item_name`,`hsncode`, `prate`,`rate`, `unit_id`, `op_qty`, `gst`, `description`, `image`, `mi_status`) VALUES ('0','".$this->rdate."','".$_SESSION[SITE_NAME]['MICMP_cmpid']."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$this->cat_id."','".$this->i_code."','".$this->item_name."','".$this->hsncode."','".$this->prate."','".$this->rate."','".$this->unit_id."','".$this->op_qty."','".$this->gst."','".$this->description."','','Yes')";
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
			move_uploaded_file($this->image["tmp_name"], "../images/item_img/".$filename);
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
        $query = "update ".$this->table_name." set `cat_id`='".$this->cat_id."',`i_code`='".$this->i_code."',`hsncode`='".$this->hsncode."',`unit_id`='".$this->unit_id."',`op_qty`='".$this->op_qty."',`prate`='".$this->prate."',`rate`='".$this->rate."',`gst`='".$this->gst."',`item_name`='".$this->item_name."', `description`='".$this->description."' where id='".$this->edit_id."' and `cmp_id`='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'";
				
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
			$picture='../images/item_img/'.$r['image'];
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
					$img="<img src='".BASE_PATH."images/item_img/".$row['image']."' style='height:50px;' />";
				}
				$str.="<tr><td>".$i."</td><td>".$row['item_name']."</td><td>".$objcat->cat_name($row['cat_id'])."</td><td>".$row['i_code']."</td><td>".$row['hsncode']."</td><!--<td>".$objunit->unit_name($row['unit_id'])."</td>--><td>".$row['rate']."</td><!--<td>".$row['op_qty']."</td><td>".$objstkitem->item_qoh($row['id'])."</td><td>".$row['gst']."</td>--><td>".$img."</td><td><a href='".BASE_PATH."Add_Item/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
				$i++;
			}
			return $str;
		}else{
			return false;
		}
	}
	
	
}
$objstkitem= new STOCK_ITEM($db);
?>