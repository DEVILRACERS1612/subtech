<?php 
require '../config/config.inc.php';
require '../Model/class.item.php';
require '../Model/class.category.php';
require '../Model/class.unit.php';
	
	$objstkitem->rdate=date("Y-m-d H:i:s");
	$objstkitem->item_name = $db->filterVar($_POST['item_name']);
	$objstkitem->i_code = $db->filterVar($_POST['i_code']);
	$objstkitem->hsncode = $db->filterVar($_POST['hsncode']);
	$objstkitem->cat_id = $db->filterVar($_POST['cat_id']);
	$objstkitem->unit_id = $db->filterVar($_POST['unit_id']);
	$objstkitem->prate = $db->filterVar($_POST['prate']);
	$objstkitem->rate = $db->filterVar($_POST['rate']);
	$objstkitem->op_qty = $db->filterVar($_POST['op_qty']);
	$objstkitem->gst = $db->filterVar($_POST['gst']);
	$objstkitem->address = $db->filterVar($_POST['address']);
	$objstkitem->description = $db->filterVar($_POST['description']);
	
	$objstkitem->image = $_FILES['image'];
    
    $objstkitem->edit_id = $_POST['edit_id'];
    $objstkitem->del_id = $db->filterVar($_POST['del_id']);
	$objstkitem->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objstkitem->find_id() )
			{
				echo '{"type":"fail","message":"Item  Already Exists"}';
			}
			else
			{
				if($objstkitem->insert()){
					echo '{"type":"success","message":"Item Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Item Not Saved Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objstkitem->find_id() )
			{
				echo '{"type":"fail","message":"Item Already Exists"}';
			}
			else
			{
				if($objstkitem->update()){
					echo '{"type":"success","message":"Item Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Item Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objstkitem->deleteme()){
				echo '{"type":"success","message":"Item Deleted Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objstkitem->view().'"}';
			
		}
		else if($method=='FindItem')
		{
			echo $objstkitem->item_cat_list($objstkitem->cat_id,'');
			
		}
    }else{
		echo '{"type":"fail","message":"Invalid Item"}';
	}

?>