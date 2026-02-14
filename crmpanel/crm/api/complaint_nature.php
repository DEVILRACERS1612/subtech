<?php 
require '../config/config.inc.php';
require '../Model/class.complaint_nature.php';
require '../Model/class.product.php';
require '../Model/class.category.php';
require '../Model/class.user.php';
require '../Model/class.sms.php';	

	$objcomplaint->rdate = date("Y-m-d H:i:s");
	$objcomplaint->complaint_nature = $_POST['complaint_nature'];
	
	$objcomplaint->csource = $db->filterVar($_POST['csource']);
	$objcomplaint->mobile = $db->filterVar($_POST['mobile']);
	$objcomplaint->mobile2 = $db->filterVar($_POST['mobile2']);
	$objcomplaint->cname = $db->filterVar($_POST['cname']);
	$objcomplaint->email = $db->filterVar($_POST['email']);
	$objcomplaint->address = $db->filterVar($_POST['address']);
	$objcomplaint->google_map_link = $db->filterVar($_POST['google_map_link']);
	$objcomplaint->defect = $db->filterVar($_POST['defect']);
	$objcomplaint->remark = $db->filterVar($_POST['remark']);
	$objcomplaint->serial_no = $db->filterVar($_POST['serial_no']);
	$objcomplaint->pfrom = $db->filterVar($_POST['pfrom']);
	$objcomplaint->amount = $db->filterVar($_POST['amount']);
	$objcomplaint->bank = $db->filterVar($_POST['bank']);
	$objcomplaint->branch = $db->filterVar($_POST['branch']);
	$objcomplaint->acno = $db->filterVar($_POST['acno']);
	$objcomplaint->acname = $db->filterVar($_POST['acname']);
	$objcomplaint->ifsc = $db->filterVar($_POST['ifsc']);
	$objcomplaint->upid = $db->filterVar($_POST['upid']);
	
	$objcomplaint->sono = $db->filterVar($_POST['sono']);
	$objcomplaint->priority = $db->filterVar($_POST['priority']);
	$objcomplaint->pdate = ($_POST['pdate']!="")?date("Y-m-d",strtotime($_POST['pdate'])):NULL;
	$objcomplaint->vdate = ($_POST['vdate']!="")?date("Y-m-d",strtotime($_POST['vdate'])):NULL;
	$objcomplaint->vtime = ($_POST['vtime']!="")?date("H:i:s",strtotime($_POST['vtime'])):NULL;
	
	$objcomplaint->cmpl_no = $db->filterVar($_POST['cmpl_no']);
	$objcomplaint->product = $db->filterVar($_POST['product']);
	$objcomplaint->tech = (is_array($_POST['tech']))?$_POST['tech']:$db->filterVar($_POST['tech']);
	
	$objcomplaint->image = $_FILES['image'];
	
	$objcomplaint->data_id = $db->filterVar($_POST['data_id']);
    $objcomplaint->edit_id = $db->filterVar($_POST['edit_id']);
	$objcomplaint->del_id = $db->filterVar($_POST['del_id']);
	$objcomplaint->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			/*echo '{"type":"fail","message":"'.$objcomplaint->insert().'"}';*/
			$ok=$objcomplaint->insert();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Complaint Nature Save Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Complaint Nature Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Edit')
		{
			$ok=$objcomplaint->update();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Complaint Nature Update Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Complaint Nature Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Delete')
		{
			if($objcomplaint->deleteme()){
				echo '{"type":"success","message":"Complaint Nature Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objcomplaint->view().'"}';
		}else if($method=='NewComplaint'){
			$ok=$objcomplaint->register_new_complaint();
			//echo $ok;
			/*echo '{"type":"success","cmpl_no":"'.$objcomplaint->cmpl_no.'","message":"'.$ok.'"}';*/
			if($ok==1){
				echo '{"type":"success","cmpl_no":"'.$objcomplaint->cmpl_no.'","message":"New Complaint Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Customer Already Exists"}';
			}else if($ok=='4'){
				echo '{"type":"fail","message":"Enter Customer Valid Mobile"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='SearchData'){
			$ok=$objcomplaint->search_complain_data();
			if($ok){
				$response = [
				'type'   => 'success',
				'cdetail' => $objcomplaint->cdata,
				'pdetail' => $objcomplaint->pdata
				];
			}else{
				$response = [
				'type'   => 'fail',
				'cdetail' => $objcomplaint->cdata,
				'pdetail' => $objcomplaint->pdata
				];
			}
			echo json_encode($response);
		}else if($method=='tech_assign'){
			$ok=$objcomplaint->tech_assign();

			if($ok){
				echo '{"type":"success","message":"Technician has been assigned Successful"}';
			}else{
				echo '{"type":"fail","message":"Something went wrong"}';
			}
		}else if($method=='assigned_detail'){
			$response = [
				'type'   => 'success',
				'message' => $objcomplaint->assigned_detail() 
			];
			echo json_encode($response);
		}else if($method=='rej_elect'){
			$response = [
				'type'   => 'success',
				'message' => $objcomplaint->rej_assigned_elect() 
			];
			echo json_encode($response);
		}else if($method=='accept_elect'){
			$response = [
				'type'   => 'success',
				'message' => $objcomplaint->accept_assigned_elect() 
			];
			echo json_encode($response);
		}else if($method=='cmpl_detail'){
			$row=$objcomplaint->complain_detail();
			$response = [
				'type'   => 'success',
				'defect' => $row['defect'] 
			];
			echo json_encode($response);
		}else if($method=='customer_detail'){
			$row=$objcomplaint->customer_detail($objcomplaint->mobile);
			$response = [
				'type'   => 'success',
				'cname' => $row['cname'],
				'mobile' => $row['mobile'],
				'mobile2' => $row['mobile2'],
				'address' => $row['address']
			];
			echo json_encode($response);
		}else if($method=='complain_detail'){
			$row=$objcomplaint->all_complain_detail();
			echo json_encode($row);
		}
		else if($method=='add_warranty'){
			$ok=$objcomplaint->add_warranty();
			if($ok==1){
				$response = [
				'type'   => 'success',
				'message' => "Warranty Updated Successful"
				];
			}else{
				$response = [
				'type'   => 'fail',
				'message' => "Product already Registered or Internal Error"
				];
			}
			echo json_encode($response);
		}else if($method=='CheckSerial'){
			$ok=$objcomplaint->check_serial();
			if($ok=='1'){
				$response = [
				'type'   => 'success',
				'product'   => $objcomplaint->product,
				'pfrom' => $objcomplaint->pfrom,
				'pdate' => $objcomplaint->pdate,
				'message' => "Warranty Updated Successful"
				];
			}else if($ok=='2'){
				$response = [
				'type'   => 'fail',
				'message' => "Serial No. Already allotted"
				];
			}else if($ok=='3'){
				$response = [
				'type'   => 'fail',
				'message' => "New"
				];
			}else{
				$response = [
				'type'   => 'fail',
				'message' => "Permission Error"
				];
			}
			echo json_encode($response);
		}else if($method=='FindCustomer'){
			$ok=$objcomplaint->customer_detail($objcomplaint->data_id);
			if($ok){
				$response = [
				'type'   => 'success',
				'mobile' => $ok['mobile'],
				'mobile2' => $ok['mobile2'],
				'name' => $ok['cname'],
				'email' => $ok['email'],
				'address' => $ok['address'],
				
				];
			}else{
				$response = [
				'type'   => 'fail',
				'message' => "New Customer"
				];
			}
			echo json_encode($response);
		}else if($method=='ViewEleCustomer'){
				$response = [
				'type'   => 'success',
				'message' => $objcomplaint->electrician_customer_list()
				];
			echo json_encode($response);
		}else if($method=='ViewCustomerPrd'){
				$response = [
				'type'   => 'success',
				'message' => $objcomplaint->customer_product_list()
				];
			echo json_encode($response);
		}else if($method=='VerifyCustomer'){
			if($objcomplaint->customer_verify()){
				$response = [
					'type'   => 'success',
					'message' => '<span class="alert alert-success">Verify and cashback distribution successfull</span>'
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => '<span class="alert alert-danger">Error! Verify and cashback distribution Fail </span>'
				];
			}
			echo json_encode($response);
		}else if($method=='RejectedCustomer'){
			if($objcomplaint->customer_rejected()){
				$response = [
					'type'   => 'success',
					'message' => '<span class="alert alert-success">Product Rejection Successfull</span>'
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => '<span class="alert alert-danger">Error! Rejection Fail </span>'
				];
			}
			echo json_encode($response);
		}else if($method=='ViewPayData'){
			$response = [
				'type'   => 'success',
				'message' => $objcomplaint->electrician_paydata()
			];
			echo json_encode($response);
		}else if($method=='BankDetail'){
			if($objcomplaint->update_bank_detail()){
				$response = [
					'type'   => 'success',
					'message' => '<span class="alert alert-success">Bank Detail Updated Successfull</span>'
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => '<span class="alert alert-danger">Error! Bank Detail Updatation Fail </span>'
				];
			}
			echo json_encode($response);
		}else if($method=='Pay'){
			if($objcomplaint->electrician_payment()){
				$response = [
					'type'   => 'success',
					'message' => '<span class="alert alert-success">Payment Successfull</span>'
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => '<span class="alert alert-danger">Error! Payment Fail </span>'
				];
			}
			echo json_encode($response);
		}else if($method=='ViewRefElec'){
			$response = [
				'type'   => 'success',
				'message' => $objcomplaint->view_ref_electrician()
			];
			echo json_encode($response);
		}else if($method=='RefVerify'){
			/*echo $objcomplaint->referral_verify();*/
			if($objcomplaint->referral_verify()){
				$response = [
					'type'   => 'success',
					'message' => '<span class="alert alert-success">Verify and cashback distribution successfull</span>'
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => '<span class="alert alert-danger">Error! Verify and cashback distribution Fail </span>'
				];
			}
			echo json_encode($response);
		}else if($method=='RefRejected'){
			if($objcomplaint->referral_rejected()){
				$response = [
					'type'   => 'success',
					'message' => '<span class="alert alert-success">Referral Rejection Successfull</span>'
				];
			}else{
				$response = [
					'type'   => 'fail',
					'message' => '<span class="alert alert-danger">Error! Rejection Fail </span>'
				];
			}
			echo json_encode($response);
		}
		
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>