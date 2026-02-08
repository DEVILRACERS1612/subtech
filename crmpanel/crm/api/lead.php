<?php 
require '../config/config.inc.php';
require '../Model/class.lead.php';
	
	$objlead->rdate = date("Y-m-d H:i:s");
	$objlead->enq_date = date("Y-m-d",strtotime($_POST['enq_date']));
	$objlead->ext_date = date("Y-m-d",strtotime($_POST['ext_date']));
	
	$objlead->cmp_name = $db->filterVar($_POST['cmp_name']);
	$objlead->web_url = $db->filterVar($_POST['web_url']);
	$objlead->address = $db->filterVar($_POST['address']);
	$objlead->email = $db->filterVar($_POST['email']);
	$objlead->telephone = $db->filterVar($_POST['telephone']);
	$objlead->mobile = $db->filterVar($_POST['mobile']);
	$objlead->industry = $db->filterVar($_POST['industry']);
	$objlead->segment = $db->filterVar($_POST['segment']);
	$objlead->source = $db->filterVar($_POST['source']);
	$objlead->reference = $db->filterVar($_POST['reference']);
	$objlead->tcode = $db->filterVar($_POST['tcode']);
	$objlead->country = $db->filterVar($_POST['country']);
	$objlead->state = $db->filterVar($_POST['state']);
	$objlead->location = $db->filterVar($_POST['location']);
	$objlead->pincode = $db->filterVar($_POST['pincode']);
	$objlead->executive = $db->filterVar($_POST['executive']);
	$objlead->initiated_by = $db->filterVar($_POST['initiated_by']);
	$objlead->enquiry_status = $db->filterVar($_POST['enquiry_status']);
	$objlead->remark = $db->filterVar($_POST['remark']);
	$objlead->product = $_POST['product'];
	
	//////////Contacts////////
	$objlead->cdesig_id = $_POST['cdesig_id'];
	$objlead->cdep_id = $_POST['cdep_id'];
	$objlead->ctitle = $_POST['ctitle'];
	$objlead->cfname = $_POST['cfname'];
	$objlead->clname = $_POST['clname'];
	$objlead->cmobile = $_POST['cmobile'];
	$objlead->ccontact = $_POST['ccontact'];
	$objlead->cemail = $_POST['cemail'];
	/////////////////Activity//////////
	$objlead->act_date = date("Y-m-d",strtotime($_POST['act_date']));
	$objlead->act_taken = $db->filterVar($_POST['act_taken']);
	$objlead->act_type = $db->filterVar($_POST['act_type']);
	$objlead->file1 = $_FILES['file1'];
	$objlead->file2 = $_FILES['file2'];
	$objlead->file3 = $_FILES['file3'];
	$objlead->plan_date = ($_POST['plan_date']!="")?date("Y-m-d H:i:s",strtotime($_POST['plan_date'])):'';
	$objlead->plan_action = $db->filterVar($_POST['plan_action']);
	$objlead->plan_act_type = $db->filterVar($_POST['plan_act_type']);
	$objlead->plan_for = $db->filterVar($_POST['plan_for']);
	$objlead->lead_id = $db->filterVar($_POST['lead_id']);
	
	//////////////Products/////////////////
	
	$objlead->qty = $_POST['qty'];
	$objlead->rate = $_POST['rate'];
	$objlead->total = $_POST['total'];
	$objlead->act_status = $_POST['act_status'];
	
	//////////////Address/////////////////
	
	$objlead->address1 = $_POST['address'];
	$objlead->state_id = $_POST['state_id'];
	$objlead->location_id = $_POST['location_id'];
	$objlead->pin_code = $_POST['pin_code'];
	$objlead->gstin = $_POST['gstin'];
	
	/////////Profile///////////
	$objlead->panno = $db->filterVar($_POST['panno']);
	$objlead->gstno = $db->filterVar($_POST['gstno']);
	$objlead->regno = $db->filterVar($_POST['regno']);
	$objlead->staxno = $db->filterVar($_POST['staxno']);
	$objlead->faxno = $db->filterVar($_POST['faxno']);
	$objlead->dealsin = $db->filterVar($_POST['dealsin']);
	
	/////////////////////////////////
    $objlead->edit_id = $db->filterVar($_POST['edit_id']);
	$objlead->del_id = $db->filterVar($_POST['del_id']);
	$objlead->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objlead->find_id()){
				echo '{"type":"fail","message":"Error: Duplicate Lead Entry"}';
			}else{
				$ok=$objlead->insert();
				if($ok==1){
					echo '{"type":"success","edit":"ok","message":"Lead Save Successfully"}';
				}else if($ok==2){
					echo '{"type":"fail","message":"Error: Duplicate Entry"}';
				}else{
					echo '{"type":"fail","message":"Lead Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			$ok=$objlead->update();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Lead Update Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Lead Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Delete')
		{
			if($objlead->deleteme()){
				echo '{"type":"success","message":"Lead Delete Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='DeleteState')
		{
			if($objlead->delete_state()){
				echo '{"type":"success","message":"Delete State Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='State')
		{
			if($objlead->state_update()){
				echo '{"type":"success","message":"State Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objlead->view().'"}';
		}
		else if($method=='ViewState')
		{
			echo '{"type":"success","message":"'.$objlead->view_state().'"}';
		}
		else if($method=='Location')
		{
			if($objlead->location_update()){
				echo '{"type":"success","message":"Location Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='ViewLocation')
		{
			echo '{"type":"success","message":"'.$objlead->view_location().'"}';
		}
		else if($method=='DeleteLocation')
		{
			if($objlead->delete_location()){
				echo '{"type":"success","message":"Delete Location Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='SearchState')
		{
			echo $objlead->state_list($objlead->country,'');
			
		}
		else if($method=='SearchLocation')
		{
			echo $objlead->location_list($objlead->state,'');
		}
		else if($method=='Contacts')
		{
			if($objlead->add_contacts()){
				echo '{"type":"success","message":"Lead Contacts Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='Activity')
		{
			/*echo $objlead->add_activity();*/
			if($objlead->add_activity()){
				echo '{"type":"success","message":"Lead Activity Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='ActivityComplete')
		{
			/*echo $objlead->add_activity();*/
			if($objlead->activity_complete()){
				echo '{"type":"success","message":"Lead Dairy Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='ActivityAdvUpdate')
		{
			/*echo $objlead->add_activity();*/
			if($objlead->activity_adv_complete()){
				echo '{"type":"success","message":"Lead Dairy Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='Products')
		{
			/*echo $objlead->add_products();*/
			if($objlead->add_products()){
				echo '{"type":"success","message":"Lead Product Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='Address')
		{
			/*echo "ok";//$objlead->add_products();*/
			if($objlead->add_address()){
				echo '{"type":"success","message":"Lead Address Saved Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='Address1')
		{
			/*echo "ok";//$objlead->add_products();*/
			if($objlead->update_address()){
				echo '{"type":"success","message":"Lead Address Saved Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='Profile')
		{
			/*echo "ok";//$objlead->add_products();*/
			if($objlead->update_profile()){
				echo '{"type":"success","message":"Lead Profile Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>