<?php 
require '../config/config.inc.php';
require '../Model/class.item.php';
require '../Model/class.category.php';
require '../Model/class.unit.php';
require '../Model/class.purchase.php';
	
	$objpur->rdate=date("Y-m-d H:i:s");
	$objpur->inv_date = date("Y-m-d",strtotime($db->filterVar($_POST['inv_date'])));
	$objpur->party_id = $db->filterVar($_POST['party_id']);
	$objpur->inv_no = $db->filterVar($_POST['inv_no']);
	$objpur->gtotal = $db->filterVar($_POST['gtotal']);
	$objpur->ggsttotal = $db->filterVar($_POST['ggsttotal']);
	$objpur->gsubtotal = $db->filterVar($_POST['gsubtotal']);
	$objpur->fright = $db->filterVar($_POST['fright']);
	$objpur->adjustment = $db->filterVar($_POST['adjustment']);
	$objpur->nettotal = $db->filterVar($_POST['nettotal']);
	$objpur->remark = $db->filterVar($_POST['remark']);
	$objpur->pdetail = $db->filterVar($_POST['pdetail']);
	$objpur->pmode = $_POST['pmode'];
	
	$objpur->item_id = $_POST['item_id'];
	$objpur->cat_id = $_POST['cat_id'];
	$objpur->unit_id = $_POST['unit_id'];
	$objpur->rate = $_POST['rate'];
	$objpur->drate = $_POST['drate'];
	$objpur->total = $_POST['total'];
	
	$objpur->qty = $_POST['qty'];
	$objpur->gst = $_POST['gst'];
	$objpur->gsttotal = $_POST['gsttotal'];
	$objpur->subtotal = $_POST['subtotal'];
	
	$objpur->image = $_FILES['image'];
    
    $objpur->edit_id = $_POST['edit_id'];
    $objpur->del_id = $db->filterVar($_POST['del_id']);
	$objpur->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objpur->find_id() )
			{
				echo '{"type":"fail","message":"Purchase  Already Exists"}';
			}
			else
			{
				if($objpur->insert()){
					echo '{"type":"success","message":"Purchase Item Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Purchase Item Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objpur->find_id() )
			{
				echo '{"type":"fail","message":"Purchase Item Already Exists"}';
			}
			else
			{
				if($objpur->update()){
					echo '{"type":"success","message":"Purchase Item Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Purchase Item Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objpur->deleteme()){
				echo '{"type":"success","message":"Purchase Item Deleted Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objpur->view().'"}';
			
		}
		else if($method=='ItemView')
		{
			$row=$objpur->item_details();
			
			echo '{"type":"success","rate":"'.$row['rate'].'","unitid":"'.$row['unit_id'].'","unit":"'.$objunit->unit_name($row['unit_id']).'","gst":"'.$row['gst'].'"}';
			
		}
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>