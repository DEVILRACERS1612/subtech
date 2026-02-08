<?php 
require '../config/config.inc.php';
require '../Model/class.item.php';
require '../Model/class.student.php';
require '../Model/class.category.php';
require '../Model/class.unit.php';
require '../Model/class.billing.php';
	
	$objbilling->rdate=date("Y-m-d H:i:s");
	$objbilling->inv_date = date("Y-m-d",strtotime($db->filterVar($_POST['inv_date'])));
	$objbilling->admno = $db->filterVar($_POST['admno']);
	$objbilling->inv_no = $db->filterVar($_POST['inv_no']);
	$objbilling->gtotal = $db->filterVar($_POST['gtotal']);
	$objbilling->ggsttotal = $db->filterVar($_POST['ggsttotal']);
	$objbilling->gsubtotal = $db->filterVar($_POST['gsubtotal']);
	$objbilling->fright = (isset($_POST['fright']) and $_POST['fright']!='')?$db->filterVar($_POST['fright']):'0';
	$objbilling->adjustment = (isset($_POST['adjustment']) and $_POST['adjustment']!='')?$db->filterVar($_POST['adjustment']):'0';
	$objbilling->nettotal = $db->filterVar($_POST['nettotal']);
	$objbilling->remark = $db->filterVar($_POST['remark']);
	$objbilling->pdetail = $db->filterVar($_POST['pdetail']);
	$objbilling->pmode = $_POST['pmode'];
	
	$objbilling->item_id = $_POST['item_id'];
	$objbilling->cat_id = $_POST['cat_id'];
	$objbilling->unit_id = $_POST['unit_id'];
	$objbilling->rate = $_POST['rate'];
	$objbilling->drate = $_POST['drate'];
	$objbilling->total = $_POST['total'];
	
	$objbilling->qty = $_POST['qty'];
	$objbilling->gst = $_POST['gst'];
	$objbilling->gsttotal = $_POST['gsttotal'];
	$objbilling->subtotal = $_POST['subtotal'];
	
	$objbilling->image = $_FILES['image'];
    
    $objbilling->edit_id = $_POST['edit_id'];
    $objbilling->del_id = $db->filterVar($_POST['del_id']);
	$objbilling->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objbilling->find_id() )
			{
				echo '{"type":"fail","message":"Billing  Already Exists"}';
			}
			else
			{
				if($objbilling->insert()){
					echo '{"type":"success","message":"Billing Item Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Billing Item Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objbilling->find_id() )
			{
				echo '{"type":"fail","message":"Billing Item Already Exists"}';
			}
			else
			{
				if($objbilling->update()){
					echo '{"type":"success","message":"Billing Item Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Billing Item Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objbilling->deleteme()){
				echo '{"type":"success","message":"Billing Item Deleted Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objbilling->view().'"}';
			
		}
		else if($method=='ItemView')
		{
			$row=$objbilling->item_details();
			$stkqty=$objstkitem->item_qoh($row['id']);
			if($stkqty>0)
			{
				echo '{"type":"success","rate":"'.$row['rate'].'","stkqty":"'.$stkqty.'","unitid":"'.$row['unit_id'].'","unit":"'.$objunit->unit_name($row['unit_id']).'","gst":"'.$row['gst'].'"}';
			}else{
				echo '{"type":"empty","message":"Item Qty is '.$stkqty.' '.$objunit->unit_name($row['unit_id']).' in Stock "}';
			}
			
			
		}
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>