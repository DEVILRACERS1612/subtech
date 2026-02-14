<?php 
require '../config/config.inc.php';
require '../Model/class.product.php';
require '../Model/class.category.php';
require '../Model/class.unit.php';
	
	$objproduct->rdate=date("Y-m-d H:i:s");
	$objproduct->pname = $db->filterVar($_POST['pname']);
	$objproduct->pcode = $db->filterVar($_POST['pcode']);
	$objproduct->hsncode = $db->filterVar($_POST['hsncode']);
	$objproduct->cat_id = is_array($_POST['cat_id'])?$_POST['cat_id']:$db->filterVar($_POST['cat_id']);
	$objproduct->sectors = is_array($_POST['sectors'])?$_POST['sectors']:$db->filterVar($_POST['sectors']);
	$objproduct->subcat_id = $db->filterVar($_POST['subcat_id']);
	$objproduct->unit_id = $db->filterVar($_POST['unit_id']);
	$objproduct->srate = $db->filterVar($_POST['srate']);
	$objproduct->drate = $db->filterVar($_POST['drate']);
	$objproduct->mrp = $db->filterVar($_POST['mrp']);
	$objproduct->warranty = $db->filterVar($_POST['warranty']);
	$objproduct->op_qty = $db->filterVar($_POST['op_qty']);
	$objproduct->gst = $db->filterVar($_POST['gst']);
	$objproduct->address = $db->filterVar($_POST['address']);
	$objproduct->length = $db->filterVar($_POST['length']);
	$objproduct->breadth = $db->filterVar($_POST['breadth']);
	$objproduct->height = $db->filterVar($_POST['height']);
	$objproduct->weight = $db->filterVar($_POST['weight']);
	$objproduct->url_name = $db->filterVar($_POST['url_name']);
	$objproduct->model = $db->filterVar($_POST['model']);
	$objproduct->rating = $db->filterVar($_POST['rating']);
	$objproduct->ptype = $db->filterVar($_POST['ptype']);
	$objproduct->ptype2 = $db->filterVar($_POST['ptype2']);
	$objproduct->varient = $db->filterVar($_POST['varient']);
	
	$objproduct->stitle = $db->filterVar($_POST['stitle']);
	$objproduct->pf_title = $db->filterVar($_POST['pf_title']);
	$objproduct->sol_title = $db->filterVar($_POST['sol_title']);
	$objproduct->wcu_title = $db->filterVar($_POST['wcu_title']);
	$objproduct->sdes = $db->filterVar($_POST['sdes']);
	$objproduct->wcudes = $db->filterVar($_POST['wcudes']);
	$objproduct->soldes = $db->filterVar($_POST['soldes']);
	$objproduct->pfdes = $db->filterVar($_POST['pfdes']);
	$objproduct->alttext = is_array($_POST['alttext'])?$_POST['alttext']:$db->filterVar($_POST['alttext']);
	$objproduct->calculator = isset($_POST['calculator'])?$db->filterVar($_POST['calculator']):'No';
	$objproduct->clname = $_POST['clname'];
	$objproduct->reason = $_POST['reason'];
	$objproduct->solution = $_POST['solution'];
	$objproduct->faq = $_POST['faq'];
	$objproduct->ans = $_POST['ans'];
	
	
	
	 $objproduct->relay = $db->filterVar($_POST['relay']);
	 $objproduct->mcb = $db->filterVar($_POST['mcb']);
	 $objproduct->mccb = $db->filterVar($_POST['mccb']);
	 $objproduct->kw = $db->filterVar($_POST['kw']);
	 $objproduct->kva = $db->filterVar($_POST['kva']);
	 $objproduct->minv = $db->filterVar($_POST['minv']);
	 $objproduct->maxv = $db->filterVar($_POST['maxv']);
	 $objproduct->cat220=$db->filterVar($_POST['cat220']);
	 $objproduct->cat415=$db->filterVar($_POST['cat415']);
	 $objproduct->startmfd=$db->filterVar($_POST['startmfd']);
	 $objproduct->runmfd=$db->filterVar($_POST['runmfd']);
	$objproduct->inbox=$db->filterVar($_POST['inbox']);
	
	$objproduct->description = $db->filterVar($_POST['description']);
	$objproduct->remark = $db->filterVar($_POST['remark']);
	$objproduct->save_for = $db->filterVar($_POST['save_for']);
	$objproduct->godown = $db->filterVar($_POST['godown']);
	$objproduct->supplier = $db->filterVar($_POST['supplier']);
	$objproduct->nettotal = $db->filterVar($_POST['nettotal']);
	$objproduct->expin = $db->filterVar($_POST['expin']);
	$objproduct->data_id = $db->filterVar($_POST['data_id']);
	
	$objproduct->cat = $_POST['cat'];
	$objproduct->subcat = $_POST['subcat'];
	$objproduct->item = $_POST['item'];
	$objproduct->brand = $_POST['brand'];
	$objproduct->rate = $_POST['rate1'];
	$objproduct->qty = $_POST['qty'];
	$objproduct->total = $_POST['total'];
	$objproduct->items = $_POST['items'];
	
	$objproduct->srno = $_POST['srno'];
	$objproduct->models = $_POST['models'];
	$objproduct->brands = $_POST['brands'];
	$objproduct->mfgdates = $_POST['mfgdates'];
	
		
	$objproduct->image = $_FILES['image'];
    $objproduct->climage = $_FILES['climage'];
    $objproduct->solimage = $_FILES['solimage'];
    $objproduct->pbimage = $_FILES['pbimage'];
    $objproduct->voucher = $_FILES['voucher'];
    
    $objproduct->edit_id = $_POST['edit_id'];
    $objproduct->del_id = $db->filterVar($_POST['del_id']);
	$objproduct->edid = $_POST['edid'];
	$objproduct->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objproduct->find_id() )
			{
				echo '{"type":"fail","message":"Item  Already Exists"}';
			}
			else
			{
				if($objproduct->insert()){
					echo '{"type":"success","message":"Item Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Item Not Saved Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objproduct->find_id() )
			{
				echo '{"type":"fail","message":"Item Already Exists"}';
			}
			else
			{
				if($objproduct->update()){
					echo '{"type":"success","message":"Item Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Item Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objproduct->deleteme()){
				echo '{"type":"success","message":"Item Deleted Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objproduct->view().'"}';
			
		}
		else if($method=='FindItem')
		{
			echo $objproduct->item_cat_list($objproduct->cat_id,'');
		}else if($method=='FindProductDetail')
		{
			echo json_encode($objproduct->item_details($objproduct->pcode));
			
		}else if($method=='updateproductin')
		{
			$ok=$objproduct->update_product_in();
			if($ok){
				echo '{"type":"success","message":"","data_id":"'.$objproduct->data_id.'"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='updateproductindetail')
		{
			$ok=$objproduct->update_product_in_detail();
			/*echo $ok;*/
			if($ok){
				echo '{"type":"success","message":"Data Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='ViewSerial')
		{
			$ok=$objproduct->view_serial();
			$response = [
				'type'   => 'success',
				'stk'	=> 100,//$objproduct->item_qoh($objproduct->pcode),
				'message' => $ok
				
			];
			echo json_encode($response);
		}
		else if($method=='ViewAllSerial')
		{
			$ok=$objproduct->view_all_serial();
			$response = [
				'type'   => 'success',
				'message' => $ok
				
			];
			echo json_encode($response);
		}else if($method=='DelbyBatch')
		{
			$ok=$objproduct->delete_all_serial_by_batch();
			$response = [
				'type'   => 'success',
				'message' => '"Data Deleted Successfully'
				
			];
			echo json_encode($response);
		}else if($method=='DelbySerial')
		{
			$ok=$objproduct->delete_serial();
			$response = [
				'type'   => 'success',
				'message' => '"Data Deleted Successfully'
				
			];
			echo json_encode($response);
		}
		else if($method=='UpdateSerial')
		{
			$ok=$objproduct->update_serial();
			/*echo $ok;*/
			if($ok){
				$response = [
				'type'   => 'success',
				'batch'   => $objproduct->batch,
				'message' => "Serial Updated"
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => "Something Went Wrong"
				];
			}
			
			echo json_encode($response);
		}else if($method=='Solution')
		{
			$ok=$objproduct->update_solution();
			if($ok){
				$response = [
				'type'   => 'success',
				'message' => "Solution Updated"
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => "Something Went Wrong"
				];
			}
			echo json_encode($response);
		}else if($method=='DeleteSolution')
		{
			$ok=$objproduct->delete_solution();
			/*echo $ok;*/
			if($ok){
				$response = [
				'type'   => 'success',
				'message' => "Solution Deleted"
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => "Something Went Wrong"
				];
			}
			echo json_encode($response);
		}else if($method=='Solution_client')
		{
			$ok=$objproduct->update_solution_client();
			/*echo $ok;*/
			if($ok){
				$response = [
				'type'   => 'success',
				'message' => "Solution Client Updated"
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => "Something Went Wrong"
				];
			}
			echo json_encode($response);
		}
		else if($method=='Solution_prob')
		{
			$ok=$objproduct->update_solution_prob();
			/*echo $ok;*/
			if($ok){
				$response = [
				'type'   => 'success',
				'message' => "Solution Problem Updated"
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => "Something Went Wrong"
				];
			}
			echo json_encode($response);
		}else if($method=='DeleteSolutionClient')
		{
			$ok=$objproduct->delete_solution_client();
			if($ok){
				$response = [
				'type'   => 'success',
				'message' => "Solution Client Deleted"
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => "Something Went Wrong"
				];
			}
			echo json_encode($response);
		}else if($method=='DeleteSolutionProb')
		{
			$ok=$objproduct->delete_solution_prob();
			if($ok){
				$response = [
				'type'   => 'success',
				'message' => "Solution Problem Deleted"
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => "Something Went Wrong"
				];
			}
			echo json_encode($response);
		}else if($method=='Solution_sol')
		{
			$ok=$objproduct->update_solution_sol();
			/*echo $ok;*/
			if($ok){
				$response = [
				'type'   => 'success',
				'message' => "Solution Details Updated"
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => "Something Went Wrong"
				];
			}
			echo json_encode($response);
		}else if($method=='Solution_wcu')
		{
			$ok=$objproduct->update_solution_wcu();
			/*echo $ok;*/
			if($ok){
				$response = [
				'type'   => 'success',
				'message' => "Solution Why Choose Us Updated"
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => "Something Went Wrong"
				];
			}
			echo json_encode($response);
		}else if($method=='Solution_faq')
		{
			$ok=$objproduct->update_solution_faq();
			/*echo $ok;*/
			if($ok){
				$response = [
				'type'   => 'success',
				'message' => "Solution FAQ Updated"
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => "Something Went Wrong"
				];
			}
			echo json_encode($response);
		}
		
    }else{
		echo '{"type":"fail","message":"Invalid Item"}';
	}

?>